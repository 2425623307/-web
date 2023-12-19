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
        function redirectToUpdate() {
            window.location.href = "../update/update.html";
        }
    </script>
</head>
<body>

<!-- 提供返回链接 -->
<a href="#" onclick="redirectToContent()">返回目录</a>
<a href="#" onclick="redirectToDefine()">数据定义</a>
<a href="#" onclick="redirectToUpdate()">数据更新</a>

<!-- 显示操作结果 -->
<?php echo $operationResult; ?>

<!-- 其他页面内容 -->
</body>
</html>

<?php  
// 引入数据库连接文件
include '../connect.php';
  
// 获取用户输入的查询语句  
$userQuery = $_POST['query'];  
  
// 执行查询并获取结果  
$sql = $userQuery;  
$result = $conn->query($sql);  

// 处理查询结果
if ($result) {
    echo "<h2>查询结果：</h2>";
    echo "<table border='1'>";
    
    // 输出表头
    $fieldinfo = $result->fetch_fields();
    echo "<tr>";
    foreach ($fieldinfo as $field) {
        echo "<th>{$field->name}</th>";
    }
    echo "</tr>";
    
    // 输出数据
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>{$value}</td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>查询失败: " . $conn->error . "</p>";
}
  
// 关闭数据库连接  
$conn->close();  
?>
