<?php

require_once 'config/db.php';

if (isset($_POST['create'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];

    try {
        $sql = $conn->prepare("INSERT INTO students(firstname, lastname, age, sex) VALUES (:firstname, :lastname, :age, :sex)");
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":age", $age);
        $sql->bindParam(":sex", $sex);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('เพิ่มข้อมูลสำเร็จ');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['update'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $studentId = $_POST['studentId'];

    try {
        $sql = $conn->prepare("UPDATE students SET firstname=:firstname, lastname=:lastname, age=:age, sex=:sex WHERE id=:studentId");
        $sql->bindParam(":firstname", $firstname);
        $sql->bindParam(":lastname", $lastname);
        $sql->bindParam(":age", $age);
        $sql->bindParam(":sex", $sex);
        $sql->bindParam(":studentId", $studentId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('อัปเดตข้อมูลสำเร็จ');";
            echo "window.location.href = 'editstudent.php?studentId=$studentId';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['delete'])) {
    $studentId = $_GET['studentId'];
    try {
        $sql = $conn->prepare("DELETE FROM students WHERE id=:studentId");
        $sql->bindParam(":studentId", $studentId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('ลบข้อมูลสำเร็จ');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href = 'index.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
