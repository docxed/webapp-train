<?php session_start() ?>
<?php if (isset($_SESSION['myId'])) header('location: home.php'); ?>
<?php include_once('./components/header.php') ?>
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="./home.php">BLeave Application</a>
    </div>
</nav>
<div class="container my-5">
    <h2>สมัครสมาชิก</h2>
    <hr><br>
    <form action="authentication_actions.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="100" required>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label for="firstname" class="form-label">ชื่อ</label>
                <input name="firstname" type="text" class="form-control" placeholder="ชื่อ" maxlength="100" required>
            </div>
            <div class="col">
                <label for="lastname" class="form-label">นามสกุล</label>
                <input name="lastname" type="text" class="form-control" placeholder="นามสกุล" maxlength="100" required>
            </div>
        </div>
        <div class="row g-2 mb-3">
            <div class="col">
                <label for="sex" class="form-label">เพศ</label>
                <select name="sex" class="form-select" required>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                </select>
            </div>
            <div class="col">
                <label for="born" class="form-label">วันเกิด</label>
                <input name="born" type="date" class="form-control" required>
            </div>
            <div class="col">
                <label for="department" class="form-label">แผนก</label>
                <input name="department" type="text" class="form-control" placeholder="แผนก" maxlength="50" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">โทรศัพท์</label>
            <input name="phone" type="text" class="form-control" placeholder="โทรศัพท์" maxlength="10" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label">รูปถ่าย</label>
            <input name="avatar" id="imageInput" type="file" class="form-control" accept=".jpg, .jpeg, .png" required>
            <img id="previewImage" class="mt-3 w-40" alt="">
            <script>
                let imageInput = document.getElementById("imageInput")
                let previewImage = document.getElementById("previewImage")

                imageInput.onchange = evt => {
                    const [file] = imageInput.files
                    if (file) {
                        previewImage.src = URL.createObjectURL(file)
                    }
                }
            </script>
        </div>
        <div class="mb-3">
            <button name="register" type="submit" class="btn btn-success">สมัครสมาชิก</button>
            <a href="./index.php" class="btn btn-light">ล็อกอิน</a>
        </div>
    </form>
</div>
<?php include_once('./components/footer.php') ?>