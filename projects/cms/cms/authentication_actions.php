<?php
session_start();
require_once './config/db.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];

    try {
        // เช็คว่ามีอีเมลนี้ในระบบหรือไม่
        $check_email = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
        $check_email->bindParam(":email", $email);
        $check_email->execute();
        $users = $check_email->fetch(PDO::FETCH_ASSOC);
        if ($check_email->rowCount() > 0) {
            echo "<script>";
            echo "alert('อีเมลนี้ลงทะเบียนแล้ว');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        } else {
            // ทำการเพิ่มข้อมูลลงใน Database เพื่อสมัครสมาชิก
            $sql = $conn->prepare("INSERT INTO users (user_email, user_firstname, user_lastname, user_password) VALUES (:email, :firstname, :lastname, :password)");
            $sql->bindParam(":email", $email);
            $sql->bindParam(":firstname", $firstname);
            $sql->bindParam(":lastname", $lastname);
            $sql->bindParam(":password", $password);
            $sql->execute();

            if ($sql) {
                echo "<script>";
                echo "alert('สมัครสมาชิกสำเร็จ');";
                echo "window.location.href = 'index.php';";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดบางประการ');";
                echo "window.location.href = 'error.php';";
                echo "</script>";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $check_email = $conn->prepare("SELECT * FROM users WHERE user_email = :email");
        $check_email->bindParam(":email", $email);
        $check_email->execute();
        $users = $check_email->fetch(PDO::FETCH_ASSOC);
        if ($check_email->rowCount() < 1) { // เคส ไม่เจออีเมลใน Database
            echo "<script>";
            echo "alert('ไม่พบอีเมลในระบบ');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        } else if ($password != $users['user_password']) { // เคส รหัสผ่านที่อินพุตเข้ามาไม่ตรงกับ Databasee
            echo "<script>";
            echo "alert('รหัสผ่านไม่ถูกต้อง');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        } else {
            // กรณีล็อกอินสำเร็จ
            $_SESSION['myId'] = $users['user_id'];
            $_SESSION['myEmail'] = $users['user_email'];
            $_SESSION['myFirstname'] = $users['user_firstname'];
            $_SESSION['myLastname'] = $users['user_lastname'];
            $_SESSION['myRole']  = $users['user_role'];
            if ($users['user_role'] == 'admin') {
                header("location: admin.php");
            } else {
                header("location: home.php");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['update_profile'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $myId = $_SESSION['myId'];

    try {
        $sql = $conn->prepare("UPDATE users SET user_email = :email, user_firstname = :firstname, user_lastname = :lastname, user_password = :password WHERE user_id = :myId");
        $sql->bindParam(":email", $email);
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":password", $password);
        $sql->bindParam(":myId", $myId);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('อัปเดตบัญชีผู้ใช้สำเร็จ');";
            echo "window.location.href = 'logout.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href = 'error.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
