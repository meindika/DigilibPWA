<?php
    
//   include_once 'ceklogin.php';
  include_once 'function.php';
  $data_buku = query("SELECT * FROM tblbuku ORDER BY id DESC");
  

?>
<?php 
		$s_jenis="";
        $keyword="";
        if (isset($_POST['search'])) {
            $s_jenis = $_POST['s_jenis'];
            $keyword = $_POST['keyword'];
        }
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>DIGILIB PERPUSDA SLEMAN</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/iconfavv.png" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!--link rel="manifest" href="/manifest.json">
</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
	<header class="header-area header-area2">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.php"><img src="assets/images/logo/alogo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                    <div class="main-menu main-menu2">
                        <ul>
                            <li class="active"><a href="index.html">Beranda</a></li>
                            <li><a href="about.php">Tentang</a></li>
                            <li><a href="contact.php">Kontak Kami</a></li>
                            <li><a href="Login.php">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Area End -->

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 menu-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i>Selamat Datang </i></h1>
                    <p class="pt-2"><i>Berbagai koleksi buku dapat Anda Lihat disini.</i></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
    
    <!-- Food Area starts -->
    <section class="food-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="section-top">
                        <h3><span class="style-change">Akses Katalog</span> <br>Publik Daring</h3>
                        <p class="pt-3">Katolog bisa disusun berdasarkan alfabetis nama pengarang, judul, nama penerbit dan lain – lain tergantung pustakawan di sekolah masing-masing. 
                            Katalog merupakan kumpulan buku -buku yang sudah masuk kedalam perpustakaan.</p>
                    </div>
                </div>
            </div>
            <!-- Form Search Filter-->
    <!--form method="POST" action="">
        <div class="row mb-3">
            <div class="col-sm-12"><h4>Cari</h4></div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="">Filter Jenis Buku</option>
                        <option value="Pemrograman" <?php if ($jenis=="Pemrograman"){ echo "selected"; } ?>>Pemrograman</option>
                        <option value="Komik" <?php if ($jenis=="Komik"){ echo "selected"; } ?>>Komik</option>
                        <option value="Pelajaran" <?php if ($jenis=="Pelajaran"){ echo "selected"; } ?>>Pelajaran</option>
                        <option value="Novel" <?php if ($jenis=="Novel"){ echo "selected"; } ?>>Novel</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" placeholder="Keyword" name="keyword" id="keyword" class="form-control" value="<?php echo $keyword; ?>">
                </div>
            </div>
            <div class="col-sm-4" >
                <button id="search" name="search" class="btn btn-warning">Cari</button>
            </div>
        </div>
    </form-->
 

            <div class="row">
            <?php
                foreach ($data_buku as $db) {
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="single-food">
                    <div class="food-img">
                        <img src="img/cover/<?= $db['cover'];?>" class="img-fluid" alt="">
                    </div>
                    
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5><?= $db['judul'];?></h5>
                            <span class="style-change">Stok <?= $db['jumlah'];?></span>
                        </div>
                        <p class="pt-3">Penerbit : <?= $db['penerbit'];?></p>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>

            </div>
        </div>
    </section>
    <!-- Food Area End -->
    <!-- Search --> 
    <?php 
                   /* include 'function.php';
	            $search_jurusan = '%'. $s_jurusan .'%';
	            $search_keyword = '%'. $s_keyword .'%';
	            $no = 1;
	            $query = "SELECT * FROM tblbuku WHERE jenis LIKE ? AND (judul LIKE ? OR kode LIKE ? OR jumlah LIKE ? OR penerbit LIKE ? ) ORDER BY id DESC";
	            $dewan1 = $db->prepare($query);
	            $dewan1->bind_param('ssssss', $search_jurusan, $search_keyword, $search_keyword, $search_keyword, $search_keyword, $search_keyword);
	            $dewan1->execute();
	            $res1 = $dewan1->get_result();
 
	            if ($res1->num_rows > 0) {
	                while ($row = $res1->fetch_assoc()) {
	                    $id = $row['id'];
	                    $judul = $row['judul'];
                        $kode = $row['kode'];
                        $jumlah = $row['jumlah'];
	        ?> 
            <div class="col-md-4 col-sm-6">
                <div class="single-food">
                    <div class="food-img">
                        <img src="img/cover/<?= $db['cover'];?>" class="img-fluid" alt="">
                    </div>
                    
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5><?= $db['judul'];?></h5>
                            <span class="style-change">Stok <?= $db['jumlah'];?></span>
                        </div>
                        <p class="pt-3">Penerbit : <?= $db['penerbit'];?></p>
                    </div>
                </div>
            </div>
	        <?php } } else { ?> 
	            <tr>
	                <td colspan='7'>Tidak ada data ditemukan</td>
	            </tr>
            <?php } */?>   
            
    <!-- Search End-->
<!-- Footer Area Start-->
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> | Digilib Perpusda Sleman
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="social-icons">
                            <ul>
                                <li class="no-margin">Follow Us</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->
    <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('library_sw.js')
        .then(swReg => {
          console.log('Service Worker is registered', swReg);
        })
        .catch(err => {
          console.error('Service Worker Error', err);
        });
      });
    }
  </script>
<!-- Javascript search -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Javascript -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="assets/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="assets/js/vendor/wow.min.js"></script>
    <script src="assets/js/vendor/owl-carousel.min.js"></script>
    <script src="assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
