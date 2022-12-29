<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
// Ref userId
$userId = $_GET['userId'];
// user
$user_stmt = $conn->query("SELECT * FROM users WHERE user_id = $userId");
$user_stmt->execute();
$user = $user_stmt->fetch();
// leaves
$leaves_stmt = $conn->query("SELECT * FROM leaves WHERE user_id = $userId");
$leaves_stmt->execute();
$leaves = $leaves_stmt->fetchAll();
?>
<div class="container my-5">
    <p class="h2">ข้อมูลสถิติลางานตามพนักงาน</span></p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">พนักงาน</div>
                    <p class="text-center">
                        <img src="./uploads/<?= $user['user_avatar']; ?>" class="rounded-circle w-50">
                    </p>
                    <p class="h4 text-center">
                        <?= $user['user_firstname'] . ' ' . $user['user_lastname']; ?>
                    </p>
                    <p class="h6 text-center text-secondary">
                        <?= $user['user_email']; ?>
                    </p>
                    <p>แผนก <?= $user['user_department']; ?></p>
                    <p>
                        เพศ <?= $user['user_sex']; ?>
                    </p>
                    <p>
                        อายุ <?php
                                $date1 = date_create($user['user_born']);
                                $date2 = date_create();
                                $dateDifference = date_diff($date1, $date2)->format('%y ปี');
                                echo $dateDifference;
                                ?>
                    </p>
                    <p>
                        โทรศัพท์ <?= $user['user_phone']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">สถิติ</div>
                    <div class="row g-2">
                        <div class="col">
                            <div class="text-light bg-success w-100 p-3" style="height: 300; border-radius: 8px;">
                                <div class="text-end">
                                    อนุมัติการลา
                                </div>
                                <h2 class="text-center">
                                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='อนุมัติ' AND user_id=$userId ")->fetchColumn(); ?>
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
                                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE leave_status='ปฏิเสธ' AND user_id=$userId ")->fetchColumn(); ?>
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
                                    <?= $conn->query("SELECT COUNT(*) FROM leaves WHERE user_id=$userId ")->fetchColumn(); ?>
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
                                    $dateleaves_stmt = $conn->query("SELECT * FROM leaves WHERE leave_status='อนุมัติ' AND user_id = $userId");
                                    $dateleaves_stmt->execute();
                                    $dateleaves = $dateleaves_stmt->fetchAll();
                                    $dayleaves_total = 0;
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
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">ประวัติการขอลางาน</div>
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
                                        <a href="./admin-manageleave.php?leaveId=<?= $leave['leave_id']; ?>" class="btn btn-primary btn-sm">จัดการ</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('./components/footer.php') ?>