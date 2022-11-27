<?php session_start(); ?>
<?php include_once("./middlewares/is_loggedin.php"); ?>
<?php require_once 'config/db.php'; ?>
<?php
$id = $_GET['id'];
$post_stmt = $conn->query("SELECT * FROM posts WHERE id = $id");
$post_stmt->execute();
$post = $post_stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouBlog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="./home.php">You Blog</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./home.php">หน้าแรก</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['email']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./logout.php">ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-5">
        <h1>แก้ไขโพสต์ ID : <?php echo $post['id']; ?></h1>
        <hr><br>

        <form action="post_action.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">หัวข้อ</label>
                <input name="title" type="text" class="form-control" placeholder="หัวข้อ" maxlength="100" required value="<?php echo $post['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">เนื้อหา</label>
                <textarea name="content" class="form-control" rows="3" placeholder="เนื้อหา" required><?php echo $post['content']; ?></textarea>
            </div>
            <input name="pid" type="hidden" value="<?php echo $post['id']; ?>">
            <div>
                <button name="update" class="btn btn-info">อัปเดต</button>
                <a href="./post_action.php?delete=<?php echo $post['id']; ?>" class="btn btn-outline-danger" role="button">ลบ</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>