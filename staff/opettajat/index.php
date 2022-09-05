<?php require_once('../../private/initialize.php'); ?>

<?php

  require_login();

  $opettaja_set = find_all_opettajat();
  $admin_set = find_all_admins();

?>

<?php $kurssi_title = 'opettajat'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="opettajat listing">
<?php if($_SESSION['role'] == "admin"){ ?>
    <h1>Opettajat</h1>
    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/opettajat/new.php'); ?>">Luo uusi opettaja</a>
    </div>
<?php } ?>
<?php if($_SESSION['role'] == "ope"){ ?>
    <h1>Opettajan kurssit</h1>
<?php } ?>
  	<table class="list ope">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Name</th>
        <th>Koodi</th>
        <th>kurssit</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>

<?php if($_SESSION['role'] == "admin"){ ?>
      <?php while($opettaja = mysqli_fetch_assoc($opettaja_set)) { ?>
        <?php $kurssi_count = count_kurssit_by_opettaja_id($opettaja['id']); ?>
        <tr>
          <td><?php echo h($opettaja['id']); ?></td>
          <td><?php echo h($opettaja['position']); ?></td>
          <td><?php echo $opettaja['visible'] == 1 ? 'true' : 'false'; ?></td>
    	    <td><?php echo h($opettaja['menu_name']); ?></td>
          <td><?php echo h($opettaja['koodi']); ?></td>
          <td><?php echo $kurssi_count; ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($opettaja['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/opettajat/edit.php?id=' . h(u($opettaja['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/opettajat/delete.php?id=' . h(u($opettaja['id']))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
<?php } elseif($_SESSION['role'] == "ope"){?>
  <?php while($opettaja = mysqli_fetch_assoc($opettaja_set)) { ?>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
    <?php if($opettaja['koodi'] == $admin['koodi']){ ?>
          <?php $kurssi_count = count_kurssit_by_opettaja_id($opettaja['id']); ?>
          <tr>
            <td><?php echo h($opettaja['id']); ?></td>
            <td><?php echo h($opettaja['position']); ?></td>
            <td><?php echo $opettaja['visible'] == 1 ? 'true' : 'false'; ?></td>
            <td><?php echo h($opettaja['menu_name']); ?></td>
            <td><?php echo h($opettaja['koodi']); ?></td>
            <td><?php echo $kurssi_count; ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($opettaja['id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/opettajat/edit.php?id=' . h(u($opettaja['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/opettajat/delete.php?id=' . h(u($opettaja['id']))); ?>">Delete</a></td>
          </tr>
          <?php } ?>
        <?php } ?>
  <?php } ?>
<?php } else{?>
<?php } ?>



  	</table>

    <?php
      mysqli_free_result($opettaja_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
