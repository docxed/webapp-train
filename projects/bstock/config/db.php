<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bstock"; // ชื่อ Database

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "เชื่อมต่อ Database ไม่สำเร็จ" . $e->getMessage();
}