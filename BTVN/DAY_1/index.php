<?php include 'header.php'; ?>
<h1 style="text-align: center;">Quản lý sản phẩm</h1>

<a href="add_product.php" class="btn btn-add" target="_blank">Thêm mới</a>

<table>
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá thành</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php include 'products.php'; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price'] ?> VND</td>
            <td>
                <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-edit" target="_blank">Sửa</a>
            </td>
            <td><a href="?delete=<?= $row['id'] ?>" class="btn btn-delete"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>