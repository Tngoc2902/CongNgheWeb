<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-top: 30px;
    }

    form {
        width: 60%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: left;
    }

    .question-container {
        margin: 20px 0;
        padding: 15px;
        background-color: #fafafa;
        border-radius: 6px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    .question-container p {
        font-size: 16px;
        color: #333;
        line-height: 1.5;
    }

    .option-item {
        margin-left: 20px;
        font-size: 14px;
        color: #555;
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    label {
        font-size: 14px;
        color: #555;
    }

    button.submit-btn {
        width: 100%;
        padding: 12px 0;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    button.submit-btn:hover {
        background-color: #0056b3;
    }

    .option-item:hover {
        background-color: #e7f3ff;
        border-radius: 4px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <?php
        // Kết nối cơ sở dữ liệu
        $servername = "localhost";
        $username = "root";
        $password = "ngoc2902";
        $dbname = "test_file_txt";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Lấy dữ liệu câu hỏi từ bảng
        $sql = "SELECT id, question_text, options FROM questions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<form method='POST' action='submit_test.php'>";
            echo "<h1>Bài Thi Trắc Nghiệm</h1>";
            $index = 1;
            while ($row = $result->fetch_assoc()) {
                $questionId = $row['id'];
                $questionText = $row['question_text'];
                $options = explode("\n", $row['options']); // Tách đáp án thành mảng

                echo "<div class='question-container'>";
                echo "<p><b>Câu $index:</b> $questionText</p>";
                $index++;
                // Hiển thị các đáp án
                foreach ($options as $option) {
                    $value = substr($option, 0, 1); 
                    echo "<div class='option-item'>
                            <input type='checkbox' name='question_$questionId' value='$value'> 
                            <label>" . htmlspecialchars($option) . "</label>
                        </div>";
                }
                echo "</div>";
            }
            echo "<button type='submit' class='submit-btn'>Nộp bài</button>";
            echo "</form>";
        } else {
            echo "<p>Không có câu hỏi nào trong cơ sở dữ liệu.</p>";
        }

        $conn->close();
    ?>
</body>

</html>