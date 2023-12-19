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
        function redirectToDefine() {
            window.location.href = "../define/define.html";
        }
        function redirectToQuery() {
            window.location.href = "../query/query.html";
        }
    </script>
</head>
<body>

<!-- 提供返回链接 -->
<a href="#" onclick="redirectToContent()">返回目录</a>
<a href="#" onclick="redirectToDefine()">数据定义</a>
<a href="#" onclick="redirectToQuery()">数据查询</a>


<?php
// 引入数据库连接文件
include '../connect.php';

// 获取用户输入的完整更新语句
$userQuery = $_POST['user_query'];

// 执行用户输入的语句
$result = $conn->query($userQuery);
if ($result) {
    echo "操作成功";
} else {
    echo "操作失败: " . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>

<!-- 显示操作结果 -->
<?php echo $operationResult; ?>

<!-- 其他页面内容 -->
</body>
</html>