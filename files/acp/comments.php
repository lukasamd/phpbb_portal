<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_comments');


// Get data for GET / POST
$action = request_var('action', '');
$status = request_var('status', '');
$comment_id = request_var('comment_id', 0);
$comment_item_id = request_var('comment_item_id', 0);

$Registry->URLs->newUrl($FILE_SELF);
if ($comment_item_id)
{
    $comments = new Comments();
    $comments->setItem($comment_id);
    
    $Registry->URLs->addToUrl('comment_item_id', $comment_item_id);
}


// Obsluga informacji po wykonaniu operacji
$message = '';

switch ($status)
{
	case 'no_comment':
		$message = 'Taki komentarz nie istnieje!';
		break;

	case 'no_reported':
		$message = 'Brak komentarzy wymagających sprawdzenia.';
		break;

  case 'no_content';
		$message = 'Taki materiał nie istnieje!';
		break;

  case 'approve_ok':
    $message = 'Komentarz został zatwierdzony!';
		break;

	case 'delete_ok':
    $message = 'Komentarz został usunięty!';
		break;

	case 'save_ok':
		$message = 'Komentarz został zapisany!';
		break;

	case 'sync_ok':
    $message = 'Synchronizacja została przeprowadzona poprawnie!';
		break;

  default:
  	break;
}

if ($message)
{
	$theme->panelOpen('Informacja');
	echo '<div class="adminInfo"><strong>' . $message . '</strong></div>';
	$theme->panelClose();
}

