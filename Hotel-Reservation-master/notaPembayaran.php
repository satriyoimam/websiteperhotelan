<?php
session_start();
include 'helper/connection.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION["nama"]) || empty($_SESSION["nama"])) {
    echo "<script>alert('Silahkan Login Dahulu!')</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$username = $_SESSION["nama"];

// Ambil data pemesanan dari database
$sql = "SELECT n.id_nota, r.id_reservasi, r.nama_tamu, SUM(r.total_biaya) as total_biaya, 
               k.nama_kamar, f.fasilitas, r.tanggal_check_in, r.tanggal_check_out, 
               r.lama_inap, r.total_biaya, r.alamat
        FROM tb_nota n
        JOIN tb_reservasi r ON n.id_reservasi = r.id_reservasi
        JOIN tb_tamu t ON n.id_tamus = t.id_tamu
        WHERE r.flag = 1 AND r.nama_tamu = '$username'
        GROUP BY n.id_nota";

$query = mysqli_query($con, $sql);

// Jika tidak ada data yang ditemukan, tampilkan pesan
if (mysqli_num_rows($query) === 0) {
    echo "<h3>Tidak ada riwayat pemesanan untuk ditampilkan.</h3>";
    exit();
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Nota Pembayaran</h2>
        <div class="row">
            <div class="col-md-6">
                <p><strong>ID Reservasi:</strong> <?php echo $data['id_reservasi']; ?></p>
                <p><strong>Nama Tamu:</strong> <?php echo $data['nama_tamu']; ?></p>
                <p><strong>Alamat:</strong> <?php echo $data['alamat']; ?></p>
            </div>
        </div>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kamar</th>
                    <th>Fasilitas</th>
                    <th>Tanggal Check In</th>
                    <th>Tanggal Check Out</th>
                    <th>Lama Inap</th>
                    <th>Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?php echo $data['nama_kamar']; ?></td>
                    <td><?php echo $data['fasilitas']; ?></td>
                    <td><?php echo $data['tanggal_check_in']; ?></td>
                    <td><?php echo $data['tanggal_check_out']; ?></td>
                    <td><?php echo $data['lama_inap']; ?></td>
                    <td>Rp. <?php echo $data['total_biaya']; ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total Bayar</th>
                    <th>Rp. <?php echo $data['total_biaya']; ?></th>
                </tr>
            </tfoot>
        </table>
        <a href="profile.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>
    