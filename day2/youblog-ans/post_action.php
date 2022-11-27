<?php

require_once 'config/db.php';

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    try {
        $sql = $conn->prepare("INSERT INTO posts(title, content) VALUES (:title, :content)");
        $sql->bindParam(":title", $title);
        $sql->bindParam(":content", $content);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('โพสต์สำเร็จ');";
            echo "window.location.href='home.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $pid = $_POST['pid'];

    try {
        $sql = $conn->prepare("UPDATE posts SET title=:title, content=:content WHERE id = :pid");
        $sql->bindParam(":title", $title);
        $sql->bindParam(":content", $content);
        $sql->bindParam(":pid", $pid);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('แก้ไขโพสต์สำเร็จ');";
            echo "window.location.href='editpost.php?id=$pid';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['delete'])) {
    $pid = $_GET['delete'];
    
    try {
        $sql = $conn->prepare("DELETE FROM posts WHERE id = :pid");
        $sql->bindParam(":pid", $pid);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('ลบโพสต์สำเร็จ');";
            echo "window.location.href='home.php';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดบางประการ');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
