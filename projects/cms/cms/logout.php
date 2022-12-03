<?php
    session_start();
    unset($_SESSION['myId']);
    unset($_SESSION['myEmail']);
    unset($_SESSION['myFirstname']);
    unset($_SESSION['myLastname']);
    unset($_SESSION['myRole']);
    echo "<script>";
    echo "alert('ลงชื่อออกจากระบบ');";
    echo "window.location.href = 'index.php';";
    echo "</script>";