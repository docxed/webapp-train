<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php include_once('./components/admin-nav-bar.php') ?>
<?php
$comments_stmt = $conn->query("SELECT * FROM comments");
$comments_stmt->execute();
$comments = $comments_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nComments = $conn->query('SELECT COUNT(*) FROM comments')->fetchColumn(); ?>
    <p class="h2">จัดการความคิดเห็นทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nComments; ?></span></p>
    <hr><br>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ความคิดเห็น</th>
                <th scope="col">post_id</th>
                <th scope="col">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($comments as $comment) {
            ?>
                <tr>
                    <th scope="row"><?= $comment['comment_id']; ?></th>
                    <td><?= $comment['comment_content']; ?></td>
                    <td><?= $comment['post_id']; ?></td>
                    <td>
                        <a href="./viewpost.php?postId=<?= $comment['post_id']; ?>" class="btn btn-sm btn-primary">ไปยังโพสต์</a>
                        <a href="./comment_actions.php?admin_delete=admin_delete&commentId=<?= $comment['comment_id']; ?>" class="btn btn-sm btn-danger">ลบ</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php include_once('./components/footer.php') ?>