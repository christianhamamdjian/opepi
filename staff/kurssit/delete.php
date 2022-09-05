<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/kurssit/index.php'));
}
$id = $_GET['id'];

$kurssi = find_kurssi_by_id($id);

if(is_post_request()) {

  $result = delete_kurssi($id);
  $_SESSION['message'] = 'The kurssi was deleted successfully.';
  redirect_to(url_for('/staff/opettajat/show.php?id=' . h(u($kurssi['opettaja_id']))));

}

?>

<?php $kurssi_title = 'Delete kurssi'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($kurssi['opettaja_id']))); ?>">&laquo; Back to opettaja kurssi</a>

  <div class="kurssi delete">
    <h1>Delete kurssi</h1>
    <p>Are you sure you want to delete this kurssi?</p>
    <p class="item"><?php echo h($kurssi['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/kurssit/delete.php?id=' . h(u($kurssi['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete kurssi" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
