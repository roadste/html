<?php
require_once 'db_connect.php';

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

if (!empty($keyword)) {
    $sql = "SELECT * FROM questions WHERE content LIKE ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$keyword%";
    $stmt->execute([$searchTerm]);
} else {
    $sql = "SELECT * FROM questions ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    echo "<div class='question' data-id='" . $row['id'] . "'>";
    echo "<p class='question-content'>" . htmlspecialchars($row['content']) . "</p>";
    
    // 添加編輯按鈕
    echo "<button class='edit-btn' data-id='" . $row['id'] . "'>編輯</button>";
    echo "<button class='delete-btn' data-id='" . $row['id'] . "'>刪除</button>";
    
    // 添加回復區域
    echo "<div class='reply-section'>";
    echo "<textarea class='reply-input' placeholder='寫下你的回復...'></textarea>";
    echo "<button class='reply-btn' data-id='" . $row['id'] . "'>回復</button>";
    echo "</div>";
    
    // 回復列表容器
    echo "<div class='replies' id='replies-" . $row['id'] . "'></div>";
    echo "</div>";
}
?>
