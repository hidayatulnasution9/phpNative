<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// keyword require / include
require 'function.php'; // untuk menghubungkan
// ASC = ascending (membesar / dari kecil ke terbesar)
//  DESC = descending (mengecil / dari besar ke kecil)
//  ORDER BY = untuk mengurutkan data berdasarkan kolom tertentu
// $result=query("SELECT * FROM barang ORDER BY nama_barang");
// $mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC"); 
// $conn = mysqli_connect("localhost", "root",""); // menyambungkan dengan database mysql
// mysqli_select_db($conn, "database1"); // memilih database yang akan digunakan
$mahasiswa = query("SELECT * FROM mahasiswa"); 

// Tombol cari ditekan
if(isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #45a049;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #tombol-cari {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #tombol-cari:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            display: block;
            margin: auto;
        }
    </style>
</head>
<body>

<a href="logout.php">Logout</a>
<h1>List Mahasiswa</h1>

<a href="add.php">Add Data</a>
<br><br>

<form action="" method="post">
    <input type="text" name="keyword" placeholder="Search Data" size="40" autofocus autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari">Search</button>
</form>
<br><br>

<div id="container">
    <table border="1" cellpadding="10" cellspacing="0" >
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($mahasiswa as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="edit.php?id=<?= $row["id"]; ?>">Edit</a> | 
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Are You Sure!');" >Delete</a>
            </td>
            <td><img src="img/<?= $row["gambar"]; ?>" width="60"></td>
            <td><?= $row["nama"]?></td>
            <td><?= $row["nim"]?></td>
            <td><?= $row["email"]?></td>
            <td><?= $row["jurusan"]?></td>  
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</div>
<script src="js/script.js"></script>
</body>
</html>
