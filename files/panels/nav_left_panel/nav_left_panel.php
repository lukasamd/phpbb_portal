<?php
$this->panelOpen("Nawigacja");
?>
<ul class="navigation">
    <li><a href="/" title="Strona Główna">Strona Główna</a></li>
    <li><a href="http://<?php echo Config::getConfig('server_name'); ?>/" title="Forum">Forum dyskusyjne</a></li>

    
    <li><a href="index.php?module=PasswordGenerator" title="Generator haseł">Generator haseł</a></li>
    <li><a href="index.php?module=Comments" title="Komentarze">Ostatnie komentarze</a></li>
    
    <li><a href="index.php?module=RSS" title="Kanał RSS">RSS</a></li>

    <li><a href="index.php?module=Chat" title="Skontaktuj się z nami">Chat</a></li>
    <li><a href="index.php?module=Search" title="Wyszukiwarka">Wyszukiwarka</a></li>
</ul>
<?php
$this->panelClose();
?>