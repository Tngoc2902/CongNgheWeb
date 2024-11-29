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
    <title>Danh sách các loài hoa</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
    font-size: 40px;
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

table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

table thead tr {
    background-color: #28a745;
    color: white;
}

th,
td {
    padding: 10px;
    border: 2px solid #ddd;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
}

td img {
    max-width: 100px;
    height: auto;
}
</style>

<body>
    <h1>Danh sách các loài hoa</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Tên Hoa</th>
                <th>Mô Tả Loài Hoa</th>
                <th>Hình Ảnh</th>
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
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>