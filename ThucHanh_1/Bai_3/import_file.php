<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File CSV và Lưu Vào CSDL</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .container-fluid {
        margin-top: 50px;
        padding: 15px;
    }

    .upload-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
    }

    h1 {
        text-align: center;
        color: #343a40;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .form-group label {
        font-size: 18px;
        color: #495057;
    }

    .file-input-label {
        color: #007bff;
        cursor: pointer;
    }

    .file-input-label:hover {
        text-decoration: underline;
    }

    button {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .message,
    .error-message {
        font-size: 16px;
        margin-top: 20px;
        text-align: center;
    }

    .message {
        color: #28a745;
    }

    .error-message {
        color: #dc3545;
    }

    .table-demo {
        overflow-x: auto;
        overflow-y: auto;
        max-height: 600px;
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 upload-container">
                <h1 class="text-center">Upload File CSV</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="csv_file">Chọn file CSV để tải lên:</label>
                        <input type="file" class="form-control-file" name="csv_file" accept=".csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="upload">Tải lên</button>
                </form>

                <?php
                session_start();

                // Kết nối cơ sở dữ liệu
                $servername = "localhost";
                $username = "root";
                $password = "ngoc2902";
                $dbname = "test_file_csv";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file']) && isset($_POST['upload'])) {
                    $fileType = pathinfo($_FILES['csv_file']['name'], PATHINFO_EXTENSION);
                    if ($fileType !== 'csv') {
                        echo "<div class='error-message'>Vui lòng tải lên một file CSV hợp lệ.</div>";
                    } else {
                        $file = fopen($_FILES['csv_file']['tmp_name'], 'r');
                        $data = [];
                        $row = 0;
                        while (($line = fgetcsv($file)) !== FALSE) {
                            if ($row > 0) {
                                $data[] = $line;
                            }
                            $row++;
                        }
                        fclose($file);

                        echo "<h3 class='text-center'>Dữ liệu từ File CSV</h3>";
                        echo "<form action='' method='POST'>";
                        echo "<div class='table-demo'>";
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead><tr><th>STT</th><th>Username</th><th>Password</th><th>Lastname</th><th>Firstname</th><th>City</th><th>Email</th><th>Course</th></tr></thead><tbody>";

                        foreach ($data as $index => $rowData) {
                            echo "<tr>";
                            echo "<td>" . ($index + 1) . "</td>";
                            echo "<td>" . $rowData[0] . "</td>";
                            echo "<td>" . $rowData[1] . "</td>";
                            echo "<td>" . $rowData[2] . "</td>";
                            echo "<td>" . $rowData[3] . "</td>";
                            echo "<td>" . $rowData[4] . "</td>";
                            echo "<td>" . $rowData[5] . "</td>";
                            echo "<td>" . $rowData[6] . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody></table>";

                        $_SESSION['csv_data'] = $data;
                        echo "</div>";
                        echo "<button type='submit' class='btn btn-success btn-block' name='submit_data'>Lưu vào CSDL</button>";
                        echo "</form>";
                    }
                }

                if (isset($_POST['submit_data']) && isset($_SESSION['csv_data'])) {
                    $csvData = $_SESSION['csv_data'];
                    $success = 0;
                    $error = 0;

                    foreach ($csvData as $rowData) {
                        $username = $rowData[0];
                        $password = $rowData[1];
                        $lastname = $rowData[2];
                        $firstname = $rowData[3];
                        $city = $rowData[4];
                        $email = $rowData[5];
                        $course = $rowData[6];

                        $stmt = $conn->prepare("INSERT INTO users (username, password, lastname, firstname, city, email, course1) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssssss", $username, $password, $lastname, $firstname, $city, $email, $course);

                        if ($stmt->execute()) {
                            $success++;
                        } else {
                            $error++;
                        }
                    }

                    if ($success > 0) {
                        echo "<div class='message'>Dữ liệu đã được lưu vào cơ sở dữ liệu thành công! ($success bản ghi)</div>";
                    }
                    if ($error > 0) {
                        echo "<div class='error-message'>Có lỗi xảy ra khi lưu một số bản ghi. ($error bản ghi lỗi)</div>";
                    }

                    unset($_SESSION['csv_data']);
                }

                $conn->close();
                ?>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>