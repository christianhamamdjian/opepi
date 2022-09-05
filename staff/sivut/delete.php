<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/sivut/index.php'));
}
$id = $_GET['id'];

$sivu = find_sivu_by_id($id);

if(is_post_request()) {

  $result = delete_sivu($id);
  $_SESSION['message'] = 'The sivu was deleted successfully.';
  redirect_to(url_for('/staff/aiheet/show.php?id=' . h(u($sivu['aihe_id']))));

}

?>

<?php $sivu_title = 'Delete sivu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/aiheet/show.php?id=' . h(u($sivu['aihe_id']))); ?>">&laquo; Back to aihe sivu</a>

  <div class="sivu delete">
    <h1>Delete sivu</h1>
    <p>Are you sure you want to delete this sivu?</p>
    <p class="item"><?php echo h($sivu['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/sivut/delete.php?id=' . h(u($sivu['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete sivu" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
