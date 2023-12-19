<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli("localhost", "root", "root", "test");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, username, password, is_admin FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $stored_password, $is_admin);
        $stmt->fetch();

        if ($password == $stored_password) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["is_admin"] = $is_admin;

            if ($is_admin) {
                // 用户是管理员
                header("Location: adminpage.html");
                exit();
            } else {
                // 用户是普通用户
                header("Location: userpage.html");
                exit();
            }
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Username not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
