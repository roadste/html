<?php
header('Content-Type: application/json');
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM replies WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => '刪除失敗']);
        }
    } catch(Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?> 