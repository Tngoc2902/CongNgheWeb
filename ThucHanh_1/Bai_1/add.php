<?php
include 'database.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    // Xử lý ảnh
    $imageName = basename($_FILES['image']['name']);
    $targetFile = "img/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
    $sql = "INSERT INTO flowers (name, description, image) VALUES ('$name', '$description', '$imageName')";
    if ($conn->query($sql) === TRUE) {
        echo "Thêm thành công! <a href='admin.php'>Quay lại</a>";
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
    <title>Thêm Hoa Mới</title>
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
    <h1>Thêm Hoa Mới</h1>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="name">Tên Hoa:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="description">Mô Tả:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="image">Hình Ảnh:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>

        <button type="submit" name="submit">Thêm</button>
    </form>
</body>

</html>