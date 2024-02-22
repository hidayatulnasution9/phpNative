<?php
session_start();
require 'function.php';

// cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if(isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}



if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            
            // set session
            $_SESSION["login"] = true;

            // cek remember me (Cookie)
            if(isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
                // setcookie('login', 'true', time() + 60);
            }

            header("Location: index.php");            
            exit;
        }
    }

    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
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
            color: #666;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        button a {
            text-decoration: none;
            color: #fff;
        }
        .error {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Login</h1>

    <?php if(isset($error)) : ?>
        <p class="error">Username / Password Salah</p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Username :</label>
        <input type="text" id="username" name="username">

        <label for="password">Password :</label>
        <input type="password" id="password" name="password">

        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>

        <button type="submit" name="login">Login</button>  
        <button>
            <a href="registrasi.php">Registrasi</a>
        </button> 
    </form>
</body>
</html>
