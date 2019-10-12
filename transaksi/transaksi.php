<?php  

session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

if ( isset($_POST["pinjam"]) ) {
  
  // cek apakah data kberhasil di tambahkan atau tidak
  if ( pinjam($_POST) > 0) {
    echo "
      <script>
        alert('Anda telah meminjam buku');
        document.location.href = 'transaksi.php';
      </script>
    ";
  }else{
    echo "
      <script>
        alert('Anda tidak meminjam buku');
        document.location.href = 'transaksi.php';
      </script>
    ";
  }  

}

$peminjam = query("SELECT * FROM tb_pinjam ORDER BY tgl_pinjam DESC");

if ( isset($_POST["cari"]) ) {

  $peminjam = cari_peminjam($_POST["keyword"]);
  echo "<script>document.location.href='#data';</script>";

}

$sql = "SELECT * FROM tb_buku";
$query = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM tb_anggota";
$query2 = mysqli_query($conn, $sql2);

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
          <li><a class="waves-effect waves-light" href="../buku/buku.php"><i class="material-icons">book</i>Data Buku</a></li>
          <li><a class="waves-effect waves-light" href="../anggota/anggota.php"><i class="material-icons">account_box</i>Data Anggota</a></li>
          <li><a class="waves-effect waves-light" href="transaksi.php"><i class="material-icons">subject</i>Transaksi</a></li>
          <li><a class="waves-effect waves-light" href="../logout.php"><i class="material-icons">highlight_off</i>Keluar</a></li>
        </ul>

          <div class="container">
            <div class="row">
              <div class="col l12 m12 s12">
                <div class="card-panel">
                  <h5 class="text-darken-2 center">Silahkan isi data peminjaman</h5>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col l6 m6 s12">
                <a href="../index.php" class="btn" type="submit" name="action"><i class="material-icons left">arrow_back</i>Kembali</a>
              </div>
            </div>
            <div class="row">
              <div class="col l12 m12 s12">
                <form class="col s12" action="" method="post">
                  <div class="row">
                    <div class="input-field col s12">
                      <select id="nama" name="nama" required>
                        <option value="">Pilih nama nggota</option>
                        <?php while($anggota = mysqli_fetch_assoc($query2)) { ?>
                        <option value="<?= $anggota["nama"] ?>" data-icon="../img/<?= $anggota["gambar"] ?>" class="left circle"><?= $anggota["nama"] ?></option>
                        <?php } ?>
                      </select>
                      <label for="nama">Nama</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <select id="judul" name="judul" required>
                        <option value="">Pilih judul buku</option>
                        <?php while($books = mysqli_fetch_assoc($query)) {  ?>
                        <option value="<?= $books["judul_buku"] ?>"><?= $books["judul_buku"] ?></option>
                        <?php } ?>
                      </select>
                      <label for="judul">Judul buku</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <input id="jumlah" type="number" name="jumlah" class="validate" placeholder="Jumlah buku" required>
                      <label for="jumlah">jumlah</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="tgl_pinjam" type="hidden" name="tgl_pinjam" class="validate" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="tgl_kembali" type="hidden" name="tgl_kembali" class="validate" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col s12">
                      <button class="btn right" type="submit" name="pinjam">Pinjam Buku</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col l12 m12 s12">
                <div class="card-panel">
                  <h5 class="text-darken-2 center">Daftar Peminjam Buku</h5>
                </div>
              </div>
            </div>
            <div class="row">
              <form action="" method="post" class="col m12 s12">
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">search</i>
                  <input id="keyword" type="text" name="keyword" class="validate">
                  <label for="keyword">Cari Seseorang...</label>
                </div>
                <div class="col l6 m6 s12">
                  <button type="submit" name="cari" class="btn btn-floating btn-large"><i class="material-icons">search</i></button>
                  <button type="submit" name="back" class="btn btn-floating btn-large"><i class="material-icons">refresh</i></button>
                </div>
              </form>
            </div>
            <div class="row">
              <div class="col s12">
                <table class="table responsive-table bordered striped highlight centered" id="data">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Judul Buku</th>
                      <th>Jumlah</th>
                      <th>Tanggal Pinjam</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                      <?php foreach( $peminjam as $row ) : ?>
                        <tr>
                          <td><?= $i; ?></td>
                          <td><?= $row["nama_peminjam"]; ?></td>
                          <td><?= $row["judul_buku"]; ?></td>
                          <td><?= $row["jumlah"]; ?></td>
                          <td><?= $row["tgl_pinjam"]; ?></td>
                          <td>
                            <a href="hapus_peminjam.php?id_peminjam=<?= $row["id_peminjam"] ?>" onclick="return confirm('Apakah anda yakin ingin mengembalikan buku ini ?')" class="btn waves-effect waves-light red">Kembalikan</a>
                          </td>
                        </tr>
                      <?php $i++; ?>  
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div> 

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="../js/jquery.min.js"></script>
      <!-- Compiled and minified JavaScript -->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="../js/script.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
          $('select').material_select();
        });
      </script>
    </body>
  </html> 