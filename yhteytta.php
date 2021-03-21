<?php include("inc/header.php");?>
		


		<h1>Ota yhteyttä</h1>

		<form action="" method="post" id="frmLogin">
    <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
    <div class="field-group">
        <div>
            <label for="login">Username</label>
        </div>
        <div>
            <input name="member_name" type="text"
                value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"
                class="input-field">
        </div>
    </div>
    <div class="field-group">
        <div>
            <label for="password">Password</label>
        </div>
        <div>
            <input name="member_password" type="password"
                value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"
                class="input-field">
        </div>
    </div>
    <div class="field-group">
        <div>
            <input type="checkbox" name="remember" id="remember"
                <?php if(isset($_COOKIE["member_login"])) { ?> checked
                <?php } ?> /> <label for="remember-me">Remember me</label>
        </div>
    </div>
    <div class="field-group">
        <div>
        	<label for="w3review">Viesti:</label>

<textarea class="input-field" name="w3review" rows="4" cols="50"></textarea>
            
        </div>
    </div>
    <div class="field-group">
        <div>
            <input type="submit" name="login" value="Lähetä"
                class="form-submit-button"></span>
        </div>
    </div>
<?php include("inc/footer.php");?>