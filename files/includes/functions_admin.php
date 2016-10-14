<?php

if (!defined('IN_PHPBB'))
    exit;

function createthumbnail($filetype, $origfile, $thumbfile, $new_w, $new_h)
{
    if ($filetype == 1)
    {

        $origimage = imagecreatefromgif($origfile);
    }
    elseif ($filetype == 2)
    {

        $origimage = imagecreatefromjpeg($origfile);
    }
    elseif ($filetype == 3)
    {

        $origimage = imagecreatefrompng($origfile);
    }

    $old_x = imagesx($origimage);
    $old_y = imagesy($origimage);

    if ($old_x > $new_w || $old_y > $new_h)
    {

        if ($old_x < $old_y)
        {

            $thumb_w = round(($old_x * $new_h) / $old_y);
            $thumb_h = $new_h;
        }
        elseif ($old_x > $old_y)
        {

            $thumb_w = $new_w;
            $thumb_h = round(($old_y * $new_w) / $old_x);
        }
        else
        {

            $thumb_w = $new_w;
            $thumb_h = $new_h;
        }
    }
    else
    {

        $thumb_w = $old_x;
        $thumb_h = $old_y;
    }


    $thumbimage = imagecreatetruecolor($thumb_w, $thumb_h);
    $result = imagecopyresampled($thumbimage, $origimage, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
    touch($thumbfile);

    if ($filetype == 1)
    {

        imagegif($thumbimage, $thumbfile);
    }
    elseif ($filetype == 2)
    {

        imagejpeg($thumbimage, $thumbfile);
    }
    elseif ($filetype == 3)
    {

        imagepng($thumbimage, $thumbfile);
    }
}

function image_exists($dir, $image)
{

    $i = 1;
    $image_name = substr($image, 0, strrpos($image, "."));
    $image_ext = strrchr($image, ".");

    while (file_exists($dir . $image))
    {

        $image = $image_name . "_" . $i . $image_ext;

        $i++;
    }

    return $image;
}

// Create a list of files or folders and store them in an array
// You may filter out extensions by adding them to $extfilter as:
// $ext_filter = "gif|jpg"

function makefilelist($folder, $filter, $sort = true, $type = "files", $ext_filter = "")
{
    //$folder = substr($folder, 1);


    $res = array();
    $filter = explode("|", $filter);
    if ($type == "files" && !empty($ext_filter))
    {

        $ext_filter = explode("|", strtolower($ext_filter));
    }
    
    $temp = opendir($folder);
    while ($file = readdir($temp))
    {

        if ($type == "files" && !in_array($file, $filter))
        {
            if (!empty($ext_filter))
            {
                if (!in_array(substr(strtolower(stristr($file, '.')), +1), $ext_filter) && !is_dir($folder . $file))
                {
                    $res[] = $file;
                }
            }
            else
            {
                if (!is_dir($folder . $file))
                {
                    $res[] = $file;
                }
            }
        }
        elseif ($type == "folders" && !in_array($file, $filter))
        {
            if (is_dir($folder . $file))
            {
                $res[] = $file;
            }
        }
    }

    closedir($temp);

    if ($sort)
    {

        sort($res);
    }

    return $res;
}


// Create a selection list from an array created by makefilelist()
function makefileopts($files, $selected = "")
{
    $res = "<option value=''>Brak</option>";
    for ($i = 0; $i < count($files); $i++)
    {
        $sel = ($selected == $files[$i] ? " selected='selected'" : "");
        $res .= "<option value='" . $files[$i] . "'$sel>" . $files[$i] . "</option>\n";
    }

    return $res;
}


// Translate bytes into kB, MB, GB or TB by CrappoMan, lelebart fix
function parsebytesize($size, $digits = 2, $dir = false)
{

    global $locale;

    $kb = 1024;

    $mb = 1024 * $kb;

    $gb = 1024 * $mb;

    $tb = 1024 * $gb;

    if (($size == 0) && ($dir))
    {

        return $locale['global_460'];
    }
    elseif ($size < $kb)
    {

        return $size . $locale['global_461'];
    }
    elseif ($size < $mb)
    {

        return round($size / $kb, $digits) . $locale['global_462'];
    }
    elseif ($size < $gb)
    {

        return round($size / $mb, $digits) . $locale['global_463'];
    }
    elseif ($size < $tb)
    {

        return round($size / $gb, $digits) . $locale['global_464'];
    }
    else
    {

        return round($size / $tb, $digits) . $locale['global_465'];
    }
}


function makepagenav($start, $count, $total, $range = 0, $link = "")
{

    if ($link == "")
        $link = $_SERVER['PHP_SELF'] . "?";

    $res = "";

    $pg_cnt = ceil($total / $count);

    if ($pg_cnt > 1)
    {

        $idx_back = $start - $count;

        $idx_next = $start + $count;

        $cur_page = ceil(($start + 1) / $count);

        $res.="<table cellspacing='1' cellpadding='1' border='0' class='tbl-border' align='center'>\n<tr>\n";

        $res.="<td class='tbl2'><span class='small'>Strona $cur_page z $pg_cnt</span></td>\n";

        if ($idx_back >= 0)
        {

            if ($cur_page > ($range + 1))
                $res.="<td class='tbl2'><a class='small' href='$link" . "rowstart=0'>&lt;&lt;</a></td>\n";

            $res.="<td class='tbl2'><a class='small' href='$link" . "rowstart=$idx_back'>&lt;</a></td>\n";
        }

        $idx_fst = max($cur_page - $range, 1);

        $idx_lst = min($cur_page + $range, $pg_cnt);

        if ($range == 0)
        {

            $idx_fst = 1;

            $idx_lst = $pg_cnt;
        }

        for ($i = $idx_fst; $i <= $idx_lst; $i++)
        {

            $offset_page = ($i - 1) * $count;

            if ($i == $cur_page)
            {

                $res.="<td class='tbl1'><span class='small'><b>$i</b></span></td>\n";
            }
            else
            {

                $res.="<td class='tbl1'><a class='small' href='$link" . "rowstart=$offset_page'>$i</a></td>\n";
            }
        }

        if ($idx_next < $total)
        {

            $res.="<td class='tbl2'><a class='small' href='$link" . "rowstart=$idx_next'>&gt;</a></td>\n";

            if ($cur_page < ($pg_cnt - $range))
                $res.="<td class='tbl2'><a class='small' href='$link" . "rowstart=" . ($pg_cnt - 1) * $count . "'>&gt;&gt;</a></td>\n";
        }

        $res.="</tr>\n</table>\n";
    }

    return $res;
}


function buildIconLink($type, $link)
{

    $iconLink = $adds = '';

    switch ($type)
    {
        case 'edit':
            $img = '<img src="' . DIR_ICONS . 'icon_edit.png" alt="Edit" />';
            break;

        case 'delete':
            $adds = ' onClick="return ConfirmDelete();"';
            $img = '<img src="' . DIR_ICONS . 'icon_delete.png" alt="Delete" />';
            break;

        case 'allow':
            $img = '<img src="' . DIR_ICONS . 'icon_allow.png" alt="Allow" />';
            break;

        case 'look':
            $img = '<img src="' . DIR_ICONS . 'icon_look.png" alt="Look" />';
            break;

        case 'left':
            $img = '<img src="' . DIR_ICONS . 'icon_left.png" alt="Left" />';
            break;

        case 'right':
            $img = '<img src="' . DIR_ICONS . 'icon_right.png" alt="Right" />';
            break;
    }
    
    if ($link != '')
    {
        $iconLink = ' <a href="' . $link . '"' . $adds . '>' . $img . '</a> ';
    }

    return $iconLink;
}


function buildCommentLink($row)
{

    global $urls;

    $tmp['id'] = $row['comment_item_id'];
    $link = $urls->buildUrl('content', $tmp, 0, true);
    $link .= '#comment' . $row['comment_id'];

    return $link;
}


function countAlbumScreens($cat)
{

    global $db;

    static $cats_cache;



    // If there is not album cache, make it now

    if (!isset($cats_cache[$cat]))
    {

        $sql = 'SELECT cat, COUNT(id) AS count_photos 
            FROM ' . DB_PHOTOS . '
            GROUP BY cat';

        $result = $db->sql_query($sql);



        while ($row = $db->sql_fetchrow($result))
        {
            $cats_cache[$row['cat']] = $row['count_photos'];
        }
    }

    return $cats_cache[$cat];
}


// Synchronizacja tabeli komentarzy
function synchroComments()
{

    global $db;
    $sql = 'SELECT id FROM ' . DB_CONTENT;
    $result = $db->sql_query($sql);

    while ($row = $db->sql_fetchrow($result))
    {

        $comments = new Comments();
        $comments->setItem($row['id']);
        $comments->resyncCommentCounter();
    }

    return true;
}


/**
* Save tags for specific content
* 	 
*/
function sg_tags_set($content_id = 0, $tags = '')
{
    global $db, $phpbb_seo;
    
    $content_id = (int) $content_id;
    $tags_old = $tags_new = array();
    
    // Zapisac nowe tagi
    //$tags = preg_replace('#\s{2,}#is', '', $tags);
    $tags = explode(',', $tags);
    $tags = array_map('trim', $tags);
    $tags = array_map('strip_tags', $tags);
    $tags = array_map('htmlentities', $tags);
    
    foreach ($tags as $tag)
    {
        $sql_arr = array();
    
        $tag_clean = strtolower($tag);
        $tag_clean = $phpbb_seo->format_url($tag_clean);
        
        $sql = "SELECT tag_id FROM " . DB_TAGS . "
                WHERE tag_tag = '{$tag_clean}'";
        $result = $db->sql_query($sql);
        $tag_id = (int) $db->sql_fetchfield('tag_id');
        
        // Przygotowanie danych
        $tags_new[] = "'{$tag_clean}'";
        $sql_arr['tag_tag'] = $tag;
        $sql_arr['tag_clean'] = $tag_clean;
        
        // Konieczny do dodania
        if (!$tag_id)
        {
            $sql = 'REPLACE INTO ' . DB_TAGS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
            $db->sql_query($sql);  
            $tag_id = $db->sql_nextid();
        }
        else
        {
            $sql = 'UPDATE ' . DB_TAGS . ' SET ' . $db->sql_build_array('UPDATE', $sql_arr) . " WHERE tag_id = '{$tag_id}'";
            $db->sql_query($sql);  
        }
        
        unset($sql_arr);
        $sql_arr['tag_id'] = $tag_id;
        $sql_arr['content_id'] = $content_id;
        $sql = 'INSERT IGNORE INTO ' . DB_TAGS_RELATIONSHIPS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
    }
    
    // Pobrac id zbednych tagow
    $sql = "SELECT ttr.tag_id 
            FROM " . DB_TAGS_RELATIONSHIPS . " AS ttr
            INNER JOIN " . DB_TAGS . " AS tt USING (tag_id)
            WHERE tt.tag_clean NOT IN (" . implode(',', $tags_new) . ")
            AND ttr.content_id = '{$content_id}'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $tags_old[] = $row['tag_id'];    
    }
    
    // Usunac relacje
    if (!empty($tags_old))
    {
        $sql = "DELETE FROM " . DB_TAGS_RELATIONSHIPS . "
                WHERE content_id = '{$content_id}'
                AND tag_id IN (" . implode(',', $tags_old) . ")";
        $db->sql_query($sql);
        
        // Sprawdzic zbedne tagi
        // Pobieranie raz jeszcze, aby wiedziec ktore sa uzywane gdzie indziej
        $tags_to_delete = array();
        $sql = "SELECT tag_id FROM " . DB_TAGS_RELATIONSHIPS . "
                WHERE tag_id IN (" . implode(',', $tags_old) . ")";
        $result = $db->sql_query($sql);
        while ($row = $db->sql_fetchrow($result))
        {
            $tags_to_delete[] = $row['tag_id'];    
        }  
        $tags_to_delete = array_diff($tags_old, $tags_to_delete);
             
        // Usunac zbedne tagi
        if (!empty($tags_to_delete))
        {
            $sql = "DELETE FROM " . DB_TAGS . "
                    WHERE tag_id IN (" . implode(',', $tags_to_delete) . ")";
            $db->sql_query($sql);
        }
    }
    
    sg_tags_cleanup();
}


