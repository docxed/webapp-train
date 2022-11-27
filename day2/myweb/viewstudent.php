<?php
require_once 'config/db.php';

$studentId = $_GET['studentId'];
$student_stmt = $conn->query("SELECT * FROM students WHERE id = $studentId");
$student_stmt->execute();
$student = $student_stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Student ID : <?php echo $studentId; ?></h1>
    <p>ชื่อ : <?php echo $student['firstname']; ?></p>
    <p>นามสกุล : <?php echo $student['lastname']; ?></p>
    <p>อายุ : <?php echo $student['age']; ?></p>
    <p>เพศ : <?php echo $student['sex']; ?></p>
</body>
</html>