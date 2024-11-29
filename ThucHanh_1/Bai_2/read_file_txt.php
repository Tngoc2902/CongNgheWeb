<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải file câu hỏi</title>
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
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
    }

    label {
        font-size: 16px;
        color: #555;
    }

    input[type="file"] {
        margin: 10px 0;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        padding: 12px 25px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    h2 {
        text-align: center;
        color: #333;
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
        text-align: left;
    }

    .options-list {
        margin-left: 20px;
        list-style-type: none;
        padding-left: 0;
        text-align: left;
    }

    .options-list li {
        font-size: 14px;
        color: #555;
    }

    .correct-answer {
        font-weight: bold;
        color: green;
    }

    hr {
        border: 0;
        border-top: 1px solid #ddd;
        margin: 20px 0;
    }
    </style>
</head>

<body>
    <h1>Tải lên file câu hỏi</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="file">Chọn file TXT:</label>
        <input type="file" name="file" id="file" accept=".txt" required>
        <button type="submit">Phân tích</button>
    </form>

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

    // Xử lý file sau khi người dùng tải lên
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileContent = file_get_contents($fileTmpPath);
        
        if ($fileContent === false) {
            die("Không thể đọc file được tải lên!");
        }

        // Phân tích nội dung file
        $lines = explode("\n", trim($fileContent));
        $questions = [];
        $currentQuestion = "";
        $options = [];
        $correctAnswer = "";

        foreach ($lines as $line) {
            $line = trim($line);

            // Nếu gặp dòng chứa ANSWER, lưu đáp án đúng và hoàn thành câu hỏi
            if (strpos($line, 'ANSWER:') !== false) {
                $correctAnswer = trim(str_replace('ANSWER:', '', $line));
                $questions[] = [
                    'question' => $currentQuestion,
                    'options' => $options,
                    'correct_answer' => $correctAnswer
                ];
                $currentQuestion = "";
                $options = [];
                $correctAnswer = "";
            }
            elseif (preg_match('/^[A-D]\./', $line)) {
                $options[] = $line;
            }
            else {
                $currentQuestion .= $line . " ";
            }
        }

        // Hiển thị câu hỏi, đáp án và đáp án đúng để xác nhận
        echo "<form method='POST'>";
        echo "<h2>Xác nhận dữ liệu để lưu vào cơ sở dữ liệu:</h2>";
        foreach ($questions as $index => $question) {
            echo "<div class='question-container'>";
            echo "<p><b>Câu hỏi " . ($index + 1) . ":</b> " . htmlspecialchars($question['question']) . "</p>";
            echo "<p><b>Các đáp án:</b></p>";
            echo "<ul class='options-list'>";
            foreach ($question['options'] as $option) {
                echo "<li>" . htmlspecialchars($option) . "</li>";
            }
            echo "</ul>";
            echo "<p><b>Đáp án đúng:</b> <span class='correct-answer'>" . htmlspecialchars($question['correct_answer']) . "</span></p>";
            echo "<hr>";
            echo "</div>";
        }
        echo "<input type='hidden' name='questions' value='" . htmlspecialchars(json_encode($questions)) . "'>";
        echo "<button type='submit' name='save'>Lưu vào cơ sở dữ liệu</button>";
        echo "</form>";
    }

    // Lưu dữ liệu vào cơ sở dữ liệu khi đồng ý
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save']) && isset($_POST['questions'])) {
        $questions = json_decode($_POST['questions'], true);

        $stmt = $conn->prepare("INSERT INTO questions (question_text, options, correct_answer) VALUES (?, ?, ?)");
        foreach ($questions as $question) {
            $optionsStr = implode("\n", $question['options']);
            $stmt->bind_param("sss", $question['question'], $optionsStr, $question['correct_answer']);
            $stmt->execute();
        }

        echo "<p style='text-align: center;'>Dữ liệu đã được lưu thành công!</p>";
        $stmt->close();
    }

    $conn->close();
    ?>
</body>

</html>