/**
* Cleanup tags - no relations, so delete tag
* 	 
*/
function sg_tags_cleanup()
{
    global $db;

    $sql = "DELETE FROM " . DB_TAGS_RELATIONSHIPS . "
            WHERE tag_id NOT IN (SELECT tag_id FROM " . DB_TAGS . ")";
    $db->sql_query($sql);
}


/**
* Get tags for specific content
* 	 
*/
function sg_tags_get($content_id)
{
    global $db;

    $content_id = (int) $content_id;
    $tags = array();
    
    $sql = "SELECT * FROM " . DB_TAGS . "
            WHERE tag_id IN (
                SELECT tag_id FROM " . DB_TAGS_RELATIONSHIPS . "
                WHERE content_id = '{$content_id}'
            )
            ORDER BY tag_clean ASC";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result))
    {
        $tags[] = $row['tag_tag'];    
    }
    
    return implode(',', $tags);
}

// TODO: DELETE?
/**
* Build link to ACP 
* 	 
*/
/*
function sg_acp_link($name = '')
{
    if ($name == '')
    {
        return DIR_ACP;
    }
    else
    {
        return DIR_ACP . 'index.php?page=' . $name;
    }
}
*/


/**
* Get categories for specific content
* 	 
*/
function sg_categories_get($content_id = 0)
{
    global $db;
    
    $content_id = (int) $content_id;
    $categories = array();
    
    // Delete old categories
    $sql = "SELECT category_id FROM " . DB_CATEGORIES_RELATIONSHIPS . "
            WHERE content_id = '{$content_id}'";
    $result = $db->sql_query($sql);
    
    while ($row = $db->sql_fetchrow($result))
    {
        $categories[] = $row['category_id'];
    }
    
    return $categories;
}


