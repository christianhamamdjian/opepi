<?php require_once('../../private/initialize.php'); ?>

<?php

  require_login();

  $aihe_set = find_all_aiheet();
?>

<?php $sivu_title = 'aiheet'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="aiheet listing">
    <h1>Aiheet</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/aiheet/new.php'); ?>">Luo uusi aihe</a>
    </div>

  	<table class="list aiheet">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
        <th>sivut</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

      <?php while($aihe = mysqli_fetch_assoc($aihe_set)) { ?>
        <?php $sivu_count = count_sivut_by_aihe_id($aihe['id']); ?>
        <tr>
          <td><?php echo h($aihe['id']); ?></td>
          <td><?php echo h($aihe['position']); ?></td>
          <td><?php echo $aihe['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($aihe['menu_name']); ?></td>
          <td><?php echo $sivu_count; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/aiheet/show.php?id=' . h(u($aihe['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/aiheet/edit.php?id=' . h(u($aihe['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/aiheet/delete.php?id=' . h(u($aihe['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

    <?php
      mysqli_free_result($aihe_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
