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
    <h1>ฟอร์มแก้ไขข้อมูล Students</h1>
    <form action="student_action.php" method="POST">
        <label for="firstname">ชื่อ</label>
        <input name="firstname" type="text" maxlength="100" required value="<?php echo $student['firstname']; ?>"> <br>
        <label for="lastname">นามสกุล</label>
        <input name="lastname" type="text" maxlength="100" required value="<?php echo $student['lastname']; ?>"> <br>
        <label for="age">อายุ</label>
        <input name="age" type="number" min="1" max="200" required value="<?php echo $student['age']; ?>"> <br>
        <label for="sex">เพศ</label>
        <input name="sex" type="radio" value="male" required <?php if ($student['sex'] == 'male') {
                                                                    echo 'checked';
                                                                }  ?>> ชาย
        <input name="sex" type="radio" value="female" required <?php if ($student['sex'] == 'female') {
                                                                    echo 'checked';
                                                                }  ?>> หญิง <br>
        <input name="update" type="submit" value="อัปเดต">
        <input type="hidden" name="studentId" value="<?php echo $student['id']; ?>">
    </form>

</body>

</html>