<?php require_once('../../private/initialize.php'); ?>

<?php

  require_login();

  $opettaja_set = find_all_opettajat();

?>

<?php $kurssi_title = 'opettajat'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="opettajat listing">
    <h1>opettajat</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/opettajat/new.php'); ?>">Create New opettaja</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
        <th>kurssit</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($opettaja = mysqli_fetch_assoc($opettaja_set)) { ?>
        <?php $kurssi_count = count_kurssit_by_opettaja_id($opettaja['id']); ?>
        <tr>
          <td><?php echo h($opettaja['id']); ?></td>
          <td><?php echo h($opettaja['position']); ?></td>
          <td><?php echo $opettaja['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($opettaja['menu_name']); ?></td>
          <td><?php echo $kurssi_count; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($opettaja['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/opettajat/edit.php?id=' . h(u($opettaja['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/opettajat/delete.php?id=' . h(u($opettaja['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php
      mysqli_free_result($opettaja_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
