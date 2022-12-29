<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<div class="container my-5">
    <p class="h2">แดชบอร์ด</p>
    <hr><br>
    <div class="row g-2 mb-5">
        <div class="col">
            <div class="text-light bg-warning w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    คำขอลารออนุมัติ
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='รอตรวจสอบ'")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    อนุมัติ
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-light text-center bg-success w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    คำขอลาอนุมัติ
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='อนุมัติ'")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    อนุมัติ
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-light text-center bg-danger w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    คำขอลาปฏิเสธ
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='ปฏิเสธ'")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    ปฏิเสธ
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-light text-center bg-info w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    พนักงานทั้งหมด
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM users WHERE user_jobtitle='employee'")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    พนักงาน
                </div>
            </div>
        </div>
    </div>
    <p class="text-center">
        <a href="./admin-leaves.php" class="btn btn-primary">จัดรายการฟอร์มลางานทั้งหมด</a>
    </p>
</div>
<?php include_once('./components/footer.php') ?>