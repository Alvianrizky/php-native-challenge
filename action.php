<?php
include 'connect.php';
$conn = new connect();

$aksi = $_GET['aksi'];
if($aksi == 'transaction') {
    $conn->transaction($_POST['action'], $_POST['value']);
} elseif ($aksi == 'transfer') {
    $conn->transfer($_POST['action'], $_POST['value']);
} elseif($aksi == 'register') {
    $conn->register($_POST['username'], $_POST['password']);
} elseif ($aksi == 'login') {
    $conn->login($_POST['username'], $_POST['password']);
} elseif ($aksi == 'logout') {
    $conn->logout();
}
?>