-- Tạo cơ sở dữ liệu nếu chưa có
CREATE DATABASE IF NOT EXISTS test_file_txt;

-- Sử dụng cơ sở dữ liệu vừa tạo
USE test_file_txt;

-- Tạo bảng 'questions' để lưu câu hỏi, đáp án và đáp án đúng
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,       -- ID câu hỏi
    question_text TEXT NOT NULL,             -- Câu hỏi
    options TEXT NOT NULL,                   -- Các đáp án, lưu dưới dạng văn bản (các đáp án cách nhau bằng ký tự newline)
    correct_answer CHAR(10) NOT NULL          -- Đáp án đúng, lưu dạng ký tự (A, B, C, D)
);

-- Nếu cần thêm bảng lưu trữ kết quả bài thi, ví dụ:
CREATE TABLE IF NOT EXISTS test_results (
    id INT AUTO_INCREMENT PRIMARY KEY,       -- ID kết quả bài thi
    user_id INT NOT NULL,                    -- ID người dùng (nếu có hệ thống người dùng)
    score DECIMAL(5, 2) NOT NULL,            -- Điểm số của người dùng
    date_taken TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Thời gian hoàn thành bài thi
);
