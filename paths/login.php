<?php
  session_start();
  require('../config/connect.php');

  $errors = array();

  if(isset($_SESSION['email'])) {
    header("location: http://$_SERVER[HTTP_HOST]/index.php");
  }

  if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($email)) { array_push($errors, "Email is required"); }
    if(empty($password)) { array_push($errors, "Password is required"); }

    if(count($errors) == 0) {
      $password = md5($password);

      $login_query = "SELECT * FROM `users` WHERE email = '$email' and password = '$password'";
      $login_query_results = mysqli_query($conn, $login_query);

      if(mysqli_num_rows($login_query_results) == 1) {
        $_SESSION['email'] = $email;
        header("location: http://$_SERVER[HTTP_HOST]/index.php");
      }else{
        array_push($errors, "Invalid Email or Password");
      }
    }  
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Back!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <div class="col-12 col-lg-5 mx-auto my-5">
    <div class="card border-0 shadow-sm pb-5">
      <div class="card-header bg-primary border-0"></div>
      <div class="text-center py-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" class="img-fluid" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
      </div>
      <h1 class="text-center pb-4">Welcome Back!</h1>
      <form class="px-4 px-md-5" method="POST">
        <div class="alert alert-primary" role="alert">
          <div>Demo Credential: </div>
          <div>Email: admin, Password: admin </div>
        </div>
        <?php  if (count($errors) > 0) : ?>
          <div class="error">
            <div class="alert alert-danger" role="alert">
              <?php foreach ($errors as $error) : ?>
                <li><?php echo $error ?></li>
              <?php endforeach ?>
            </div> 
          </div>
        <?php  endif ?>
        <input name="email" type="email" placeholder="Email" class="form-control my-3">
        <input name="password" type="password" placeholder="Password" class="form-control my-3">
        <div class="my-3">
          <a href="/paths/registration.php">I don't have account.</a>
        </div>
        <button class="login btn btn-primary" type="submit" name="login" id="submit">Login</button><br />
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
</script>
</body>
</html>