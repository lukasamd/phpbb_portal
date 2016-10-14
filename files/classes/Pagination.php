<?php

class Pagination extends URLs
{

    /**
     * Int - Page from GET
     */
    private $page;

    /**
     * Constructor - Set SEO urls status
     * 
     * @param $enableSEO Status of SEO in portal 
     */
    public function __construct()
    {
        parent::__construct();
        
        $Registry = Loader::load('Registry');
        $this->page = $Registry->Input->get('page', 0);
        if ($this->page == 0)
        {
            $this->page = 1;
        }
    }

    /**
     * Get current page
     * 
     * @return int Current page number
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get page for sql
     * 
     * @return int Current page for SQL
     */
    public function getPageSQL($pages)
    {
        $start = ($this->page - 1) * $pages;
        return "{$start},{$pages}";
    }

    /**
     * Build pagination from data
     * 	 
     * @param $numPages Numer of elements to display on each page
     * @param $countElements Sum of elements
     * @param $range Numer of pages to display on left/right side
     * @param $data Type data
     * @param $type Type of building URLs
     * @return string Builded pagination
     */
    public function generate($numPages, $countElements, $range = 0, $data, $type = '')
    {
        $view = Registry::get('Theme');
        
        
        if ($countElements <= $numPages)
        {
            return;
        }

        $pagination = '';
        $countPages = ceil($countElements / $numPages);

        if ($countPages > 1)
        {
            $pageBefore = $this->page - 1;
            $pageAfter = $this->page + 1;

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
            if ($this->page > ($range + 1))
            {
                $pageFrom = $this->page - $range;
                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageBefore) . '">...</a></li>';
            }

            // Select last page from the list
            $pageTo = $countPages;
            if (($countPages - $this->page) > $range)
            {
                $pageTo = $this->page + $range;
            }

            // Pages between start and end
            for ($pageFrom; $pageFrom <= $pageTo; $pageFrom++)
            {
                if ($pageFrom == $this->page)
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
            elseif ($this->page != $countPages && $pageTo < $countPages)
            {
                $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $countPages) . '">' . $countPages . '</a></li>';

                if ($this->page != $countPages)
                {
                    $pagination .= '<li><a href="' . $this->buildUrl($type, $data, $pageAfter) . '">&gt;&gt;</a></li>';
                }
            }

            $pagination .= '</ul>';
            
        }
        
        $view->tpl->assign_var('PAGINATION', $pagination);
        return $pagination;
    }

}