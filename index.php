<?php 

session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="fa/css/font-awesome.min.css">
      <link rel="stylesheet"  href="css/style.css">
      <title>Perpustakaan</title> 
    </head>

    <body>

        <div class="main">
          <div class="navigation">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>  
          </div>  
        </div>

        <div class="banner">
          <div class="bann-caption">
            <div class="col l12 m6 s6">
              <p class="white-text center"><span class="condensed light">PERPUSTAKAAN</span> <span class="bold">SMK WIKRAMA BOGOR</span></p>
            </div>
          </div>
        </div>
        
        <ul id="slide-out" class="side-nav">
          <li>
            <div class="user-view">
              <div class="background">
                <img src="img/porf-4.jpg">
              </div>
              <a href="#!user"><img class="circle" src="img/team-3.jpg"></a>
              <a href="#!name"><span class="white-text name">Salman Saputra</span></a>
              <a href="#!email"><span class="white-text">SUPER ADMIN</span></a>
            </div>
          </li>
          <li><a class="waves-effect waves-light" href="index.php"><i class="material-icons">insert_chart</i>Dashboard</a></li>
          <li><a class="waves-effect waves-light" href="buku/buku.php"><i class="material-icons">book</i>Data Buku</a></li>
          <li><a class="waves-effect waves-light" href="anggota/anggota.php"><i class="material-icons">account_box</i>Data Anggota</a></li>
          <li><a class="waves-effect waves-light" href="transaksi/transaksi.php"><i class="material-icons">subject</i>Transaksi</a></li>
          <li><a class="waves-effect waves-light" href="logout.php"><i class="material-icons">highlight_off</i>Keluar</a></li>
        </ul>

        <div class="container">
          <div class="row">
            <div class="col l12 m12 s12">
                <div class="card-panel">
                  <h5 class="text-darken-2 center">Selamat Datang Di Perpustakaan Kami</h5>
                </div>
            </div>
            <div class="col l4 m6 s12">
              <div class="card hoverable">
                <div class="card-image">
                  <img src="img/teal4.jpg">
                  <span class="card-title">DATA BUKU</span>
                </div>
                <div class="card-content">
                  <p>Silahkan klik link dibawah ini untuk melihat dan menginput data buku</p>
                </div>
                <div class="card-action">
                  <a href="buku/buku.php">Lihat buku</a>
                </div>
              </div>
            </div>
            <div class="col l4 m6 s12">
              <div class="card hoverable">
                <div class="card-image">
                  <img src="img/teal4.jpg">
                  <span class="card-title">DATA ANGGOTA</span>
                </div>
                <div class="card-content">
                  <p>Silahkan klik link dibawah ini untuk melihat dan menginput data anggota</p>
                </div>
                <div class="card-action" id="anggota">
                  <a href="anggota/anggota.php">Lihat anggota</a>
                </div>
              </div>
            </div>
            <div class="col l4 m6 s12">
              <div class="card hoverable">
                <div class="card-image">
                  <img src="img/teal4.jpg">
                  <span class="card-title">TRANSAKSI</span>
                </div>
                <div class="card-content">
                  <p>Silahkan klik link dibawah ini untuk melakukan transaksi</p>
                </div>
                <div class="card-action">
                  <a href="transaksi/transaksi.php">Lakukan transaksi</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="fixed-action-btn">
          <a id="menu" class="btn btn-floating btn-large pulse waves-effect waves-light teal t-open tooltipped" data-position="left" data-delay="30" data-tooltip="Tekan untuk membaca petunjuk awal"><i class="material-icons">info_outline</i></a>
        </div>

        <div class="tap-target" data-activates="menu">
          <div class="tap-target-content">
            <p class="white-text">PETUNJUK</p>
            <p class="white-text">Silahkan anda Tekan tombol <b>MENU</b> di pojok kiri atas untuk melihat navigasi pada halaman ini. Atau anda dapat memilih pilihan disamping kiri petunjuk ini.</p>
          </div>
        </div>


      <!--Import jQuery before materialize.js-->
      <script src="js/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->
      <script src="js/materialize.min.js"></script>
      <script src="js/script.js"></script>
    </body>
  </html> 