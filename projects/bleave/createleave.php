<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<div class="container my-5">
    <h2>ฟอร์มขอลางาน</h2>
    <hr><br>
    <form action="./createleaveconfirm.php" method="POST">
        <div class="mb-3">
            <label for="description" class="form-label">รายละเอียดการลางาน</label>
            <textarea name="description" class="form-control" placeholder="รายละเอียดการลางาน" rows="3" required></textarea>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label for="start" class="form-label">ตั้งแต่</label>
                <input name="start" type="date" class="form-control" placeholder="ระยะเวลาตั้งแต่" required>
            </div>
            <div class="col">
                <label for="end" class="form-label">จนถึง</label>
                <input name="end" type="date" class="form-control" placeholder="จนถึง" required>
            </div>
        </div>
        <div class="mb-3">
            <input name="status" type="hidden" value="รอตรวจสอบ">
            <input name="userId" type="hidden" value="<?= $_SESSION['myId']; ?>">
            <button type="submit" class="btn btn-light">ยืนยัน</button>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>