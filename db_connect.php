<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'qa_platform');

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 設置字符集
$conn->set_charset("utf8mb4");
?> 