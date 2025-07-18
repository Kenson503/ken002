<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'info');

$id = $_GET['id'];

// delete the record
$sql = "DELETE FROM logs WHERE id=$id";
mysqli_query($conn, $sql);

header("Location: dashboard.php");
?>