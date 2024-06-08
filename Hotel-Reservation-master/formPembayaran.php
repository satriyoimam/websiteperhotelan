<?php
    session_start();
    $username = $_SESSION["nama"];
?>
<?php
if(isset($_POST['submit'])){
    $nama_tamu = $_POST["nama_tamu"];
    $alamat = $_POST["alamat"];
    $nama_kamar = $_POST["nama_kamar"];
    $fasilitas = $_POST["fasilitas"];
    $tgl_ci = $_POST["tgl_ci"];
    $tgl_co = $_POST["tgl_co"];
    $lama_inap = $_POST["lama_inap"];
    $tarif = $_POST["tarif"];
    $total_biaya = $lama_inap * $tarif;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Hotelku</title>
<link rel="shortcut icon" type="image/png" href="img/logo4.png" />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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

<div class="desc/formRiwayatTamu" action="proses/prosesInsertPembayaran.php" method="POST">
        <div class="container">
        <h3 style="margin-top:80px;">Form Pembayaran</h3><br>
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Alamat</th>
                        <th>Kamar</th>
                        <th>Fasilitas</th>
                        <th>Tanggal Check In</th>
                        <th>Tanggal Check Out</th>
                        <th>Lama inap</th>
                        <th>Total</th>
            
                    </tr>
                </thead>
                <tbody>
                <?php
                include 'helper/connection.php';
                    
                $sql = "SELECT r.id_reservasi, r.nama_tamu, SUM(r.total_biaya) as total_biaya, k.nama_kamar, f.fasilitas, r.tanggal_check_in, r.tanggal_check_out, r.lama_inap, r.total_biaya, r.alamat
        FROM tb_reservasi r
        JOIN tb_kamar k ON r.kode_kamar = k.kode_kamar
        JOIN tb_fasilitas f ON r.id_fasilitas = f.id_fasilitas
        WHERE r.flag = 1 AND r.nama_tamu = '$username'
        GROUP BY r.nama_tamu";



                $query = mysqli_query($con, $sql);

                //var_dump($sql);
                $no = 1;
                $total_biaya =0;

                while ($data = mysqli_fetch_assoc($query)){
                ?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_tamu']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['nama_kamar']; ?></td>
                    <td><?php echo $data['fasilitas']; ?></td>
                    <td><?php echo $data['tanggal_check_in']; ?></td>
                    <td><?php echo $data['tanggal_check_out']; ?></td>
                    <td><?php echo $data['lama_inap']; ?></td>
                    <td>Rp. <?php echo $data['total_biaya']; ?></td>
                    
                    </tr>
                <?php
                    
                    $total_biaya += $data['total_biaya'];
                   
                ?>
                
    
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">Total Bayar</th>
                        <th>Rp. <?php echo $total_biaya; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Total yang harus dibayar Rp. <?php echo number_format($total_biaya); ?> <br>
                            <strong>BANK BRI <br>1234-12-1234567-09-2<br> a.n. StayEase</strong>
                        </p>
                    </div>
                </div>
            </div>
            <a href="proses/prosesInsertPembayaran.php?id=<?php echo $data['id_reservasi'] ?>" class="btn btn-success">Simpan</a>
        </div>

        <?php
            }
        ?>
        </div>
        
    <div>
    <p>
    </p>
      <!-- Footer -->
      <!-- /.container -->
    </footer>
    </body>
</html>