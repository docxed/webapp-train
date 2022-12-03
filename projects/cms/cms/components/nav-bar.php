<?php
$categories_stmt = $conn->query("SELECT DISTINCT post_category FROM posts");
$categories_stmt->execute();
$categories = $categories_stmt->fetchAll();
?>
<div>
    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container">
            <a class="navbar-brand" href="./home.php">CMS Application</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./home.php">หน้าแรก</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        หมวดหมู่
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        foreach ($categories as $category) {
                        ?>
                            <li><a class="dropdown-item" href="./categories.php?category=<?= $category['post_category'] ?>"><?= $category['post_category'] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./comments.php">ความคิดเห็น</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['myEmail']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./myposts.php">จัดการโพสต์ของฉัน</a></li>
                        <li><a class="dropdown-item" href="./profile.php">จัดการบัญชีผู้ใช้</a></li>
                        <li><a class="dropdown-item" href="./logout.php"><span class="text-danger">ออกจากระบบ</span></a></li>
                        <?php
                        if ($_SESSION['myRole'] == 'admin') {
                        ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./admin.php"><span class="text-primary">Admin Panel</span></a></li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>