<?php

require_once('../../private/initialize.php');

require_login();

$aihe_set = find_all_aiheet();
$aihe_count = mysqli_num_rows($aihe_set) + 1;
mysqli_free_result($aihe_set);

if(is_post_request()) {

  $aihe = [];
  $aihe['menu_name'] = $_POST['menu_name'] ?? '';
  $aihe['position'] = $_POST['position'] ?? '';
  $aihe['visible'] = $_POST['visible'] ?? '';

  $result = insert_aihe($aihe);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The aihe was created successfully.';
    redirect_to(url_for('/staff/aiheet/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $aihe = [];
  $aihe["menu_name"] = '';
  $aihe["position"] = $aihe_count;
  $aihe["visible"] = '';
}

?>

<?php $page_title = 'Create aihe'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/aiheet/index.php'); ?>">&laquo; Back to List</a>

  <div class="aihe new">
    <h1>Create aihe</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/aiheet/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($aihe['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php
            for($i=1; $i <= $aihe_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($aihe["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($aihe['visible'] == 1) { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create aihe" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
