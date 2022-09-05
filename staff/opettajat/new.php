<?php

require_once('../../private/initialize.php');

require_login();

$opettaja_set = find_all_opettajat();
$opettaja_count = mysqli_num_rows($opettaja_set) + 1;
mysqli_free_result($opettaja_set);

if(is_post_request()) {

  $opettaja = [];
  $opettaja['menu_name'] = $_POST['menu_name'] ?? '';
  $opettaja['koodi'] = $_POST['koodi'] ?? '';
  $opettaja['position'] = $_POST['position'] ?? '';
  $opettaja['visible'] = $_POST['visible'] ?? '';

  $result = insert_opettaja($opettaja);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The opettaja was created successfully.';
    redirect_to(url_for('/staff/opettajat/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $opettaja = [];
  $opettaja["menu_name"] = '';
  $opettaja["koodi"] = '';
  $opettaja["position"] = $opettaja_count;
  $opettaja["visible"] = '';
}

?>

<?php $page_title = 'Create opettaja'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/index.php'); ?>">&laquo; Back to List</a>

  <div class="opettaja new">
    <h1>Create opettaja</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/opettajat/new.php'); ?>" method="post">
      <dl>
        <dt>Nimi</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($opettaja['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Koodi</dt>
        <dd><input type="text" name="koodi" value="<?php echo h($opettaja['koodi']); ?>" /></dd>
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
          <input type="checkbox" name="visible" value="1"<?php if($opettaja['visible'] == 1) { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create opettaja" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
