<?php
require_once './config/db.php';
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image = $_FILES['image']; // รูปภาพจะถูกส่งมาในรูปแบบของ array
    $userId = $_POST['userId'];

    $allow = array('jpg', 'jpeg', 'png'); // กำหนดไฟล์ที่อนุญาตให้อัปโหลด
    $extention = explode(".", $image['name']); // แยกชื่อไฟล์กับนามสกุลออกจากกัน
    $fileActExt = strtolower(end($extention)); // แปลงนามสกุลไฟล์ให้เป็นตัวพิมพ์เล็กทั้งหมด
    $fileNew = rand() . "." . $fileActExt; // สุ่มชื่อไฟล์ใหม่
    $filePath = "uploads/" . $fileNew; // กำหนด path ของไฟล์ที่จะอัปโหลด

    try {

        if (in_array($fileActExt, $allow)) { // ตรวจสอบว่านามสกุลไฟล์ที่อัปโหลดมาเป็นไฟล์ที่อนุญาตหรือไม่
            if ($image['size'] > 0 && $image['error'] == 0) { // ตรวจสอบว่าไฟล์มีขนาดมากกว่า 0 และไม่มี error
                if (move_uploaded_file($image['tmp_name'], $filePath)) { // อัปโหลดไฟล์
                    $sql = $conn->prepare("INSERT INTO posts (post_title, post_content, post_category, post_image, user_id) VALUES (:title, :content, :category, :image, :userId)");
                    $sql->bindParam(":title", $title);
                    $sql->bindParam(":content", $content);
                    $sql->bindParam(":category", $category);
                    $sql->bindParam(":image", $fileNew);
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
                } else {
                    echo "<script>";
                    echo "alert('เกิดข้อผิดพลาดในการอัปโหลดไฟล์');";
                    echo "window.location.href = 'createpost.php';";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "alert('ไฟล์มีขนาดที่ไม่ถูกต้อง');";
                echo "window.location.href = 'createpost.php';";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "alert('ไม่อนุญาตนามสกุลไฟล์รูปภาพประเภทนี้');";
            echo "window.location.href = 'createpost.php';";
            echo "</script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image = $_FILES['image'];
    $postId = $_POST['postId'];

    $image2 = $_POST['image2']; // รูปภาพเก่า
    $upload = $_FILES['image']['name']; // รูปภาพใหม่

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
                echo "window.location.href = 'createpost.php';";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "alert('ไม่อนุญาตนามสกุลไฟล์รูปภาพประเภทนี้');";
            echo "window.location.href = 'createpost.php';";
            echo "</script>";
        }
    } else {
        $fileNew = $image2;
    }

    try {
        $sql = $conn->prepare("UPDATE posts SET post_title = :title, post_content = :content, post_category = :category, post_image=:image WHERE post_id = :postId");
        $sql->bindParam(":title", $title);
        $sql->bindParam(":content", $content);
        $sql->bindParam(":category", $category);
        $sql->bindParam(":image", $fileNew);
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
