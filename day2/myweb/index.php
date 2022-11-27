<?php
require_once 'config/db.php';

$students_stmt = $conn->query("SELECT id, firstname, lastname FROM students");
$students_stmt->execute();
$students = $students_stmt->fetchAll()
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
    <h1>ฟอร์มเพิ่มข้อมูล Students</h1>
    <form action="student_action.php" method="POST">
        <label for="firstname">ชื่อ</label>
        <input name="firstname" type="text" maxlength="100" required> <br>
        <label for="lastname">นามสกุล</label>
        <input name="lastname" type="text" maxlength="100" required> <br>
        <label for="age">อายุ</label>
        <input name="age" type="number" min="1" max="200" required> <br>
        <label for="sex">เพศ</label>
        <input name="sex" type="radio" value="male" required> ชาย
        <input name="sex" type="radio" value="female" required> หญิง <br>
        <input name="create" type="submit" value="ส่ง">
    </form>
    <br>
    <h1>ข้อมูล Students</h1>
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>ชื่อ - นามสกุล</th>
            <th>จัดการ</th>
        </tr>
        <?php
        foreach ($students as $student) {
        ?>
            <tr>
                <td align="center"><?php echo $student['id']; ?></td>
                <td align="center"><?php echo $student['firstname'] . ' ' . $student['lastname']; ?></td>
                <td align="center">
                    <a href="./viewstudent.php?studentId=<?php echo $student['id']; ?>">
                        <button>ดูข้อมูล</button>
                    </a>
                    <a href="./editstudent.php?studentId=<?php echo $student['id']; ?>">
                        <button>แก้ไข</button>
                    </a>
                    <a href="./student_action.php?delete=delete&studentId=<?php echo $student['id']; ?>">
                        <button>ลบ</button>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>