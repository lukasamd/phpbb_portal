<?php
if (!defined('IN_PHPBB')) exit;
SAC::checkPageAccess('u_sg_portal_settings');

// Zapis ustawien do bazy danych
if (isset($_POST['savesettings']))
{
    $vars = array(
        'portal_name', 'portal_url', 'portal_email', 'portal_email_author',
        'portal_desc', 'portal_news_display', 'portal_thumb_w', 'portal_thumb_h',
        'portal_photo_w', 'portal_photo_h', 'portal_thumbs_per_row', 'portal_thumbs_per_page',
        'portal_photo_max_b', 'portal_guestposts', 'portal_akismet_portal', 'portal_akismet_forum', 'portal_akismet_key',
        'portal_sblam_portal', 'portal_sblam_forum', 'portal_sblam_key',
        'portal_censor_enabled'
    );
    foreach ($vars as $var)
    {
        if (isset($_POST[$var]))
        {
            if ($_POST[$var] == 'on')
            {
                $_POST[$var] = 1;
            }
        }
        else
        {
            $_POST[$var] = 0;
        }
        set_config($var, $_POST[$var]);
    }
    redirect("{$FILE_SELF}&akcja=zapisano");
}

$theme->panelOpen('Ustawienia witryny');
if (isset($_GET['akcja']) && $_GET['akcja'] == 'zapisano')
{
    echo '<h2 class="center">Ustawienia zostały zapisane</h2><br />';
}
?>
<form name="settingsform" method="post" action="<?php echo $FILE_SELF; ?>">
    <table align="center" cellpadding="0" cellspacing="0" width="75%">
        <tr>
            <td width="50%" class="tbl2">Nazwa strony:<br /><span class="small">Określa główną nazwę portalu.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_name" value="<?php echo $config["portal_name"]; ?>" maxlength="255" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td width="50%" class="tbl2">Adres strony:<br /><span class="small">Określa główny adres portalu - link bazowy dla innych plików np. css, js.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_url" value="<?php echo $config["portal_url"]; ?>" maxlength="255" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td width="50%" class="tbl2">Adres email:<br /><span class="small">Adres email-kontaktowy dla wysyłki mailingu.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_email" value="<?php echo $config["portal_email"]; ?>" maxlength="128" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td width="50%" class="tbl2">Nadawca email:<br /><span class="small">Adres email-nadawca dla wysyłki mailingu.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_email_author" value="<?php echo $config["portal_email_author"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Opis strony:<br /><span class="small">Opis strony głównej oraz innych podstron bez wprowadzonej treści dla pól typu meta, dodawany automatycznie.</span></td>
            <td width="50%" class="tbl2"><textarea name="portal_desc" rows="5" class="textbox" style="width:95%;"><?php echo $config["portal_desc"]; ?></textarea></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Newsów na stronie głównej:<br /><span class="small">Ilość aktualności jaka ma być wyświetlana na stronie głównej.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_news_display" value="<?php echo $config["portal_news_display"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Szerokość miniaturki [px]:<br /><span class="small">Szerokość automatycznie tworzonej miniaturki obrazka w pikselach.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_thumb_w" value="<?php echo $config["portal_thumb_w"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr> 
        <tr>
            <td valign="top" width="50%" class="tbl2">Wysokość miniaturki [px]:<br /><span class="small">Wysokość automatycznie tworzonej miniaturki obrazka w pikselach.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_thumb_h" value="<?php echo $config["portal_thumb_h"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>       
        <tr>
            <td valign="top" width="50%" class="tbl2">Szerokość screena [px]:<br /><span class="small">Szerokość screena podczas wyświetlania w galerii programu.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_photo_w" value="<?php echo $config["portal_photo_w"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr> 
        <tr>
            <td valign="top" width="50%" class="tbl2">Wysokość screena [px]:<br /><span class="small">Wysokość screena podczas wyświetlania w galerii programu.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_photo_h" value="<?php echo $config["portal_photo_h"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Max. szerokość uploadowanego screena [px]:<br /><span class="small">Maksymalna szerokość screena dodawanego do galerii w pikselach.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_photo_max_w" value="<?php echo $config["portal_photo_max_w"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr> 
        <tr>
            <td valign="top" width="50%" class="tbl2">Max. wysokość uploadowanego screena [px]:<br /><span class="small">Maksymalna szerokość screena dodawanego do galerii w pikselach.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_photo_max_h" value="<?php echo $config["portal_photo_max_h"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>      
        <tr>
            <td valign="top" width="50%" class="tbl2">Kolumn miniatur w albumie:</td>
            <td width="50%" class="tbl2"><input type="text" name="portal_thumbs_per_row" value="<?php echo $config["portal_thumbs_per_row"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr> 
        <tr>
            <td valign="top" width="50%" class="tbl2">Ilość miniatur w albumie:</td>
            <td width="50%" class="tbl2"><input type="text" name="portal_thumbs_per_page" value="<?php echo $config["portal_thumbs_per_page"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Max. wielkość pliku screena [KB]:<br /><span class="small">Maksymalna wielkość uploadowanego pliku screena podana w kilobajtach.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_photo_max_b" value="<?php echo $config["portal_photo_max_b"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>              
        <tr>
            <td valign="top" width="50%" class="tbl2">Zezwolenie na komentarze:<br /><span class="small">Określa globalnie, czy komentowanie materiałów ma być możliwe.</span></td>
            <td width="50%" class="tbl2"><input type="checkbox" name="portal_guestposts"<?php echo ($config['portal_guestposts'] == '1') ? ' checked="checked"' : ''; ?> /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Sblam na portalu - Status:<br /><span class="small">Włacza / wyłącza system antyspamowy Sblam na portalu.</span></td>
            <td width="50%" class="tbl2"><input type="checkbox" name="portal_sblam_portal"<?php echo ($config['portal_sblam_portal'] == '1') ? ' checked="checked"' : ''; ?> /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Sblam na forum - Status:<br /><span class="small">Włacza / wyłącza system antyspamowy Sblam na forum.</span></td>
            <td width="50%" class="tbl2"><input type="checkbox" name="portal_sblam_forum"<?php echo ($config['portal_sblam_forum'] == '1') ? ' checked="checked"' : ''; ?> /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Sblam - Klucz:<br /><span class="small">Klucz API do systemu antyspamowego Sblam.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_sblam_key" value="<?php echo $config["portal_sblam_key"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>
        
        
        <tr>
            <td valign="top" width="50%" class="tbl2">Askimet na portalu - Status:<br /><span class="small">Włacza / wyłącza system antyspamowy Akismet na portalu.</span></td>
            <td width="50%" class="tbl2"><input type="checkbox" name="portal_akismet_portal"<?php echo ($config['portal_akismet_portal'] == '1') ? ' checked="checked"' : ''; ?> /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Askimet na forum - Status:<br /><span class="small">Włacza / wyłącza system antyspamowy Akismet na forum.</span></td>
            <td width="50%" class="tbl2"><input type="checkbox" name="portal_akismet_forum"<?php echo ($config['portal_akismet_forum'] == '1') ? ' checked="checked"' : ''; ?> /></td>
        </tr>
        <tr>
            <td valign="top" width="50%" class="tbl2">Askimet - Klucz:<br /><span class="small">Klucz API do systemu antyspamowego Akismet.</span></td>
            <td width="50%" class="tbl2"><input type="text" name="portal_akismet_key" value="<?php echo $config["portal_akismet_key"]; ?>" maxlength="32" class="textbox" style="width:95%;" /></td>
        </tr>  
        <tr>
            <td valign="top" width="50%" class="tbl2">Cenzor słów dla komentarzy:<br /><span class="small">Określa, czy system ma sprawdzać komentarze na obecność zakazanych słów.</span></td>
            <td width="50%" class="tbl2"><input type="checkbox" name="portal_censor_enabled"<?php echo ($config['portal_censor_enabled'] == '1') ? ' checked="checked"' : ''; ?> /></td>
        </tr>   
        <tr>
            <td style="text-align:center" colspan="2" class="tbl2">
                <br>
                <input type="submit" name="savesettings" value="Zapisz ustawienia" class="button">
            </td>
        </tr>
    </table>
</form>
<?php
$theme->panelClose();
