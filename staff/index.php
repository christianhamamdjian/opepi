<?php require_once('../private/initialize.php'); ?>

<?php require_login(); ?>

<?php $kurssi_title = 'Private Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div id="main-menu">
    <h2>Pääsivu</h2>
    <ul>
      <li><a href="<?php echo url_for('/staff/opettajat/index.php'); ?>">Opettajat</a></li>
      <li><a href="<?php echo url_for('/staff/opiskelijat/index.php'); ?>">Opiskelijat</a></li>
      <li><a href="<?php echo url_for('/staff/aiheet/index.php'); ?>">Aiheet</a></li>
      <li><a href="<?php echo url_for('/staff/admins/index.php'); ?>">Admins</a></li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
