<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';
// Cek apakah tombol sumbit sudah di tekan atau belum
if (isset ($_POST["submit"])) {

    // var_dump($_POST); die;
    // var_dump($_FILES); die;
    
    // Cek apakah data berhasil di tambahkan atau tidak
    if(tambah($_POST) > 0 ) {
        echo "
        <script>
        alert('Add Successfully');
        document.location.href = 'index.php';
        </script>
        ";
    }
    else  {
        echo "
        <script>
        alert('Add Failed');
        document.location.href = 'add.php';
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
    <title>Add Data</title>
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
    <h1>Add Data</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama :</label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="nim">NIM :</label>
                <input type="number" name="nim" id="nim" required>
            </li>
            <li>
                <label for="jurusan">Jurusan :</label>
                <input type="text" name="jurusan" id="jurusan" required>
            </li>
            <li>
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="gambar">Gambar :</label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Add Data</button>
            </li>
        </ul>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
