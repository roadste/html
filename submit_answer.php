<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content']) && !empty($_POST['question_id'])) {
    $content = trim($_POST['content']);
    $question_id = $_POST['question_id'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO answers (question_id, content) VALUES (?, ?)");
        $stmt->execute([$question_id, $content]);
        echo json_encode(['success' => true]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}
?> 