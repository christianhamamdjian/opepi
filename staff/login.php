<?php
require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';
$role = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  $role = $_POST['role'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $admin = find_admin_by_username($username);
    if($admin) {

      if(password_verify($password, $admin['hashed_password'])) {
        // password matches
        log_in_admin($admin);
        redirect_to(url_for('/staff/index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }

  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
<a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Takaisin etusivulle</a>

  <h1>Kirjaudu sisään</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post" style="width:30%; margin-left:80px;">
    Käyttäyätunnus:<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    Salasana:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" class="button" value="Lähetä"  />
  </form>
  <br>
<a style="font-size:0.8rem;" href="register.php">Et ole käyttäjä? Kirjautu täältä &#62;&#62;></a>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
