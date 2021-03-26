<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/opettajat/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $opettaja = [];
  $opettaja['id'] = $id;
  $opettaja['menu_name'] = $_POST['menu_name'] ?? '';
  $opettaja['position'] = $_POST['position'] ?? '';
  $opettaja['visible'] = $_POST['visible'] ?? '';

  $result = update_opettaja($opettaja);
  if($result === true) {
    $_SESSION['message'] = 'The opettaja was updated successfully.';
    redirect_to(url_for('/staff/opettajat/show.php?id=' . $id));
  } else {
    $errors = $result;
    //var_dump($errors);
  }

} else {

  $opettaja = find_opettaja_by_id($id);

}

$opettaja_set = find_all_opettajat();
$opettaja_count = mysqli_num_rows($opettaja_set);
mysqli_free_result($opettaja_set);

?>

<?php $page_title = 'Edit opettaja'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/index.php'); ?>">&laquo; Back to List</a>

  <div class="opettaja edit">
    <h1>Edit opettaja</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/opettajat/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($opettaja['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php
            for($i=1; $i <= $opettaja_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($opettaja["position"] == $i) {
                echo " selected";
              }
              echo ">{$i}</option>";
            }
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1"<?php if($opettaja['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit opettaja" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
