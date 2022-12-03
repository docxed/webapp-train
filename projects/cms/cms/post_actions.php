<?php
require_once './config/db.php';
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $userId = $_POST['userId'];

    try {
        $sql = $conn->prepare("INSERT INTO posts (post_title, post_content, post_category, user_id) VALUES (:title, :content, :category, :userId)");
        $sql->bindParam(":title", $title);
        $sql->bindParam(":content", $content);
        $sql->bindParam(":category", $category);
        $sql->bindParam(":userId", $userId);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('สร้างโพสต์สำเร็จ');";
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
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $postId = $_POST['postId'];

    try {
        $sql = $conn->prepare("UPDATE posts SET post_title = :title, post_content = :content, post_category = :category WHERE post_id = :postId");
        $sql->bindParam(":title", $title);
        $sql->bindParam(":content", $content);
        $sql->bindParam(":category", $category);
        $sql->bindParam(":postId", $postId);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('แก้ไขโพสต์สำเร็จ');";
            echo "window.location.href = 'viewpost.php?postId=$postId';";
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
    $postId = $_GET['postId'];

    try {
        $sql = $conn->prepare("DELETE FROM posts WHERE post_id = :postId");
        $sql->bindParam(":postId", $postId);
        $sql->execute();

        if ($sql) {
            $sql2 = $conn->prepare("DELETE FROM comments WHERE post_id = :postId");
            $sql2->bindParam(":postId", $postId);
            $sql2->execute();

            if ($sql2) {
                echo "<script>";
                echo "alert('ลบโพสต์สำเร็จ');";
                echo "window.location.href = 'home.php';";
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
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['admin_delete'])) {
    $postId = $_GET['postId'];

    try {
        $sql = $conn->prepare("DELETE FROM posts WHERE post_id = :postId");
        $sql->bindParam(":postId", $postId);
        $sql->execute();

        if ($sql) {
            $sql2 = $conn->prepare("DELETE FROM comments WHERE post_id = :postId");
            $sql2->bindParam(":postId", $postId);
            $sql2->execute();

            if ($sql2) {
                echo "<script>";
                echo "alert('ลบโพสต์สำเร็จ');";
                echo "window.location.href = 'admin.php';";
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
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_GET['admin_delete_category'])) {
    $category = $_GET['category'];

    try {
        $sql = $conn->prepare("DELETE FROM posts WHERE post_category = :category");
        $sql->bindParam(":category", $category);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('ลบโพสต์สำเร็จ');";
            echo "window.location.href = 'admin_categories.php';";
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
