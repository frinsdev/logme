<?php 
  session_start();
  require('config/connect.php');

  function get_current_email() {
    return $_SESSION['email'];
  }

  function connection_query() {
    require('config/connect.php');

    $user_email = get_current_email();
    $user_query = "SELECT * FROM `users` WHERE email = '$user_email'";
    $connection_query = $conn->query($user_query);

    return $connection_query;
  }

  function get_fullname() {
    $request_data = connection_query();
    $request_data = $request_data->fetch_assoc();
    $user_fullname = "$request_data[firstname] $request_data[lastname]";

    return $user_fullname;
  }

  $current_user_fullname = get_fullname();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogMe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
  <?php if(isset($_SESSION['email'])) { ?>
    <div class="container">
      <div class="col-12 col-md-10 mx-auto my-5">
        <div class="card border-0 shadow-lg my-5">
          <div class="card-header bg-white border-0">
            <div class="text-end">
              <a href="paths/logout.php" class="btn btn-danger">Logout</a>
            </div>
          </div>
          <div class="text-center p-5">
            <div class="my-4">
              <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" class="img-fluid" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </div>
            <h1 class="mb-5"><?php echo $current_user_fullname; ?></h1>
          </div>
        </div>
      </div>
    </div>
  <?php }else{ ?>
    <div class="container">
      <div class="col-12 col-md-10 mx-auto">
        <div class="card border-0 shadow-lg my-5">
          <div class="card-header bg-primary border-0">
            <div class="text-end">
              <a href="/paths/login.php" class="text-white">Sign In</a>
            </div>
          </div>
          <div class="px-5 py-3">
            <h1 class="text-center mb-4">Hi Welcome to LogMe.</h1>
            <div class="container">
              <div class="row">
                <div class="col-12 my-3">
                  <div class="row">
                    <div class="col-12 col-md-5 col-lg-3 text-center mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" class="img-auto" fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                      </svg>
                    </div>
                    <div class="col-12 col-md-6 col-lg-9">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo quis imperdiet massa tincidunt nunc pulvinar.</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 my-3">
                  <div class="row flex-column-reverse flex-lg-row">
                    <div class="col-12 col-md-6 col-lg-9">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Commodo quis imperdiet massa tincidunt nunc pulvinar.</p>
                    </div>
                    <div class="col-12 col-md-5 col-lg-3 text-center mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" class="img-auto" fill="currentColor" class="bi bi-calendar2-week" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                        <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center">
              <a href="/paths/registration.php" class="btn btn-primary btn-lg">Get Started >></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
  </script>
</body>
</html>