<?php  

session_start();
require 'functions.php';

// cek cookie
if ( isset($_COOKIE['mark']) && isset($_COOKIE['key']) ) {

  $mark = $_COOKIE['mark'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE id = $mark");

  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if ( $key === hash('sha256', $row['username']) ) {
    
    $_SESSION['login'] = true;

  }

}

if ( isset($_SESSION["login"]) ) {
  header("Location: index.php");
  exit;
}

if ( isset($_POST["login"]) ) {
  
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

  // cek apakah username tersedia atau tidak
  if (mysqli_num_rows($result) === 1) {
    
    // cek password
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])){

      // set session
      $_SESSION["login"] = true;

      // cek remember me
      if ( isset($_POST["remember"]) ) {
        
        // buat cookie
        setcookie('mark', $row['id'], time() + 180);
        setcookie('key', hash('sha256', $row['username']), time() + 180);

      }

      header('Location: index.php');
      exit;
    }

  }

  $error = true;

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
      <link rel="stylesheet" type="text/css" href="css/login.css">
      <title>Login</title>
    </head>

    <body>

          <div class="container">
            <div class="row">
              <div class="col l6 m12 s12 offset-l3 z-depth-4 wrapper">
                <form class="col s12" action="" method="post">
                  <div class="row">
                    <div class="col s12">
                      <p class="teal-text caption center">Please login into your account</p>
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
                      <input id="Password" type="password" name="password" class="validate">
                      <label for="password">Password</label>
                    </div>
                  </div>
                  <?php if( isset($error) ) : ?>
                    <div class="row">
                      <div class="col s12 ">
                          <p class="red-text error">*Username atau password yang anda masukkan salah</p>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="row">
                    <div class="col s12">
                      <p>
                        <input type="checkbox" name="remember" id="remember" />
                        <label for="remember">Remember Me</label>
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s3">
                      <button class="btn" type="submit" name="login">Login</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <a href="register.php" class="teal-text right suggest">Don't have an account? register here</a>
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