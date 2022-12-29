<div>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="./home.php">BStock Application</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="./home.php">สต็อกสินค้า</a>
                </li>
                <?php
                if ($_SESSION['myRole'] == 'admin') {
                ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="./requests.php">คำขอ</a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['myRole'] . ' : ' . $_SESSION['myFirstname'] . ' ' . $_SESSION['myLastname']; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./myrequests.php">รายการคำขอของฉัน</a></li>
                        <li><a class="dropdown-item" href="./logout.php"><span class="text-danger">ออกจากระบบ</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>