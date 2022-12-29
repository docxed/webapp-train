<?php
require_once './config/db.php';

if (isset($_POST['create'])) {
    $type = $_POST['type'];
    $quantity = $_POST['quantity'];
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];

    try {
        $sql = $conn->prepare("INSERT INTO requests (request_type, request_quantity, product_id, user_id) VALUES (:type, :quantity, :productId, :userId)");
        $sql->bindParam(":type", $type);
        $sql->bindParam(":quantity", $quantity);
        $sql->bindParam(":productId", $productId);
        $sql->bindParam(":userId", $userId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('สร้างคำขอสำเร็จ');";
            echo "window.location.href = 'myrequests.php';";
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
} else if (isset($_GET['approve'])) {
    $requestId = $_GET['reqeustId'];
    $productId = $_GET['productId'];
    $requestStatus = "อนุมัติ";
    $result_quantity = $_GET['result_quantity'];
    try {
        $sql = $conn->prepare("UPDATE requests SET request_status = :requestStatus WHERE request_id = :requestId");
        $sql->bindParam(":requestStatus", $requestStatus);
        $sql->bindParam(":requestId", $requestId);
        $sql->execute();

        if ($sql) {
            $sql2 = $conn->prepare("UPDATE products SET product_quantity = :result_quantity WHERE product_id = :productId");
            $sql2->bindParam(":result_quantity", $result_quantity);
            $sql2->bindParam(":productId", $productId);
            $sql2->execute();

            if ($sql2) {
                echo "<script>";
                echo "alert('อัปเดตสถานะคำขอสำเร็จ');";
                echo "window.location.href = 'viewrequest.php?q=$requestId';";
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
} else if (isset($_GET['cancel'])) {
    $requestId = $_GET['reqeustId'];
    $requestStatus = "ยกเลิก";
    try {
        $sql = $conn->prepare("UPDATE requests SET request_status = :requestStatus WHERE request_id = :requestId");
        $sql->bindParam(":requestStatus", $requestStatus);
        $sql->bindParam(":requestId", $requestId);
        $sql->execute();
        if ($sql) {
            echo "<script>";
            echo "alert('อัปเดตสถานะคำขอสำเร็จ');";
            echo "window.location.href = 'viewrequest.php?q=$requestId';";
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
