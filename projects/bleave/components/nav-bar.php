<div>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand" href="./home.php">BLeave Application</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="./home.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./createleave.php">สร้างฟอร์มขอลางาน</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./uploads/<?= $_SESSION['myAvatar']; ?>" width="24" height="24" class="rounded-circle"> <?= $_SESSION['myFirstname'] . ' ' . $_SESSION['myLastname']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./profile.php">โปรไฟล์</a></li>
                        <li><a class="dropdown-item" href="./logout.php"><span class="text-danger">ออกจากระบบ</span></a></li>
                        <?php
                        if ($_SESSION['myJobTitle'] == 'manager') {
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