<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/kurssit/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  $kurssi = [];
  $kurssi['id'] = $id;
  $kurssi['opettaja_id'] = $_POST['opettaja_id'] ?? '';
  $kurssi['menu_name'] = $_POST['menu_name'] ?? '';
  $kurssi['position'] = $_POST['position'] ?? '';
  $kurssi['visible'] = $_POST['visible'] ?? '';
  $kurssi['content'] = $_POST['content'] ?? '';

  $result = update_kurssi($kurssi);
  if($result === true) {
    $_SESSION['message'] = 'The kurssi was updated successfully.';
    redirect_to(url_for('/staff/kurssit/show.php?id=' . $id));
  } else {
    $errors = $result;
  }

} else {

  $kurssi = find_kurssi_by_id($id);

}

$kurssi_count = count_kurssit_by_opettaja_id($kurssi['opettaja_id']);

?>

<?php $kurssi_title = 'Edit kurssi'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($kurssi['opettaja_id']))); ?>">&laquo; Back to opettaja kurssi</a>

  <div class="kurssi edit">
    <h1>Edit kurssi</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/kurssit/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>opettaja</dt>
        <dd>
          <select name="opettaja_id">
          <?php
            $opettaja_set = find_all_opettajat();
            while($opettaja = mysqli_fetch_assoc($opettaja_set)) {
              echo "<option value=\"" . h($opettaja['id']) . "\"";
              if($kurssi["opettaja_id"] == $opettaja['id']) {
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
        <dd><input type="text" name="menu_name" value="<?php echo h($kurssi['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=1; $i <= $kurssi_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($kurssi["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($kurssi['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($kurssi['content']); ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit kurssi" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
