<?php  

session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// ambil data dari url
$id_anggota = $_GET["id_anggota"];

// query data anggota berdasarkan id
$anggota = query("SELECT * FROM tb_anggota WHERE id_anggota = $id_anggota")[0];

if ( isset($_POST["ubah"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if ( ubah($_POST) > 0) {
		echo "
			<script>
				alert('Data berhasil diubah');
				document.location.href = 'anggota.php';
			</script>
		";
	}else{
		echo "
			<script>
				alert('Data gagal diubah');
				document.location.href = 'anggota.php';
			</script>
		";
	}

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
          <li><a class="waves-effect waves-light" href="#"><i class="material-icons">book</i>Data Buku</a></li>
          <li><a class="waves-effect waves-light" href="../anggota/anggota.php"><i class="material-icons">account_box</i>Data Anggota</a></li>
          <li><a class="waves-effect waves-light" href="../transaksi/transaksi.php"><i class="material-icons">subject</i>Transaksi</a></li>
          <li><a class="waves-effect waves-light" href="../logout.php"><i class="material-icons">highlight_off</i>Keluar</a></li>
        </ul>

        <div class="container">
          <div class="row">
            <div class="col l12 m12 s12">
              <div class="card-panel">
                <h5 class="text-darken-2 center">Ubah Data Anggota</h5>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col l6 m6 s12">
              <a href="anggota.php" class="btn" type="submit" name="action"><i class="material-icons left">arrow_back</i>Kembali</a>
            </div>
          </div>
          <div class="row">
            <div class="col l12 m12 s12">
              <form class="col s12" action="" method="post" enctype="multipart/form-data">
              	<div class="row">
		              <div class="input-field col s12">
						      <input type="hidden" name="id_anggota" value="<?= $anggota["id_anggota"]; ?>">
					      </div>
      		      <div class="row">
      		        <div class="input-field col s12">
      						<input type="hidden" name="gambarlama" value="<?= $anggota["gambar"]; ?>">
      					</div>
  	            </div>
                  <div class="row">
                    <div class="input-field col s6">
                      <input id="nis" type="text" name="nis" class="validate" value="<?= $anggota["nis"]; ?>" required>
                      <label for="nis">NIS</label>
                    </div>
                    <div class="input-field col s6">
                      <input id="nama" type="text" name="nama" class="validate" value="<?= $anggota["nama"]; ?>">
                      <label for="nama">Nama</label>
                    </div>
                  </div>
                  <div>
  					        <img src="../img/<?= $anggota["gambar"]; ?>" width="50">
                  </div>
                  <div class="row">
                      <div class="file-field input-field col s12">
                        <div class="btn">
                          <span>Ubah Gambar</span>
                          <input type="file" name="gambar" multiple>
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text" placeholder="Tambahkan Gambar">
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="email" type="text" name="email" class="validate" value="<?= $anggota["email"]; ?>">
                      <label for="email">Email</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <button class="btn right" type="submit" name="ubah">Ubah Data</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        </div>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/script.js"></script>
    </body>
  </html> 