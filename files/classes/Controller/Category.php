<?php
class Controller_Category extends Controller
{

    public function __construct()
    {
        parent::__construct();
        
        define('MODULE', 'newsCat');
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
        $model = Registry::get('Model');
        $pagination = Registry::get('Pagination'); 
        
        $cat = Input::get('url', '');
        $category = $model->Category->getCategoryByURL($cat);

        if (!$category)
        {
            $view->outputMessage('404');
        }
        $urls->zeroDuplicate('Category', $category);
        
        
        $category['cat_title'] = stripslashes($category['cat_title']);
        $category['cat_desc'] = stripslashes($category['cat_desc']);

        $view->tpl->assign_var('CAT_TITLE', $category['cat_title']);
        $view->tpl->assign_var('CAT_DESC', $category['cat_desc']);
        
        $view->setMeta('title', 'Newsy z kategorii ' . $category['cat_title']);
        $view->setMeta('description', trimlink($category['cat_desc'], 180));
        $view->setMeta('canonical', $urls->buildUrl('Category', $category));
        //$view->setOption('panels', 'newsCat');
        
        
        // Get contents from category
        $contents_ids = $model->Category->getContents($category['cat_id']);
        $contents = $model->Content->getContent($contents_ids);

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
                
                /*
                'CAT' => $content['cat_id'],
                'CAT_TITLE' => $content['cat_title'],
                'CAT_URL' => $urls->buildUrl('category', $content),
                */
                
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
        $countElements = $model->Content->getContent($contents_ids);
        $pagination->generate(Config::getConfig('portal_news_display'), $countElements, 3, $category, 'Category');

        $view->tpl->set_filenames(array('body' => 'category_list.html'));
        $view->tpl->display('body');

        $view->renderPage();
    }

}

