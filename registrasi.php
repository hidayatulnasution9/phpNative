<?php
require 'function.php';

if (isset($_POST["register"])) {

    if(registrasi($_POST) > 0) {
        echo "<script>
            alert('Add User Succesfully');
            </script>
        ";
    }
    else {
        echo mysqli_error($conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            color: #333;
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
    </style>
</head>
<body>
    <h1>Registrasi</h1>

    <form action="" method="post">

    <ul>
        
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" required>
        
        
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" required> 
       
            <label for="password2">Confirm Password :</label>
            <input type="password" name="password2" id="password2" required>
        
            <button type="submit" name="register">Register</button>
       
        <button>
            <a href="login.php">Login</a>
        </button>
    </ul>
    </form>
</body>
</html>