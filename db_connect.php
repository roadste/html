<?php
$host = 'localhost';
$dbname = 'qa_platform';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "數據庫連接成功";  // 測試用
} catch(PDOException $e) {
    die("連接失敗: " . $e->getMessage());
}

// 確保 $pdo 可以被其他文件使用
global $pdo;
?> 