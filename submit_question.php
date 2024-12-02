<?php
require_once 'db_connect.php';
//在文件頂部添加以下代碼來顯示錯誤
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    $content = trim($_POST['content']);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO questions (content) VALUES (?)");
        $stmt->execute([$content]);
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?>
