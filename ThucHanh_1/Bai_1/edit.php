<?php
include 'database.php';

// Lấy ID của hoa từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin của hoa từ cơ sở dữ liệu
    $sql = "SELECT * FROM flowers WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $flower = $result->fetch_assoc();
    } else {
        die("Không tìm thấy thông tin của hoa.");
    }
}

// Xử lý khi người dùng cập nhật thông tin
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $imageName = $flower['image']; // Giữ ảnh cũ nếu không thay đổi ảnh

    // Kiểm tra nếu người dùng tải lên ảnh mới
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $targetFile = "img/" . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    }

    // Cập nhật thông tin hoa trong cơ sở dữ liệu
    $sql = "UPDATE flowers SET name='$name', description='$description', image='$imageName' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công! <a href='admin.php'>Quay lại danh sách</a>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Hoa</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
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
    <h1>Sửa Thông Tin Hoa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Tên Hoa:</label>
        <input type="text" name="name" id="name" value="<?= $flower['name']; ?>" required><br><br>

        <label for="description">Mô Tả:</label>
        <textarea name="description" id="description" required><?= $flower['description']; ?></textarea><br><br>

        <label for="image">Hình Ảnh Hiện Tại:</label><br>
        <img src="img/<?= $flower['image']; ?>" alt="<?= $flower['name']; ?>" width="150"><br><br>

        <label for="image">Tải Lên Hình Ảnh Mới (nếu có):</label>
        <input type="file" name="image" id="image" accept="image/*"><br><br>

        <button type="submit" name="submit">Cập Nhật</button>
    </form>
</body>

</html>