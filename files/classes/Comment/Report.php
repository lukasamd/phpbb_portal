<?php

if (!defined('IN_PHPBB')) exit;





class Comment_Report extends Comments

{



  public function __construct()

  {

		parent::__construct();

		if (!defined('MODULE'))

		{

			define('MODULE', 'CommentReport');    

		}

  }



  public function execute()

  {

    if ($this->Registry->user->data['user_id'] == ANONYMOUS)

    {

        return;

    }

      

  	if (empty($this->comment))

  	{

			$this->comment['comment_id'] = $this->Registry->Input->get('commentId', 0);

		}



    $sql = "SELECT * FROM " . DB_COMMENTS . "

            WHERE comment_id = '{$this->comment['comment_id']}'";

    $result = $this->Registry->db->sql_query($sql);

    $dataComment = $this->Registry->db->sql_fetchrow($result);



    if (!$dataComment || $dataComment['comment_reported'])

    {

        return;

    }

    $this->item['id'] = $dataComment['comment_item_id'];



    if (!$this->isItemExist())

    {

        return;

    }



    $sql_arr = array(

        'comment_reported' => 1,

        'comment_reported_time' => TIME_NOW,

        'comment_reported_by' => $this->Registry->user->data['user_id'],

    );



    $sql = "UPDATE " . DB_COMMENTS . " 

        SET " . $this->Registry->db->sql_build_array('UPDATE', $sql_arr) . "

        WHERE comment_id = '{$this->comment['comment_id']}'";

    $this->Registry->db->sql_query($sql);





    if (!$this->item['ajax'])

    {

    	$redirect_url = $this->Registry->URLs->buildUrl('content', $this->item['data']);

    	$redirect_url .= "#comment{$this->comment['comment_id']}";

    	redirect($redirect_url); 

		}

		else

		{

			// Message for ok

		}

  }

}