<?php
    session_start();
    require_once 'config/db.php';

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $check_data->bindParam(":email", $email);
        $check_data->execute();
        $row_users = $check_data->fetch(PDO::FETCH_ASSOC);

        if ($check_data->rowCount() == 0) {
            echo "<script>";
            echo "alert('ไม่พบข้อมูลในระบบ');";
            echo "window.location.href='index.php';";
            echo "</script>";
        } else if ($password != $row_users['password']) {
            echo "<script>";
            echo "alert('รหัสผ่านไม่ถูกต้อง');";
            echo "window.location.href='index.php';";
            echo "</script>";
        } else {
            $_SESSION['email'] = $row_users['email'];
            $_SESSION['role'] = $row_users['role'];
            header("location: home.php");
        }
    }
