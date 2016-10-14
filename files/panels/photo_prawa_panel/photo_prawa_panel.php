<?php
if (!defined('IN_FUSION')) 
{ 
  header('Location:../../index.php'); 
  exit; 
}

$result = dbquery('SELECT photo_id, photo_thumb1, photo_title, album_id
  FROM '.DB_PREFIX.'photos 
  ORDER BY RAND() LIMIT 1');

$data = dbarray($result);
$katalog = PHOTOS.'album_'.$data['album_id'].'/';

$losowanie = rand(1, 3);

openside('Losowe zdjęcie');
?>
  <div class="center">
    <span class="small2" style="display:block;font-weight:bold;margin-bottom:4px"><?= $data['photo_title'] ?></span>
    <a href="screen<?= $data['photo_id'] ?>/" title="<?= $data['photo_title'] ?> - Zobacz screen">
      <img src="<?= $katalog . $data['photo_thumb1'] ?>" alt="<?= $data['photo_title'] ?>" class="imgbox" />
    </a>
    
    <hr style="margin:10px 0px;" />
    <span class="small2" style="display:block;font-weight:bold;margin-bottom:4px;">Zobacz również:</span>
<?php
  if ($losowanie == 1)
  { 
    echo '<a href="http://www.youtube.com/jaggedalliance" title="Przełącz się na Jagged Alliance TV"><img src="' . IMAGES . '/promo/jatv.gif" class="imgbox" alt="Jagged Alliance TV" /></a>';
  }
  elseif ($losowanie == 2) 
  {  
    echo '<a href="http://arulco.jacenter.pl" title="Zapoznaj się z przewodnikiem po Arulco"><img src="' . IMAGES . '/promo/mapa.gif" class="imgbox" alt="Mapa Arulco" /></a>';
  }
  elseif ($losowanie == 3) 
  { 
    echo '<a href="http://muzeum.jacenter.pl" title="Muzeum Jagged Alliance - historia kultowej serii"><img src="' . IMAGES . '/promo/muzeum.gif" class="imgbox" alt="Muzeum Serii Jagged Alliance" /></a>';
  }
?>
  </div>

  
<?php
closeside();
?>