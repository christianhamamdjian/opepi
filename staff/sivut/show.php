<?php require_once('../../private/initialize.php'); ?>

<?php

require_login();

$id = $_GET['id'] ?? '1';

$sivu = find_sivu_by_id($id);
$aihe = find_aihe_by_id($sivu['aihe_id']);

?>

<?php $sivu_title = 'Show sivu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/aiheet/show.php?id=' . h(u($aihe['id']))); ?>">&laquo; Back to aihe sivu</a>

  <div class="sivu show">

    <h1>sivu: <?php echo h($sivu['menu_name']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/index.php?sivu_id=' . h(u($sivu['id'])) . '&preview=true'); ?>" target="_blank">Esikatsele</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>aihe</dt>
        <dd><?php echo h($aihe['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($sivu['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($sivu['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $sivu['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($sivu['content']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
