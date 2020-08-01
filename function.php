<?php  
	// Koneksi Database
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "dbperpus";
	$conn = mysqli_connect($host,$user,$pass,$db);

	function query($query) {
		global $conn;
		$result = mysqli_query($conn, $query);
		$rows = [];
		while ( $row = mysqli_fetch_assoc($result) ) {
				$rows[]  = $row;
		}
		return $rows;	
	}

	function tambahbuku($databuku) {
		global $conn;
		$kode = htmlspecialchars($databuku["kode"]);
		$judul = htmlspecialchars($databuku["judul"]);
		$penerbit = htmlspecialchars($databuku["penerbit"]);
		$jumlah = htmlspecialchars($databuku["jumlah"]);
		$jenis = htmlspecialchars($databuku["jenis"]);
		// $cover = $_FILES["cover"]["name"];
        // $tmp_cover = $_FILES["cover"]["tmp_name"];
        // $target = "../img/cover/";
		// move_uploaded_file($tmp_cover, $target.$cover);

		// $query = "INSERT INTO tblbuku VALUES ('','$kode','$judul','$penerbit','$jumlah','$jenis','$cover')";
		// mysqli_query($conn, $query);
		// return mysqli_affected_rows($conn);

		date_default_timezone_set('Asia/Jakarta');
		$time        = time();
		$nama_gambar = $_FILES['cover'] ['name']; // Nama Gambar
		$size        = $_FILES['cover'] ['size'];// Size Gambar
		$error       = $_FILES['cover'] ['error'];
		$tipe_video  = $_FILES['cover'] ['type']; //tipe gambar untuk filter
		$folder      = "img/cover/"; //folder tujuan upload
		$valid       = array('jpg','png','gif','jpeg'); //Format File yang di ijinkan Masuk ke server
		$n ="img-".date('mhis')."-".$nama_gambar;
		if(strlen($nama_gambar)){   
			// Perintah untuk mengecek format gambar
			list($txt, $ext) = explode(".", $nama_gambar);
			if(in_array($ext,$valid)){
			// Perintah untuk mengecek size file gambar
				if($size>0){   
				// Perintah untuk mengupload gambar dan memberi nama baru
					$gambarnya = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
					$gmbr  = $folder.$gambarnya;
					$tmp = $_FILES['cover']['tmp_name'];
					if(move_uploaded_file($tmp, $folder.$n)){   
						
						$query = "INSERT INTO tblbuku VALUES ('','$kode','$judul','$penerbit','$jumlah','$jenis','$n')";
						mysqli_query($conn, $query);
						 return mysqli_affected_rows($conn);
					//   header("location:../D/index.php");
					}
					else{ // Jika Gambar Gagal Di upload 
					//   header("location:../D/index.php");
					}
				}
				else{ // Jika Gambar melebihi size 
				// header("location:../D/index.php");
				}   
			}
			else{ // Jika File Gambar Yang di Upload tidak sesuai eksistensi yang sudah di tetapkan
				// header("location:../D/index.php");
			}
		}  
		else{ // Jika Gambar belum di pilih 
		// header("location:../D/index.php");
		}   

		// print_r($_FILES['cover']);
	}	
	function hapusbuku($id) {
		global $conn;
		$query = "DELETE FROM tblbuku WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function ubahbuku($databuku) {
		global $conn;
		$id = $databuku["id"];
		$kode = htmlspecialchars($databuku["kode"]);
		$judul = htmlspecialchars($databuku["judul"]);
		$penerbit = htmlspecialchars($databuku["penerbit"]);
		$jumlah = htmlspecialchars($databuku["jumlah"]);
		$jenis = htmlspecialchars($databuku["jenis"]);
		date_default_timezone_set('Asia/Jakarta');
		$time        = time();
		$nama_gambar = $_FILES['cover'] ['name']; // Nama Gambar
		$size        = $_FILES['cover'] ['size'];// Size Gambar
		$error       = $_FILES['cover'] ['error'];
		$tipe_video  = $_FILES['cover'] ['type']; //tipe gambar untuk filter
		$folder      = "img/cover/"; //folder tujuan upload
		$valid       = array('jpg','png','gif','jpeg'); //Format File yang di ijinkan Masuk ke server
		$n ="img-".date('mhis')."-".$nama_gambar;
		if(strlen($nama_gambar)){   
			// Perintah untuk mengecek format gambar
			list($txt, $ext) = explode(".", $nama_gambar);
			if(in_array($ext,$valid)){
			// Perintah untuk mengecek size file gambar
				if($size>0){   
				// Perintah untuk mengupload gambar dan memberi nama baru
					$gambarnya = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
					$gmbr  = $folder.$gambarnya;
					$tmp = $_FILES['cover']['tmp_name'];
					if(move_uploaded_file($tmp, $folder.$n)){   
						
		$query = "UPDATE tblbuku SET 
					judul = '$judul',
					penerbit = '$penerbit', 
					jumlah = '$jumlah', 
					jenis = '$jenis',
					cover = '$n'
				   WHERE id = '$id'";
		mysqli_query($conn, $query);
									
		return mysqli_affected_rows($conn);
	}
	else{ // Jika Gambar Gagal Di upload 
	//   header("location:../D/index.php");
	}
}
else{ // Jika Gambar melebihi size 
// header("location:../D/index.php");
}   
}
else{ // Jika File Gambar Yang di Upload tidak sesuai eksistensi yang sudah di tetapkan
// header("location:../D/index.php");
}
}  
else{ // Jika Gambar belum di pilih 
// header("location:../D/index.php");
}   

// print_r($_FILES['cover']);
}	
return mysqli_affected_rows($conn);
	function pencarian($keyword) {
		$query = "SELECT * FROM tblbuku WHERE 
					judul LIKE '%$keyword%'
				 ";
		return query($query);
	}

	function registrasi($datauser) {
		global $conn;

		$nama = $datauser["nama"];
		$username = strtolower(stripslashes($datauser["username"]));
		$password = mysqli_real_escape_string($conn, $datauser["password"]);
		$email = $datauser["email"];
		$jenis_kelamin = $datauser["jenis_kelamin"];
		if ($jenis_kelamin == 'laki-laki') {
			$pict = 'default.png';
		} elseif ($jenis_kelamin == 'perempuan') {
			$pict = 'defaultwoman.png';
		}

		// encrypt password
		$passencrypted = password_hash($password, PASSWORD_DEFAULT);

		// Cek username
		$cekuser = mysqli_query($conn, "SELECT username FROM tbluser WHERE username = '$username'");
		if ( mysqli_fetch_assoc($cekuser) ) {
			echo "
				<script>
					alert('Username sudah ada!')
				</script>
			";
			return false;
		}
		
		mysqli_query($conn, "INSERT INTO tbluser VALUES('','$nama','$username','$passencrypted','$email','User','$pict','$jenis_kelamin', 'Pending')");
		return mysqli_affected_rows($conn); 
	}

	function uploadfoto($data) {
		global $conn;

		// Ambil ID
		$id = $data['id'];

		
		// Ambil Gambar
		$namafile = $_FILES['pict']['name'];
		$ukuranfile = $_FILES['pict']['size'];
		$error = $_FILES['pict']['error'];
		$tmp = $_FILES['pict']['tmp_name'];



		
		// Cek apakah di upload
		if ( $error === 4 ) {
			echo "
		        <script>
		          alert('Pilih Gambar!');
		          window.location = 'changephoto.php';
		        </script>
		      ";
		    return false;
		}
		
		// Cek apakah di upload itu adalah gambar.
		$ekstensivalid = ['jpg', 'jpeg', 'png'];
		$ekstensifile = explode('.', $namafile);
		$ekstensifile = strtolower(end($ekstensifile));
		if ( !in_array($ekstensifile, $ekstensivalid) ) {
			echo "
		        <script>
		          alert('Gambar hanya boleh ber-ekstensi .jpg, .jpeg, .png');
		          window.location = 'changephoto.php';
		        </script>
		      ";
		    return false;
		}
		
		// Cek ukuran gambar harus <2jt byte
		if ( $ukuranfile > 2000000 ) {
			echo "
		        <script>
		          alert('Ukuran gambar terlalu besar!');
		          window.location = 'changephoto.php';
		        </script>
		      ";
		    return false;
		}
		
		// Generate nama file random
		$fixfile = uniqid();
		$fixfile .= '.';
		$fixfile .= $ekstensifile;

		// Upload Gambar
		move_uploaded_file($tmp, 'img/avatar/'.$fixfile);


		// Eksekusi Gambar
		$pict = $fixfile;

		if ( !$pict ) {
		     return false;
		} else {
			$query = "UPDATE tbluser SET pict = '$pict' WHERE id = $id";
			mysqli_query($conn, $query);
		}

		return mysqli_affected_rows($conn);		

	}

	function edituser($datauser) {
		global $conn;
		$id = $datauser["id"];
		$nama = htmlspecialchars($datauser["nama"]);
		$email = htmlspecialchars($datauser["email"]);

		$query = "UPDATE tbluser SET  nama = '$nama', email = '$email' WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function editpassworduser($datauser) {
		global $conn;
		$id = $datauser["id"];
		$password = htmlspecialchars($datauser["passbaru"]);

		// Encrypt Password
		$passencrypted = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE tbluser SET password = '$passencrypted' WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function pinjambuku($databuku) {
		global $conn;

		$kode = $databuku['kode'];
		$nama = $databuku['nama'];
		$tanggal = $databuku['tanggal'];

		$query = mysqli_query($conn,"SELECT judul, jumlah FROM tblbuku WHERE kode = '$kode'");
		$result = mysqli_fetch_assoc($query);
		$judul = $result["judul"];
		$jumlah = $result["jumlah"] - 1;

		$exe = mysqli_query($conn, "INSERT INTO tblpinjam VALUES('','$kode','$judul','$nama','$tanggal','Dibaca')");
		$exe = mysqli_query($conn, "UPDATE `tblbuku` SET `jumlah`='$jumlah' WHERE kode = '$kode'");
		return mysqli_affected_rows($conn);
	}

	function kembalikanbuku($databuku) {
		global $conn;

		$kode = $databuku['kode'];
		$nama = $databuku['nama'];
		$tanggalpinjam = $databuku['tanggalpinjam'];
		$tanggalkembalikan = $databuku['tanggalkembalikan'];

		$query = mysqli_query($conn, "SELECT judul FROM tblpinjam WHERE kode = '$kode'");
		$result = mysqli_fetch_assoc($query);
		$judul = $result['judul'];
		// $query = mysqli_query($conn, "UPDATE 'tblbuku' SET 'jumlah'='$jumlah' WHERE kode= '$kode'");
		// $jumlah = $result["jumlah"] + 1;


		$exe = mysqli_query($conn, "INSERT INTO tblrequestkembali VALUES 
							('','$kode','$judul','$nama','$tanggalpinjam','$tanggalkembalikan')");
		$exe2 = mysqli_query($conn, "UPDATE tblpinjam SET status = 'Pending' WHERE kode = '$kode' AND nama = '$nama'");
		// $exe3 = mysqli_query($conn, "UPDATE `tblbuku` SET `jumlah`='$jumlah' WHERE kode = '$kode'");
							return mysqli_affected_rows($conn);
	}

	function konfirmasikembalibuku($data) {
		global $conn;
		$kode = $data['kode'];
		$nama = $data['nama'];
		$tanggalpinjam = $data['tanggalpinjam'];
		$tanggalkembalikan = $data['tanggalkembalikan'];
		//$tanggalkembalikan = Date('2020-07-08');

		$query = mysqli_query($conn, "SELECT judul FROM tblpinjam WHERE kode = '$kode'");
		$query2 = mysqli_query($conn,"SELECT judul, jumlah FROM tblbuku WHERE kode = '$kode'");
		$result = mysqli_fetch_assoc($query);
		$result2 = mysqli_fetch_assoc($query2);
		$judul = $result['judul'];

		$jumlah = $result2["jumlah"] + 1;

		$cari_hari = abs(strtotime($tanggalpinjam)- strtotime($tanggalkembalikan));
		$hitung_hari = floor($cari_hari/(60*60*24));
			if($hitung_hari > 7){
				$telat = $hitung_hari - 7 ;
				$denda = 1000 * $telat;
				echo "
				<script>
        alert('Denda Telah Berlaku ! $nama telah telat mengembalikan $telat hari dengan denda $denda' );
        window.location = 'pengembalian.php';
        </script> ";
				//echo $nama. " telah telat mengembalikan " .$telat. " hari dengan denda " .$denda;
			}else{
				$denda = 0;
				$telat = 0;
			}
			

		// echo $jumlah." - ".$kode;
		mysqli_query($conn, "UPDATE `tblbuku` SET `jumlah`='$jumlah' WHERE `kode`= '$kode'");

		$exe = mysqli_query($conn, "DELETE FROM tblrequestkembali WHERE kode = '$kode' AND nama = '$nama'");
		return mysqli_affected_rows($conn);
		$exe2 = mysqli_query($conn, "UPDATE tblpinjam SET status = 'Diterima' WHERE kode = '$kode' AND nama = '$nama'");

		return mysqli_affected_rows($conn);
	}

	/*function denda($data){
		global $conn;
		$nama = $data['nama'];
		$tanggalpinjam = $data['tanggalpinjam'];
		$tanggalkembalikan = $data['tanggalkembalikan'];
		$denda= $data['denda'];
		$cari_hari = abs(strtotime($tanggalpinjam)- strtotime($tanggalkembalikan));
		$hitung_hari = floor($cari_hari/(60*60*24));
			if($hitung_hari > 7){
				$telat = $hitung_hari - 7 ;
				$denda = 1000 * $telat;
			}else{
				$denda = 0;
				$telat = 0;
			}
			$denda = $denda; 
			echo $nama. " telah telat mengembalikan " .$telat. " hari dengan denda " .$jumlah_denda;
		}*/

	function pencarianuser($keyword) {
		$query = "SELECT * FROM tblrequestkembali WHERE 
					nama LIKE '%$keyword%'
				 ";
		return query($query);
	}

	function cariuser($keyword) {
		$query = "SELECT * FROM tbluser WHERE 
					nama LIKE '%$keyword%'
					AND status = 'Active'
					AND lvl = 'User'
				 ";
		return query($query);
	}

	function cariuserpending($keyword) {
		$query = "SELECT * FROM tbluser WHERE 
					nama LIKE '%$keyword%'
					AND status = 'Pending'
					AND lvl = 'User'
				 ";
		return query($query);
	}

	function hapususer($data) {
		global $conn;

		$id = $data['id'];

		$query = "DELETE FROM tbluser WHERE id = $id";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function blockuser($data) {
		global $conn;

		$id = $data['id'];

		$query = "UPDATE tbluser SET status = 'Pending' WHERE id = '$id'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function aktifkanuser($data) {
		global $conn;

		$id = $data['id'];

		$query = "UPDATE tbluser SET status = 'Active' WHERE id = '$id'";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function kirimpesan($datapesan) {
		global $conn;

		$judul = $datapesan['judul'];
		$penerima = $datapesan['penerima'];
		$isi = $datapesan['pesan'];
		$pengirim = $datapesan['nama'];
		$username = $datapesan['username'];

		// Cek Username
		$cekuser = mysqli_query($conn, "SELECT username FROM tbluser WHERE username = '$penerima'");
		if ( !mysqli_fetch_assoc($cekuser) ) {
			echo "
				<script>
					alert('Username tidak ada!')
				</script>
			";
			return false;
		} else {
			$query = "INSERT INTO tblpesan VALUES ('','$judul','$isi','$pengirim','$username','$penerima')";
			mysqli_query($conn, $query);

			return mysqli_affected_rows($conn);
		}
	}

	function hapuspesan($datapesan) {
		global $conn;
		$id = $datapesan['id'];
		$query = "DELETE FROM tblpesan WHERE id = $id";

		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function daftaradmin($datauser) {
		global $conn;

		$nama = $datauser["nama"];
		$username = strtolower(stripslashes($datauser["username"]));
		$password = mysqli_real_escape_string($conn, $datauser["password"]);
		$email = $datauser["email"];
		$jenis_kelamin = $datauser["jenis_kelamin"];
		if ($jenis_kelamin == 'laki-laki') {
			$pict = 'default.png';
		} elseif ($jenis_kelamin == 'perempuan') {
			$pict = 'defaultwoman.png';
		}

		// encrypt password
		$passencrypted = password_hash($password, PASSWORD_DEFAULT);

		// Cek username
		$cekuser = mysqli_query($conn, "SELECT username FROM tbluser WHERE username = '$username'");
		if ( mysqli_fetch_assoc($cekuser) ) {
			echo "
				<script>
					alert('Username sudah ada!')
				</script>
			";
			return false;
		}
		
		mysqli_query($conn, "INSERT INTO tbluser VALUES('','$nama','$username','$passencrypted','$email','Admin','$pict','$jenis_kelamin', 'Active')");
		return mysqli_affected_rows($conn); 
	}
?>