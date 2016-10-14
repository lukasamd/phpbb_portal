<?php

class Controller_Program extends Controller
{

    public function __construct()
    {
        parent::__construct();

        define('MODULE', 'program');
        $model->Content = new Model_Program();
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');

        $id  = Input::get('id', 0);
        $cat = Input::get('cat', 0);

        if ($id)
        {
            $row = $model->Content->getProgram($id);
            if (!$row || !SAC::checkAccess($row['cat_access']))
            {
                redirect(Config::getConfig('portal_url'));
            }

            $urls->zeroDuplicate('program', $row);
            $model->Content->updateViews($id);


            $Model_Company = new Model_Company();
            $company       = $Model_Company->getCompany($row['company']);

            $Model_Files = new Model_Files();
            $res_files   = $Model_Files->getFilesByProgram($row['id']);
            while ($file        = $Model_Files->fetchResultDB())
            {
                $view->tpl->assign_block_vars('files', array(
                    'TITLE' => $file['title'],
                    'URL'   => $file['url'],
                ));
            }

            $content = array(
                'ID'      => $row['id'],
                'URL'     => $urls->buildUrl('program', $row),
                'TITLE'   => stripslashes($row['title']),
                'CONTENT' => stripslashes($row['content']),
                'COMPANY_NAME' => stripslashes($company['name']),
                'COMPANY_ID'   => stripslashes($company['id']),
                'COMPANY_URL'  => $urls->buildUrl('company', $company),
                'CAT'       => $row['cat_id'],
                'CAT_TITLE' => $row['cat_title'],
                'CAT_URL'   => $urls->buildUrl('programCat', $row),
                'TIME_ADD'  => Core::$user->format_date($row['time_add']),
                'TIME'      => Core::$user->format_date($row['time']),
                'VERSION'   => $row['version'],
                'COMMENTS'       => $row['comments'],
                'COMMENTS_ALLOW' => $row['comments_allow'],
                'VIEWS'          => $row['views'],
                'EDITLINK'       => DIR_ACP . "programs.php?id={$row['id']}",
                //'A_CAN_EDIT' => Core::$auth->acl_get('u_site_programs'), 
                'GALLERY'        => array(),
            );

            if ($row['gallery'])
            {
                $db      = Registry::get('db');
                $sql     = "SELECT *
            			FROM " . DB_ALBUMS . "
            			WHERE cat_id = '{$row['gallery']}'";
                $result  = $db->sql_query($sql);
                $gallery = $db->sql_fetchrow($result);

                $view->tpl->assign_vars(array(
                    'GALLERY_URL'   => $urls->buildUrl('Gallery', $gallery),
                    'GALLERY_ID'    => $gallery['cat_id'],
                    'GALLERY_TITLE' => $gallery['cat_title'],
                    'GALLERY_DIR'   => DIR_SCREENSHOTS . 'c' . $gallery['cat_id'] . '/',
                ));

                $sql    = "SELECT *
                        FROM " . DB_PHOTOS . "
                        WHERE cat = '{$row['gallery']}'
                        ORDER BY id
                        LIMIT 1";
                $result = $db->sql_query($sql);
                $screen = $db->sql_fetchrow($result);

                $view->tpl->assign_vars(array(
                    'SCREEN_FILENAME' => $screen['filename'],
                    'SCREEN_THUMB1'   => $screen['thumb1'],
                    'SCREEN_THUMB2'   => $screen['thumb2'],
                    'SCREEN_TITLE'    => stripslashes($screen['title']),
                    'SCREEN_TIME'     => Core::$user->format_date($screen['time']),
                    'SCREEN_VIEWS'    => $screen['views'],
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
            $comments->setStatus(array('view'  => $row['comments_view'], 'allow' => $row['comments_allow']));
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
            $model->Content->getProgramsCats();
            while ($row = $model->Content->fetchResultDB())
            {
                $categories[$row['cat_id']] = array(
                    'title'       => stripslashes($row['cat_title']),
                    'description' => stripslashes($row['cat_desc']),
                    'url'         => $urls->buildUrl('programCat', $row),
                    'subcats'     => array(),
                );
            }

            // Get all subcategories
            $model->Content->getProgramsSubcats();
            while ($row = $model->Content->fetchResultDB())
            {
                $categories[$row['cat_parent']]['subcats'][] = array(
                    'title'       => stripslashes($row['cat_title']),
                    'description' => stripslashes($row['cat_desc']),
                    'url'         => $urls->buildUrl('programCat', $row),
                );
            }

            foreach ($categories as $category)
            {
                $view->tpl->assign_block_vars('cat', array(
                    'TITLE'       => $category['title'],
                    'DESCRIPTION' => $category['description'],
                    'URL'         => $category['url'],
                    'HAS_SUBCATS' => !empty($category['subcats']),
                ));

                foreach ($category['subcats'] as $subcat)
                {
                    $view->tpl->assign_block_vars('cat.subcat', array(
                        'TITLE'       => $subcat['title'],
                        'DESCRIPTION' => $subcat['description'],
                        'URL'         => $subcat['url'],
                    ));
                }
            }

            $view->tpl->set_filenames(array('body' => 'program_cat_list.html'));
            $view->tpl->display('body');
        }

        $view->renderPage();
    }

}