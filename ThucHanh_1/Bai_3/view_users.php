<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển Thị Dữ Liệu Từ CSDL</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 50px;
        padding: 15px;
    }

    .data-table-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    h1 {
        text-align: center;
        color: #343a40;
        font-size: 28px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        text-align: left;
        padding: 12px;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #007bff;
        color: #fff;
        font-size: 18px;
    }

    table td {
        background-color: #f9f9f9;
        font-size: 16px;
    }

    table tr:nth-child(even) td {
        background-color: #f1f1f1;
    }

    table tr:hover td {
        background-color: #e2e6ea;
    }

    .message {
        font-size: 16px;
        margin-top: 20px;
        text-align: center;
        color: #28a745;
    }

    .error-message {
        font-size: 16px;
        margin-top: 20px;
        text-align: center;
        color: #dc3545;
    }

    @media (max-width: 768px) {

        table th,
        table td {
            font-size: 14px;
            padding: 8px;
        }
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="data-table-container">
            <h1>Danh Sách Dữ Liệu Người Dùng</h1>

            <?php
            // Kết nối cơ sở dữ liệu
            $servername = "localhost";
            $username = "root";
            $password = "ngoc2902";
            $dbname = "test_file_csv";
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $sql = "SELECT username, password, lastname, firstname, city, email, course1 FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>";
                echo "<thead><tr><th>STT</th><th>Username</th><th>Password</th><th>Lastname</th><th>Firstname</th><th>City</th><th>Email</th><th>Course</th></tr></thead>";
                echo "<tbody>";

                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['course1'] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<div class='error-message'>Không có dữ liệu nào trong cơ sở dữ liệu.</div>";
            }

            $conn->close();
            ?>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>