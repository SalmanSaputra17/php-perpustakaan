<?php 

// koneksi
$conn = mysqli_connect("localhost","root","","perpustakaan");

function query($query){

	global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}

	return $rows;

}

function pinjam($data){

	global $conn;

	date_default_timezone_set("Asia/Jakarta");

	$nama = htmlspecialchars($data["nama"]);
	$judul = htmlspecialchars($data["judul"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
	$tgl_pinjam = date('Y-m-d');
	$tujuh_hari = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
	$tgl_kembali = date("Y-m-d", $tujuh_hari);

	$query = "INSERT INTO tb_pinjam VALUES('','$nama', '$judul', '$jumlah', '$tgl_pinjam', '$tgl_kembali')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function hapus_peminjam($id){

	global $conn;
	mysqli_query($conn, "DELETE FROM tb_pinjam WHERE id_peminjam = $id");
	return mysqli_affected_rows($conn);
		

}

function cari_peminjam($keyword){

	$query = "SELECT * FROM tb_pinjam 
				WHERE  
				nama_peminjam LIKE '%$keyword%' OR
				judul_buku LIKE '%$keyword%' OR
				jumlah LIKE '%$keyword%' OR
				tgl_pinjam LIKE '%$keyword%' OR
				tgl_kembali LIKE '%$keyword%'
			 ";

	return query($query);

}

?>
