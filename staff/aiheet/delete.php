<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/opettajat/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_opettaja($id);
  $_SESSION['message'] = 'The opettaja was deleted successfully.';
  redirect_to(url_for('/staff/opettajat/index.php'));

} else {
  $opettaja = find_opettaja_by_id($id);
}

?>

<?php $page_title = 'Delete opettaja'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/index.php'); ?>">&laquo; Back to List</a>

  <div class="opettaja delete">
    <h1>Delete opettaja</h1>
    <p>Are you sure you want to delete this opettaja?</p>
    <p class="item"><?php echo h($opettaja['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/opettajat/delete.php?id=' . h(u($opettaja['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete opettaja" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
