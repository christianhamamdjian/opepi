<?php require_once('../../private/initialize.php'); ?>

<?php

  require_login();

  $palaute_set = find_all_palautteet();

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
<?php if($_SESSION['role'] == "admin"){ ?>
    <h1>Palautteet</h1>
<?php } ?>
  	<table class="list palaute">
  	  <tr>
        <th>ID</th>
        <th>Innovatiivisuus</th>
        <th>Esitys</th>
  	    <th>Toteutus</th>
        <th>Palaute</th>
  	  </tr>
        
<?php if($_SESSION['role'] == "admin"){ ?>
      <?php while($palaute = mysqli_fetch_assoc($palaute_set)) { ?>
        <tr>
          <td><?php echo h($palaute['id']); ?></td>
          <td><?php echo h($palaute['innovatiivisuus_score']); ?></td>
          <td><?php echo h($palaute['esitys_score']); ?></td>
          <td><?php echo h($palaute['toteutus_score']); ?></td>
          <td><?php echo h($palaute['palaute']); ?></td>
    	</tr>
      <?php } ?>
<?php } else{?>
<?php } ?>



  	</table>

    <?php
      mysqli_free_result($palaute_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
