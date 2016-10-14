<?php
$pollVoted = false;

if (isset($_POST['pollVote'])) 
{
	$optionId = request_var('optionId', 0);
	$pollId = request_var('pollId', 0);

  if ($optionId > 0 && $pollId > 0)
  {
    $sql = "SELECT timeEnd  
            FROM " . DB_POLLS . " 
            WHERE id = '" . $pollId . "'";
    $result = $db->sql_query($sql);
  
    // Is the poll active?
    if (!$db->sql_fetchfield('timeEnd'))
    {
      $sql = "SELECT * 
              FROM " . DB_POLLS_VOTES . " 
              WHERE vote_poll = '" . $pollId . "'
              AND vote_ip = '" . Core::$user->ip . "'";
      $result = $db->sql_query($sql);
  
      // Osoba z tym adresem IP jeszcze nie glosowala w tej ankiecie
      if (!$db->sql_fetchrow($result))
      {
      	$sql_arr = array(
          'vote_poll' => $pollId,
          'vote_ip' => Core::$user->ip,
          'vote_vote' => $optionId,
          'vote_time'    => time(),
      	);
      	
      	$sql = 'INSERT INTO ' . DB_POLLS_VOTES . ' ' . $db->sql_build_array('INSERT', $sql_arr);
      	$db->sql_query($sql);
      	
      	$sql = "UPDATE " . DB_POLLS_OPTIONS . " 
                SET votes = votes + 1
                WHERE id = " . $optionId; 
      	$db->sql_query($sql);
  
        $pollVoted = true;
      }
    }
  }
}


// Jezeli glosowano, wybierany ankiete w ktorej oddano glos aby wyswietlic wyniki
$sql_poll_inject = ' ORDER BY RAND()';
if ($pollVoted)
{
  $sql_poll_inject = " AND id = '" . $pollId . "'";
}

$sql = "SELECT * FROM " . DB_POLLS . "
        WHERE timeEnd = '0' 
        " . $sql_poll_inject . "
        LIMIT 1";
$result = $db->sql_query($sql);
$pollData = $db->sql_fetchrow($result);

// Istnieje aktywna ankieta
if ($pollData) 
{
  // Sprawdzanie czy osoba o tym IP juz glosowala w tej ankiecie
  if (!$pollVoted)
  {
    $sql = "SELECT * 
            FROM " . DB_POLLS_VOTES . " 
            WHERE vote_poll = '" . $pollData['id'] . "'
            AND vote_ip = '" . Core::$user->ip . "'";
    $result = $db->sql_query($sql);
    if ($db->sql_fetchrow($result))
    {
      $pollVoted = true;
    }
  }
  
  // Get all vote options
  $pollOptions = array();
  $pollData['votes'] = 0;
  $sql = "SELECT * 
          FROM " . DB_POLLS_OPTIONS . " 
          WHERE poll = '" . $pollData['id'] . "'
          ORDER BY id";
  $result = $db->sql_query($sql);
  while ($row = $db->sql_fetchrow($result))
  {
    $pollOptions[$row['id']]['title'] = stripslashes($row['title']);  
    $pollOptions[$row['id']]['votes'] = $row['votes'];
    $pollOptions[$row['id']]['id'] = $row['id'];
    
    $pollData['votes'] += $row['votes']; 
  }

    
	$this->tpl->assign_vars(array(
		'FORM_ACTION' => $_SERVER['REQUEST_URI'],
		'POLL_TITLE' => $pollData['title'],
		'POLL_ID' => $pollData['id'],
		'POLL_VOTES' => $pollData['votes'],
		'POLL_START' => Core::$user->format_date($pollData['timeStart']),
		'POLL_END' => ($pollData['timeEnd']) ? Core::$user->format_date($pollData['timeEnd']) : false,
		'ALREADY_VOTED' => $pollVoted,
	)); 
	
  if ($pollVoted) 
  {
    foreach ($pollOptions as $option)
    {
			$this->tpl->assign_block_vars('option', array(
	      'ID' => $option['id'],
	      'TITLE' => $option['title'],
	      'PERCENT' => ($pollData['votes'] ? number_format(100 / $pollData['votes'] * $option['votes']) : 0),
				'VOTES' => $option['votes'],  
	    )); 
		}
	}   
  else 
  {
    foreach ($pollOptions as $option)
    {
	    $this->tpl->assign_block_vars('option', array(
	      'ID' => $option['id'],
	      'TITLE' => $option['title'],
	    )); 	
    }
	}
  
	$this->tpl->set_filenames(array('body' => 'section_poll.html'));
	$this->tpl->display('body');
}

?>