switch ($action)
{
  // Delete all spam comments
  case 'delete_spam':
    $sql = 'DELETE FROM ' . DB_COMMENTS . '
            WHERE comment_spam = 1';
    $db->sql_query($sql);

    $Registry->URLs->addToUrl('status', 'delete_ok');
    redirect($Registry->URLs->getUrl());
  	break;


  // Delete one comment
  case 'delete':
    $comments->deleteComment($comment_id);

    $Registry->URLs->addToUrl('action', 'display');
    $Registry->URLs->addToUrl('status', 'delete_ok');
    redirect($Registry->URLs->getUrl());
  	break;


  // Sync all comments
  case 'sync':
    synchroComments();

    $Registry->URLs->addToUrl('status', 'sync_ok');
    redirect($Registry->URLs->getUrl());
  	break;


  // Approve comment
  case 'approve';
    $type = request_var('type', '');
    $sql = 'SELECT * FROM ' . DB_COMMENTS . '
            WHERE comment_id = ' . $comment_id . '
            AND comment_spam = 1';
    $result = $db->sql_query($sql);
    $comment_data = $db->sql_fetchrow($result);

    if ($comment_data)
    {
      $sql = 'UPDATE ' . DB_COMMENTS . '
              SET comment_spam = 0
              WHERE comment_id = ' . $comment_id;
      $db->sql_query($sql);

		  $comments = new Comments();
			$comments->setItem($comment_data['comment_item_id']);
			$comments->resyncCommentCounter();

      if ($type == 'spam')
      {
        $Registry->URLs->addToUrl('status', 'approve_ok');
        redirect($Registry->URLs->getUrl());
      }

      $Registry->URLs->addToUrl('action', 'display');
      $Registry->URLs->addToUrl('status', 'approve_ok');
      redirect($Registry->URLs->getUrl());
    }
    else
    {
      $Registry->URLs->addToUrl('status', 'no_comment');
			redirect($Registry->URLs->getUrl());
    }
  	break;


	// Edit comment
	case 'edit':
		$row = $comments->getCommentData($comment_id);

		if (!$row)
		{
      $Registry->URLs->addToUrl('action', 'display');
      $Registry->URLs->addToUrl('status', 'no_comment');
			redirect($Registry->URLs->getUrl());
		}
		decode_message($row['comment_message'], $row['comment_bbcode_uid']);


    $Registry->URLs->addToUrl('action', 'save');
    $Registry->URLs->addToUrl('comment_id', $comment_id);
		$theme->panelOpen('Edycja komentarza');
		?>
			<form name="inputform" method="post" action="<?php echo $Registry->URLs->getUrl(); ?>">
				<table align="center" cellpadding="2" cellspacing="0" class="tbl" width="400px">
      		<tr>
        		<td style="text-align:center"><textarea name="comment_message" rows="6" class="textbox" style="width:100%"><?php echo $row['comment_message']; ?></textarea></td>
      		</tr>
					<tr>
						<td align="left">
							<input type="button" value=" B " class="button" style="font-weight:bold; width: 30px;" onClick='addText("comment_message", "[b]", "[/b]");' />
							<input type="button" value=" i " class="button" style="font-style:italic; width: 30px;" onClick='addText("comment_message", "[i]", "[/i]");' />
							<input type="button" value=" u " class="button" style="text-decoration: underline; width: 30px;" onClick='addText("comment_message", "[u]", "[/u]");' />
          		<input type="button" value=" s " class="button" style="text-decoration: line-through; width: 30px;" onClick='addText("comment_message", "[s]", "[/s]");' />
          		<input type="button" value="URL" class="button" style="text-decoration: underline; width: 40px" onClick='addText("comment_message", "[url]", "[/url]");' />
          		<input type="submit" name="save_comment" value="Zapisz komentarz" class="button" style="float:right;" />
						</td>
					</tr>
				</table>
			</form>
		<?php
		$theme->panelClose();
		break;


  // Save comment
  case 'save':
    $comment_message = utf8_normalize_nfc(request_var('comment_message', '', true));
    $uid = $bitfield = $options = '';
    $allow_bbcode = $allow_urls = $allow_smilies = false;
    generate_text_for_storage($comment_message, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

    $sql_ary = array(
      'comment_message'			=> $comment_message,
    	'comment_bbcode_uid'		=> $uid,
    	'comment_bbcode_bitfield'		=> $bitfield
    );

    $sql = 'UPDATE ' . DB_COMMENTS . '
            SET ' . $db->sql_build_array('UPDATE', $sql_ary) . '
            WHERE comment_id = ' . $comment_id;
    $db->sql_query($sql);

    $Registry->URLs->addToUrl('action', 'display');
    $Registry->URLs->addToUrl('status', 'save_ok');
		redirect($Registry->URLs->getUrl());
  	break;


  // Display comments for content
	case 'display':
    $sql_where = "comment_item_id = '{$comment_item_id}'";
	$sql_where .= " AND comment_spam = '0'";
    $comments_num = dbCount(DB_COMMENTS, 'comment_id', $sql_where);

    if ($comments_num > 0)
    {
    	$theme->panelOpen('Komentarze dla tego materiału');
      ?>
        <table class="tbl-border" style="width:95%;text-align:center;">
	        <tr>
	          <th class="tbl2" style="width:15%" align="center">Autor</th>
	          <th class="tbl2">Wiadomość</th>
	          <th class="tbl2" style="width:90px" align="center">Opcje</th>
	        </tr>
      <?php

		  $sql = "SELECT tc.*, tu.user_id, tu.username, tu.username_clean, tu.user_colour
        FROM " . DB_COMMENTS . " AS tc
        LEFT JOIN " . USERS_TABLE . " AS tu ON tc.comment_name = tu.user_id
  		  WHERE comment_item_id = '" . $comment_item_id . "'
  		  AND comment_spam = '0'
  		  ORDER BY comment_datestamp DESC";
      $result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
        showCommentRow($row);
			}
			$db->sql_freeresult($result);

      ?>
        </table>
      <?php
			$theme->panelClose();
		}
		else
		{
      $Registry->URLs->addToUrl('status', 'no_content');
		  redirect($Registry->URLs->getUrl());
		}
		break;



  // Display comments by IP
	case 'ip':
    $comment_ip = request_var('comment_ip', '');
		$content_comments = dbCount(DB_COMMENTS, 'comment_id', "comment_ip = '{$comment_ip}'");

    if ($content_comments > 0)
    {
    	$theme->panelOpen("Komentarze dla adresu IP: {$comment_ip}");
      ?>
        <table class="tbl-border" style="width:95%;text-align:center;">
	        <tr>
	          <th class="tbl2" style="width:15%" align="center">Autor</th>
	          <th class="tbl2">Wiadomość</th>
	          <th class="tbl2" style="width:90px" align="center">Opcje</th>
	        </tr>
      <?php

		  $sql = "SELECT tc.*, tu.user_id, tu.username, tu.username_clean, tu.user_colour
        FROM " . DB_COMMENTS . " AS tc
        LEFT JOIN " . USERS_TABLE . " AS tu ON tc.comment_name = tu.user_id
  		  WHERE comment_ip = '{$comment_ip}'
  		  ORDER BY comment_datestamp DESC";
      $result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
        showCommentRow($row);
			}
			$db->sql_freeresult($result);

      ?>
        </table>
      <?php
			$theme->panelClose();
		}
		else
		{
      $Registry->URLs->addToUrl('status', 'no_content');
		  redirect($Registry->URLs->getUrl());
		}
		break;


  // Display reported comments
	case 'reported':
        $content_comments = dbCount(DB_COMMENTS, 'comment_id', "comment_reported = 1");

        if ($content_comments > 0)
        {
            $theme->panelOpen("Zgłoszone komentarze");
            ?>
            <table class="tbl-border" style="width:95%;text-align:center;">
                <tr>
                  <th class="tbl2" style="width:15%" align="center">Autor</th>
                  <th class="tbl2" style="width:15%" align="center">Zgłaszający</th>
                  <th class="tbl2">Wiadomość</th>
                  <th class="tbl2" style="width:90px" align="center">Opcje</th>
                </tr>
            <?php

            $sql = "SELECT tc.*, tu.user_id, tu.username, tu.username_clean, tu.user_colour
                    FROM " . DB_COMMENTS . " AS tc
                    LEFT JOIN " . USERS_TABLE . " AS tu ON tc.comment_name = tu.user_id
                    WHERE comment_reported = 1
                    ORDER BY comment_datestamp DESC";
            $result = $db->sql_query($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                showCommentRow($row, 'reported');
            }
            $db->sql_freeresult($result);

            ?>
            </table>
            <?php
            $theme->panelClose();
    	}
    	else
    	{
            $Registry->URLs->addToUrl('status', 'no_reported');
            redirect($Registry->URLs->getUrl());
    	}
    	break;


  // Display spam comments
  default:
    $theme->panelOpen('Podejrzane komentarze');

		$spam_comments = dbCount(DB_COMMENTS, 'comment_id', "comment_spam = '1'");

    if ($spam_comments > 0)
    {
		  $sql = "SELECT tc.*, tu.user_id, tu.username, tu.username_clean, tu.user_colour
        FROM " . DB_COMMENTS . " AS tc
        LEFT JOIN " . USERS_TABLE . " AS tu ON tc.comment_name = tu.user_id
  		  WHERE comment_spam = '1'
  		  ORDER BY comment_datestamp DESC";
      $result = $db->sql_query($sql);

      ?>
        <h3 class="center"><a href="<?php echo $Registry->URLs->getUrl(); ?>?action=delete_spam">Usuń cały wykryty spam</a></h3>
        <br />

        <table class="tbl-border" style="width:95%;text-align:center;">
	        <tr>
	          <th class="tbl2" style="width:15%" align="center">Autor</th>
	          <th class="tbl2">Wiadomość</th>
	          <th class="tbl2" style="width:90px" align="center">Opcje</th>
	        </tr>
      <?php

      while($row = $db->sql_fetchrow($result))
      {
        showCommentRow($row);
      }

      ?>
        </table>
      <?php
    }
    else
    {
      ?>
        <h3 class="center">Brak komentarzy wymagających sprawdzenia.</h3>
      <?php
    }
    ?>
      <br />
      <h4 class="center"><a href="<?php echo $Registry->URLs->getUrl(); ?>?action=sync">Wykonaj synchronizację komentarzy</a></h4>
    <?php
    $theme->panelClose();
  	break;
}





