<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<div class="container my-5">
    <p class="h2">เพิ่มสต็อกใหม่</p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-7 mx-auto">
            <div class="card">
                <div class="card-body">
                <form action="./product_actions.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="code" class="form-label">รหัสสินค้า</label>
                    <input name="code" type="text" class="form-control" placeholder="รหัสสินค้า" maxlength="10" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อสินค้า</label>
                    <input name="name" type="text" class="form-control" placeholder="ชื่อสินค้า" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="detail" class="form-label">รายละเอียดสินค้า</label>
                    <textarea name="detail" class="form-control" rows="3" placeholder="รายละเอียดสินค้า" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="unit" class="form-label">หน่วยสินค้า</label>
                    <input name="unit" type="text" class="form-control" placeholder="หน่วยสินค้า" maxlength="7" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">หมวดสินค้า</label>
                    <input name="category" type="text" class="form-control" placeholder="หมวดสินค้า" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">ความจุ</label>
                    <input name="capacity" type="number" class="form-control" placeholder="ความจุ" min="1" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">ราคาขาย</label>
                    <input name="price" type="text" class="form-control" placeholder="ราคาขาย" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">รูปสินค้า</label>
                    <input name="img" id="imageInput" type="file" class="form-control" accept=".jpg, .jpeg, .png" required>
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
                    <input name="userId" type="hidden" value="<?= $_SESSION['myId']; ?>">
                    <button name="create" type="submit" class="btn btn-success">เพิ่มสต็อกใหม่</button>
                </div>
            </form>
                </div>
            </div>
        
        </div>
    </div>

</div>
<?php include_once('./components/footer.php') ?>