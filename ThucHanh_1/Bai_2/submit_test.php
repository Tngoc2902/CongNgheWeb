<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài thi</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7f6;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
        font-size: 2rem;
        font-weight: bold;
    }

    .result-container {
        width: 80%;
        max-width: 600px;
        padding: 40px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .result-container:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .result-container p {
        font-size: 18px;
        color: #333;
        line-height: 1.6;
        margin: 15px 0;
    }

    .result-container b {
        font-size: 1.2rem;
        color: #007bff;
    }

    .result-container p:last-child {
        font-size: 1.4rem;
        font-weight: bold;
        color: #28a745;
    }

    .result-container p:last-child b {
        color: #28a745;
    }

    .button-container {
        margin-top: 20px;
    }

    .back-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .back-button:hover {
        background-color: #0056b3;
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

    // Lấy tất cả các câu hỏi và đáp án đúng
    $sql = "SELECT id, correct_answer FROM questions";
    $result = $conn->query($sql);

    $correctAnswers = [];
    while ($row = $result->fetch_assoc()) {
        $correctAnswers[$row['id']] = $row['correct_answer'];
    }

    // Xử lý kết quả người dùng
    $totalQuestions = count($correctAnswers);
    $correctCount = 0;

    foreach ($correctAnswers as $questionId => $correctAnswer) {
        if (isset($_POST["question_$questionId"]) && $_POST["question_$questionId"] == $correctAnswer) {
            $correctCount++;
        }
    }

    // Tính toán điểm số
    $score = round(($correctCount / $totalQuestions) * 100, 2);

    $userId = 1;
    $stmt = $conn->prepare("INSERT INTO test_results (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("id", $userId, $score);
    $stmt->execute();

    // Hiển thị kết quả
    echo "<div class='result-container'>";
    echo "<h1>Kết Quả Bài Làm</h1>";

    echo "<p>Bạn trả lời đúng <b>$correctCount</b> / <b>$totalQuestions</b> câu hỏi.</p>";
    echo "<p>Điểm số: <b>$score%</b></p>";
    echo "<div class='button-container'>";
    echo "<button class='back-button' onclick='window.history.back();'>Quay lại</button>";
    echo "</div>";
    echo "</div>";

    $stmt->close();
    $conn->close();
    ?>
</body>

</html>