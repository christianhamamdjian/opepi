<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/opiskelijat/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_opiskelija($id);
  $_SESSION['message'] = 'The opiskelija was deleted successfully.';
  redirect_to(url_for('/staff/opiskelijat/index.php'));

} else {
  $opiskelija = find_opiskelija_by_id($id);
}

?>

<?php $page_title = 'Delete opiskelija'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/index.php'); ?>">&laquo; Back to List</a>

  <div class="opiskelija delete">
    <h1>Delete opiskelija</h1>
    <p>Are you sure you want to delete this opiskelija?</p>
    <p class="item"><?php echo h($opiskelija['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/opiskelijat/delete.php?id=' . h(u($opiskelija['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete opiskelija" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
