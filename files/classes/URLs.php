<?php



class URLs

{
    public $Model;


    /**

     * String - Url for urls creator method

     */

    private $url = '';



    /**

     * Bool -  enable or disable SEO urls

     */

    private $enableSEO;



    /**

     * Array -  All sings for SEO urls

     */

    private $signs = array(
        'comma' => ',',
        'ext' => '/',
        'index' => 'aktualnosci',
        'Company' => ',firma',
        'Gallery' => 'galeria',
        'Program' => 'program',
        'ProgramCat' => 'programy',
        'Category' => 'kategoria/',
        'Tag' => 'tag/',
        'Search' => 'szukaj/',
        
        'Simple' => array(
            'Program' => 'programy',
            'News' => 'newsy',
            'NewsCats' => 'kategorie',
            'Companies' => 'firmy',
            'Search'  => 'szukaj',

        ),

    );



    /**

     * Constructor - Set SEO urls status

     * 

     * @param $enableSEO Status of SEO in portal 

     */

    public function __construct($enableSEO = false)

    {

        $this->enableSEO = $enableSEO;

        $this->enableSEO = true;
        $this->Model = new Model_URLs();
    }



    /**

     * Parse string to url

     * 	 

     * @param $url String to parse

     * @return string Parsed string	 

     */

    public function parseUrl($url)

    {

        $chars['bad'] = array('Ę', 'Ó', 'Ą', 'Ś', 'Ł', 'Ż', 'Ź', 'Ć', 'Ń', 'ę', 'ó', 'ą', 'ś', 'ł', 'ż', 'ź', 'ć', 'ń');

        $chars['good'] = array('E', 'O', 'A', 'S', 'L', 'Z', 'Z', 'C', 'N', 'e', 'o', 'a', 's', 'l', 'z', 'z', 'c', 'n');



        $url = str_replace($chars['bad'], $chars['good'], $url);

        $url = preg_replace('#[^A-Za-z0-9]#', ' ', $url);

        $url = strtolower(trim($url));

        $url = preg_replace('#(\s)+#', '-', $url);



        return $url;

    }



    /**

     * Create URL according to portal standards

     * 	 

     * @param $type Type of URL to build

     * @param $row Type data

     * @param $pageStart Page for url

     * @param $seoForceDisable Force disable SEO URL (for ACP)

     * @return string Builded URL

     */

    public function buildUrl($type, $row, $pageStart = 0, $seoForceDisable = false)

    {

        global $page;



        $type = ucfirst($type);


        $seoStatus = $this->enableSEO;

        if ($seoForceDisable)

        {

            $seoStatus = false;

        }


        $urlPage = '';

        if ($pageStart > 0)

        {

            $urlPage = ($seoStatus) ? "{$pageStart}" : ('&amp;page=' . $pageStart);

        }



        switch ($type)

        {
            case 'Search':
                $row = (string) $row;
                $row = html_entity_decode($row);
                
                $urlPage = ($urlPage) ? "/{$urlPage}" : '';
                $urlBuilded = ($seoStatus) ? "{$this->signs[$type]}{$row}{$urlPage}{$this->signs['ext']}" : "index.php?module={$type}&amp;q={$row}{$urlPage}";
            break;
            

            case 'Index':

                if ($pageStart)

                {
                    $urlBuilded = ($seoStatus) ? "{$urlPage}{$this->signs['ext']}" : "index.php?module=Content{$urlPage}";

                }

                else

                {
                    $urlBuilded = ($seoStatus) ? '' : 'index.php';

                }

                break;



            case 'Content':
                $urlPage = ($urlPage) ? "/{$urlPage}" : '';
                $urlBuilded = ($seoStatus) ? "{$row['url']}{$urlPage}{$this->signs['ext']}" : "index.php?module={$type}&amp;id={$row['id']}{$urlPage}";
                break;



            case 'Gallery':
                $urlPage = ($urlPage) ? "/{$urlPage}" : '';
                $urlBuilded = ($seoStatus) ? "{$row['url']}{$urlPage}{$this->signs[$type]}{$row['cat_program']}{$this->signs['ext']}" : "index.php?module={$type}&amp;id={$row['cat_program']}{$urlPage}";
                break;
                
                
            case 'Category':
                $urlPage = ($urlPage) ? "/{$urlPage}" : '';
                $urlBuilded = ($seoStatus) ? "{$this->signs[$type]}{$row['cat_url']}{$urlPage}{$this->signs['ext']}" : "index.php?module={$type}&amp;id={$row['cat_id']}{$urlPage}";
                break;
                
            case 'Tag':
                $urlPage = ($urlPage) ? "/{$urlPage}" : '';
                $urlBuilded = ($seoStatus) ? "{$this->signs[$type]}{$row['tag_clean']}{$urlPage}{$this->signs['ext']}" : "index.php?module={$type}&amp;id={$row['tag_id']}{$urlPage}";
                break;



            case 'NewsCat':

            case 'ProgramCat':

            case 'Gallery':

                $urlBuilded = ($seoStatus) ? "{$row['cat_url']}{$urlPage}{$this->signs[$type]}{$row['cat_id']}{$this->signs['ext']}" : "index.php?module={$type}&amp;cat={$row['cat_id']}{$urlPage}";

                break;



            case 'Simple':

                $row = ucfirst($row);

                $urlBuilded = ($seoStatus) ? "{$this->signs['Simple'][$row]}{$this->signs['ext']}" : ('index.php?module=' . $row);

                break;



            default:
                if ($pageStart > 0)
        
                {
        
                    $urlPage = '&amp;page=' . $pageStart;
        
                }


                if (!strstr($type, '?'))

                {

                    $urlPage = str_replace('&amp;', '?', $urlPage);

                }

                $urlBuilded = $type . $urlPage;

                break;

        }
        
        return Config::getConfig('portal_url') . $urlBuilded;

    }



