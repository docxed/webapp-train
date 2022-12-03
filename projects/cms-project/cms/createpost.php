<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$categories_stmt = $conn->query("SELECT DISTINCT post_category FROM posts");
$categories_stmt->execute();
$categories = $categories_stmt->fetchAll();
?>
<div class="container my-5">
    <p class="h2">สร้างโพสต์ใหม่</p>
    <hr><br>
    <form action="post_actions.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">หัวข้อ</label>
            <input name="title" type="text" class="form-control" placeholder="หัวข้อ" maxlength="255" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">เนื้อหา</label>
            <textarea name="content" class="form-control" placeholder="เนื้อหา" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">หมวดหมู่</label>
            <input name="category" list="categories_list" class="form-control" placeholder="หมวดหมู่" maxlength="50" required>
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
            <input name="userId" type="hidden" value="<?= $_SESSION['myId']; ?>">
            <button name="create" type="submit" class="btn btn-success">สร้างโพสต์เดี๋ยวนี้</button>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>