<?php require_once('private/initialize.php'); ?>

<?php

$preview = false;
if(isset($_GET['preview'])) {
  // previewing should require admin to be logged in
  $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}
$visible = !$preview;

if(isset($_GET['id'])) {
  $kurssi_id = $_GET['id'];
  $kurssi = find_kurssi_by_id($kurssi_id, ['visible' => $visible]);
  if(!$kurssi) {
    redirect_to(url_for('/'));
  }
  $opettaja_id = $kurssi['opettaja_id'];
  $opettaja = find_opettaja_by_id($opettaja_id, ['visible' => $visible]);
  if(!$opettaja) {
    redirect_to(url_for('/'));
  }

} elseif(isset($_GET['opettaja_id'])) {
  $opettaja_id = $_GET['opettaja_id'];
  $opettaja = find_opettaja_by_id($opettaja_id, ['visible' => $visible]);
  if(!$opettaja) {
    redirect_to(url_for('/'));
  }
  $kurssi_set = find_kurssit_by_opettaja_id($opettaja_id, ['visible' => $visible]);
  $kurssi = mysqli_fetch_assoc($kurssi_set); // first kurssi
  mysqli_free_result($kurssi_set);
  if(!$kurssi) {
    redirect_to(url_for('/'));
  }
  $kurssi_id = $kurssi['id'];
} else {
  // nothing selected; show the homekurssi
}

// if(isset($_GET['id'])) {
//   $kurssi_id = $_GET['id'];
//   $kurssi = find_kurssi_by_id($kurssi_id, ['visible' => $visible]);
//   if(!$kurssi) {
//     redirect_to(url_for('/index.php'));
//   }
//   $opettaja_id = $kurssi['opettaja_id'];
//   $opettaja = find_opettaja_by_id($opettaja_id, ['visible' => $visible]);
//   if(!$opettaja) {
//     redirect_to(url_for('/index.php'));
//   }

// } elseif(isset($_GET['opettaja_id'])) {
//   $opettaja_id = $_GET['opettaja_id'];
//   $opettaja = find_opettaja_by_id($opettaja_id, ['visible' => $visible]);
//   if(!$opettaja) {
//     redirect_to(url_for('/index.php'));
//   }
//   $kurssi_set = find_kurssit_by_opettaja_id($opettaja_id, ['visible' => $visible]);
//   $kurssi = mysqli_fetch_assoc($kurssi_set); // first kurssi
//   mysqli_free_result($kurssi_set);
//   if(!$kurssi) {
//     redirect_to(url_for('/index.php'));
//   }
//   $kurssi_id = $kurssi['id'];
// } else {
//   // nothing selected; show the homekurssi
// }


?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

   

    <?php
      if(isset($kurssi)) {
        $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
        echo "<div id=\"kurssi\">";
        echo strip_tags($kurssi['content'], $allowed_tags);
        echo "</div>";
      } else {
        include(SHARED_PATH . '/static_homepage.php');
      }
    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
