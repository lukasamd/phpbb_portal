<?php

class Controller_Program extends Controller
{

    public function __construct()
    {
        parent::__construct();

        define('MODULE', 'company');
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');

        $id = Input::get('id', 0);
        $cat = Input::get('cat', 0);

        if ($id)
        {
            $row = $model->Content->getCompany($id);
            if (!$row || !SAC::checkAccess($row['cat_access']))
            {
                redirect(URL_SITE);
            }

            $urls->zeroDuplicate('program', $row);
            $model->Content->updateViews($id);

            $content = array(
                'ID' => $row['id'],
                'URL' => $urls->buildUrl('program', $row),
                'TITLE' => stripslashes($row['title']),
                'CONTENT' => stripslashes($row['content']),
                'CAT' => $row['cat_id'],
                'CAT_TITLE' => $row['cat_title'],
                'CAT_URL' => $urls->buildUrl('programCat', $row),
                'TIME_ADD' => Core::$user->format_date($row['time_add']),
                'TIME' => Core::$user->format_date($row['time']),
                'COMMENTS' => $row['comments'],
                'COMMENTS_ALLOW' => $row['comments_allow'],
                'VIEWS' => $row['views'],
                'EDITLINK' => DIR_ACP . "programs.php?id={$row['id']}",
                //'A_CAN_EDIT' => Core::$auth->acl_get('u_site_programs'), 
                'GALLERY' => array(),
            );

            if ($row['gallery'])
            {
                $db = Registry::get('db');
                $sql = "SELECT *
  				FROM " . DB_ALBUMS . "
    			WHERE cat_id = '{$row['gallery']}'";
                $result = $db->sql_query($sql);
                $gallery = $db->sql_fetchrow($result);

                $view->tpl->assign_vars(array(
                    'GALLERY_URL' => $urls->buildUrl('Gallery', $gallery),
                    'GALLERY_ID' => $gallery['cat_id'],
                    'GALLERY_TITLE' => $gallery['cat_title'],
                    'GALLERY_DIR' => DIR_SCREENSHOTS . 'c' . $gallery['cat_id'] . '/',
                ));

                $sql = "SELECT *
  				FROM " . DB_PHOTOS . "
    			WHERE cat = '{$row['gallery']}'
          ORDER BY id
          LIMIT 1";
                $result = $db->sql_query($sql);
                $screen = $db->sql_fetchrow($result);

                $view->tpl->assign_vars(array(
                    'SCREEN_FILENAME' => $screen['filename'],
                    'SCREEN_THUMB1' => $screen['thumb1'],
                    'SCREEN_THUMB2' => $screen['thumb2'],
                    'SCREEN_TITLE' => stripslashes($screen['title']),
                    'SCREEN_TIME' => Core::$user->format_date($screen['time']),
                    'SCREEN_VIEWS' => $screen['views'],
                ));
            }

            $view->setMeta('title', $content['TITLE']);
            $view->setMeta('description', trimlink($row['meta'], 180));
            $view->setMeta('canonical', $content['URL']);
            $view->setOption('panels', 'program');

            $view->tpl->assign_vars($content);
            $view->tpl->assign_var('U_CAN_EDIT', Core::$auth->acl_get('u_site_news'));
            $view->tpl->set_filenames(array('body' => 'program_single.html'));
            $view->tpl->display('body');

            $comments = new Comments();
            $comments->setItem($id);
            $comments->setStatus(array('view' => $row['comments_view'], 'allow' => $row['comments_allow']));
            $comments->showComments();
        }
        else
        {
            $urls->zeroDuplicate('simple', 'program');

            $view->setMeta('title', 'Kategorie programów');
            $view->setMeta('description', 'Wszystkie kategorie programów.');
            $view->setMeta('canonical', 'programy.html');
            $view->setOption('panels', 'programCats');

            // Get main categories
            $categories = array();
            $model->Content->getCompanysCats();
            while ($row = $model->Content->fetchResultDB())
            {
                $categories[$row['cat_id']] = array(
                    'title' => stripslashes($row['cat_title']),
                    'description' => stripslashes($row['cat_desc']),
                    'url' => $urls->buildUrl('programCat', $row),
                    'subcats' => array(),
                );
            }

            // Get all subcategories
            $model->Content->getCompanysSubcats();
            while ($row = $model->Content->fetchResultDB())
            {
                $categories[$row['cat_parent']]['subcats'][] = array(
                    'title' => stripslashes($row['cat_title']),
                    'description' => stripslashes($row['cat_desc']),
                    'url' => $urls->buildUrl('programCat', $row),
                );
            }

            foreach ($categories as $category)
            {
                $view->tpl->assign_block_vars('cat', array(
                    'TITLE' => $category['title'],
                    'DESCRIPTION' => $category['description'],
                    'URL' => $category['url'],
                    'HAS_SUBCATS' => !empty($category['subcats']),
                ));

                foreach ($category['subcats'] as $subcat)
                {
                    $view->tpl->assign_block_vars('cat.subcat', array(
                        'TITLE' => $subcat['title'],
                        'DESCRIPTION' => $subcat['description'],
                        'URL' => $subcat['url'],
                    ));
                }
            }

            $view->tpl->set_filenames(array('body' => 'program_cat_list.html'));
            $view->tpl->display('body');
        }

        $view->renderPage();
    }

}