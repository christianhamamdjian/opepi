<?php
$sivu = $_SERVER['PHP_SELF'];
$loppuosa = substr($sivu,strrpos($sivu,"/") + 1);
$osoite = substr($loppuosa,0,strpos($loppuosa,"."));
$valittu="class=\"valittu\" ";
?>

<?php
  // Default values to prevent errors
  $sivu_id = $sivu_id ?? '';
  $aihe_id = $aihe_id ?? '';
  $visible = $visible ?? true;
?>

<div class="header">
    <div class="container">
        <div class="header__wrapper">
            <a href="./index.php">
                <h2 class="logo">Opepi yksytyisalue</h2>
            </a>

        </div>
    </div>
</div>