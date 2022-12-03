<?php
require_once './config/db.php';
if (isset($_POST['create'])) {
    $content = $_POST['content'];
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];

    try {
        $sql = $conn->prepare("INSERT INTO comments (comment_content, post_id, user_id) VALUES (:content, :postId, :userId)");
        $sql->bindParam(":content", $content);
        $sql->bindParam(":postId", $postId);
        $sql->bindParam(":userId", $userId);
        $sql->execute();

        if ($sql) {
            echo "<script>";
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
    $commentId = $_GET['commentId'];
    $postId = $_GET['postId'];

    try {
        $sql = $conn->prepare("DELETE FROM comments WHERE comment_id = :commentId");
        $sql->bindParam(":commentId", $commentId);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('ลบความคิดเห็นแล้ว');";
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
} else if (isset($_GET['admin_delete'])) {
    $commentId = $_GET['commentId'];

    try {
        $sql = $conn->prepare("DELETE FROM comments WHERE comment_id = :commentId");
        $sql->bindParam(":commentId", $commentId);
        $sql->execute();

        if ($sql) {
            echo "<script>";
            echo "alert('ลบความคิดเห็นแล้ว');";
            echo "window.location.href = 'admin_comments.php';";
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
