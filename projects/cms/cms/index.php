<?php session_start() ?>
<?php if (isset($_SESSION['myId'])) header('location: home.php'); ?>
<?php include_once('./components/header.php') ?>
<nav class="navbar navbar-expand-lg bg-light navbar-light">
    <div class="container">
        <a class="navbar-brand" href="./home.php">CMS Application</a>
    </div>
</nav>
<div class="container my-5">
    <p class="h2">ลงชื่อเข้าใช้งาน</p>
    <hr><br>
    <form action="authentication_actions.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="100" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
        </div>
        <div class="mb-3">
            <button name="login" type="submit" class="btn btn-primary">ลงชื่อเข้าใช้งานเดี๋ยวนี้</button>
            <a href="./register.php" class="btn btn-light">
                ลงทะเบียนเข้าใช้งาน
            </a>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>