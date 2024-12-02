<?php
// 数据库连接
$conn = new mysqli("localhost", "root", "", "qa_platform");

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取搜索关键字
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// 准备SQL语句
if (!empty($keyword)) {
    // 如果有关键字，使用LIKE进行搜索
    $sql = "SELECT * FROM questions WHERE content LIKE ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $keyword . "%";
    $stmt->bind_param("s", $searchTerm);
} else {
    // 如果没有关键字，获取所有问题
    $sql = "SELECT * FROM questions ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
}

// 执行查询
$stmt->execute();
$result = $stmt->get_result();

// 输出结果
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='question'>";
        echo "<p>" . htmlspecialchars($row['content']) . "</p>";
        echo "<button class='delete-btn' data-id='" . $row['id'] . "'>删除</button>";
        echo "</div>";
    }
} else {
    echo "<p>没有找到相关问题</p>";
}

$stmt->close();
$conn->close();
?>
