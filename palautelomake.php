<?php
require_once('private/initialize.php');
include('private/shared/public_header.php');
?>

 <div class="form_box">
 <form method="post" action="palaute.php" id="palaute">
 <div class="heading">
   Palautelomake
 </div>
 <br/>

 <h3>Mitä mieltä olet laadusta tämä sovellus?</h3>

 <h3>Innovatiivisuus:</h3>
 <div>
   <div>
     <input type="radio" name="innovatiivisuus" value="0" required> Hyvää
   </div>
   <div>
     <input type="radio" name="innovatiivisuus" value="1" required> Parannettevaa
   </div>
 </div>
 <br>
 <h3>Esitys:</h3>
 <div>
   <div>
     <input type="radio" name="esitys" value="0" required> Hyvää
   </div>
   <div>
     <input type="radio" name="esitys" value="1" required> Parannettevaa
   </div>
 </div>
 <br>
 <h3>Toteutus:</h3>
 <div>
   <div>
     <input type="radio" name="toteutus" value="0" required> Hyvää
   </div>
   <div>
     <input type="radio" name="toteutus" value="1" required> Parannettevaa
   </div>
 </div>
 <br>
 <div>
 <h3>Onko sinulla ehdotusta meille? </h3>
 <textarea name="palaute" rows="8" cols="40" required></textarea>
 </div>
 <div class="submit">
  <input type="submit" name="submit" onClick="ValidateForm(this.form)" value="Lähetä">
</div>
</form>
<script>
function init() {
  document.getElementById("palaute").reset();
}
window.onload = init;

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
if (ErrorText= "") { 
  form.submit();
  form.reset();
 }
}
</script>

<?php
include('private/shared/public_footer.php');
?>