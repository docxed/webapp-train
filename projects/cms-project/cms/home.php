<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$posts_stmt = $conn->query("SELECT * FROM posts ORDER BY post_timestamp DESC");
$posts_stmt->execute();
$posts = $posts_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nPosts = $conn->query('SELECT COUNT(*) FROM posts')->fetchColumn(); ?>
    <p class="h2">รายการโพสต์ทั้งหมด <span class="badge rounded-pill text-bg-primary"><?= $nPosts; ?></span></p>
    <hr><br>
    <div class="row">
        <p class="text-end">
            <a href="./createpost.php" class="btn btn-success">สร้างโพสต์ใหม่</a>
        </p>
        <?php
        foreach ($posts as $post) {
        ?>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 ">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['post_title']; ?></h5>
                        <h6> หมวดหมู่ <a href="./categories.php?category=<?= $post['post_category']; ?>" class="badge rounded-pill text-bg-primary"><?= $post['post_category']; ?></a></h6>
                        <p class="card-text"><?= $post['post_content']; ?></p>
                        <?php
                        if ($post['post_image']) {
                        ?>
                            <p>
                                <img src="uploads/<?= $post['post_image']; ?>" alt="" style="width: 100%; height: 230px; object-fit: cover;">
                            </p>
                        <?php
                        }
                        ?>
                        <p class="text-end">
                            <a href="./viewpost.php?postId=<?= $post['post_id'];  ?>" class="btn btn-outline-primary">รายละเอียด</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include_once('./components/footer.php') ?>