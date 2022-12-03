<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$users_stmt = $conn->query("SELECT * FROM users");
$users_stmt->execute();
$users = $users_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nUsers = $conn->query('SELECT COUNT(*) FROM users')->fetchColumn(); ?>
    <p class="h2">จัดการผู้ใช้ทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nUsers; ?></span></p>
    <hr><br>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">อีเมล</th>
                <th scope="col">ชื่อ - นามสกุล</th>
                <th scope="col">บทบาท</th>
                <th scope="col">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <th scope="row"><?= $user['user_id']; ?></th>
                    <td><?= $user['user_email']; ?></td>
                    <td><?= $user['user_firstname'] . ' ' . $user['user_lastname']; ?></td>
                    <td><?= $user['user_role']; ?></td>
                    <td>
                        <?php
                        if ($user['user_role'] != 'admin') {
                        ?>
                            <a href="./user_actions.php?admin_delete=admin_delete&userId=<?= $user['user_id']; ?>" class="btn btn-sm btn-danger">ลบ</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include_once('./components/footer.php') ?>