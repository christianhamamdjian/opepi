<?php require_once('../../private/initialize.php'); ?>

<?php

require_login();

$id = $_GET['id'] ?? '1';

$kurssi = find_kurssi_by_id($id);
$opettaja = find_opettaja_by_id($kurssi['opettaja_id']);
$opiskelija_set = find_all_opiskelijat();
?>

<?php $kurssi_title = 'Show kurssi'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/opettajat/show.php?id=' . h(u($opettaja['id']))); ?>">&laquo; Takaisin opettajan kursseille</a>

  <div class="kurssi show">

    <h1>kurssi: <?php echo h($kurssi['menu_name']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/index.php?kurssi_id=' . h(u($kurssi['id'])) . '&preview=true'); ?>" target="_blank">Esikatsele</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>opettaja</dt>
        <dd><?php echo h($opettaja['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><?php echo h($kurssi['menu_name']); ?></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd><?php echo h($kurssi['position']); ?></dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd><?php echo $kurssi['visible'] == '1' ? 'true' : 'false'; ?></dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd><?php echo h($kurssi['content']); ?></dd>
      </dl>
    </div>


  </div>



  <div>
    <h3>Opiskelijat</h3>
<?php if($_SESSION['role'] == "admin" or $_SESSION['role'] == "ope"){ ?>
    <div class="actions">
      <!-- <a class="action" href="<?php echo url_for('/staff/opiskelijat/new.php'); ?>">Luo uusi opiskelija</a> -->
    </div>
<?php } ?>
  	<table class="list">
  	  <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
  	    <th>Nimi</th>
        <th>Kurssi</th>
        <th>Tehtävät</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>Koodi</th>
  	  </tr>

<?php if($_SESSION['role'] == "ope"){?>
  <?php while($opiskelija = mysqli_fetch_assoc($opiskelija_set)) { ?>
    <?php //while($admin = mysqli_fetch_assoc($admin_set)) { ?>
    <?php if(strtolower($opiskelija['kurssi']) == strtolower($kurssi['menu_name'])){ ?>
          <?php $tehtava_count = count_tehtavat_by_opiskelija_id($opiskelija['id']); ?>
          <tr>
            <td><?php echo h($opiskelija['id']); ?></td>
            <td><?php echo h($opiskelija['position']); ?></td>
            <td><?php echo $opiskelija['visible'] == 1 ? 'true' : 'false'; ?></td>
            <td><?php echo h($opiskelija['menu_name']); ?></td>
            <td><?php echo h($opiskelija['kurssi']); ?></td>
            <td><?php echo $tehtava_count; ?></td>
            <td><a class="action" href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($opiskelija['id']))); ?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/opiskelijat/edit.php?id=' . h(u($opiskelija['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/opiskelijat/delete.php?id=' . h(u($opiskelija['id']))); ?>">Delete</a></td>
            <td><?php echo h($opiskelija['koodi']); ?></td>
          </tr>
          <?php } ?>
        <?php //} ?>
  <?php } ?>
<?php } else{?>
<?php } ?>

  	</table>

    <?php
      mysqli_free_result($opiskelija_set);
    ?>
  </div>

</div>


 




<?php include(SHARED_PATH . '/staff_footer.php'); ?>
