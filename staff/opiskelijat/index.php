<?php require_once('../../private/initialize.php'); ?>

<?php

  require_login();

  $opiskelija_set = find_all_opiskelijat();
?>

<?php $tehtava_title = 'opiskelijat'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="opiskelijat listing">
    <h1>opiskelijat</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/opiskelijat/new.php'); ?>">Create New opiskelija</a>
    </div>

  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
        <th>tehtavat</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($opiskelija = mysqli_fetch_assoc($opiskelija_set)) { ?>
        <?php $tehtava_count = count_tehtavat_by_opiskelija_id($opiskelija['id']); ?>
        <tr>
          <td><?php echo h($opiskelija['id']); ?></td>
          <td><?php echo h($opiskelija['position']); ?></td>
          <td><?php echo $opiskelija['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($opiskelija['menu_name']); ?></td>
          <td><?php echo $tehtava_count; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($opiskelija['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/opiskelijat/edit.php?id=' . h(u($opiskelija['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/opiskelijat/delete.php?id=' . h(u($opiskelija['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php
      mysqli_free_result($opiskelija_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
