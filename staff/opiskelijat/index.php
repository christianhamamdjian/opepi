<?php require_once('../../private/initialize.php'); ?>

<?php

  require_login();

  $opiskelija_set = find_all_opiskelijat();
  $admin_set = find_all_admins();
  $kurssit_set = find_all_kurssit();
  
?>

<?php $tehtava_title = 'opiskelijat'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="opiskelijat listing">
        <h1>Opiskelijat</h1>


        <?php if($_SESSION['role'] == "admin" or $_SESSION['role'] == "ope"){ ?>
        <div class="actions">
            <a class="action" href="<?php echo url_for('/staff/opiskelijat/new.php'); ?>">Luo uusi opiskelija</a>
        </div>
        <?php } ?>

        <?php if($_SESSION['role'] == "admin" or $_SESSION['role'] == "ope"){ ?>
        <table class="list opi">
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

            <?php while($opiskelija = mysqli_fetch_assoc($opiskelija_set)) { ?>
            <?php $tehtava_count = count_tehtavat_by_opiskelija_id($opiskelija['id']); ?>
            <tr>
                <td><?php echo h($opiskelija['id']); ?></td>
                <td><?php echo h($opiskelija['position']); ?></td>
                <td><?php echo $opiskelija['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($opiskelija['menu_name']); ?></td>
                <td><?php echo h($opiskelija['kurssi']); ?></td>
                <td><?php echo $tehtava_count; ?></td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($opiskelija['id']))); ?>">View</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/opiskelijat/edit.php?id=' . h(u($opiskelija['id']))); ?>">Edit</a>
                </td>
                <td><a class="action"
                        href="<?php echo url_for('/staff/opiskelijat/delete.php?id=' . h(u($opiskelija['id']))); ?>">Delete</a>
                </td>
                <td><?php echo h($opiskelija['koodi']); ?></td>
            </tr>
            <?php } ?>


            <?php } elseif($_SESSION['role'] == "opi"){?>
            <table class="list opi">
                <tr>
                    <!-- <th>ID</th>
        <th>Position</th>
        <th>Visible</th> -->
                    <th>Nimi</th>
                    <th>Kurssi</th>
                    <th>Kurssin linkki</th>
                    <th>Tehtävät</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <!-- <th>Koodi</th> -->
                </tr>
                <?php while($opiskelija = mysqli_fetch_assoc($opiskelija_set)) { ?>

                <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>

                <?php if($opiskelija['koodi'] == $admin['koodi']){ ?>

                <?php $tehtava_count = count_tehtavat_by_opiskelija_id($opiskelija['id']); ?>

                <?php while($kurssit = mysqli_fetch_assoc($kurssit_set)){ if($kurssit['menu_name'] == $opiskelija['kurssi']){ ?>
                <tr>
                    <td><?php echo h($opiskelija['menu_name']); ?></td>
                    <td><?php echo h($opiskelija['kurssi']); ?></td>
                    <td><a class="action" target="_blank"
                            href="<?php echo url_for('/index.php?kurssi_id=' . h(u($kurssit['id'])) . '&preview=true'); ?>"
                            target="_blank">Kurssin linkki</a>
                    </td>
                    <td><?php echo $tehtava_count; ?></td>
                    <td><a class="action"
                            href="<?php echo url_for('/staff/opiskelijat/show.php?id=' . h(u($opiskelija['id']))); ?>">View</a>
                    </td>
                    <td><a class="action"
                            href="<?php echo url_for('/staff/opiskelijat/edit.php?id=' . h(u($opiskelija['id']))); ?>">Edit</a>
                    </td>
                    <td><a class="action"
                            href="<?php echo url_for('/staff/opiskelijat/delete.php?id=' . h(u($opiskelija['id']))); ?>">Delete</a>
                    </td>
                    <!-- <td><?php echo h($opiskelija['koodi']); ?></td> -->
                </tr>
                <?php } ?>
                <?php } ?>
                <?php } ?>
                <?php } ?>
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