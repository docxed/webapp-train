<?php
require_once './config/db.php';

if (isset($_POST['create'])) {
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $status = $_POST['status'];
    $userId = $_POST['userId'];

    try {
        $sql = $conn->prepare("INSERT INTO leaves (leave_description, leave_start, leave_end, leave_status, user_id) VALUES (:description, :start, :end, :status, :userId)");
        $sql->bindParam(":description", $description);
        $sql->bindParam(":start", $start);
        $sql->bindParam(":end", $end);
        $sql->bindParam(":status", $status);
        $sql->bindParam(":userId", $userId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('ส่งฟอร์มลางานสำเร็จ');";
            echo "window.location.href = 'home.php';";
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
} else if (isset($_POST['update'])) {
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $userId = $_POST['userId'];
    $leaveId = $_POST['leaveId'];

    try {
        $sql = $conn->prepare("UPDATE leaves SET leave_description=:description, leave_start=:start, leave_end=:end, user_id=:userId WHERE leave_id=:leaveId");
        $sql->bindParam(":description", $description);
        $sql->bindParam(":start", $start);
        $sql->bindParam(":end", $end);
        $sql->bindParam(":userId", $userId);
        $sql->bindParam(":leaveId", $leaveId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('อัปเดตฟอร์มลางานสำเร็จ');";
            echo "window.location.href = 'editleave.php?leaveId=$leaveId';";
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
} else if (isset($_GET['delete'])) {
    $leaveId = $_GET['leaveId'];

    try {
        $sql = $conn->prepare("DELETE FROM leaves WHERE leave_id=:leaveId");
        $sql->bindParam(":leaveId", $leaveId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('ลบฟอร์มลางานสำเร็จ');";
            echo "window.location.href = 'home.php';";
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
} else if (isset($_POST['admin_status'])) {
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $leaveId = $_POST['leaveId'];
    
    try {
        $sql = $conn->prepare("UPDATE leaves SET leave_status=:status, leave_remark=:remark WHERE leave_id=:leaveId");
        $sql->bindParam(":status", $status);
        $sql->bindParam(":remark", $remark);
        $sql->bindParam(":leaveId", $leaveId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('ตรวจสอบสำเร็จ');";
            echo "window.location.href = 'admin-manageleave.php?leaveId=$leaveId';";
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

