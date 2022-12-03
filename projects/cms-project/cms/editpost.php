<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$postId = $_GET['postId'];

$post_stmt = $conn->query("SELECT * FROM posts WHERE post_id = $postId");
$post_stmt->execute();
$post = $post_stmt->fetch();

$categories_stmt = $conn->query("SELECT DISTINCT post_category FROM posts");
$categories_stmt->execute();
$categories = $categories_stmt->fetchAll();
?>
<div class="container my-5">
    <p class="h2">แก้ไขโพสต์หมายเลข <span class="text-primary"><?= $post['post_id'] ?></span></p>
    <hr><br>
    <form action="post_actions.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">หัวข้อ</label>
            <input name="title" type="text" class="form-control" placeholder="หัวข้อ" maxlength="255" required value="<?= $post['post_title'] ?>">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">เนื้อหา</label>
            <textarea name="content" class="form-control" placeholder="เนื้อหา" rows="3" required><?= $post['post_content'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">หมวดหมู่</label>
            <input name="category" list="categories_list" class="form-control" placeholder="หมวดหมู่" maxlength="50" required value="<?= $post['post_category'] ?>">
            <datalist id="categories_list">
                <?php
                foreach ($categories as $category) {
                ?>
                    <option value="<?= $category['post_category']; ?>"><?= $category['post_category']; ?></option>
                <?php
                }
                ?>
            </datalist>
        </div>
        <div class="mb-3">
            <input name="postId" type="hidden" value="<?= $post['post_id']; ?>">
            <button name="update" type="submit" class="btn btn-info">อัปเดต</button>
            <a href="./viewpost.php?postId=<?= $post['post_id'] ?>" class="btn btn-secondary">ยกเลิก</a>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>