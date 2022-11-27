<?php session_start(); ?>
<?php include_once("./middlewares/is_loggedin.php"); ?>
<?php require_once 'config/db.php'; ?>
<?php
$post_stmt = $conn->query("SELECT * FROM posts");
$post_stmt->execute();
$posts = $post_stmt->fetchAll()
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
        <h1>หน้าแรก</h1>
        <hr><br>

        <div class="text-end mb-3">
            <a href="./newpost.php">
                <button class="btn btn-success">สร้างโพสต์ใหม่</button>
            </a>
        </div>

        <div class="row">
            <?php
            foreach ($posts as $post) {
            ?>
                <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3"><?php echo $post['title']; ?></h4>

                            <a class="btn btn-primary" href="./viewpost.php?id=<?php echo $post['id']; ?>" role="button">รายละเอียด</a>
                            <a class="btn btn-secondary" href="./editpost.php?id=<?php echo $post['id']; ?>" role="button">แก้ไข</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>