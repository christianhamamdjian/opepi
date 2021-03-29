<?php
require_once('private/initialize.php');
include('private/shared/public_header.php');
?>

 <div class="form_box">
 <form method="post" action="palaute.php">
 <div class="heading">
   Palautelomake
 </div>
 <br/>
 <h3>Mitä mieltä olet laadusta tämä sovellus?</h3>
 <div>
   <div class="pic">
     <input type="radio" name="quality" value="0" required> Huono
   </div>
   <div class="pic">
     <input type="radio" name="quality" value="1" required> Tyydyttävä
   </div>
   <div class="pic">
     <input type="radio" name="quality" value="2" required> Hyvää
   </div>
 </div>
 <br>
 <div>
 <h3>Onko sinulla ehdotusta meille? </h3>
 <textarea name=" suggestion" rows="8" cols="40" required></textarea>
 </div>
 <div class="submit">
  <input type="submit" name="submit" value="Lähetä">
</div>
</form>


<?php
include('private/shared/public_footer.php');
?>