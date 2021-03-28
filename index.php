<?php require_once('private/initialize.php'); ?>

<?php

$preview = false;
if(isset($_GET['preview'])) {
  // previewing should require admin to be logged in
  $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}
$visible = !$preview;

if(isset($_GET['kurssi_id'])) {
  $kurssi_id = $_GET['kurssi_id'];
  $kurssi = find_kurssi_by_id($kurssi_id, ['visible' => $visible]);
  if(!$kurssi) {
    redirect_to(url_for('/index.php'));
  }
  $opettaja_id = $kurssi['opettaja_id'];
  $opettaja = find_opettaja_by_id($opettaja_id, ['visible' => $visible]);
  if(!$opettaja) {
    redirect_to(url_for('/index.php'));
  }

} elseif(isset($_GET['opettaja_id'])) {
  $opettaja_id = $_GET['opettaja_id'];
  $opettaja = find_opettaja_by_id($opettaja_id, ['visible' => $visible]);
  if(!$opettaja) {
    redirect_to(url_for('/index.php'));
  }
  $kurssi_set = find_kurssit_by_opettaja_id($opettaja_id, ['visible' => $visible]);
  $kurssi = mysqli_fetch_assoc($kurssi_set); // first kurssi
  mysqli_free_result($kurssi_set);
  if(!$kurssi) {
    redirect_to(url_for('/index.php'));
  }
  $kurssi_id = $kurssi['id'];
} else {
  // nothing selected; show the static_home_page
}

if(isset($_GET['tehtava_id'])) {
  $tehtava_id = $_GET['tehtava_id'];
  $tehtava = find_tehtava_by_id($tehtava_id, ['visible' => $visible]);
  if(!$tehtava) {
    redirect_to(url_for('/index.php'));
  }
  $opiskelija_id = $tehtava['opiskelija_id'];
  $opiskelija = find_opiskelija_by_id($opiskelija_id, ['visible' => $visible]);
  if(!$opiskelija) {
    redirect_to(url_for('/index.php'));
  }

} elseif(isset($_GET['opiskelija_id'])) {
  $opiskelija_id = $_GET['opiskelija_id'];
  $opiskelija = find_opiskelija_by_id($opiskelija_id, ['visible' => $visible]);
  if(!$opiskelija) {
    redirect_to(url_for('/index.php'));
  }
  $tehtava_set = find_tehtavat_by_opiskelija_id($opiskelija_id, ['visible' => $visible]);
  $tehtava = mysqli_fetch_assoc($tehtava_set); // first tehtava
  mysqli_free_result($tehtava_set);
  if(!$tehtava) {
    redirect_to(url_for('/index.php'));
  }
  $tehtava_id = $tehtava['id'];
} else {
  // nothing selected; show the static_home_page
}


if(isset($_GET['sivu_id'])) {
  $sivu_id = $_GET['sivu_id'];
  $sivu = find_sivu_by_id($sivu_id, ['visible' => $visible]);
  if(!$sivu) {
    redirect_to(url_for('/index.php'));
  }
  $aihe_id = $sivu['aihe_id'];
  $aihe = find_aihe_by_id($aihe_id, ['visible' => $visible]);
  if(!$aihe) {
    redirect_to(url_for('/index.php'));
  }

} elseif(isset($_GET['aihe_id'])) {
  $aihe_id = $_GET['aihe_id'];
  $aihe = find_aihe_by_id($aihe_id, ['visible' => $visible]);
  if(!$aihe) {
    redirect_to(url_for('/index.php'));
  }
  $sivu_set = find_sivut_by_aihe_id($aihe_id, ['visible' => $visible]);
  $sivu = mysqli_fetch_assoc($sivu_set); // first sivu
  mysqli_free_result($sivu_set);
  if(!$sivu) {
    redirect_to(url_for('/index.php'));
  }
  $sivu_id = $sivu['id'];
} else {
  // nothing selected; show the static_home_page
}

?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

   

    <?php
      if(isset($kurssi)) {
        $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
        echo "<div id=\"kurssi\">";
        echo strip_tags($kurssi['content'], $allowed_tags);
        echo "</div>";
      }elseif(isset($tehtava)) {
        $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
        echo "<div id=\"kurssi\">";
        echo strip_tags($tehtava['content'], $allowed_tags);
        echo "</div>";
      }elseif(isset($sivu)) {
        $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
        echo "<div id=\"kurssi\">";
        echo strip_tags($sivu['content'], $allowed_tags);
        echo "</div>";
      }
      else {
        include(SHARED_PATH . '/static_homepage.php');
      }
    ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
