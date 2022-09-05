<?php require_once('../../private/initialize.php'); ?>

<?php
require_login();

$id = $_GET['id'] ?? '1';

$aihe = find_aihe_by_id($id);
$sivu_set = find_sivut_by_aihe_id($id);

?>

<?php $sivu_title = 'Show aihe'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/aiheet/index.php'); ?>">&laquo; Back to List</a>

  <div class="aihe show">

    <h1>aihe: <?php echo h($aihe['menu_name']); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($aihe['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($aihe['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $aihe['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
    </div>

    <hr />

    <div class="sivut listing">
      <h2>sivut</h2>

      <div class="actions">
        <a class="action" href="<?php echo url_for('/staff/sivut/new.php?aihe_id=' . h(u($aihe['id']))); ?>">Luo uusi sivu</a>
      </div>

      <table class="list sivut">
        <tr>
          <th>ID</th>
          <th>Position</th>
          <th>Visible</th>
          <th>Name</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>

        <?php while($sivu = mysqli_fetch_assoc($sivu_set)) { ?>
          <?php $aihe = find_aihe_by_id($sivu['aihe_id']); ?>
          <tr>
            <td><?php echo h($sivu['id']); ?></td>
            <td><?php echo h($sivu['position']); ?></td>
            <td><?php echo $sivu['visible'] == 1 ? 'true' : 'false'; ?></td>
            <td><?php echo h($sivu['menu_name']); ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/sivut/show.php?id=' . h(u($sivu['id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/sivut/edit.php?id=' . h(u($sivu['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/sivut/delete.php?id=' . h(u($sivu['id']))); ?>">Delete</a></td>
          </tr>
        <?php } ?>
      </table>

      <?php mysqli_free_result($sivu_set); ?>

    </div>



  </div>

</div>
