<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM flowers WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công! <a href='admin.php'>Quay lại</a>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>