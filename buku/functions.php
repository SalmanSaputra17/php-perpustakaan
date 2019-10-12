<?php 

// koneksi
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");

function query($query){

	global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ){
		$rows[] = $row;
	}

	return $rows;

}

function tambah($data){

	global $conn;

	$judul = htmlspecialchars($data["judul_buku"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
	$jumlah = htmlspecialchars($data["jumlah"]);

	$query = "INSERT INTO tb_buku VALUES('','$judul', '$pengarang', '$penerbit' , $tahun_terbit , $jumlah)";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function hapus($id){

	global $conn;

	mysqli_query($conn, "DELETE FROM tb_buku WHERE id_buku = $id");
	return mysqli_affected_rows($conn);	

}

function ubah($data){

	global $conn;

	$id_buku = $data["id_buku"];
	$judul = htmlspecialchars($data["judul_buku"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$penerbit = htmlspecialchars($data["penerbit"]);	
	$tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
	$jumlah = htmlspecialchars($data["jumlah"]);	

	// query update data
	$query = "UPDATE tb_buku SET 
				  judul_buku = '$judul',
				  pengarang = '$pengarang',
				  penerbit = '$penerbit',
				  tahun_terbit = $tahun_terbit, 
				  jumlah = $jumlah
			  WHERE id_buku = $id_buku;
			  ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function cari($keyword){

	$query = "SELECT * FROM tb_buku 
				WHERE  
				judul_buku LIKE '%$keyword%' OR
				pengarang LIKE '%$keyword%' OR
				penerbit LIKE '%$keyword%' OR
				tahun_terbit LIKE '%$keyword%' OR
				jumlah LIKE '%$keyword%' 
			 ";

	return query($query);

}






?>