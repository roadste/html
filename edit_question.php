<?php
header('Content-Type: application/json');
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $content = trim($_POST['content']);
    
    try {
        $stmt = $conn->prepare("UPDATE questions SET content = ? WHERE id = ?");
        if ($stmt->execute([$content, $id])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '更新失敗']);
        }
    } catch(Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?> 