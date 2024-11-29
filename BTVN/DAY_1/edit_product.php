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

// Kiểm tra nếu tham số 'id' được truyền qua URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc(); // Lấy thông tin sản phẩm
    $stmt->close();
}

// Kiểm tra nếu không tìm thấy sản phẩm
if (!$product) {
    echo "<script>alert('Không tìm thấy sản phẩm!'); window.close();</script>";
    exit();
}

// Xử lý khi form được gửi đi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (!empty($name) && !empty($price)) {
        $sql = "UPDATE products SET name = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $name, $price, $id);

        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật sản phẩm thành công!'); window.close();</script>";
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<h1 style="text-align: center;">Sửa sản phẩm</h1>
<form method="POST" style="text-align: center;">
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
    <button type="submit">Lưu</button>
</form>

<?php include 'footer.php'; ?>