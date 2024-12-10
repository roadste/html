<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = trim($_POST['content']);
    
    if (empty($content)) {
        echo "error: 問題內容不能為空";
        exit;
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO questions (content) VALUES (?)");
        if ($stmt->execute([$content])) {
            echo "success";
        } else {
            echo "error: 提交失敗";
        }
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>
