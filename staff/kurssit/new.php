<?php

require_once('../../private/initialize.php');

require_login();

if(is_post_request()) {

  $kurssi = [];
  $kurssi['opettaja_id'] = $_POST['opettaja_id'] ?? '';
  $kurssi['menu_name'] = $_POST['menu_name'] ?? '';
  $kurssi['position'] = $_POST['position'] ?? '';
  $kurssi['visible'] = $_POST['visible'] ?? '';
  $kurssi['content'] = $_POST['content'] ?? '';

  $result = insert_kurssi($kurssi);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The kurssi was created successfully.';
    redirect_to(url_for('/staff/kurssit/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {

  $kurssi = [];
  $kurssi['opettaja_id'] = $_GET['opettaja_id'] ?? '1';
  $kurssi['menu_name'] = '';
  $kurssi['position'] = '';
  $kurssi['visible'] = '';
  $kurssi['content'] = '';

}

$kurssi_count = count_kurssit_by_opettaja_id($kurssi['opettaja_id']) + 1;

?>

<?php $kurssi_title = 'Create kurssi'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($kurssi['opettaja_id']))); ?>">&laquo; Back to opettaja kurssi</a>

  <div class="kurssi new">
    <h1>Create kurssi</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/kurssit/new.php'); ?>" method="post">
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
        <dt>Nimi</dt>
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
        <input type="submit" value="Create kurssi" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
