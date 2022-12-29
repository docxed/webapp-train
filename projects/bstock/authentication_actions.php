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
            echo "alert('อีเมลนี้สมัครแล้ว');";
            echo "window.location.href = 'register.php';";
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
            $_SESSION['myRole'] = $users['user_role'];
            if ($users['user_role'] == 'admin') {
                header("location: home.php");
            } else {
                header("location: home.php");
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['update_profile'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sex = $_POST['sex'];
    $born = $_POST['born'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $userId = $_POST['userId'];

    $image = $_FILES['avatar'];
    $image2 = $_POST['avatar2']; // รูปภาพเก่า
    $upload = $_FILES['avatar']['name']; // รูปภาพใหม่

    if ($upload != '') { // ถ้ามีการอัปโหลดไฟล์ใหม่
        $allow = array('jpg', 'jpeg', 'png'); // กำหนดไฟล์ที่อนุญาตให้อัปโหลด
        $extention = explode(".", $image['name']); // แยกชื่อไฟล์กับนามสกุลออกจากกัน
        $fileActExt = strtolower(end($extention)); // แปลงนามสกุลไฟล์ให้เป็นตัวพิมพ์เล็กทั้งหมด
        $fileNew = rand() . "." . $fileActExt; // สุ่มชื่อไฟล์ใหม่
        $filePath = "uploads/" . $fileNew; // กำหนด path ของไฟล์ที่จะอัปโหลด

        if (in_array($fileActExt, $allow)) { // ตรวจสอบว่านามสกุลไฟล์ที่อัปโหลดมาเป็นไฟล์ที่อนุญาตหรือไม่
            if ($image['size'] > 0 && $image['error'] == 0) { // ตรวจสอบว่าไฟล์มีขนาดมากกว่า 0 และไม่มี error
                move_uploaded_file($image['tmp_name'], $filePath);
            } else {
                echo "<script>";
                echo "alert('ไฟล์มีขนาดที่ไม่ถูกต้อง');";
                echo "window.location.href = 'profile.php';";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "alert('ไม่อนุญาตนามสกุลไฟล์รูปภาพประเภทนี้');";
            echo "window.location.href = 'profile.php';";
            echo "</script>";
        }
    } else {
        $fileNew = $image2;
    }

    try {
        $sql = $conn->prepare("UPDATE users SET user_firstname=:firstname, user_lastname=:lastname, user_sex=:sex, user_born=:born, user_department=:department, user_phone=:phone, user_avatar=:avatar, user_password=:password WHERE user_id=:userId");
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':sex', $sex);
        $sql->bindParam(':born', $born);
        $sql->bindParam(':department', $department);
        $sql->bindParam(':phone', $phone);
        $sql->bindParam(':avatar', $fileNew);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':userId', $userId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('อัปเดตโปรไฟล์สำเร็จ');";
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
