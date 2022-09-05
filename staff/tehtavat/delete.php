<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/tehtavat/index.php'));
}
$id = $_GET['id'];

$tehtava = find_tehtava_by_id($id);

if(is_post_request()) {

  $result = delete_tehtava($id);
  $_SESSION['message'] = 'The tehtava was deleted successfully.';
  redirect_to(url_for('/staff/opiskelijat/show.php?id=' . h(u($tehtava['opiskelija_id']))));

}

?>

<?php $tehtava_title = 'Delete tehtava'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($tehtava['opiskelija_id']))); ?>">&laquo; Back to opiskelija tehtava</a>

  <div class="tehtava delete">
    <h1>Delete tehtava</h1>
    <p>Are you sure you want to delete this tehtava?</p>
    <p class="item"><?php echo h($tehtava['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/tehtavat/delete.php?id=' . h(u($tehtava['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete tehtava" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
