<?php  
usleep(1000000);
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

$anggota = query("SELECT * FROM tb_anggota");

if ( isset($_POST["cari"]) ) {

  $anggota = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="../css/materialize.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>

        <div class="main">
          <div class="navigation">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>  
          </div>  
        </div>

        <!-- <div class="progress" id="progress">
            <div class="indeterminate"></div>
        </div> -->
        
        <ul id="slide-out" class="side-nav">
          <li>
            <div class="user-view">
              <div class="background">
                <img src="../img/porf-4.jpg">
              </div>
                <a href="#!user"><img class="circle" src="../img/team-3.jpg"></a>
                <a href="#!name"><span class="white-text name">Salman Saputra</span></a>
                <a href="#!email"><span class="white-text email">SUPER ADMIN</span></a>
            </div>
          </li>
          <li><a class="waves-effect waves-light" href="../index.php"><i class="material-icons">insert_chart</i>Dashboard</a></li>
          <li><a class="waves-effect waves-light" href="../buku/buku.php"><i class="material-icons">book</i>Data Buku</a></li>
          <li><a class="waves-effect waves-light" href="#"><i class="material-icons">account_box</i>Data Anggota</a></li>
          <li><a class="waves-effect waves-light" href="../transaksi/transaksi.php"><i class="material-icons">subject</i>Transaksi</a></li>
          <li><a class="waves-effect waves-light" href="../logout.php"><i class="material-icons">highlight_off</i>Keluar</a></li>
        </ul>

        <div class="container">
          <div class="row">
            <div class="col l12 m12 s12">
              <div class="card-panel">
                <h5 class="text-darken-2 center">Daftar Anggota Di Perpustakaan</h5>
              </div>
            </div>
          </div>
          <div class="row">
              <form action="" method="post" class="col m12 s12">
                <div class="input-field col m6 s12">
                  <i class="material-icons prefix">search</i>
                  <input id="keyword" type="text" name="keyword" class="validate">
                  <label for="keyword">Cari Seseorang...</label>
                </div>
                <div class="col m6 s12">
                  <button type="submit" name="cari" class="btn btn-floating btn-large"><i class="material-icons">search</i></button>
                  <button type="submit" name="back" class="btn btn-floating btn-large"><i class="material-icons">refresh</i></button>
                </div>
              </form>
          </div>
          <div id="container">
            <div class="row">
              <div class="col s12">
                <table class="table responsive-table bordered striped highlight centered">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>AKSI</th>
                      <th>NIS</th>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Email</th>
                    </tr>  
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                      <?php foreach( $anggota as $row ) : ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td> 
                            <a href="ubah.php?id_anggota=<?= $row["id_anggota"]; ?>" class="btn btn-floating waves-effect waves-light light_blue"><i class="material-icons">create</i></a>
                            <a href="hapus.php?id_anggota=<?= $row["id_anggota"] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="btn btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></a>
                          </td>
                          <td><?= $row["nis"]; ?></td>
                          <td>
                            <img src="../img/<?= $row["gambar"]; ?>" width="50">
                          </td>
                          <td><?= $row["nama"]; ?></td>
                          <td><?= $row["email"]; ?></td>
                        </tr> 
                        <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col m6 s12">
                <a href="../index.php" class="btn" type="submit" name="action">Kembali ke Dashboard
                  <i class="material-icons left">arrow_back</i>
                </a>
              </div>
          </div>
        </div> 

        <div class="fixed-action-btn">
          <a class="btn btn-floating btn-large pulse waves-effect waves-light teal tooltipped" data-position="left" data-delay="30" data-tooltip="Tekan untuk tambah anggota" href="tambah_anggota.php"><i class="material-icons">person_add</i></a>
        </div>


      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/script.js"></script>
    </body>
  </html> 