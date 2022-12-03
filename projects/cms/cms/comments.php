<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$comments_stmt = $conn->query("SELECT * FROM comments INNER JOIN users ON users.user_id=comments.user_id ORDER BY comment_timestamp DESC");
$comments_stmt->execute();
$comments = $comments_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nComments = $conn->query('SELECT COUNT(*) FROM comments')->fetchColumn(); ?>
    <p class="h2">รายการความคิดเห็นทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nComments; ?></span></p>
    <hr><br>
    <div class="row">
        <?php
        foreach ($comments as $comment) {
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p><?= $comment['comment_content']; ?></p>
                    <div class="text-end text-muted caption">
                        <?= $comment['user_firstname'] . ' ' . $comment['user_lastname']; ?>
                    </div>
                    <div class="text-end text-muted mb-3">
                        <?= date("Y-m-d H:i:s", strtotime($comment['comment_timestamp'])); ?>
                    </div>
                    <div class="text-end">
                        <a href="./viewpost.php?postId=<?= $comment['post_id']; ?>" class="btn btn-primary">ไปยังโพสต์</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include_once('./components/footer.php') ?>