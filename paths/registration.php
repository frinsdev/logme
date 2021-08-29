<?php 
  session_start();
  require('../config/connect.php');

  $username = "";
  $email = "";
  $errors = array();

  if(isset($_SESSION['email'])) {
    header("location: http://$_SERVER[HTTP_HOST]/index.php");
  }

  if(isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password_confirmation = mysqli_real_escape_string($conn, $_POST['password_confirmation']);

    if(empty($firstname)) { array_push($errors, "Firstname is required"); }
    if(empty($lastname)) { array_push($errors, "Lastname is required"); }
    if(empty($contact_number)) { array_push($errors, "Contact number is required"); }
    if(empty($email)) { array_push($errors, "Email is required"); }
    if(empty($username)) { array_push($errors, "Username is required"); }
    if(empty($password)) { array_push($errors, "Password is required"); }
    if($password != $password_confirmation) { array_push($errors, "Password confirmation does not match."); }

    $user_check_query = "SELECT * FROM `users` WHERE username = '$username' or email = '$email'";
    $user_check_query_result = mysqli_query($conn, $user_check_query);

    if(mysqli_num_rows($user_check_query_result) > 0) {
      $user = mysqli_fetch_assoc($user_check_query_result);
      if($user['username'] == $username) { array_push($errors, "Username already taken"); }
      if($user['email'] == $email) { array_push($errors, "Email already taken"); }
    }

    if(count($errors) == 0) {
      $password = MD5($password);
      $insert_user_query = "INSERT INTO `users`(`firstname`, `lastname`, `contact_number`, `username`, `email`, `password`) VALUES('$firstname', '$lastname', '$contact_number', '$username', '$email', '$password')";

      mysqli_query($conn, $insert_user_query);
      $_SESSION['email'] = $email;

      header("location: http://$_SERVER[HTTP_HOST]/index.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <div class="col-12 col-lg-5 mx-auto my-5">
    <div class="card border-0 shadow-sm pb-5">
      <div class="card-header bg-primary border-0"></div>
      <div class="text-center pt-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" class="img-fluid" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
      </div>
      <h1 class="text-center mt-3">JOIN</h1>
      <form class="px-4 px-md-5" method="post">
        <?php  if (count($errors) > 0) : ?>
          <div class="error">
            <div class="alert alert-danger" role="alert">
              <?php foreach ($errors as $error) : ?>
                <li><?php echo $error ?></li>
              <?php endforeach ?>
            </div> 
          </div>
        <?php  endif ?>
        <div class="row my-3">
          <div class="col-12 col-md-6">
            <input name="firstname" type="text" placeholder="Firstname" class="form-control" value="<?php echo $firstname ?>">
          </div>
          <div class="col-12 col-md-6">
            <input name="lastname" type="text" placeholder="Lastname" class="form-control" value="<?php echo $lastname ?>">
          </div>
        </div>
        <input name="email" type="email" placeholder="Email" class="form-control my-3" value="<?php echo $email ?>">
        <input name="contact_number" type="number" placeholder="Contact Number" class="form-control my-3" value="<?php echo $contact_number ?>">
        <input name="username" type="text" placeholder="Username" class="form-control my-3" value="<?php echo $username ?>">
        <input name="password" type="password" placeholder="Password" class="form-control my-3">
        <input name="password_confirmation" type="password" placeholder="Password Confirmation" class="form-control">
        <div class="form-check my-3">
          <input type="checkbox" class="form-check-input">
          <label class="form-check-label">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis tortor tellus, fringilla eget mattis ut, consequat nec est.</label>
        </div>
        <div class="my-3">
          <a href="/paths/login.php">I already have account.</a>
        </div>
        <button name="register" type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
</script>
</body>
</html>