<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 其他头部内容 -->
    <meta charset="UTF-8">
    <script>
        // JavaScript 跳转
        function redirectToContent() {
            window.location.href = "../adminpage.html";
        }
        function redirectToQuery() {
            window.location.href = "../query/query.html";
        }
        function redirectToUpdate() {
            window.location.href = "../update/update.html";
        }
    </script>
</head>
<body>

<!-- 提供返回链接 -->
<a href="#" onclick="redirectToContent()">返回目录</a>
<a href="#" onclick="redirectToQuery()">数据查询</a>
<a href="#" onclick="redirectToUpdate()">数据更新</a>

<?php
// 引入数据库连接文件
include '../connect.php';

// 处理用户提交的数据定义语句
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // 获取用户输入的数据定义语句
    $userQuery = $_POST['user_query'];

    // 执行用户输入的语句
    $result = $conn->query($userQuery);

    // 显示执行结果
    echo "<h3>执行结果：</h3>";
    if ($result) {
        echo "操作成功";
    } else {
        echo "操作失败: " . $conn->error;
    }

    // 关闭数据库连接
    $conn->close();
}
?>
