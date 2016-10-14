<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_content');

// Get data for GET / POST
$id     = request_var('id', 0);
$cat    = request_var('cat', 0);
$action = request_var('action', '');
$status = request_var('status', '');
$show   = request_var('show', 'normal');

// Messages
if ($status)
{
    if ($status == 'updated')
    {
        $message = '<strong>Wpis został zaktualizowany!</strong>';
    }
    else if ($status == 'added')
    {
        $message = '<strong>Wpis został dodany!</strong>';
    }
    else if ($status == 'deleted')
    {
        $message = '<strong>Wpis został usunięty!</strong>';
    }
    else if ($status == 'published')
    {
        $message = '<strong>Wpis został opublikowany!</strong>';
    }
    $theme->panelOpen('Informacja');
    echo '<div class="adminInfo">' . $message . '</div>';
    $theme->panelClose();
}

$options['draft'] = 0;
if ($show == 'draft')
{
    $options['draft'] = 1;
}
if ($show == 'trash')
{
    $options['trash'] = 1;
}
if ($show == 'normal')
{
    $options['trash'] = 0;
    $options['draft'] = 0;
}
$formAction = "{$FILE_SELF}&show={$show}";

switch ($action)
{
    case 'delete':
        $sql    = "SELECT trash FROM " . DB_CONTENT . "
            WHERE id = {$id}";
        $result = $db->sql_query($sql);
        $row    = $db->sql_fetchrow($result);
        // Move to trash
        if ($row['trash'] == 0)
        {
            $sql = "UPDATE " . DB_CONTENT . "
    					SET trash = 1 
    					WHERE id = {$id}";
            $db->sql_query($sql);
        }
        // Parmament delete
        else
        {
            sg_content_delete($id);
            $sql = "DELETE FROM " . DB_CONTENT . "
                WHERE id ={$id}";
            $db->sql_query($sql);
            $sql = "DELETE FROM " . DB_COMMENTS . "
                WHERE comment_item_id = {$id}
                AND comment_type = 'news'";
            $db->sql_query($sql);
        }
        redirect("{$formAction}&status=deleted");
        break;

    case 'publish':
        $sql = "UPDATE " . DB_CONTENT . "
  					SET draft = 0 
  					WHERE id = {$id}";
        $db->sql_query($sql);
        redirect("{$formAction}&status=published");
        break;
    default:
        break;
}
$editlist = '';
$selected = '';

$theme->panelOpen('Lista wpisów');
$countNormal = dbCount(DB_CONTENT, 'id', 'draft <> 1 AND trash <> 1');
$countDraft  = dbCount(DB_CONTENT, 'id', 'draft = 1');
$countTrash  = dbCount(DB_CONTENT, 'id', 'trash = 1');
?>





<ul style="float:left; list-style-type:none; margin:10px 0;padding:0;">
    <li style="display:inline-block; padding-right:10px; border-right:1px solid #000;">
        <?php if ($show != 'normal'): ?><a href="<?php echo URLs::ACP('self', array("show=normal")); ?>"><?php endif; ?>Opublikowane (<?php echo $countNormal; ?>)<?php if ($show != 'normal'): ?></a><?php endif; ?>
    </li>
    <li style="display:inline-block; padding-right:10px; margin-left:5px; border-right:1px solid #000;">
        <?php if ($show != 'draft'): ?><a href="<?php echo URLs::ACP('self', array("show=draft")); ?>"><?php endif; ?>Szkice (<?php echo $countDraft; ?>)<?php if ($show != 'draft'): ?></a><?php endif; ?>
    </li>
    <li style="display:inline-block; padding-right:10px; margin-left:5px;">
        <?php if ($show != 'trash'): ?><a href="<?php echo URLs::ACP('self', array("show=trash")); ?>"><?php endif; ?>Kosz (<?php echo $countTrash; ?>)<?php if ($show != 'trash'): ?></a><?php endif; ?>
    </li>
</ul>
<div style="float:right">
    <a href="<?php echo URLs::ACP('content'); ?>" class="button">Dodaj nowy wpis</a>
</div>

<table align="center" cellpadding="0" cellspacing="0" width="850px">
    <tr>
        <th>Tytuł</th>
        <th>Autor</th>
        <th>Kategoria</th>
        <th>Data</th>
        <th>Opcje</th>
    </tr>  
<?php
$i = 0;

$Model = new Model_Content();
$Model_Category = new Model_Category();
$Model->setOptions($options);
$contents = $Model->getContent();



foreach ($contents as $id => $content)
{
    $class = ($i % 2) ? 'tbl1' : 'tbl2';
    $u_edit = URLs::ACP('content', array('action=edit' , "id={$id}"));
    $u_delete = URLs::ACP('content_list', array('action=delete' , "id={$id}"));
    $u_publish = URLs::ACP('content_list', array('action=publish' , "id={$id}"));
    $img_edit    = buildIconLink('edit', $u_edit);
    $img_delete  = buildIconLink('delete', $u_delete);
    $img_publish = ($show == 'draft') ? buildIconLink('allow', $u_publish) : '';
    ?>
    <tr>
        <td class="<?php echo $class; ?>">
            <a href="<?php echo $u_edit; ?>"><?php echo stripslashes($content['title']); ?></a>
            <?php if ($content['draft']) echo '<em>(Szkic)</em>'; ?>
            <?php if ($content['trash']) echo '<em>(W koszu)</em>'; ?>
        </td>
        <td class="<?php echo $class; ?>"><?php echo $content['author']; ?></td>
        <td class="<?php echo $class; ?>">
            <?php 
            $categories = $Model_Category->getCategories($content['categories']);
            
            foreach ($categories as $cat_id => $category)
            {
                $cat_url = URLs::ACP('categories', array("action=edit", "cat_id={$cat_id}"));
                ?>
                    <a href="<?php echo $cat_url; ?>"><?php echo stripslashes($category['cat_title']); ?></a><br />
                <?php
            }
            ?>
        </td>
        <td class="<?php echo $class; ?>"><?php echo $user->format_date($content['time']); ?></td>
        <td class="<?php echo $class; ?>">
            <?php echo $img_publish . $img_edit . $img_delete; ?>
        </td>
    </tr>
    <?php
    $i++;
}
?>
</table>
<?php


$Model->setOptions(array('count' => 1));
$countElements = $Model->getContent();
echo $Registry->Pagination->generate(10, $countElements, 3, '', $formAction);

$theme->panelClose();
