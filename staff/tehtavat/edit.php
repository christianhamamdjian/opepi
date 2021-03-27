<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/tehtavat/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $tehtava = [];
  $tehtava['id'] = $id;
  $tehtava['opettaja_id'] = $_POST['opettaja_id'] ?? '';
  $tehtava['menu_name'] = $_POST['menu_name'] ?? '';
  $tehtava['position'] = $_POST['position'] ?? '';
  $tehtava['visible'] = $_POST['visible'] ?? '';
  $tehtava['content'] = $_POST['content'] ?? '';

  $result = update_tehtava($tehtava);
  if($result === true) {
    $_SESSION['message'] = 'The tehtava was updated successfully.';
    redirect_to(url_for('/staff/tehtavat/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $tehtava = find_tehtava_by_id($id);

}

$tehtava_count = count_tehtavat_by_opettaja_id($tehtava['opettaja_id']);

?>

<?php $tehtava_title = 'Edit tehtava'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($tehtava['opettaja_id']))); ?>">&laquo; Back to opettaja tehtava</a>

  <div class="tehtava edit">
    <h1>Edit tehtava</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/tehtavat/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>opettaja</dt>
        <dd>
          <select name="opettaja_id">
          <?php
            $opettaja_set = find_all_opettajat();
            while($opettaja = mysqli_fetch_assoc($opettaja_set)) {
              echo "<option value=\"" . h($opettaja['id']) . "\"";
              if($tehtava["opettaja_id"] == $opettaja['id']) {
                echo " selected";
              }
              echo ">" . h($opettaja['menu_name']) . "</option>";
            }
            mysqli_free_result($opettaja_set);
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($tehtava['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=1; $i <= $tehtava_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($tehtava["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($tehtava['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($tehtava['content']); ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit tehtava" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
