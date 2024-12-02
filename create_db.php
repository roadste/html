<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    
    // 創建數據庫
    $pdo->exec("CREATE DATABASE IF NOT EXISTS qa_platform");
    
    // 選擇數據庫
    $pdo->exec("USE qa_platform");
    
    // 創建表
    $sql = "CREATE TABLE IF NOT EXISTS questions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    
    echo "數據庫和表創建成功！";
    
} catch(PDOException $e) {
    die("操作失敗: " . $e->getMessage());
}
?> 