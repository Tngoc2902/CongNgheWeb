<?php
include 'database.php';

$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách hoa</title>
</head>
<style>
/* style.css */
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
    font-size: 40px;
}

.btn {
    padding: 5px 10px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
}

.btn-add {
    background-color: #28a745;
    display: block;
    margin: 20px auto;
    width: 100px;
    text-align: center;
}

.btn-edit {
    background-color: #007bff;
}

.btn-delete {
    background-color: #dc3545;
}

table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    /* Cố định chiều rộng cột */
}

table thead tr {
    background-color: #28a745;
    color: white;
}

th,
td {
    padding: 10px;
    border: 1px solid #ddd;
    word-wrap: break-word;
    /* Tự động ngắt dòng */
    overflow-wrap: break-word;
    white-space: normal;
    /* Cho phép xuống dòng */
}

td img {
    max-width: 100px;
    /* Kích thước ảnh giới hạn */
    height: auto;
}

form {
    max-width: 500px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

form input,
form textarea,
form button {
    padding: 10px;
}
</style>

<body>
    <h1>Quản lý danh sách hoa</h1>
    <a href="add.php" class="btn btn-add" target="_blank">Thêm mới</a>
    <table border="1">
        <thead>
            <tr>
                <th>Tên Hoa</th>
                <th>Mô Tả Loài Hoa</th>
                <th>Hình Ảnh</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['description']); ?></td> <!-- Ngắt dòng -->
                <td>
                    <img src="img
                    /<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" width="100">
                </td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Sửa</a>
                    <a href="delete.php?id=<?= $row['id']; ?>" class="btn btn-delete"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>