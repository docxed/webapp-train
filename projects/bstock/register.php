<?php session_start() ?>
<?php if (isset($_SESSION['myId'])) header('location: home.php'); ?>
<?php include_once('./components/header.php') ?>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="./home.php">BStock Application</a>
    </div>
</nav>
<div class="container my-5">
    <h2>สมัครสมาชิก</h2>
    <hr><br>
    <form action="authentication_actions.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="100" required>
        </div>
        <div class="row g-2 mb-3">
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
        <div class="mb-3">
            <button name="register" type="submit" class="btn btn-success">สมัครสมาชิก</button>
            <a href="./index.php" class="btn btn-light">ล็อกอิน</a>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>