<?php
// $currentsivu = $_SERVER['PHP_SELF'];
// $loppuosa = substr($currentsivu,strrpos($currentsivu,"/") + 1);
// $osoite = substr($loppuosa,0,strpos($loppuosa,"."));
// $valittu="class=\"valittu\" ";
?>

<?php
  //Default values to prevent errors
  $sivu_id = $sivu_id ?? '';
  $aihe_id = $aihe_id ?? '';
  $visible = $visible ?? true;
?>

<div class="header">
    <div class="container">
        <div class="header__wrapper">
            <a href="./index.php">
                <h2 class="logo">Opepi</h2>
            </a>

            <a id="toggler-link" href="#menu">
                <div id="toggler"></div>
            </a>
            <nav id="menu">
                <a id="close" href="#"></a>

                <?php $nav_aiheet = find_all_aiheet(['visible' => $visible]); ?>
                <ul class="menu">
                    <?php while($nav_aihe = mysqli_fetch_assoc($nav_aiheet)) { ?>
                    <li class="<?php  echo 'selected';  ?>">
                        <a href="<?php echo url_for('index.php?aihe_id=' . h(u($nav_aihe['id']))); ?>">
                            <?php echo h($nav_aihe['menu_name']); ?>
                        </a>

                        <?php //if($nav_aihe['id'] == $aihe_id) { ?>
                        <?php $nav_sivut = find_sivut_by_aihe_id($nav_aihe['id'], ['visible' => $visible]); ?>
                        <!-- <ul class="sivut submenu"> -->
                        <ul class="submenu">
                            <?php while($nav_sivu = mysqli_fetch_assoc($nav_sivut)) { ?>
                            <li class="<?php if($nav_sivu['id'] == $sivu_id) { echo 'selected'; } ?>">
                                <a href="<?php echo url_for('index.php?sivu_id=' . h(u($nav_sivu['id']))); ?>">
                                    <?php echo h($nav_sivu['menu_name']); ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php mysqli_free_result($nav_sivut); ?>
                        <?php // } ?>

                    </li>
                    <?php } ?>
                </ul>
                <?php mysqli_free_result($nav_aiheet); ?>
            </nav>


        </div>
    </div>
</div>