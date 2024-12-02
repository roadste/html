<?php
// 添加错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 打印接收到的ID，确认数据是否传递成功
echo "Received ID: " . $_POST['id'] . "\n";

// 数据库连接
$conn = new mysqli("localhost", "root", "", "qa_platform");

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取要删除的问题ID
$id = $_POST['id'];

// 打印SQL语句，用于调试
echo "Attempting to delete question with ID: " . $id . "\n";

// 准备SQL语句
$sql = "DELETE FROM questions WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("准备语句失败: " . $conn->error);
}

$stmt->bind_param("i", $id);

// 执行删除操作
if ($stmt->execute()) {
    echo "success: 成功删除问题";
} else {
    echo "error: " . $stmt->error . "\n";
    echo "SQL错误: " . $conn->error;
}

$stmt->close();
$conn->close();
?> 