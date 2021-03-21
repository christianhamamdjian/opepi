<?php
$sivu = $_SERVER['PHP_SELF'];
$loppuosa = substr($sivu,strrpos($sivu,"/") + 1);
$osoite = substr($loppuosa,0,strpos($loppuosa,"."));
$valittu="class=\"valittu\" ";
?>

  <div class="header">
    <div class="container">
      <div class="header__wrapper">
        <a href="./index.php"><h2 class="logo">Opepi</h2></a>

        <a id="toggler-link" href="#menu">
            <div id="toggler"></div>
        </a>
            <nav id="menu">
              <a id="close" href="#"></a>
                <ul>
                    <li><a <?php if($osoite == "tietoa") echo $valittu; ?> href="./tietoa.php">Tietoa Opepista</a></li>
                    <li><a <?php if($osoite == "kurssit") echo $valittu; ?> href="./kurssit.php">Kurssit</a></li>
                    <li><a <?php if($osoite == "opettajat") echo $valittu; ?> href="./opettajat.php">Opettajat</a></li>
                    <li><a <?php if($osoite == "yhteytta") echo $valittu; ?> href="./yhteytta.php">Ota&nbsp;yteyttä</a></li>
                </ul>
            </nav>

      </div>
    </div>
  </div>

