<?php  

require 'functions.php';

if ( isset($_POST["register"]) ) {
  
  if ( registrasi($_POST) > 0 ) {
    echo "<script>
          alert('Anda berhasil terdaftar sebagai user baru');
          document.location.href='login.php';
          </script>";
  }else{
    echo mysqli_error($conn);
  }

}


?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="css/login.css">
      <title>Registrasi</title>
    </head>

    <body>

      <div class="container">
            <div class="row">
              <div class="col l6 m12 s12 offset-l3 z-depth-4 wrapper">
                <form class="col s12" action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col s12">
                      <p class="teal-text caption center">Register for an account</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="username" type="text" name="username" class="validate">
                      <label for="username">username</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="email" type="email" name="email" class="validate">
                      <label for="email">Email</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="Password" type="password" name="password" class="validate">
                      <label for="password">Password</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="konfirmasi-password" type="password" name="konfirmasi-password" class="validate">
                      <label for="konfirmasi-password">Confirm Password</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s3">
                      <button class="btn" type="submit" name="register">Register</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <a href="login.php" class="teal-text center right suggest">Back to login page !</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
      </div>
        
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
    </body>
  </html> 