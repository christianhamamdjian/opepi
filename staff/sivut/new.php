<?php

require_once('../../private/initialize.php');

require_login();

if(is_post_request()) {

  $sivu = [];
  $sivu['aihe_id'] = $_POST['aihe_id'] ?? '';
  $sivu['menu_name'] = $_POST['menu_name'] ?? '';
  $sivu['position'] = $_POST['position'] ?? '';
  $sivu['visible'] = $_POST['visible'] ?? '';
  $sivu['content'] = $_POST['content'] ?? '';

  $result = insert_sivu($sivu);
  if($result === true) {
    $new_id = mysqli_insert_id($db);
    $_SESSION['message'] = 'The sivu was created successfully.';
    redirect_to(url_for('/staff/sivut/show.php?id=' . $new_id));
  } else {
    $errors = $result;
  }

} else {

  $sivu = [];
  $sivu['aihe_id'] = $_GET['aihe_id'] ?? '1';
  $sivu['menu_name'] = '';
  $sivu['position'] = '';
  $sivu['visible'] = '';
  $sivu['content'] = '';

}

$sivu_count = count_sivut_by_aihe_id($sivu['aihe_id']) + 1;

?>

<?php $sivu_title = 'Create sivu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/aiheet/show.php?id=' . h(u($sivu['aihe_id']))); ?>">&laquo; Back to aihe sivu</a>

  <div class="sivu new">
    <h1>Create sivu</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/sivut/new.php'); ?>" method="post">
      <dl>
        <dt>aihe</dt>
        <dd>
          <select name="aihe_id">
          <?php
            $aihe_set = find_all_aiheet();
            while($aihe = mysqli_fetch_assoc($aihe_set)) {
              echo "<option value=\"" . h($aihe['id']) . "\"";
              if($sivu["aihe_id"] == $aihe['id']) {
                echo " selected";
              }
              echo ">" . h($aihe['menu_name']) . "</option>";
            }
            mysqli_free_result($aihe_set);
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($sivu['menu_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=1; $i <= $sivu_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($sivu["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($sivu['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo h($sivu['content']); ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create sivu" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
