<?php
require_once './config/db.php';

if (isset($_GET['admin_delete'])) {
    $userId = $_GET['userId'];

    $sql = $conn->prepare("DELETE FROM users WHERE user_id = :userId");
    $sql->bindParam(":userId", $userId);
    $sql->execute();

    if ($sql) {
        $sql2 = $conn->prepare("DELETE FROM posts WHERE user_id = :userId");
        $sql2->bindParam(":userId", $userId);
        $sql2->execute();

        if ($sql2) {
            $sql2 = $conn->prepare("DELETE FROM comments WHERE user_id = :userId");
            $sql2->bindParam(":userId", $userId);
            $sql2->execute();
            if ($sql) {
                echo "<script>";
                echo "alert('ลบผู้ใช้');";
                echo "window.location.href = 'admin_users.php';";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดบางประการ');";
                echo "window.location.href = 'error.php';";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href = 'error.php';";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert('เกิดข้อผิดพลาดบางประการ');";
        echo "window.location.href = 'error.php';";
        echo "</script>";
    }
}
