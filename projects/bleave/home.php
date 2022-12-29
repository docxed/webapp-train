<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$myId = $_SESSION['myId'];
$leaves_stmt = $conn->query("SELECT * FROM leaves WHERE user_id = $myId");
$leaves_stmt->execute();
$leaves = $leaves_stmt->fetchAll();
?>
<div class="container my-5">
    <p class="h2">แดชบอร์ด</p>
    <hr><br>
    <div class="row g-2">
        <div class="col">
            <div class="text-light bg-success w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    อนุมัติการลา
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='อนุมัติ' AND user_id=$myId")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    ครั้ง
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-light text-center bg-danger w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    ปฏิเสธการลา
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='ปฏิเสธ' AND user_id=$myId")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    ครั้ง
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-light text-center bg-primary w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    จำนวนครั้งที่ขอลา
                </div>
                <h2 class="text-center">
                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE user_id=$myId")->fetchColumn(); ?>
                </h2>
                <div class="text-end">
                    ครั้ง
                </div>
            </div>
        </div>
        <div class="col">
            <div class="text-light text-center bg-warning w-100 p-3" style="height: 300; border-radius: 8px;">
                <div class="text-end">
                    จำนวนวันที่ลาทั้งสิ้น
                </div>
                <h2 class="text-center">
                    <?php
                    // ดึงข้อมูลวันที่ลาของพนักงานที่เข้าสู่ระบบ
                    $dateleaves_stmt = $conn->query("SELECT * FROM leaves WHERE leave_status='อนุมัติ' AND user_id = $myId");
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
                    echo $dayleaves_total;
                    ?>
                </h2>
                <div class="text-end">
                    วัน
                </div>
            </div>
        </div>
    </div>
    <?php $nLeaves = $conn->query("SELECT COUNT(*) FROM leaves WHERE user_id = $myId")->fetchColumn(); ?>
    <p class="h2 mt-5">ประวัติการยื่นฟอร์มลางาน <span class="badge rounded-pill text-bg-primary"><?= $nLeaves; ?></span></p>
    <hr><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">วันที่ยื่นฟอร์มลางาน</th>
                <th scope="col">ระยะเวลา</th>
                <th scope="col">รวมทั้งสิ้น</th>
                <th scope="col">สถานะ</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($leaves as $leave) {
            ?>
                <tr>
                    <th scope="row"><?= date_format(date_create($leave['leave_timestamp']), "d-m-Y"); ?></th>
                    <td><?= date_format(date_create($leave['leave_start']), "d-m-Y") . ' - ' . date_format(date_create($leave['leave_end']), "d-m-Y"); ?></td>
                    <td><?php
                        $date1 = date_create($leave['leave_start']);
                        $date2 = date_create($leave['leave_end']);
                        $dateDifference = date_diff($date1, $date2)->format('%a วัน');
                        echo $dateDifference;
                        ?></td>
                    <td>
                        <span class="badge text-bg-<?php
                                                    if ($leave['leave_status'] == 'รอตรวจสอบ') {
                                                        echo 'warning';
                                                    } else if ($leave['leave_status'] == 'อนุมัติ') {
                                                        echo 'success';
                                                    } else {
                                                        echo 'danger';
                                                    }
                                                    ?>"><?= $leave['leave_status']; ?></span>
                    </td>
                    <td>
                        <a href="./viewleave.php?leaveId=<?= $leave['leave_id']; ?>" class="btn btn-info btn-sm">รายละเอียด</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include_once('./components/footer.php') ?>