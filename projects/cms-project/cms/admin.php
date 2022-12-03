<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$posts_stmt = $conn->query("SELECT * FROM posts");
$posts_stmt->execute();
$posts = $posts_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nPosts = $conn->query('SELECT COUNT(*) FROM posts')->fetchColumn(); ?>
    <p class="h2">จัดการโพสต์ทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nPosts; ?></span></p>
    <hr><br>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">หมวดหมู่</th>
                <th scope="col">หัวข้อ</th>
                <th scope="col">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($posts as $post) {
            ?>
                <tr>
                    <th scope="row"><?= $post['post_id']; ?></th>
                    <td><?= $post['post_category']; ?></td>
                    <td><?= $post['post_title']; ?></td>
                    <td><a href="./post_actions.php?admin_delete=admin_delete&postId=<?= $post['post_id']; ?>" class="btn btn-sm btn-danger">ลบ</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include_once('./components/footer.php') ?>