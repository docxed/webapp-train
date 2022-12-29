<?php
    session_start();
    unset($_SESSION['myId']);
    unset($_SESSION['myEmail']);
    unset($_SESSION['myFirstname']);
    unset($_SESSION['myLastname']);
    unset($_SESSION['mySex']);
    unset($_SESSION['myBorn']);
    unset($_SESSION['myDepartment']);
    unset($_SESSION['myPhone']);
    unset($_SESSION['myAvatar']);
    unset($_SESSION['myJobTitle']);
    echo "<script>";
    echo "alert('ลงชื่อออกจากระบบ');";
    echo "window.location.href = 'index.php';";
    echo "</script>";