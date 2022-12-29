<?php
require_once './config/db.php';

if (isset($_POST['create'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $unit = $_POST['unit'];
    $category = $_POST['category'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $userId = $_POST['userId'];
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png'); // กำหนดไฟล์ที่อนุญาตให้อัปโหลด
    $extention = explode(".", $img['name']); // แยกชื่อไฟล์กับนามสกุลออกจากกัน
    $fileActExt = strtolower(end($extention)); // แปลงนามสกุลไฟล์ให้เป็นตัวพิมพ์เล็กทั้งหมด
    $fileNew = rand() . "." . $fileActExt; // สุ่มชื่อไฟล์ใหม่
    $filePath = "uploads/" . $fileNew; // กำหนด path ของไฟล์ที่จะอัปโหลด

    try {
        if (in_array($fileActExt, $allow)) { // ตรวจสอบว่านามสกุลไฟล์ที่อัปโหลดมาเป็นไฟล์ที่อนุญาตหรือไม่
            if ($img['size'] > 0 && $img['error'] == 0) { // ตรวจสอบว่าไฟล์มีขนาดมากกว่า 0 และไม่มี error
                if (move_uploaded_file($img['tmp_name'], $filePath)) { // อัปโหลดไฟล์
                    // ทำการเพิ่มข้อมูลลงใน Database เพื่อสมัครสมาชิก
                    $sql = $conn->prepare("INSERT INTO products (product_code, product_name, product_detail, product_unit, product_category, product_capacity, product_price, product_img, user_id)
                    VALUES (:code, :name, :detail, :unit, :category, :capacity, :price, :img, :userId)");
                    $sql->bindParam(":code", $code);
                    $sql->bindParam(":name", $name);
                    $sql->bindParam(":detail", $detail);
                    $sql->bindParam(":unit", $unit);
                    $sql->bindParam(":category", $category);
                    $sql->bindParam(":capacity", $capacity);
                    $sql->bindParam(":price", $price);
                    $sql->bindParam(":img", $fileNew);
                    $sql->bindParam(":userId", $userId);
                    $sql->execute();
                    if ($sql) {
                        echo "<script>";
                        echo "alert('เพิ่มสต็อกสำเร็จ');";
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
                    echo "window.location.href = 'createproduct.php';";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "alert('ไฟล์มีขนาดที่ไม่ถูกต้อง');";
                echo "window.location.href = 'createproduct.php';";
                echo "</script>";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
