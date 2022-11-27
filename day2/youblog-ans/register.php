<?php session_start(); ?>
<?php if (isset($_SESSION['email'])) {
    header("location: home.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container my-5">
        <h1>สมัครสมาชิก</h1>
        <hr><br>
        <form action="register_action.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="50" required>
            </div>
            <div class="row mb-3 g-2">
                <div class="col">
                    <label for="firstname" class="form-label">ชื่อ</label>
                    <input name="firstname" type="text" class="form-control" placeholder="ชื่อ" maxlength="100" required>
                </div>
                <div class="col">
                    <label for="lastname" class="form-label">นามสกุล</label>
                    <input name="lastname" type="text" class="form-control" placeholder="นามสกุล" maxlength="100" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
            </div>
            <div>
                <button name="register" class="btn btn-primary">สมัครสมาชิก</button>
                <a class="btn btn-secondary" href="./index.php" role="button">ยกเลิก</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>