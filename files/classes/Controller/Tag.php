<?php
class Controller_Tag extends Controller
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
        
        $tag = Input::get('url', '');
        $tag = $model->Tag->getTagByURL($tag);

        if (!$tag)
        {
            $view->outputMessage('404');
        }
        $urls->zeroDuplicate('Category', $tag);

        
        
        $tag['tag_tag'] = stripslashes($tag['tag_tag']);

        $view->tpl->assign_var('TAG_TITLE', $tag['tag_tag']);
        
        $view->setMeta('title', 'Materiały otagowane: ' . $tag['tag_tag']);
        //$view->setMeta('description', trimlink($tag['cat_desc'], 180));
        $view->setMeta('canonical', $urls->buildUrl('Tag', $tag));
        //$view->setOption('panels', 'newsCat');

        // Get contents from Tag
        $contents_ids = $model->Tag->getContents($tag['tag_id']);
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
                'CAT_URL' => $urls->buildUrl('Tag', $content),
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
        $pagination->generate(Config::getConfig('portal_news_display'), $countElements, 3, $tag, 'Tag');

        $view->tpl->set_filenames(array('body' => 'tag_list.html'));
        $view->tpl->display('body');

        $view->renderPage();
    }

}

