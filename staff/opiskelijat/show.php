<?php require_once('../../private/initialize.php'); ?>

<?php
require_login();

$id = $_GET['id'] ?? '1';

$opiskelija = find_opiskelija_by_id($id);
$tehtava_set = find_tehtavat_by_opiskelija_id($id);

?>

<?php $tehtava_title = 'Show opiskelija'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/index.php'); ?>">&laquo; Takaisin listalle</a>

  <div class="opiskelija show">

    <h1>opiskelija: <?php echo h($opiskelija['menu_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($opiskelija['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($opiskelija['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $opiskelija['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>

    <hr />

    <div class="tehtavat listing">
      <h2>Tehtävät</h2>

      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/tehtavat/new.php?opiskelija_id=' . h(u($opiskelija['id']))); ?>">Luo uusi tehtava</a>
      </div>

      <table class="list tehtavat">
        <tr>
          <th>ID</th>
          <th>Position</th>
          <th>Visible</th>
          <th>Tehtävät</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>Arvosana</th>
        </tr>

        <?php while($tehtava = mysqli_fetch_assoc($tehtava_set)) { ?>
          <?php $opiskelija = find_opiskelija_by_id($tehtava['opiskelija_id']); ?>
          <tr>
            <td><?php echo h($tehtava['id']); ?></td>
            <td><?php echo h($tehtava['position']); ?></td>
            <td><?php echo $tehtava['visible'] == 1 ? 'true' : 'false'; ?></td>
            <td><?php echo h($tehtava['menu_name']); ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/tehtavat/show.php?id=' . h(u($tehtava['id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/tehtavat/edit.php?id=' . h(u($tehtava['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/tehtavat/delete.php?id=' . h(u($tehtava['id']))); ?>">Delete</a></td>
            <td><?php echo h($tehtava['arvosana']); ?></td>
          </tr>
        <?php } ?>
      </table>

      <?php mysqli_free_result($tehtava_set); ?>

    </div>



  </div>

</div>
