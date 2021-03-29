<?php

require_once('../../private/initialize.php');

require_login();

$opiskelija_set = find_all_opiskelijat();
$opiskelija_count = mysqli_num_rows($opiskelija_set) + 1;
mysqli_free_result($opiskelija_set);

if(is_post_request()) {

  $opiskelija = [];
  $opiskelija['menu_name'] = $_POST['menu_name'] ?? '';
  $opiskelija['kurssi'] = $_POST['kurssi'] ?? '';
  $opiskelija['position'] = $_POST['position'] ?? '';
  $opiskelija['visible'] = $_POST['visible'] ?? '';
  $opiskelija['koodi'] = $_POST['koodi'] ?? '';

  $result = insert_opiskelija($opiskelija);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'Opiskelija luotiin onnistuneesti.';
    redirect_to(url_for('/staff/opiskelijat/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {
  // display the blank form
  $opiskelija = [];
  $opiskelija["menu_name"] = '';
  $opiskelija["kurssi"] = '';
  $opiskelija["position"] = $opiskelija_count;
  $opiskelija["visible"] = '';
  $opiskelija["koodi"] = '';
}

?>

<?php $page_title = 'Create opiskelija'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/index.php'); ?>">&laquo; Back to List</a>

  <div class="opiskelija new">
    <h1>Luo uusi opiskelija</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/opiskelijat/new.php'); ?>" method="post">
      <dl>
        <dt>Nimi</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($opiskelija['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Kurssi</dt>
        <dd><input type="text" name="kurssi" value="<?php echo h($opiskelija['kurssi']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php
            for($i=1; $i <= $opiskelija_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($opiskelija["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($opiskelija['visible'] == 1) { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Koodi</dt>
        <dd><input type="text" name="koodi" value="<?php echo h($opiskelija['koodi']); ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create opiskelija" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