    /**

     * 301 Redirects on invalid URL

     * 	 

     * @param $type Type of URL to build

     * @param $row Type data

     */

    public function zeroDuplicate($type, $row = '')

    {

        return;



        if ($this->enableSEO)

        {

            $page = (isset($_GET['page'])) ? $_GET['page'] : '';

            $urlGood = $this->buildUrl($type, $row, $page);



            if (!strstr($_SERVER['REQUEST_URI'], $urlGood))

            {

                header('Location: ' . $urlGood, true, 301);

            }

        }

    }



    /**

     * Build pagination from data

     * 	 

     * @param $pageStart First, actual visiting page

     * @param $numPages Numer of elements to display on each page

     * @param $countElements Sum of elements

     * @param $range Numer of pages to display on left/right side

     * @param $data Type data

     * @param $type Type of building URLs

     * @return string Builded pagination

     */

    /*
    public function generatePagination($pageStart, $numPages, $countElements, $range = 0, $data, $type = '')

    {

        if ($countElements <= $numPages)

        {

            return;

        }



        $pagination = '';

        $countPages = ceil($countElements / $numPages);



        if ($countPages > 1)

        {

            $pageBefore = $pageStart - 1;

            $pageAfter = $pageStart + 1;



            $pagination = '<ul class="pagination">';



            // Beginning if there is smaller page than start

            if ($pageBefore > 0)

            {

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageBefore) . '">&lt;&lt;</a></li>';

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data) . '">1</a></li>';

            }

            else

            {

                $pagination .= '<li><b>1</b></li>';

            }



            // Select first page from the list

            $pageFrom = 2;

            if ($pageStart > ($range + 1))

            {

                $pageFrom = $pageStart - $range;

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageBefore) . '">...</a></li>';

            }



            // Select last page from the list

            $pageTo = $countPages;

            if (($countPages - $pageStart) > $range)

            {

                $pageTo = $pageStart + $range;

            }



            // Pages between start and end

            for ($pageFrom; $pageFrom <= $pageTo; $pageFrom++)

            {

                if ($pageFrom == $pageStart)

                {

                    $pagination .= '<li><b>' . $pageFrom . '</b></li>';

                }

                else

                {

                    $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageFrom) . '">' . $pageFrom . '</a></li>';

                }

            }



            // Ending if there is or isn't larger page

            if ($pageAfter < $countPages - $range)

            {

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageAfter) . '">...</a></li>';

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $countPages) . '">' . $countPages . '</a></li>';

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageAfter) . '">&gt;&gt;</a></li>';

            }

            elseif ($pageStart != $countPages && $pageTo < $countPages)

            {

                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $countPages) . '">' . $countPages . '</a></li>';

            }



            $pagination .= '</ul>';

        }



        echo $pagination;

    }



    /**

     * Create URL

     * 	 

     * @param $value URL data

     */

    public function newUrl($value = '')

    {

        if ($value == '')

        {

            $value = $_SERVER['REQUEST_URI'];

        }

        $this->url = $value;

    }



    /**

     * Add new parameter to URL

     * 	 

     * @param $name Parameter name

     * @param $val Parameter value

     */

    public function addToUrl($name, $val)

    {

        if (!strstr($this->url, '?'))

        {

            $this->url .= "?{$name}={$val}";

        }

        else

        {

            $this->url .= "&{$name}={$val}";

        }

    }



    /**

     * Get URL

     * 	 

     * @return string Created url

     */

    public function getUrl()

    {

        $url = $this->url;

        $this->url = '';



        return $url;

    }
    
    
    public static function ACP($name = '', $params = array(), $secure_link = false)
    {
        $secured_actions = array('edit', 'delete', 'save');
        $params_clean = array();

        if ($name == 'self')
        {
            $name = Input::get('p', '');
        }
        if ($name != '')
        {
            $params_clean['p'] = $name;
        }

        if (!empty($params))
        {
            foreach ($params as $param)
            {
                $data = explode('=', $param);
                if (isset($data[1]))
                {
                    $params_clean[$data[0]] = $data[1];
                } 
            }
        }
        
        // Add hash to link
        if ($secure_link || (isset($params_clean['action']) && in_array($params_clean['action'], $secured_actions)))
        {
            $page = Input::get('p', 'main');
            $params_clean['hash'] = generate_link_hash($page);
        }
        
        $link = Config::getConfig('portal_url') . 'acp/index.php?' . http_build_query($params_clean);
        return $link;
    }
    
    
    public function buildTags($tags)
    {
        
        if (empty($tags) || !is_array($tags))
        {
            return '';
        }
        
        $links = array();
        foreach ($tags as $tag)
        {
            $u_tag = $this->buildUrl('Tag', $tag);
            $links[] = '<a href="' . $u_tag . '">' . $tag['tag_tag'] . '</a>';
        }

        return implode(', ', $links);
    }
    
    
    public function buildCategories($categories)
    {
        
        if (empty($categories) || !is_array($categories))
        {
            return '';
        }
        
        $links = array();
        foreach ($categories as $category)
        {
            $links[] = '<a href="' . $category['cat_url'] . '">' . $category['cat_title'] . '</a>';
        }

        return implode(', ', $links);
    }



}