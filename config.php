<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$conn = mysqli_connect('144.217.39.54', 'hostdeprojetos', 'ifspgru@2022', 'hostdeprojetos_airesstores');
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
