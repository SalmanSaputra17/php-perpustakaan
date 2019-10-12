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

function tambah($data){

	global $conn;

	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);	

	$gambar = upload();

	if ( !$gambar ) {
		return false;
	}

	$query = "INSERT INTO tb_anggota VALUES('','$nis','$gambar','$nama','$email')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function upload(){

	$namafile = $_FILES["gambar"]["name"];
	$ukuranfile = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmpfile = $_FILES["gambar"]["tmp_name"];

	// cek apakah tidak ada gambar yang di upload
	if ($error === 4) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu');
			  </script>";
		return false;
	}

	// memeriksa apakah yang diupload gambar atau bukan
	$ekstensigambarbenar = ['jpg','jpeg','png'];
	$ekstensigambar = explode('.', $namafile);
	$ekstensigambar = strtolower(end($ekstensigambar));
 	 
 	if ( !in_array($ekstensigambar, $ekstensigambarbenar) ) {
 		echo "<script>
				alert('yang anda upload bukanlah gambar');
			  </script>";
		return false;
 	}

 	// cek jika ukuran gambar terlalu besar
 	if ( $ukuranfile > 2000000 ) {
 		echo "<script>
				alert('ukuran gambar tersebut terlalu besar');
			  </script>";
		return false;
 	}

 	// jika semua lolos, gambar di upload
 	// generate nama file baru

 	$namafilebaru = uniqid();
 	$namafilebaru .= '.';
 	$namafilebaru .= $ekstensigambar;

 	move_uploaded_file($tmpfile, '../img/'.$namafilebaru);

 	return $namafilebaru;

}

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM tb_anggota WHERE id_anggota = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data){

	global $conn;

	$id_anggota = $data["id_anggota"];
	$nis = htmlspecialchars($data["nis"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);	
	$gambarlama = htmlspecialchars($data["gambarlama"]);

	// cek apakah user pilih gambar baru atau tidak
	if ( $_FILES["gambar"]["error"] === 4) {
		$gambar = $gambarlama;
	}else{
		$gambar = upload();
	}

	// query update data
	$query = "UPDATE tb_anggota SET 
				  nis = $nis,
				  nama = '$nama',
				  email = '$email',
				  gambar = '$gambar'
			  WHERE id_anggota = $id_anggota
			  ";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function cari($keyword){

	$query = "SELECT * FROM tb_anggota 
				WHERE  
				nis LIKE '%$keyword%' OR
				nama LIKE '%$keyword%' OR
				email LIKE '%$keyword%' 
			 ";

	return query($query);

}


?>