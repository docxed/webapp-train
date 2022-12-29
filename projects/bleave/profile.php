<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$myId = $_SESSION['myId'];
$user_stmt = $conn->query("SELECT * FROM users WHERE user_id = $myId");
$user_stmt->execute();
$user = $user_stmt->fetch();;
?>
<div class="container my-5">
    <p class="h2">โปรไฟล์</p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">โปรไฟล์</div>
                    <p class="text-center">
                        <img src="./uploads/<?= $user['user_avatar']; ?>" class="rounded-circle w-50">
                    </p>
                    <p class="h4 text-center">
                        <?= $user['user_firstname'] . ' ' . $user['user_lastname']; ?>
                    </p>
                    <p class="h6 text-center text-secondary">
                        <?= $user['user_email']; ?>
                    </p>
                    <p>แผนก <?= $user['user_department']; ?></p>
                    <p>
                        เพศ <?= $user['user_sex']; ?>
                    </p>
                    <p>
                        อายุ <?php
                                $date1 = date_create($user['user_born']);
                                $date2 = date_create();
                                $dateDifference = date_diff($date1, $date2)->format('%y ปี');
                                echo $dateDifference;
                                ?>
                    </p>
                    <p>
                        โทรศัพท์ <?= $user['user_phone']; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="card-title h5">แก้ไขข้อมูล</div>
                    <form action="authentication_actions.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input name="email" type="email" class="form-control" placeholder="อีเมล" maxlength="100" required readonly value="<?= $user['user_email']; ?>">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <label for="firstname" class="form-label">ชื่อ</label>
                                <input name="firstname" type="text" class="form-control" placeholder="ชื่อ" maxlength="100" required value="<?= $user['user_firstname']; ?>">
                            </div>
                            <div class="col">
                                <label for="lastname" class="form-label">นามสกุล</label>
                                <input name="lastname" type="text" class="form-control" placeholder="นามสกุล" maxlength="100" required value="<?= $user['user_lastname']; ?>">
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <label for="sex" class="form-label">เพศ</label>
                                <select name="sex" class="form-select" required>
                                    <option value="ชาย" <?php if ($user['user_sex'] == 'ชาย') { echo 'selected'; } ?>>ชาย</option>
                                    <option value="หญิง" <?php if ($user['user_sex'] == 'หญิง') { echo 'selected'; } ?>>หญิง</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="born" class="form-label">วันเกิด</label>
                                <input name="born" type="date" class="form-control" required value="<?= $user['user_born']; ?>">
                            </div>
                            <div class="col">
                                <label for="department" class="form-label">แผนก</label>
                                <input name="department" type="text" class="form-control" placeholder="แผนก" maxlength="50" required value="<?= $user['user_department']; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">โทรศัพท์</label>
                            <input name="phone" type="text" class="form-control" placeholder="โทรศัพท์" maxlength="10" required value="<?= $user['user_phone']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่านใหม่</label>
                            <input name="password" type="password" class="form-control" placeholder="รหัสผ่าน" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">รูปถ่าย (Optional)</label>
                            <input name="avatar" id="imageInput" type="file" class="form-control" accept=".jpg, .jpeg, .png">
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
                            <input name="avatar2" type="hidden" value="<?= $user['user_avatar']; ?>">
                            <input name="userId" type="hidden" value="<?= $myId; ?>">
                            <button name="update_profile" type="submit" class="btn btn-info">อัปเดต</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include_once('./components/footer.php') ?>