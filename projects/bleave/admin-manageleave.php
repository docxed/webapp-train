<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$leaveId = $_GET['leaveId'];
$leave_stmt = $conn->query("SELECT * FROM leaves INNER JOIN users ON leaves.user_id=users.user_id WHERE leave_id = $leaveId");
$leave_stmt->execute();
$leave = $leave_stmt->fetch();
?>
<div class="container my-5">
    <p class="h2">จัดการฟอร์มลางานหมายเลข <span class="text-primary"><?= $leave['leave_id']; ?></span></p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">พนักงาน</div>
                    <p class="text-center">
                        <img src="./uploads/<?= $leave['user_avatar']; ?>" class="rounded-circle w-50">
                    </p>
                    <p class="h4 text-center">
                        <?= $leave['user_firstname'] . ' ' . $leave['user_lastname']; ?>
                    </p>
                    <p class="h6 text-center text-secondary">
                        <?= $leave['user_email']; ?>
                    </p>
                    <p>แผนก <?= $leave['user_department']; ?></p>
                    <p>
                        เพศ <?= $leave['user_sex']; ?>
                    </p>
                    <p>
                        อายุ <?php
                                $date1 = date_create($leave['user_born']);
                                $date2 = date_create();
                                $dateDifference = date_diff($date1, $date2)->format('%y ปี');
                                echo $dateDifference;
                                ?>
                    </p>
                    <p>
                        โทรศัพท์ <?= $leave['user_phone']; ?>
                    </p>
                    <p class="text-end">
                        <a href="./admin-viewstatleave.php?userId=<?= $leave['user_id']; ?>" class="btn btn-primary btn-sm">รายละเอียดพนักงาน</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">ข้อมูลฟอร์มลางาน</div>
                    <h6 class="mb-3">ระยะเวลาตั้งแต่ <span class="text-primary"><?= date_format(date_create($leave['leave_start']), "d-m-Y"); ?></span> จนถึง <span class="text-primary"><?= date_format(date_create($leave['leave_end']), "d-m-Y"); ?></span> </h6>
                    <h6>
                        ระยะเวลารวมทั้งสิ้น <span class="text-primary"><?php
                                                                        $date1 = date_create($leave['leave_start']);
                                                                        $date2 = date_create($leave['leave_end']);
                                                                        $dateDifference = date_diff($date1, $date2)->format('%a');
                                                                        echo $dateDifference;
                                                                        ?></span> วัน
                    </h6>
                    <h6 class="mt-3">รายละเอียดการลา</h6>
                    <p class="mx-3">
                        <?= $leave['leave_description']; ?>
                    </p>
                </div>
            </div>
            <p class="h5">ตรวจสอบ</p>
            <form action="./leave_actions.php" method="POST">
                <div class="mb-3">
                    <label for="status" class="form-label">อนุมัติ</label>
                    <select name="status" class="form-select" required>
                        <option value="รอตรวจสอบ" <?php if ($leave['leave_status'] == 'รอตรวจสอบ') {
                                                        echo 'selected';
                                                    } ?>>รอตรวจสอบ</option>
                        <option value="อนุมัติ" <?php if ($leave['leave_status'] == 'อนุมัติ') {
                                                    echo 'selected';
                                                } ?>>อนุมัติ</option>
                        <option value="ปฏิเสธ" <?php if ($leave['leave_status'] == 'ปฏิเสธ') {
                                                    echo 'selected';
                                                } ?>>ปฏิเสธ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="remark" class="form-label">หมายเหตุ</label>
                    <textarea name="remark" class="form-control" placeholder="หมายเหตุ" rows="2"><?= $leave['leave_remark']; ?></textarea>
                </div>
                <div class="mb-3">
                    <input name="leaveId" type="hidden" value="<?= $leave['leave_id']; ?>">
                    <button name="admin_status" class="btn btn-info">อัปเดต</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once('./components/footer.php') ?>