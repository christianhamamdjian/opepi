<?php require_once('../private/initialize.php'); ?>

<?php require_login(); ?>
<?php // echo "Moi " .$_SESSION['role'] ?? '' . "!"; ?>
<?php 
        
?>
<?php $kurssi_title = 'Private Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Pääsivu</h2>
    <ul>
        <?php 
        $opelink = url_for('/staff/opettajat/index.php');
        $opilink = url_for('/staff/opiskelijat/index.php');
        $aihelink = url_for('/staff/aiheet/index.php');
        $adminlink = url_for('/staff/admins/index.php');
        $palautelink = url_for('/staff/admins/palautteet.php');
        if($_SESSION['role'] == "admin"){
            echo "<li><a href=".$opelink.">Opettajat</a></li>";
            echo "<li><a href=".$opilink.">Opiskelijat</a></li>";
            echo "<li><a href=".$aihelink.">Aiheet</a></li>";
            echo "<li><a href=".$adminlink.">Admins</a></li>"; 
            echo "<li><a href=".$palautelink.">Palaute</a></li>"; 
        }elseif($_SESSION['role'] == "ope"){
            echo "<li><a href=" .$opelink. ">Opettajan kurssit</a></li>";
            //echo "<li><a href=".$opilink.">Opiskelijat</a></li>";
        }elseif($_SESSION['role'] == "opi"){
            echo "<li><a href=".$opilink.">Opiskelijan tehtävät</a></li>";
        }else{
            // do nothing
        }
        ?>
      <!-- <li><a href="<?php // echo url_for('/staff/opettajat/index.php'); ?>">Opettajat</a></li>
      <li><a href="<?php // echo url_for('/staff/opiskelijat/index.php'); ?>">Opiskelijat</a></li>
      <li><a href="<?php // echo url_for('/staff/aiheet/index.php'); ?>">Aiheet</a></li>
      <li><a href="<?php // echo url_for('/staff/admins/index.php'); ?>">Admins</a></li> -->
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
