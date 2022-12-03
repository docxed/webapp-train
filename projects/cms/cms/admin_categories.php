<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$categories_stmt = $conn->query("SELECT DISTINCT post_category FROM posts");
$categories_stmt->execute();
$categories = $categories_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nCategories = $conn->query('SELECT COUNT(DISTINCT post_category) FROM posts')->fetchColumn(); ?>
    <p class="h2">จัดการหมวดหมู่ทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nCategories; ?></span></p>
    <hr><br>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th scope="col">หมวดหมู่</th>
                <th scope="col">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categories as $category) {
            ?>
                <tr>
                    <td><?= $category['post_category']; ?></td>
                    <td><a href="./post_actions.php?admin_delete_category=admin_delete_category&category=<?= $category['post_category']; ?>" class="btn btn-sm btn-danger">ลบ</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include_once('./components/footer.php') ?>