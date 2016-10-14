<?php
$this->panelOpen('Wyszukiwarka');

$searchKeyword = trim(Input::get('q', ''));
?>
<div id="quicksearch">
  <form action="<?php echo $urls->buildUrl('simple', 'Search'); ?>" method="post">
    <fieldset>
      <input type="text" value="<?php echo $searchKeyword; ?>" name="q" id="searchfield" class="textbox" />
      <input type="submit" value="Szukaj w serwisie" class="button" />
    </fieldset>
  </form>
</div>
<?php
$this->panelClose();
?>