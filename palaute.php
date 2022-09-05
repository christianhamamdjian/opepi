<?php
require_once('private/initialize.php');

include('private/shared/public_header.php');

global $db;
//if(isset($_POST['submit'])){
$inno_score = $_POST['innovatiivisuus'] ? strip_tags("Parannettevaa") : strip_tags("Hyvää") ;
$esitys_score = $_POST['esitys'] ? strip_tags("Parannettevaa") : strip_tags("Hyvää") ;
$toteutus_score = $_POST['toteutus'] ? strip_tags("Parannettevaa") : strip_tags("Hyvää") ;
$palaute_txt = strip_tags($_POST['palaute']);
// }else{

// }

// echo $inno_score;
// echo $esitys_score;
// echo $toteutus_score;
// echo $palaute_txt;

$query ="insert into palaute(innovatiivisuus_score, esitys_score, toteutus_score, palaute)values('$inno_score', '$esitys_score', '$toteutus_score', '$palaute_txt')";

$result = mysqli_query($db, $query);
if($result)
  echo '<h1 style="width:50%;margin:120px auto;">Kiitos palautteesta. Arvostamme!</h1>';
else
die("<h1 style=\"width:50%;margin:120px auto;\">Jotain kauheaa tapahtui. Yritä uudelleen.</h1>");
?>

<?php
include('private/shared/public_footer.php');
?>