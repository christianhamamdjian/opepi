
<?php include("inc/header.php");?>
		


		<h1>Register</h1>		

            <form method="POST" action="" id="frmLogin">
                <div class="field-group">
                    <label>Firstname</label>
                    <input type="text" class="input-field" name="firstname" required="required"/>
                </div>
                <div class="field-group">
                    <label>Lastname</label>
                    <input type="text" class="input-field" name="lastname" required="required"/>
                </div>
                <div class="field-group">
                    <label>Username</label>
                    <input type="text" class="input-field" name="username" required="required"/>
                </div>
                <div class="field-group">
                    <label>Password</label>
                    <input type="password" class="input-field" maxlength="12" name="password" required="required"/>
                </div>
                <p><input type="checkbox" id="toggle"/> I agree with the terms and conditions.</p>
                <button class="form-submit-button" id="register" name="register">Register</button>
            </form>

<?php include("inc/footer.php");?>
