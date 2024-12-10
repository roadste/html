<?php
header('Content-Type: application/json');
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_id = $_POST['question_id'];
    $content = trim($_POST['content']);
    
    try {
        $stmt = $conn->prepare("INSERT INTO replies (question_id, content) VALUES (?, ?)");
        if ($stmt->execute([$question_id, $content])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '回復保存失敗']);
        }
    } catch(Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?> 