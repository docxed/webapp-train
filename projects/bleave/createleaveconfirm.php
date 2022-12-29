<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$userId = $_SESSION['myId'];
$check_notvalid_form = false;

// ดึงข้อมูลวันที่ลาของพนักงานที่เข้าสู่ระบบ
$dateleaves_stmt = $conn->query("SELECT * FROM leaves WHERE leave_status='อนุมัติ' AND user_id = $userId");
$dateleaves_stmt->execute();
$dateleaves = $dateleaves_stmt->fetchAll();

$dayleaves_total = 0; // จำนวนวันลาทั้งหมด
// วนลูปเพื่อนับจำนวนวันลาทั้งหมด
foreach ($dateleaves as $dateleave) {
    $date1 = date_create($dateleave['leave_start']);
    $date2 = date_create($dateleave['leave_end']);
    $dateDifference = date_diff($date1, $date2)->format('%a');
    $dayleaves_total += $dateDifference;
}

// ข้อมูลวันลาที่พนักงานต้องการลา
$date1 = date_create($_POST['start']);
$date2 = date_create($_POST['end']);
$day_need_to_leave = date_diff($date1, $date2)->format('%a'); // จำนวนวันที่ต้องการลา
?>
<div class="container my-5">
    <h2>คอนเฟิร์มส่งฟอร์มขอลางาน</h2>
    <hr><br>
    <form action="leave_actions.php" method="POST">
        <?php
        if ($day_need_to_leave < 1 || date_create($_POST['start']) >= date_create($_POST['end'])) {
            $check_notvalid_form = true;
        ?>
            <div class="mb-3">
                <div class="alert alert-warning" role="alert">
                    กรุณาเลือกวันที่ต้องการลาให้ถูกต้อง
                </div>
            </div>
        <?php
        } else if ($dayleaves_total + $day_need_to_leave > 30) {
            $check_notvalid_form = true;
        ?>
            <div class="mb-3">
                <div class="alert alert-danger" role="alert">
                    ท่านลาเกิน 30 วัน ท่านจะไม่ได้รับค่าแรงถ้าหากท่านลา
                </div>
            </div>
        <?php
        }
        ?>
        <div class="mb-3">
            <label for="description" class="form-label">รายละเอียดการลางาน</label>
            <textarea name="description" class="form-control" placeholder="รายละเอียดการลางาน" rows="3" required readonly><?= $_POST['description']; ?></textarea>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label for="start" class="form-label">ตั้งแต่</label>
                <input name="start" type="date" class="form-control" placeholder="ระยะเวลาตั้งแต่" required readonly value="<?= $_POST['start']; ?>">
            </div>
            <div class="col">
                <label for="end" class="form-label">จนถึง</label>
                <input name="end" type="date" class="form-control" placeholder="จนถึง" required readonly value="<?= $_POST['end']; ?>">
            </div>
        </div>
        <div class="mb-3">
            ระยะเวลารวมทั้งสิ้น <span class="text-primary"><?= $day_need_to_leave; ?></span> วัน
        </div>
        <div class="mb-3">
            <input name="status" type="hidden" value="รอตรวจสอบ">
            <input name="userId" type="hidden" value="<?= $_SESSION['myId']; ?>">
            <button name="create" type="submit" class="btn btn-primary" <?php if ($check_notvalid_form) {
                                                                            echo 'disabled';
                                                                        } ?>>ส่งแบบฟอร์ม</button>
            <a href="./createleave.php" class="btn btn-light">ยกเลิก</a>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>