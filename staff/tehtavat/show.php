<?php require_once('../../private/initialize.php'); ?>

<?php

require_login();

$id = $_GET['id'] ?? '1';

$tehtava = find_tehtava_by_id($id);
$opiskelija = find_opiskelija_by_id($tehtava['opiskelija_id']);

?>

<?php $tehtava_title = 'Show tehtava'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($opiskelija['id']))); ?>">&laquo; Takaisin opiskelijan tehtäviin</a>

  <div class="tehtava show">

    <h1>tehtava: <?php echo h($tehtava['menu_name']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/index.php?tehtava_id=' . h(u($tehtava['id'])) . '&preview=true'); ?>" target="_blank">Esikatsele</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>opiskelija</dt>
        <dd><?php echo h($opiskelija['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($tehtava['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($tehtava['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $tehtava['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($tehtava['content']); ?></dd>
      </dl>
    </div>


  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
