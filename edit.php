<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

// Ambil Data id di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id") [0];
// var_dump($mhs["jurusan"]);

// Cek apakah tombol sumbit sudah di tekan atau belum
if (isset ($_POST["submit"])) {
    
    // Cek apakah data berhasil di edit atau tidak
    if(edit($_POST) > 0 ) {
        echo "
        <script>
        alert('Edit Successfully');
        document.location.href = 'index.php';
        </script>
        ";
    }
    else  {
        echo "
        <script>
        alert('Edit Failed');
        document.location.href = 'index.php';
        </script>
        ";
        echo mysqli_error($conn);
    } 

   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
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
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        img {
            display: block;
            margin-bottom: 10px;
        }
        button[type="submit"] {
            width: 100%;
            background-color: #4caf50;
            color: #fff;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Edit Data</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>" >
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>" >
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"] ?>">
            </li>
            <li>
                <label for="nim">NIM :</label>
                <input type="number" name="nim" id="nim" required value="<?= $mhs["nim"] ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]?>">
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required value="<?= $mhs["email"]?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label><br>
                <img src="img/<?= $mhs['gambar']; ?>" width="50" > <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Edit Data</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
