<?php
require_once('private/initialize.php');

include('private/shared/public_header.php');

global $db;

$q_score = $_POST['quality'];
$feedback_txt = strip_tags($_POST['suggestion']);



// if (isset($_POST['quality'])) {

//   echo 'Olet valinnut:<br>';

//   if ($_POST['quality'] === '1') {

//     echo 'Huono';

//   } else if ($_POST['quality'] === '2') {

//     echo 'Tyyduttävä';

//   } else if ($_POST['quality'] === '3') {

//     echo 'Hyvää';

//   }

// } else {

//   echo 'Et ole valinnut mitään.';

// }



$query ="insert into palaute(quality_score, feedback)values($q_score, '$feedback_txt')";
$result = mysqli_query($db, $query);
if($result)
  echo '<h1 style="width:50%;margin:100px auto;">Kiitos palautteesta. Arvostamme!</h1>';
else
die("Jotain kauheaa tapahtui. Yritä uudelleen. ");
?>

<?php
include('private/shared/public_footer.php');
?>