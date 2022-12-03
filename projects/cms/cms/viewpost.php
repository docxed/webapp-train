<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$postId = $_GET['postId'];

$post_stmt = $conn->query("SELECT * FROM posts INNER JOIN users ON users.user_id=posts.user_id WHERE post_id = $postId");
$post_stmt->execute();
$post = $post_stmt->fetch();

$comments_stmt = $conn->query("SELECT * FROM comments INNER JOIN users ON users.user_id=comments.user_id WHERE post_id = $postId ORDER BY comment_timestamp DESC");
$comments_stmt->execute();
$comments = $comments_stmt->fetchAll();
?>
<div class="container my-5">
    <p class="h2">ข้อมูลโพสต์หมายเลข <span class="text-primary"><?= $post['post_id']; ?></span></p>
    <hr><br>
    <div class="col-sm-12 col-md-8 col-lg-8 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title mb-3">หัวข้อ <?= $post['post_title']; ?></h4>
                <h6 class="mb-3">
                    หมวดหมู่ <a href="./categories.php?category=<?= $post['post_category']; ?>" class="badge rounded-pill text-bg-primary"><?= $post['post_category']; ?></a>
                </h6>
                <h6 class="mb-3">
                    ผู้โพสต์ <span class="badge rounded-pill text-bg-success"><?= $post['user_firstname'] . ' ' . $post['user_lastname']; ?></span>
                </h6>
                <h6 class="mb-3">
                    วันที่ <?= date("Y-m-d เวลา H:i น.", strtotime($post['post_timestamp'])); ?>
                </h6>
                <hr>
                <p>
                    <?= $post['post_content']; ?>
                </p>
                <?php
                if ($post['user_id'] == $_SESSION['myId']) {
                ?>
                    <div class="text-end">
                        <a href="./editpost.php?postId=<?= $post['post_id']; ?>" class="btn btn-sm btn-warning">แก้ไข</a>
                        <a href="./post_actions.php?delete=delete&postId=<?= $post['post_id']; ?>" class="btn btn-sm btn-outline-danger">ลบ</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <!-- Comment Create -->
        <form action="comment_actions.php" method="POST" class="mb-3">
            <div class="row g-2">
                <div class="col-10">
                    <input name="content" type="text" class="form-control" placeholder="แสดงความคิดเห็น" maxlength="255" required />
                </div>
                <div class="col-2 d-grid gap-2">
                    <input name="postId" type="hidden" value="<?= $post['post_id']; ?>">
                    <input name="userId" type="hidden" value="<?= $_SESSION['myId']; ?>">
                    <button name="create" type="submit" class="btn btn-primary">ส่ง</button>
                </div>
            </div>
        </form>

        <!-- Comment List -->
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
                    <?php
                    if ($comment['user_id'] == $_SESSION['myId']) {
                    ?>
                        <div class="text-end">
                            <a href="./comment_actions.php?delete=delete&postId=<?= $post['post_id']; ?>&commentId=<?= $comment['comment_id']; ?>" class="btn btn-sm btn-outline-danger">ลบ</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include_once('./components/footer.php') ?>