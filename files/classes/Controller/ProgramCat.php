<?php

class Controller_ProgramCat extends Controller
{

    public function __construct()
    {
        parent::__construct();

        define('MODULE', 'programCat');
        $model->Content = new Model_Program();
    }

    public function execute()
    {
        $urls       = Registry::get('URLs');
        $view       = Registry::get('Theme');
        $pagination = Registry::get('Pagination');

        $cat = Input::get('cat', 0);

        $content = $model->Content->getProgramCat($cat);


        if (!$content || !SAC::checkAccess($content['cat_access']))
        {
            redirect(Config::getConfig('portal_url'));
        }
        $urls->zeroDuplicate('program_cat', $content);

        // Is here parent cat info
        if ($content['cat_parent'])
        {
            $parent = $model->Content->getProgramCat($content['cat_parent']);

            if (!SAC::checkAccess($parent['cat_access']))
            {
                redirect(Config::getConfig('portal_url'));
            }
        }

        $urls->zeroDuplicate('programCat', $content);

        $content['cat_title'] = stripslashes($content['cat_title']);
        $content['cat_desc']  = stripslashes($content['cat_desc']);

        $view->tpl->assign_var('CAT_TITLE', $content['cat_title']);
        $view->tpl->assign_var('CAT_DESC', $content['cat_desc']);

        $view->setMeta('title', 'Programy z kategorii ' . $content['cat_title']);
        $view->setMeta('description', trimlink($content['cat_desc'], 180));
        $view->setMeta('canonical', $urls->buildUrl('programCat', $content));
        $view->setOption('panels', 'programCat');

        $model->Content->setDBSorting($content['cat_sorting']);
        $model->Content->getProgramsFromCat($cat);

        while ($element = $model->Content->fetchResultDB())
        {
            $view->tpl->assign_block_vars('element', array(
                'TITLE' => stripslashes($element['title']),
                'URL'   => $urls->buildUrl('program', $element),
                'META'  => stripslashes($element['meta']),
            ));
        }

        $view->tpl->set_filenames(array('body' => 'program_cat.html'));
        $view->tpl->display('body');

        $countElements = $model->Content->countProgramsFromCat($cat);
        $pagination->generate(Config::getConfig('portal_news_display'), $countElements, 3, $content, 'ProgramCat');

        $view->renderPage();
    }

}

