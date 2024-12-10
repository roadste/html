<?php
require_once 'db_connect.php';

if (isset($_GET['question_id'])) {
    $question_id = $_GET['question_id'];
    
    try {
        $stmt = $conn->prepare("SELECT * FROM replies WHERE question_id = ? ORDER BY created_at DESC");
        $stmt->execute([$question_id]);
        $result = $stmt->get_result();
        
        while($row = $result->fetch_assoc()) {
            echo "<div class='reply' data-id='" . $row['id'] . "'>";
            echo "<p class='reply-content'>" . htmlspecialchars($row['content']) . "</p>";
            echo "<small>" . $row['created_at'] . "</small>";
            // 添加編輯和刪除按鈕
            echo "<div class='reply-actions'>";
            echo "<button class='edit-reply-btn' data-id='" . $row['id'] . "'>編輯</button>";
            echo "<button class='delete-reply-btn' data-id='" . $row['id'] . "'>刪除</button>";
            echo "</div>";
            echo "</div>";
        }
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>