function showCommentRow($row, $type = '')
{
  global $FILE_SELF, $db, $user, $Registry;

  if ($type == 'reported')
  {
    $sql = "SELECT user_id, username, username_clean, user_colour
      FROM " . USERS_TABLE . "
  	  WHERE user_id = '{$row['comment_reported_by']}'";
    $result = $db->sql_query($sql);
    $reporter =  $db->sql_fetchrow($result);

  	if ($reporter)
  	{
  		$reporter['comment_name'] = get_username_string('full', $reporter['user_id'], $reporter['username'], $reporter['user_colour'], $reporter['username']);
  	}
  }

    $row['comment_smilies'] = false;
  $row['bbcode_options'] = (($row['comment_bbcode']) ? OPTION_FLAG_BBCODE : 0) + (($row['comment_smilies']) ? OPTION_FLAG_SMILIES : 0) + (($row['comment_magic_url']) ? OPTION_FLAG_LINKS : 0);
	$row['comment_message'] = generate_text_for_display($row['comment_message'], $row['comment_bbcode_uid'], $row['comment_bbcode_bitfield'], $row['bbcode_options']);

    $Registry->URLs->newUrl($FILE_SELF);
  $Registry->URLs->addToUrl('comment_item_id', $row['comment_item_id']);
	$returnLink = $Registry->URLs->getUrl();

	if (!$row['comment_guest'])
	{
		$row['comment_name'] = get_username_string('full', $row['user_id'], $row['username'], $row['user_colour'], $row['username']);
	}

	$row['link'] = buildCommentLink($row);

	?>
    <tr>
      <td class="tbl1" valign="top">
        <b><?php echo $row['comment_name']; ?></b>
        <br />
        <span class="small2">
      	<b>IP:</b> <a href="{$FILE_SELF}&action=ip&comment_ip=<?php echo $row['comment_ip']; ?>"><?php echo $row['comment_ip']; ?></a> &mdash; <a href="http://whois.domaintools.com/<?php echo $row['comment_ip']; ?>">WHOIS</a>
				<br />Data: <?php echo $user->format_date($row['comment_datestamp']); ?>
        </span>
      </td>

      <?php if ($type == 'reported') : ?>
        <td class="tbl1" valign="top">
          <b><?php echo $reporter['comment_name']; ?></b>
          <br /><span class="small2">Data: <?php echo $user->format_date($row['comment_reported_time']); ?></span>
        </td>
      <?php endif; ?>


      <td class="tbl1" valign="top"><?php echo $row['comment_message']; ?></td>
      <td class="tbl1" align="center" valign="top">
				<?php echo (!$row['comment_spam']) ? buildIconLink('look', URL_SITE . $row['link']) : ''; ?>
				<?php echo buildIconLink('edit', "{$returnLink}&comment_id={$row['comment_id']}&action=edit"); ?>
        <?php echo ($row['comment_spam']) ? buildIconLink('allow', $FILE_SELF . "?action=approve&comment_id={$row['comment_id']}&type=spam") : ''; ?>
				<?php echo buildIconLink('delete', "{$returnLink}&comment_id={$row['comment_id']}&action=delete"); ?>

      </td>
    </tr>
	<?php

}


require_once DIR_ACP . 'footer.php';
