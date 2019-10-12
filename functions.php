<?php 

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "perpustakaan");
	
function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}

	return $rows;
}

function upload(){

	$namafile = $_FILES["gambar"]["name"];
	$ukuranfile = $_FILES["gambar"]["size"];
	$error = $_FILES["gambar"]["error"];
	$tmpfile = $_FILES["gambar"]["tmp_name"];

	// cek apakah tidak ada gambar yg di upload
	if ($error === 4) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu');
			  </script>";
		return false;
	}

	// yang boleh di upload hanya gambar
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

 	move_uploaded_file($tmpfile, 'user-avatar/'.$namafilebaru);

 	return $namafilebaru;

}

function registrasi($data){

	global $conn;

	if ( $data["username"] == "" || $data["password"] == "" || $data["konfirmasi-password"] == "") {
		
		echo "<script>
				alert('silahkan isi data terlebih dahulu !');
			  </script>";

		return false;

	}

	$username = strtolower(stripslashes($data["username"]));
	$email = strtolower(stripslashes($data["email"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["konfirmasi-password"]);

	// periksa apakah username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username, email FROM tb_user WHERE username = '$username' AND email = '$email'");

	if ( mysqli_fetch_assoc($result) ) {
		
		echo "<script>
				alert('username yang anda masukkan sudah terdaftar');
			  </script>";

		return false;
	}

	// periksa konfirmasi password
	if ( $password !== $password2 ) {
		
		echo "<script>
				alert('Konfirmasi password anda tidak sesuai, silahkan coba lagi');
			  </script>";

		return false;

	}else{

		// enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT);

		// tambahkan user kedalam database
		mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$email', '$username', '$password')");

		return mysqli_affected_rows($conn);

	}

}


?>