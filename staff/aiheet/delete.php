<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/aiheet/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $result = delete_aihe($id);
  $_SESSION['message'] = 'The aihe was deleted successfully.';
  redirect_to(url_for('/staff/aiheet/index.php'));

} else {
  $aihe = find_aihe_by_id($id);
}

?>

<?php $page_title = 'Delete aihe'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/aiheet/index.php'); ?>">&laquo; Back to List</a>

  <div class="aihe delete">
    <h1>Delete aihe</h1>
    <p>Are you sure you want to delete this aihe?</p>
    <p class="item"><?php echo h($aihe['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/aiheet/delete.php?id=' . h(u($aihe['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete aihe" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
