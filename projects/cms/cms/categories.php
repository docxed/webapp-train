<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$category = $_GET['category'];
$posts_stmt = $conn->query("SELECT * FROM posts WHERE post_category = '$category'");
$posts_stmt->execute();
$posts = $posts_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nCategories = $conn->query("SELECT COUNT(*) FROM posts WHERE post_category = '$category'")->fetchColumn(); ?>
    <p class="h2">
        <button type="button" class="btn btn-primary">
            <?= $category; ?> <span class="badge text-bg-danger"><?= $nCategories; ?></span>
        </button>
    </p>
    <hr><br>
    <div class="row">
        <?php
        foreach ($posts as $post) {
        ?>
            <div class="col-sm-12 col-md-6 col-lg-4 mb-4 ">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post['post_title']; ?></h5>
                        <h6> หมวดหมู่ <a href="./categories.php?category=<?= $post['post_category']; ?>" class="badge rounded-pill text-bg-primary"><?= $post['post_category']; ?></a></h6>
                        <p class="card-text"><?= $post['post_content']; ?></p>
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