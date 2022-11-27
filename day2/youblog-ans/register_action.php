<?php

require_once 'config/db.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];

    try {
        $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
        $check_email->bindParam(":email", $email);
        $check_email->execute();
        $row_email = $check_email->fetch(PDO::FETCH_ASSOC);

        if (isset($row_email['email'])) { // เคสอีเมลซ้ำใน Database
            echo "<script>";
            echo "alert('อีเมลนี้เคยถูกใช้งานแล้ว');";
            echo "window.location.href='register.php';";
            echo "</script>";
        } else {
            $sql = $conn->prepare("INSERT INTO users(email, firstname, lastname, password) VALUES (:email, :firstname, :lastname, :password)");
            $sql->bindParam(":email", $email);
            $sql->bindParam(":firstname", $firstname);
            $sql->bindParam(":lastname", $lastname);
            $sql->bindParam(":password", $password);
            $sql->execute();

            if ($stmt) {
                echo "<script>";
                echo "alert('สมัครสมาชิกสำเร็จ');";
                echo "window.location.href='index.php';";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดบางประการ');";
                echo "window.location.href='index.php';";
                echo "</script>";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
