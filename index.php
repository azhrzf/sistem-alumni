<?php
    session_start();

    // menghubungkan ke function
    require "functions.php";

    if(!isset($_SESSION["login"]) && !isset($_SESSION["alulogin"])) {
        header("Location: login.php");
        exit;
    }

    if(isset($_SESSION["alulogin"])) {
        $alunim = $_SESSION["alunim"];  
        $alul = query("SELECT * FROM alumni WHERE nim = $alunim");
        if($alul == false) {
            header("Location: local.php");
        }
    }

    $alumni = query("SELECT * FROM alumni ORDER BY nim ASC");

    if(isset($_POST["cari"])) {
        $alumni = cari($_POST["keyword"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Alumni</title>
</head>
<body>
    <h1>Sistem Informasi Alumni</h1>
    <form action="" method="post">
        <input type="text" name="keyword" placeholder="masukkan keyword" autofocus autocomplete="off" size="30">
        <button type="submit" name="cari">Cari</button>
    </form>
    <br>
    <table border= "2px solid black" cellpadding="10">
        <tr>
           <th>NO</th>
           <th>NIM</th>
           <th>Nama</th>
           <th>Program Studi</th>
           <th>Tahun Lulus</th> 
        </tr>

        <?php $no = 1; ?>
            <?php foreach($alumni as $tabel) : ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><a href="ganti.php?id=<?= $tabel['id']; ?>"><?php echo $tabel["nim"]; ?></a></td>
                    <td><?php echo $tabel["nama"]; ?></td>
                    <td><?php echo $tabel["prodi"]; ?></td>
                    <td><?php echo $tabel["thlulus"]; ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <br>
    <h3><a href="local.php">Logout</a></h3>
    <?php 
        if (isset($_SESSION["login"])) {
            echo "<h3><a href=tambah.php>Tambah Data</a></h3>";
        }
    ?>
    <h3><a href=profil.php>Lihat Profil</a></h3>
</body>
</html>