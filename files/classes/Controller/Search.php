<?php

class Controller_Search extends Controller
{

    public function __construct()
    {
        parent::__construct();
        define('MODULE', 'search');
    }

    public function execute()
    {
        $urls = Registry::get('URLs');
        $view = Registry::get('Theme');
        $model = Registry::get('Model');
        $pagination = Registry::get('Pagination'); 

        $view->setMeta('title', 'Wyszukiwanie');
        $view->setMeta('canonical', 'szukaj.html');
        $view->setOption('panels', 'search');

        // Initialize search system options
        $errorLength     = false;
        $countElements   = -1;
        $searchInContent = Input::get('searchInContent', '');
        $searchKeyword   = preg_replace('#[^a-z0-9-\s]#i', '', trim(Input::get('q', '')));
        $sortBy          = trim(Input::get('sortBy', 'time'));
        
        
        if (mb_strlen($searchKeyword) < 4)
        {
            $errorLength   = true;
        }
        else
        {
            $options_sort = array(
                'time' => 'time DESC',
                'title' => 'title ASC',
            );
            
            $sql_sort = 'time DESC';
            if (in_array($sortBy, array_keys($options_sort)))
            {
                $sql_sort = $options_sort[$sortBy];
            }
            
            
            $options = array(
                'search_in_content' => ($searchInContent) ? true : false,
                'keywords' => $searchKeyword,
            );
            
            
            // Get contents from search
            $model->Search->setOptions($options);
            $contents_ids = $model->Search->doSearch();
            
            $model->Content->setOptions(array('order' => $sql_sort));
            $contents = $model->Content->getContent($contents_ids);
            
            $countElements = 0;
            if (!empty($contents))
            {
                foreach ($contents as $content)
                {
                    $categories = $model->Category->getCategories($content['categories']);
                
                    $view->tpl->assign_block_vars('content', array(
                        'ID' => $content['id'],
                        'URL' => $urls->buildUrl('content', $content),
                        'TITLE' => stripslashes($content['title']),
                        'CONTENT' => html_entity_decode(stripslashes($content['meta'])),
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
                $countElements = $model->Content->getContent($contents_ids);
        
                $pagination->generate(Config::getConfig('portal_news_display'), $countElements, 3, $searchKeyword, 'search');
            }
        }

        $view->tpl->assign_vars(array(
            'FORM_ACTION'       => $urls->buildUrl('simple', 'Search'),
            'KEYWORD'           => $searchKeyword,
            'SORT_BY_TIME'      => ($sortBy == 'time'),
            'SORT_BY_TITLE'     => ($sortBy == 'title'),
            'SEARCH_IN_CONTENT' => $searchInContent,
            'ERROR_LENGTH'      => $errorLength,
            'NUM_RESULTS'       => $countElements,
        ));
        

        
        $view->tpl->set_filenames(array('body' => 'search.html'));
        $view->tpl->display('body');

        $view->renderPage();
    }
        



        // Default search option
        /*
        if (!isset($_POST['searchOptions']))
        {
            $_POST['searchOptions']['news'] = true;
        }

        // Data for search options
        $optionsData['program'] = array(
            'title'              => 'Programy',
            'table'              => DB_SOFTWARE,
            'type'               => 'program',
        );
        $optionsData['content'] = array(
            'title'                 => 'Aktualności',
            'table'                 => DB_CONTENT,
            'type'                  => 'news',
        );

        // Check if options are checked
        /*
        foreach ($optionsData as $name => $option)
        {
            $view->tpl->assign_block_vars('option', array(
                'TITLE'   => $option['title'],
                'NAME'    => $name,
                'CHECKED' => isset($_POST['searchOptions'][$name]),
            ));
        }
        */

        // If there is search action, make variables good!
        /*
        if ($searchAction)
        {
            if ($searchMode)
            {
                $searchLoops++;
                $searchOptions[] = $optionsData[$searchMode];
                unset($optionsData[$searchMode]);
            }
            elseif (isset($_POST['searchOptions']))
            {

                foreach ($_POST['searchOptions'] as $type => $val)
                {
                    if (isset($optionsData[$type]))
                    {
                        $searchLoops++;
                        $searchOptions[] = $optionsData[$type];
                        unset($optionsData[$type]);
                    }
                }
            }
            else
            {
                foreach ($optionsData as $option)
                {
                    $searchOptions[] = $option;
                }
                $searchLoops     = count($searchOptions);
                unset($optionsData);
            }

            $sortBy = trim(Input::get('sortBy', ''));
            if (!in_array($sortBy, array('time', 'title')))
            {
                $sortBy = 'time';
            }

            if (strlen($searchKeyword) < 4)
            {
                $errorLength   = true;
            }
            $searchKeyword = $this->Registry->db->sql_escape(utf8_clean_string($searchKeyword));
            
            // Clean $searchKeyword
            $searchKeyword = preg_replace('#[^a-z0-9-\s]#i', '', $searchKeyword);
        }

        $view->tpl->assign_vars(array(
            'FORM_ACTION'       => $urls->buildUrl('simple', 'Search'),
            'KEYWORD'           => $searchKeyword,
            'SORT_BY_TIME'      => ($sortBy == 'time'),
            'SORT_BY_TITLE'     => ($sortBy == 'title'),
            'SEARCH_IN_CONTENT' => $searchInContent,
            'ERROR_LENGTH'      => $errorLength,
        ));


        // Make a search action
        if ($searchAction)
        {
            $sql_where = '';
            $keywords = explode(' ', $searchKeyword);
            $sql_title = array_map(array($this,'keywordTitle'), $keywords);
            $sql_where = implode(' OR ', $sql_title);
            
            if ($searchInContent)
            {
                //$sql_where = " OR MATCH(content) AGAINST('" . $searchKeyword . "')";
                $sql_content = array_map(array($this,'keywordContent'), $keywords);
                $sql_content = implode(' OR ', $sql_content);
                
                $sql_where = "{$sql_where} OR {$sql_content}";
            }

        
            for ($iLoop = 0; $iLoop < $searchLoops; $iLoop++)
            {
                /*
                $sql = "SELECT COUNT(id) AS matches
				        FROM {$searchOptions[$iLoop]['table']}
					    WHERE MATCH(title) AGAINST('{$searchKeyword}')
				        {$sql_where}
					    ORDER BY {$sortBy}";
              
                
                $sql = "SELECT COUNT(id) AS matches
				        FROM {$searchOptions[$iLoop]['table']}
					    WHERE {$sql_where}
					    ORDER BY {$sortBy}";

                $result       = $this->Registry->db->sql_query($sql);
                $matchesCount = (int) $this->Registry->db->sql_fetchfield('matches');

                // Link for more only when there is more than 5 and other search options
                $sql_limit = '';
                $moreLink  = false;

                if ($matchesCount > 5 && $searchMode == '' && $searchLoops > 1)
                {
                    $matchesText  = '5 z ' . $matchesCount . ' wyników<br />';
                    $sql_limit    = ' LIMIT 5';
                    $matchesCount = 5;
                    $moreLink     = true;
                }
                elseif ($matchesCount > 0)
                {
                    $matchesText = $matchesCount . ' wyników';
                }
                else
                {
                    $matchesText = 'Brak wyników';
                }

                $view->tpl->assign_block_vars('type', array(
                    'TITLE'         => $searchOptions[$iLoop]['title'],
                    'TYPE'          => $searchOptions[$iLoop]['type'],
                    'SEARCH_MORE'   => $moreLink,
                    'MATCHES'       => $matchesText,
                    'MATCHES_COUNT' => $matchesCount,
                ));

                if ($matchesCount > 0)
                {
                    $sql_where = '';
                    if ($searchInContent)
                    {
                        $sql_where = " OR MATCH(content) AGAINST('" . $searchKeyword . "')";
                    }

                    $sql = "SELECT id, title, meta, url, time, comments
			                FROM {$searchOptions[$iLoop]['table']}
			  		        WHERE MATCH(title) AGAINST('{$searchKeyword}')
			  		        {$sql_where}
			  			    ORDER BY {$sortBy} {$sql_limit}";
                    $result = $this->Registry->db->sql_query($sql);

                    $data_matches = array();
                    while ($row = $this->Registry->db->sql_fetchrow($result))
                    {
                        $view->tpl->assign_block_vars('type.result', array(
                            'URL'      => $urls->buildUrl('Content', $row),
                            'TITLE'    => stripslashes($row['title']),
                            'TIME'     => Core::$user->format_date($row['time']),
                            'COMMENTS' => $row['comments'],
                            'META'     => html_entity_decode(stripslashes($row['meta'])),
                        ));
                    }
                }
            }
        }

        $view->tpl->set_filenames(array('body' => 'search.html'));
        $view->tpl->display('body');

        $view->renderPage();
    }

    
    
    private function keywordTitle($keyword)
    {
        return "(title LIKE '%{$keyword}%')";
    }
    
    private function keywordContent($keyword)
    {
        return "(content LIKE '%{$keyword}%')";
    }
    */

}