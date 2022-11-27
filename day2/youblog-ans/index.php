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
        <h1>ล็อกอิน</h1>
        <hr><br>
        <form action="login_action.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">อีเมล</label>
                <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="50" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
            </div>
            <div>
                <button name="login" class="btn btn-primary">ล็อกอิน</button>
                <a class="btn btn-light" href="./register.php" role="button">สมัครสมาชิก</a>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>