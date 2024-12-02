<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$username = 'root';
$password = '';

try {
    // 先測試不指定數據庫的連接
    $pdo = new PDO("mysql:host=$host", $username, $password);
    echo "基本連接成功！<br>";
    
    // 檢查數據庫是否存在
    $stmt = $pdo->query("SHOW DATABASES");
    echo "現有的數據庫：<br>";
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Database'] . "<br>";
    }
    
} catch(PDOException $e) {
    die("連接失敗: " . $e->getMessage());
}
?> 