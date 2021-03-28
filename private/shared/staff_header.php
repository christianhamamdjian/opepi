<?php
  if(!isset($kurssi_title)) { $kurssi_title = 'Private Area'; }
?>

<!doctype html>

<html lang="en">
  <head>
    <title>OPEPI - <?php echo h($kurssi_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
  </head>

  <body>
    <header>
      <h1>OPEPI yksityisalue</h1>
    </header>
      <?php // include("staff_navigation.php"); ?>
      <div class="moi">Moi <?php echo $_SESSION['username'] ?? ''; ?> !</div>
    <navigation>
      <ul>
        <li><a href="<?php echo url_for('/staff/index.php'); ?>">Pääsivu</a></li>
        <li><a href="<?php echo url_for('/staff/logout.php'); ?>">Kirjaudu ulos</a></li>
      </ul>
    </navigation>

    <?php echo display_session_message(); ?>
