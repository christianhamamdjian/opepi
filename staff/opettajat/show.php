<?php require_once('../../private/initialize.php'); ?>

<?php
require_login();

$id = $_GET['id'] ?? '1';

$opettaja = find_opettaja_by_id($id);
$kurssi_set = find_kurssit_by_opettaja_id($id);

?>

<?php $kurssi_title = 'Show opettaja'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/index.php'); ?>">&laquo; Takaisin listalle</a>

  <div class="opettaja show">

    <h1>opettaja: <?php echo h($opettaja['menu_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($opettaja['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($opettaja['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $opettaja['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>

    <hr />

    <div class="kurssit listing">
      <h2>Kurssit</h2>

      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/kurssit/new.php?opettaja_id=' . h(u($opettaja['id']))); ?>">Luo uusi kurssi</a>
      </div>

      <table class="list kurssit">
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
          <?php $opettaja = find_opettaja_by_id($kurssi['opettaja_id']); ?>
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
