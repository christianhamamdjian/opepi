<?php require_once('../../private/initialize.php'); ?>

<?php

require_login();

// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$kurssi = find_kurssi_by_id($id);
$opettaja = find_opettaja_by_id($kurssi['opettaja_id']);

?>

<?php $kurssi_title = 'Show kurssi'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($opettaja['id']))); ?>">&laquo; Back to opettaja kurssi</a>

  <div class="kurssi show">

    <h1>kurssi: <?php echo h($kurssi['menu_name']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/index.php?id=' . h(u($kurssi['id'])) . '&preview=true'); ?>" target="_blank">Preview</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>opettaja</dt>
        <dd><?php echo h($opettaja['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($kurssi['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($kurssi['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $kurssi['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($kurssi['content']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
