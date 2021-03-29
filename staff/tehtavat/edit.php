<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/tehtavat/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $tehtava = [];
  $tehtava['id'] = $id;
  $tehtava['opiskelija_id'] = $_POST['opiskelija_id'] ?? '';
  $tehtava['menu_name'] = $_POST['menu_name'] ?? '';
  $tehtava['position'] = $_POST['position'] ?? '';
  $tehtava['visible'] = $_POST['visible'] ?? '';
  $tehtava['content'] = $_POST['content'] ?? '';
  $tehtava['arvosana'] = $_POST['arvosana'] ?? '';

  $result = update_tehtava($tehtava);
  if($result === true) {
    $_SESSION['message'] = 'The tehtävä was updated successfully.';
    redirect_to(url_for('/staff/tehtavat/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $tehtava = find_tehtava_by_id($id);

}

$tehtava_count = count_tehtavat_by_opiskelija_id($tehtava['opiskelija_id']);

?>

<?php $tehtava_title = 'Edit tehtava'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($tehtava['opiskelija_id']))); ?>">&laquo; Back to opiskelija tehtava</a>

  <div class="tehtava edit">
    <h1>Edit tehtävä</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/tehtavat/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>opiskelija</dt>
        <dd>
          <select name="opiskelija_id">
          <?php
            $opiskelija_set = find_all_opiskelijat();
            while($opiskelija = mysqli_fetch_assoc($opiskelija_set)) {
              echo "<option value=\"" . h($opiskelija['id']) . "\"";
              if($tehtava["opiskelija_id"] == $opiskelija['id']) {
                echo " selected";
              }
              echo ">" . h($opiskelija['menu_name']) . "</option>";
            }
            mysqli_free_result($opiskelija_set);
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
      <?php if($_SESSION['role'] == "ope"){ ?>
      <dl>
        <dt>Arvosana</dt>
        <dd><input type="text" name="arvosana" value="<?php echo h($tehtava['arvosana']); ?>" /></dd>
      </dl>
      <?php } ?>
      <div id="operations">
        <input type="submit" value="Edit tehtava" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
