<?php

class Theme
{

    public $options;
    public $meta;
    public $tpl;
    private $content;
    private $panels;

    public function __construct()
    {
        $this->Registry = Loader::load('Registry');
        $this->tpl = $this->Registry->template;

        $this->tpl->set_custom_template(DIR_TEMPLATES, 'SafeGroup');

        $this->options = array(
            'panels' => 'index',
            'width'  => 500,
        );
        $this->panels = array(
            'leftCount'   => 0,
            'rightCount'  => 0,
            'headerCount' => 0,
            'footerCount' => 0,
        );
        $this->meta = array(
            'title'       => '',
            'description' => '',
            'canonical'   => '',
        );
    }

    public function setMeta($type, $desc)
    {
        $this->meta[$type] = $desc;
    }

    public function setOption($type, $desc)
    {
        $this->options[$type] = $desc;
    }

    public function setTpl($tpl)
    {
        $this->tpl = $tpl;
    }

    public function renderPage()
    {
        global $db, $starttime, $urls, $config;

        $urls = Loader::load("URLs");

        $sql = "SELECT panel_name, panel_filename, panel_content, panel_side 
            FROM " . DB_PANELS . " 
    		WHERE panel_type = '" . $this->options['panels'] . "' 
            AND panel_status = 1  
            AND " . SAC::SQLWhere('panel_access') . "                                                          
            ORDER BY panel_order";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $this->panels[$row['panel_side']][] = $row;
            $this->panels[$row['panel_side'] . 'Count']++;
        }
        $db->sql_freeresult($result);

        $this->meta['title'] = ($this->meta['title'] != '') ? "{$this->meta['title']} - SafeGroup.pl" : Config::getConfig('portal_name');
        if ($this->meta['description'] == '')
        {
            $this->meta['description'] = Config::getConfig('portal_desc');
        }
        if ($this->meta['canonical'] != '')
        {
            $this->meta['canonical'] = str_replace('&amp;', '&', $this->meta['canonical']);
            $this->meta['canonical'] = Config::getConfig('portal_url') . $this->meta['canonical'];
        }

        // Add tpl filename for panels
        $this->tpl->set_filenames(array('panel' => 'section_main.html'));

        // Central page side
        $this->content = ob_get_clean();

        ob_start();
        if ($this->panels['headerCount'])
        {
            $this->outputPanels('header');
        }
        echo $this->content;
        if ($this->panels['footerCount'])
        {
            $this->outputPanels('footer');
        }
        $page_center = ob_get_clean();

        // Left page side
        ob_start();
        if ($this->panels['leftCount'])
        {
            $this->outputPanels('left');
        }
        else
        {
            $this->options['width'] += 230;
        }
        $page_left = ob_get_clean();

        // Right page side
        ob_start();
        if ($this->panels['rightCount'])
        {
            $this->outputPanels('right');
        }
        else
        {
            $this->options['width'] += 230;
        }
        $page_right = ob_get_clean();

        // Get debug informations data   
        $mtime        = explode(' ', microtime());
        $totaltime    = $mtime[0] + $mtime[1] - $starttime;
        $debug_output = sprintf('SQL: ' . $db->sql_num_queries() . ' | %.3fs', $totaltime);
        if ($memory_usage = memory_get_usage())
        {
            global $base_memory_usage;
            $memory_usage -= $base_memory_usage;
            $memory_usage = get_formatted_filesize($memory_usage);

            $debug_output .= ' | Mem: ' . $memory_usage;
        }

