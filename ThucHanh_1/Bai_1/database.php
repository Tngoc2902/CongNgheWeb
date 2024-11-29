<?php
$host = 'localhost';
$user = 'root'; // Thay bằng user của bạn
$password = 'ngoc2902'; // Thay bằng mật khẩu của bạn
$dbname = 'flower_management';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>