/**
* Set categories for specific content
* 	 
*/
function sg_categories_set($content_id = 0, $categories = array())
{
    global $db;
    
    $content_id = (int) $content_id;
    
    // Delete old categories
    $sql = "DELETE FROM " . DB_CATEGORIES_RELATIONSHIPS . "
            WHERE content_id = '{$content_id}'";
    $db->sql_query($sql);
    
    if (empty($categories))
    {
        return;
    }
    
    // Prepare & save categories
    $sql_arr['content_id'] = $content_id;
    $categories = array_map('intval', $categories);
    
    foreach ($categories as $category_id)
    {
        $sql_arr['category_id'] = $category_id;
        $sql = 'INSERT IGNORE INTO ' . DB_CATEGORIES_RELATIONSHIPS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
        $db->sql_query($sql);
    }
}


/**
* Set author for specific content
* 	 
*/
function sg_author_set($content_id = 0, $author = '')
{
    global $db;
    
    $author_id = (int) getAuthorId($author);
    $content_id = (int) $content_id;
    
    // Delete old data
    $sql = "DELETE FROM " . DB_CONTENT_AUTHORS . "
            WHERE content_id = '{$content_id}'";
    $db->sql_query($sql);

    // Prepare & save data
    $sql_arr = array(
        'content_id' => $content_id,
        'author_id' => $author_id,
        'author_name' => $author,
    );
    
    $sql = 'INSERT INTO ' . DB_CONTENT_AUTHORS . ' ' . $db->sql_build_array('INSERT', $sql_arr);
    $db->sql_query($sql);
}


