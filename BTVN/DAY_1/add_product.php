<?php include 'header.php';
$servername = "localhost";
$username = "root";
$password = "ngoc2902";
$dbname = "product_management";

// Kết nối cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['name'];
$price = $_POST['price'];

if (!empty($name) && !empty($price)) {
$sql = "INSERT INTO products (name, price) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sd", $name, $price);

if ($stmt->execute()) {
    echo "<script>
    alert('Thêm sản phẩm thành công!');
    window.close();
    </script>";
} else {
    echo "Lỗi: " . $stmt->error;
}
    $stmt->close();
}
    $conn->close();
}
?>

<h1 style="text-align: center;">Thêm sản phẩm mới</h1>
<form method="POST" style="text-align: center;">
    <input type="text" name="name" placeholder="Tên sản phẩm" required>
    <input type="number" name="price" placeholder="Giá sản phẩm" required>
    <button type="submit">Thêm</button>
</form>
<?php include 'footer.php'; ?>