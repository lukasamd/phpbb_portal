<?php

class Controller_Content extends Controller
{

    public function __construct()
    {
        parent::__construct();
        
        define('MODULE', 'content');
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
        $model = Registry::get('Model');
        $pagination = Registry::get('Pagination'); 
        $id = Input::get('id', '');
        
        if ($id)
        {
            if (!is_numeric($id))
            {
                $id = $model->URLs->getURL($id); 
                $id = (int) $id['url_id'];
            }
            
            $content = $model->Content->getContent($id);
            if (!empty($content))
            {
                foreach ($content as $content);
            }
             
            if (empty($content) || !SAC::checkAccess($content['access']))
            {
                $view->outputMessage('404');
            }
            

            $urls->zeroDuplicate('news', $content);
            $model->Content->updateViews($content['id']);
            $categories = $model->Category->getCategories($content['categories']);

            
            $content = array(
                'ID' => $content['id'],
                'URL' => $urls->buildUrl('content', $content),
                'TITLE' => stripslashes($content['title']),
                'CONTENT' => nl2br(stripslashes($content['content'])),
                'META' => stripslashes($content['content']),
                'IMAGE_EXIST' => (!empty($content['image'])),
                'IMAGE' => DIR_IMAGES . $content['image'],
                'TAGS' => $urls->buildTags($content['tags']),
                'CATEGORIES' => $urls->buildCategories($categories),
                'AUTHOR' => $content['author'],
                'TIME' => Core::$user->format_date($content['time']),
                'COMMENTS' => $content['comments'],
                'COMMENTS_VIEW' => $content['comments_view'],
                'COMMENTS_ALLOW' => $content['comments_allow'],
                'VIEWS' => $content['views'],
                'EDITLINK' => URLs::ACP('content', array('action=edit' , "id={$content['id']}")),
                'U_CAN_EDIT' => Core::$auth->acl_get('u_sg_portal_content'),
            );

            $view->setMeta('title', $content['TITLE']);
            $view->setMeta('description', trimlink($content['META'], 180));
            $view->setMeta('canonical', $content['URL']);
            $view->setOption('panels', 'news');

            $view->tpl->assign_vars($content);
            $view->tpl->set_filenames(array('body' => 'content_news.html'));
            $view->tpl->display('body');

            $comments = new Comments();
            $comments->setItem($content['ID']);
            $comments->setStatus(array('view' => $content['COMMENTS_VIEW'], 'allow' => $content['COMMENTS_ALLOW']));
            $comments->showComments();
        }
        else
        {
            if (!isset($_GET['page']) && count($_GET) > 0)
            {
                $view->outputMessage('404');
            }

        
            $urls->zeroDuplicate('index');
            $view->setOption('panels', 'index');
    
            $contents = $model->Content->getContent();
            if (empty($contents))
            {
                $view->outputMessage('404');
            }
            
            foreach ($contents as $content)
            {
                $categories = $model->Category->getCategories($content['categories']);
            
                $view->tpl->assign_block_vars('content', array(
                    'ID' => $content['id'],
                    'URL' => $urls->buildUrl('content', $content),
                    'TITLE' => stripslashes($content['title']),
                    'CONTENT' => stripslashes($content['content']),
                    'IMAGE_EXIST' => (!empty($content['image'])),
                    'IMAGE' => DIR_IMAGES . $content['image'],
                    'TAGS' => $urls->buildTags($content['tags']),
                    'CATEGORIES' => $urls->buildCategories($categories),
            
                    'AUTHOR' => $content['author'],
                    'TIME' => Core::$user->format_date($content['time']),
                    'DATETIME' => date('c', $content['time']),
                    'COMMENTS' => $content['comments'],
                    'COMMENTS_ALLOW' => $content['comments_allow'],
                    'VIEWS' => $content['views'],
                    'EDITLINK' => DIR_ACP . "news.php?action=edit&id={$content['id']}",
                ));
            }
            
            $model->Content->setOptions(array('count' => 1));
            $countElements = $model->Content->getContent();
            $pagination->generate(Config::getConfig('portal_news_display'), $countElements, 3, '', 'index');
            
            $view->tpl->assign_var('U_CAN_EDIT', Core::$auth->acl_get('u_site_news'));
            $view->tpl->set_filenames(array('body' => 'content_index.html'));
            $view->tpl->display('body');
        }

        $view->renderPage();
    }
    
}

