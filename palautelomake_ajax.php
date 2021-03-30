<?php
require_once('private/initialize.php');
include('private/shared/public_header.php');

if(!empty($_POST)) {
global $db;
$inno_score = $_POST['innovatiivisuus'] ? strip_tags("Parannettevaa") : strip_tags("Hyvää") ;
$esitys_score = $_POST['esitys'] ? strip_tags("Parannettevaa") : strip_tags("Hyvää") ;
$toteutus_score = $_POST['toteutus'] ? strip_tags("Parannettevaa") : strip_tags("Hyvää") ;
$palaute_txt = strip_tags($_POST['palaute']);

$error_msg = array(); 
    if(!isset($_POST['innovatiivisuus'])){ 
        $error_msg[] = "Ei radiopainikkeita tarkistettiin."; 
    } 
    if(!isset($_POST['esitys'])){ 
      $error_msg[] = "Ei radiopainikkeita tarkistettiin."; 
    } 
    if(!isset($_POST['esitys'])){ 
      $error_msg[] = "Ei radiopainikkeita tarkistettiin."; 
    }
    else{ 
        // redirect to the form again. 
    }


$query ="insert into palaute(innovatiivisuus_score, esitys_score, toteutus_score, palaute)values('$inno_score', '$esitys_score', '$toteutus_score', '$palaute_txt')";
mysqli_query($db, $query);

}
?>

<div class="form_box">
    <form method="post" action="#" id="contactform" onsubmit="return validateForm()">
        <div class="heading">
            Palautelomake
        </div>
        <br />
        <div id="result"> </div>
        <br />
        <h3>Mitä mieltä olet laadusta tämä sovellus?</h3>

        <h3>Innovatiivisuus:</h3>
        <div>
            <div>
                <input type="radio" name="innovatiivisuus" value="0" id="innovatiivisuus" > Hyvää
            </div>
            <div>
                <input type="radio" name="innovatiivisuus" value="1" > Parannettevaa
            </div>
        </div>
        <br>
        <h3>Esitys:</h3>
        <div>
            <div>
                <input type="radio" name="esitys" value="0" id="esitys" > Hyvää
            </div>
            <div>
                <input type="radio" name="esitys" value="1" > Parannettevaa
            </div>
        </div>
        <br>
        <h3>Toteutus:</h3>
        <div>
            <div>
                <input type="radio" name="toteutus" value="0" id="toteutus" > Hyvää
            </div>
            <div>
                <input type="radio" name="toteutus" value="1" > Parannettevaa
            </div>
        </div>
        <br>
        <div>
            <h3>Onko sinulla ehdotusta meille? </h3>
            <textarea name="palaute" rows="8" cols="40" id="palaute" ></textarea>
        </div>
        <div class="submit">
          <input type="submit" name="submit" onClick="ValidateForm(this.form)" value="Lähetä">
        </div>
        <!-- <button type="submit" class="btn btn-primary">Lähetä</button> -->
        <!-- <input type="submit" name="SubmitButton" value="Lähetä" onClick="ValidateForm(this.form)" /> -->
    </form>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
function ValidateForm(form){
ErrorText= "";
if ( ( form.innovatiivisuus[0].checked == false ) && ( form.innovatiivisuus[1].checked == false ) ) 
{
alert ( "Valitse innovatiivisuus vaihtoehto." ); 
return false;
}
if ( ( form.esitys[0].checked == false ) && ( form.esitys[1].checked == false ) ) 
{
alert ( "Valitse esitys vaihtoehto." ); 
return false;
}
if ( ( form.toteutus[0].checked == false ) && ( form.toteutus[1].checked == false ) ) 
{
alert ( "Valitse toteutus vaihtoehto." ); 
return false;
}
if (ErrorText= "") { form.submit() }
}
</script>
<script>
$(document).ready(function() {
    $('.btn-primary').click(function(e) {
        e.preventDefault();
        var innovatiivisuus = $('#innovatiivisuus').val();
        var esitys = $('#esitys').val();
        var toteutus = $('#toteutus').val();
        var palaute = $('#palaute').val();
        var kiitosViesti = "<h3 style='color:red;'>Kiitos palautteesta. Arvostamme!</h3>";
        $.ajax({
            type: "POST",
            url: "<?php echo $_SERVER['PHP_SELF']; ?>",
            data: { "innovatiivisuus": innovatiivisuus, "esitys": esitys, "toteutus": toteutus, "palaute": palaute },
            success: function(data) {
                $('#result').html('Kiitos palautteesta. Arvostamme!');
                $('#contactform')[0].reset();
            }
        });
    });
});
</script>
<?php
include('private/shared/public_footer.php');
?>