<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$leaves_stmt = $conn->query("SELECT * FROM leaves INNER JOIN users ON leaves.user_id=users.user_id WHERE user_jobtitle = 'employee' ORDER BY leave_timestamp DESC " );
$leaves_stmt->execute();
$leaves = $leaves_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nLeaves = $conn->query('SELECT COUNT(*) FROM leaves')->fetchColumn(); ?>
    <p class="h2">จัดรายการฟอร์มลางานทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nLeaves; ?></span></p>
    <hr><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">วันที่ยื่นฟอร์มลางาน</th>
                <th scope="col">ชื่อ - นามสกุล</th>
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
                    <td><?= $leave['user_firstname'].' '.$leave['user_lastname']; ?></td>
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
<?php include_once('./components/footer.php') ?>