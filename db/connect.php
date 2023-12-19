<?php
// 数据库连接配置
$servername = "localhost";  //连接名
$username = "root";         //用户名
$password = "root";         //密码
$dbname = "database";       //数据库名        只需要改这些就好了！！！！！

/*
   ****     ****
 *******   *******
*******************
 *****************
  **************
    **********
      ******
        **
*/

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>