        $this->tpl->assign_vars(array(
            'IS_HOME_URL'         => isHomeURL(),
            'PORTAL_NAME'         => Config::getConfig('portal_name'),
            'DEBUG'               => $debug_output,
            'U_HOME'              => Config::getConfig('portal_url'),
            'U_FORUM'             => 'http://' . Config::getConfig('server_name'),
            'U_NEWS'              => $urls->buildUrl('Simple', 'News'),
            'U_PROGRAMS'          => $urls->buildUrl('Simple', 'Program'),
            'U_NEWS_CATS'         => $urls->buildUrl('Simple', 'News'),
            'DIR_THEME'           => DIR_THEME,
            'META_TITLE'          => $this->meta['title'],
            'META_DESCRIPTION'    => $this->meta['description'],
            'META_CANONICAL'      => $this->meta['canonical'],
            'GOOGLE_ANALYTICS_ID' => Config::getConfig('portal_analytics_id'),
            'PAGE_LEFT'           => $page_left,
            'PAGE_CENTER'         => $page_center,
            'PAGE_RIGHT'          => $page_right,
            'CENTER_WIDTH'        => $this->options['width'],
            'PANELS_HEADER'       => $this->panels['headerCount'],
            'PANELS_LEFT'         => $this->panels['leftCount'],
            'PANELS_RIGHT'        => $this->panels['rightCount'],
            
            'SEARCH_ACTION'       => $urls->buildUrl('simple', 'Search'),
        ));
        
        
        if (Core::$user->data['user_id'] != ANONYMOUS && !Core::$user->data['is_bot'])
        {
            $this->tpl->assign_vars(array(
                'S_USER_LOGGED_IN' => true,
                'UCP_USERNAME' => get_username_string('full', Core::$user->data['user_id'], Core::$user->data['username']),
                'UCP_URL_LOGOUT' => append_sid("ucp.php", 'mode=logout', true, Core::$user->session_id),
                'IS_ADMIN' => Core::$auth->acl_get('u_sg_portal_acp'),
                'DIR_ACP' => DIR_ACP . 'index.php',
            ));
        }

        $this->tpl->set_filenames(array('body' => 'main_body.html'));
        $this->tpl->display('body');

        // Clear cache and close connection with db
        garbage_collection();
    }

    public function outputPanels($type)
    {
        global $db, $phpEx, $phpbb_seo, $phpbb_root_path, $starttime, $config;

        $urls = Loader::load("URLs");

        for ($i = 0; $i < $this->panels["{$type}Count"]; $i++)
        {
            $filename = DIR_PANELS . "{$this->panels[$type][$i]['panel_filename']}/{$this->panels[$type][$i]['panel_filename']}.php";

            if ($this->panels[$type][$i]['panel_filename'] === '---')
            {
                $this->tpl->assign_vars(array(
                    'TITLE'   => $this->panels[$type][$i]['panel_name'],
                    'CONTENT' => stripslashes($this->panels[$type][$i]['panel_content']),
                ));
                $this->tpl->display('panel');
            }
            else
            {
                if (file_exists($filename))
                {
                    include($filename);
                }
            }
        }
    }

    public function panelOpen($title, $class = '')
    {
        ?>
        <div class="panel">
            <div class="panelTop"><?php echo $title ?></div>
            <div class="panelMain<?php echo $class; ?>">
        <?php
    }

    public function panelClose()
    {
        ?>
            </div>
            <div class="panelBottom"></div>
        </div>
        <?php
    }

    public function outputMessage($type = '', $message = '')
    {
        switch ($type)
        {
            case '403':
                header('HTTP/1.1 403 Forbidden');
                $message = "Brak dostepu";
                $this->meta['title'] = $message;
                break;

            case '404':
                header('HTTP/1.1 404 Not Found');
                $message = "Nie znaleziono strony";
                $this->meta['title'] = $message;
                break;
        }

        $this->options['panels'] = 'none';
        $this->tpl->assign_var('TYPE', $type);
        $this->tpl->assign_var('MESSAGE', $message);
        $this->tpl->set_filenames(array('body' => 'main_message.html'));
        $this->tpl->display('body');
        $this->renderPage();
        die();
    }
    
    public function outputXML($content)
    {
        header('Content-type: application/xml; charset="utf-8"');
        echo $content;
        die();
    }

}