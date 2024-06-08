<?php
    session_start();
    $username = $_SESSION["nama"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile - StayEase</title>
<link rel="shortcut icon" type="image/png" href="img/logo4.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
      crossorigin="anonymous"
    />

<!-- Custom styles for this template -->
<link href="admin/css/business-frontpage.css" rel="stylesheet">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark content-center fixed-top" style="background-color: #596FB7 ;   height : 100px">
        <div class="container">
            <!-- Brand -->
        <a class="navbar-brand" href="profile.php"><img src="img/logo3.png" alt=""></a>
        <!-- Links -->
        <ul class="navbar-nav" style="font-size: 25px">
            <li class="nav-item">
            <a class="nav-link" href="profile.php" style="padding-right: 35px">Home</a>
            </li>
            <?php if(isset($_SESSION["nama"])): ?>
            <li class="nav-item">
            <a class="nav-link" href="formRiwayatTamu.php"style="padding-right: 35px">Riwayat</a>
            </li>
            <?php else: ?>
            <?php endif ?>
            <li class="nav-item">
            <a class="nav-link" style="padding-right: 35px; color: yellow"><?php echo $username; ?></a>
            </li>
            
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>  
        
    </nav> 

    <!-- Header with Background Image -->
    <header class="business-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- <img src="img/1.jpg" alt="pemandangan"> -->
          </div>
        </div>
      </div>
    </header>
    <br>
    <!-- Page Content -->
    <div class="container">

    <p align="center"><a class="btn btn-success" href="showKamar.php" style="background-color: #11235A; font-size: 26px">Tampilkan Kamar</a></p>

    <div class="row">
        <div class="col-sm-8"style="margin-right: 50px">
          <h2 class="mt-4">Tentang Kami</h2>
          <p style="text-align: justify">Selamat datang di StayEase - Destinasi Kenyamanan dan Kemudahan!

StayEase adalah tempat yang menyediakan pengalaman menginap istimewa dengan kenyamanan modern dan keramahan hangat. Kami berkomitmen untuk menciptakan momen tak terlupakan bagi setiap tamu, dengan layanan berkualitas dan perhatian tulus dari tim kami yang berdedikasi.

Bergabunglah dengan kami di StayEase dan temukan kenyamanan serta kemudahan yang Anda cari dalam perjalanan Anda.</p>
        </div>
        <div class="col-sm-3" style="text-align: justify">  
          <h2 class="mt-4">Hubungi Kami</h2>
          <address>
            <strong>StayEase Hotel</strong>
            <br>Jl. Ketintang Baru
            <br>
            Ketintang, Kode Pos 60231
            <br>
          </address>
          <address>
            <div class="hub">
            <h3 class="sosmed">Social Media</h3><br>
              <a class="sosmed" href="https://facebook.com/" target="_blank"><i class="fab fa-facebook fa-2x" style="color: grey"></i></a>
              <a class="sosmed" href="https://instagram.com/" target="_blank"><i class="fab fa-instagram fa-2x" style="margin-left: 7%; color: grey"></i></i></a>
              <a class="sosmed" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter-square fa-2x" style="margin-left: 7%; color: grey"></i></a>
              <a class="sosmed" href="https://web.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp fa-2x" style="margin-left: 7%; color: grey"></i></a>
            </div>
            <!-- <abbr title="Email">Inbox :</abbr>
            <a href="mailto:#">sabanahotel.htl.com</a> -->
          </address>
        </div>
      </div>
      <br><br><br>
      <!-- /.row -->

<?php
  include 'helper/connection.php';

    $sql = "select nama_kamar, gambar from tb_kamar where flag = 1 and kode_kamar = 'K001'";
    $query = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($query)){
      $image = $row["gambar"];
      $kamar = $row["nama_kamar"];  
?>
      <div style="text-align: center"><h3>Jelajahi Kamar yang Kami Sediakan</h3></div>
      <div class="row">
        <div class="col-sm-4 my-4 float-right">
          <div class="card">
          <?php
            echo "
            <img class='card-img-top float-right' src='admin/tempat_upload/".$image."' alt='gambar'>
            "
          ?>
            <div class="card-body">
              <h4 class="card-title"><?php echo $kamar ?></h4>
              <p class="card-text" style="text-align: justify">Kamar berukuran 5 x 3 meter dengan balutan warna menarik dengan fasilitas kasur empuk nan mewah, kamar mandi, toilet, televisi, dan pencahayaan yang cukup menjadikan kamar tipe Deluxe banyak dicari kalangan menengah</p>
            </div>
            <div class="card-footer text-center">
              <a href="showKamar.php" class="btn btn-primary">Booking Sekarang</a>
            </div>
          </div>
        </div>
<?php
    }
?>
<?php

    $sql = "select nama_kamar, gambar from tb_kamar where flag = 1 and kode_kamar = 'K002'";
    $query = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($query)){
      $image = $row["gambar"];
      $kamar = $row["nama_kamar"];  
?>
        <div class="col-sm-4 my-4 float-right">
          <div class="card">
          <?php
            echo "
            <img class='card-img-top float-right' src='admin/tempat_upload/".$image."' alt='gambar'>
            "
          ?>
            <div class="card-body">
              <h4 class="card-title"><?php echo $kamar ?></h4>
              <p class="card-text" style="text-align: justify">Terinspirasi dari kediaman mewah ala kerajaan, kamar berukuran 6 x 4 meter dengan balutan warna menarik dengan fasilitas kasur empuk nan mewah, kamar mandi, toilet, televisi, sofa dan pencahayaan yang cukup menjadikan kamar tipe Exclussive banyak dicari kalangan menengah keatas.</p>
            </div>
            <div class="card-footer text-center">
              <a href="showKamar.php" class="btn btn-primary">Booking Sekarang</a>
            </div>
          </div>
        </div>
<?php
    }
?>
<?php

$sql = "select nama_kamar, gambar from tb_kamar where flag = 1 and kode_kamar = 'K003'";
$query = mysqli_query($con, $sql);
if($row = mysqli_fetch_assoc($query)){
  $image = $row["gambar"];
  $kamar = $row["nama_kamar"];  
?>
    <div class="col-sm-4 my-4 float-right">
      <div class="card">
      <?php
        echo "
        <img class='card-img-top float-right' src='admin/tempat_upload/".$image."' alt='gambar'>
        "
      ?>
        <div class="card-body">
          <h4 class="card-title"><?php echo $kamar ?></h4>
          <p class="card-text" style="text-align: justify">Seperti kediaman yang mewah, kamar berukuran 7 x 5 meter dengan balutan warna menarik dengan fasilitas kasur empuk nan mewah, kamar mandi, toilet, televisi, sofa, pemandangan skylight dan pencahayaan yang cukup menjadikan kamar tipe Premium banyak dicari kalangan Atas.</p>
        </div>
        <div class="card-footer text-center">
          <a href="showKamar.php" class="btn btn-primary">Booking Sekarang</a>
        </div>
      </div>
    </div>
<?php
}
?>

      </div>
      <!-- /.row -->



    </div>
    <!-- /.container -->

    <!-- Footer -->
    

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
