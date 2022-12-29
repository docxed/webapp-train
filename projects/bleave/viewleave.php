<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$leaveId = $_GET['leaveId'];
$leave_stmt = $conn->query("SELECT * FROM leaves WHERE leave_id = $leaveId");
$leave_stmt->execute();
$leave = $leave_stmt->fetch();
?>
<div class="container my-5">
    <p class="h2">ข้อมูลฟอร์มลางานหมายเลข <span class="text-primary"><?= $leave['leave_id']; ?></span></p>
    <hr><br>
    <div class="col-sm-12 col-md-8 col-lg-8 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="mb-3">ระยะเวลาตั้งแต่ <span class="text-primary"><?= date_format(date_create($leave['leave_start']), "d-m-Y"); ?></span> จนถึง <span class="text-primary"><?= date_format(date_create($leave['leave_end']), "d-m-Y"); ?></span> </h5>
                <h5>
                    ระยะเวลารวมทั้งสิ้น <span class="text-primary"><?php
                                                                    $date1 = date_create($leave['leave_start']);
                                                                    $date2 = date_create($leave['leave_end']);
                                                                    $dateDifference = date_diff($date1, $date2)->format('%a');
                                                                    echo $dateDifference;
                                                                    ?></span> วัน
                </h5>
                <h5 class="mt-3">รายละเอียดการลา</h5>
                <p class="mx-3">
                    <?= $leave['leave_description']; ?>
                </p>
                <?php
                if ($leave['leave_status'] == 'รอตรวจสอบ') {
                ?>
                    <p class="text-end">
                        <a href="./editleave.php?leaveId=<?= $leave['leave_id']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                        <a href="./leave_actions.php?delete=delete&leaveId=<?= $leave['leave_id']; ?>" class="btn btn-outline-danger btn-sm">ลบ</a>
                    </p>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="card-title h5">การอนุมัติ</div>
                <p>
                    <span class="badge text-bg-<?php
                                                if ($leave['leave_status'] == 'รอตรวจสอบ') {
                                                    echo 'warning';
                                                } else if ($leave['leave_status'] == 'อนุมัติ') {
                                                    echo 'success';
                                                } else {
                                                    echo 'danger';
                                                }
                                                ?>"><?= $leave['leave_status']; ?></span>
                </p>
                <?php
                if ($leave['leave_remark']) {
                ?>
                    <p>
                        <strong>หมายเหตุ</strong> <?= $leave['leave_remark']; ?>
                    </p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include_once('./components/footer.php') ?>