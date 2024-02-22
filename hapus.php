<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'function.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
    <script>
    alert('Delete Successfully');
    document.location.href = 'index.php';
    </script>
";

}
else {
    echo "
    <script>
    alert('Delete Failed');
    document.location.href = 'index.php';
    </script>
    ";
}


?>