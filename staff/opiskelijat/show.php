<?php require_once('../../private/initialize.php'); ?>

<?php
require_login();

// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$opiskelija = find_opiskelija_by_id($id);
$kurssi_set = find_kurssit_by_opiskelija_id($id);

?>

<?php $kurssi_title = 'Show opiskelija'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opiskelijat/index.php'); ?>">&laquo; Back to List</a>

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

    <div class="kurssit listing">
      <h2>kurssit</h2>

      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/kurssit/new.php?opiskelija_id=' . h(u($opiskelija['id']))); ?>">Create New kurssi</a>
      </div>

      <table class="list">
        <tr>
          <th>ID</th>
          <th>Position</th>
          <th>Visible</th>
          <th>Name</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

        <?php while($kurssi = mysqli_fetch_assoc($kurssi_set)) { ?>
          <?php $opiskelija = find_opiskelija_by_id($kurssi['opiskelija_id']); ?>
          <tr>
            <td><?php echo h($kurssi['id']); ?></td>
            <td><?php echo h($kurssi['position']); ?></td>
            <td><?php echo $kurssi['visible'] == 1 ? 'true' : 'false'; ?></td>
            <td><?php echo h($kurssi['menu_name']); ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/kurssit/show.php?id=' . h(u($kurssi['id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/kurssit/edit.php?id=' . h(u($kurssi['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/kurssit/delete.php?id=' . h(u($kurssi['id']))); ?>">Delete</a></td>
          </tr>
        <?php } ?>
      </table>

      <?php mysqli_free_result($kurssi_set); ?>

    </div>



  </div>

</div>
