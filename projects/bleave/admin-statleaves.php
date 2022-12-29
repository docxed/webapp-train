<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$users_stmt = $conn->query("SELECT * FROM users WHERE user_jobtitle='employee'");
$users_stmt->execute();
$users = $users_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nUsers = $conn->query("SELECT COUNT(*) FROM users WHERE user_jobtitle='employee'")->fetchColumn(); ?>
    <p class="h2">จัดการรายการฟอร์มลางานตามพนักงาน <span class="badge rounded-pill text-bg-primary"><?= $nUsers; ?></span></p>
    <hr><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">อีเมล</th>
                <th scope="col">ชื่อ</th>
                <th scope="col">ตำแหน่ง</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <th scope="row"><?= $user['user_email']; ?></th>
                    <td><?= $user['user_firstname'] . ' ' . $user['user_lastname']; ?></td>
                    <td><?= $user['user_department']; ?></td>
                    <td>
                        <a href="./admin-viewstatleave.php?userId=<?= $user['user_id']; ?>" class="btn btn-primary btn-sm">รายละเอียด</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include_once('./components/footer.php') ?>