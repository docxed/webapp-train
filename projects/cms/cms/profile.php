<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$myId = $_SESSION['myId'];
$info_stmt = $conn->query("SELECT * FROM users WHERE user_id = $myId");
$info_stmt->execute();
$info = $info_stmt->fetch();
?>
<div class="container my-5">
    <p class="h2">จัดการบัญชีผู้ใช้</p>
    <hr><br>
    <form action="./authentication_actions.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="100" required value="<?= $info['user_email']; ?>" readonly>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label for="firstname" class="form-label">ชื่อ</label>
                <input name="firstname" type="text" class="form-control" placeholder="ชื่อ" maxlength="100" required value="<?= $info['user_firstname']; ?>">
            </div>
            <div class="col">
                <label for="lastname" class="form-label">นามสกุล</label>
                <input name="lastname" type="text" class="form-control" placeholder="นามสกุล" maxlength="100" required value="<?= $info['user_lastname']; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่านใหม่</label>
            <input name="password" type="password" class="form-control" placeholder="รหัสผ่านใหม่" maxlength="20" required>
        </div>
        <div class="mb-3">
            <input name="myId" type="hidden" value="<?= $info['user_id']; ?>">
            <button name="update_profile" type="submit" class="btn btn-info">อัปเดต</button>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>