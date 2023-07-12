<?php
include 'connect.php';
$conn = new connect();

$action = $_POST['action'];
$value = $_POST['value'];

if($action == 'Deposit') {
    $conn->deposit($value);
} else {
    $conn->withdraw($value);
}
?>