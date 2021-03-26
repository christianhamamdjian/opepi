<?php
$sivu = $_SERVER['PHP_SELF'];
$loppuosa = substr($sivu,strrpos($sivu,"/") + 1);
$osoite = substr($loppuosa,0,strpos($loppuosa,"."));
$valittu="class=\"valittu\" ";
?>

<?php
  // Default values to prevent errors
  $kurssi_id = $kurssi_id ?? '';
  $opettaja_id = $opettaja_id ?? '';
  $visible = $visible ?? true;
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

              <?php $nav_opettajat = find_all_opettajat(['visible' => $visible]); ?>
                <ul class="opettajat">
                  <?php while($nav_opettaja = mysqli_fetch_assoc($nav_opettajat)) { ?>
                    <li class="<?php if($nav_opettaja['id'] == $opettaja_id) { echo 'selected'; } ?>">
                      <a href="<?php echo url_for('index.php?opettaja_id=' . h(u($nav_opettaja['id']))); ?>">
                        <?php echo h($nav_opettaja['menu_name']); ?>
                      </a>

                      <?php if($nav_opettaja['id'] == $opettaja_id) { ?>
                        <?php $nav_kurssit = find_kurssit_by_opettaja_id($nav_opettaja['id'], ['visible' => $visible]); ?>
                        <ul class="kurssit">
                          <?php while($nav_kurssi = mysqli_fetch_assoc($nav_kurssit)) { ?>
                            <li class="<?php if($nav_kurssi['id'] == $kurssi_id) { echo 'selected'; } ?>">
                              <a href="<?php echo url_for('index.php?id=' . h(u($nav_kurssi['id']))); ?>">
                                <?php echo h($nav_kurssi['menu_name']); ?>
                              </a>
                            </li>
                          <?php } ?>
                        </ul>
                        <?php mysqli_free_result($nav_kurssit); ?>
                      <?php } ?>

                    </li>
                  <?php } ?>
                </ul>
                <?php mysqli_free_result($nav_opettajat); ?>
            </nav>

      </div>
    </div>
  </div>