/**
* Get author for specific content
* 	 
*/
function sg_author_get($content_id = 0)
{
    global $db;
    
    $sql = "SELECT * FROM " . DB_CONTENT_AUTHORS . " WHERE content_id = '{$content_id}'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    
    return ($row['author_id'] > 0) ? getAuthorName($row['author_id']) : $row['author_name'];
}


/**
* Delete content from database
* 	 
*/
function sg_content_delete($id)
{
    global $db;
    
    $id = (int) $id;
    
    // Delete content
    $sql = "DELETE FROM " . DB_CONTENT . " 
            WHERE id ={$id}";
    $db->sql_query($sql);
    
    // Delete comments
    $sql = "DELETE FROM " . DB_COMMENTS . "
            WHERE comment_item_id = {$id}
            AND comment_type = 'news'";
    $db->sql_query($sql);
    
    // Delete relations - authors
    $sql = "DELETE FROM " . DB_CONTENT_AUTHORS . "
            WHERE content_id = {$id}";
    $db->sql_query($sql);
    
    // Delete relations - authors
    $sql = "DELETE FROM " . DB_CATEGORIES_RELATIONSHIPS . "
            WHERE content_id = {$id}";
    $db->sql_query($sql);
    
    // Delete relations - urls
    $sql = "DELETE FROM " . DB_URLS . "
            WHERE url_id = {$id}";
    $db->sql_query($sql);
    
    // Delete relations - tags
    $sql = "DELETE FROM " . DB_TAGS_RELATIONSHIPS . "
            WHERE content_id = {$id}";
    $db->sql_query($sql);
    
    sg_tags_cleanup();
}