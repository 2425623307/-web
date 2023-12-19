<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $admin_password = $_POST["admin_password"];

    $conn = new mysqli("localhost", "root", "root", "test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmtCheckAdmin = $conn->prepare("SELECT id FROM admins WHERE username = ?");
    $stmtCheckAdmin->bind_param("s", $username);
    $stmtCheckAdmin->execute();
    $stmtCheckAdmin->store_result();

    if ($stmtCheckAdmin->num_rows > 0) {
        echo "用户名已存在，请选择其他用户名。";
    } else {
        // 根据用户是否提供 Admin Password 来设置 is_admin 的值
        $is_admin = isset($admin_password) && $admin_password == "admin" ? 1 : 0;

        if ($password === $confirm_password) {
            // 不使用哈希处理密码
            $stmtInsertUser = $conn->prepare("INSERT INTO admins (username, password, is_admin) VALUES (?, ?, ?)");
            $stmtInsertUser->bind_param("ssi", $username, $password, $is_admin);
            $stmtInsertUser->execute();

            echo "注册成功。您现在可以 <a href='../index.html'>登录</a>。";
        } else {
            echo "密码不匹配。";
        }
    }

    $stmtCheckAdmin->close();
    $conn->close();
}
?>
