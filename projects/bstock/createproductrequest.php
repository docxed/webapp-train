<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$productId = $_GET['q'];
$product_stmt = $conn->query("SELECT * FROM products WHERE product_id = $productId");
$product_stmt->execute();
$product = $product_stmt->fetch();
?>
<div class="container my-5">
    <p class="h2">ปรับยอดคงคลัง</p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-7 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลสินค้า</h5>
                    <div>รหัสสินค้า : <?= $product['product_code']; ?></div>
                    <div>ชื่อสินค้า : <strong><?= $product['product_name']; ?></strong></div>
                    <div>รายละเอียด : <?= $product['product_detail']; ?></div>
                    <div>หน่วยสินค้า : <?= $product['product_unit']; ?></div>
                    <div>หมวดสินค้า : <?= $product['product_category']; ?></div>
                    <div>ราคาขาย : <?= number_format($product['product_price'], 2); ?> บาท</div>
                    <div>จำนวนคงคลัง : <strong class="text-primary"><?= $product['product_quantity']; ?></strong></div>
                    <div>ความจุ : <strong class="text-success"><?= $product['product_capacity']; ?></strong></div>
                    <div class="text-center">
                        <img src="./uploads/<?= $product['product_img']; ?>" alt="" class="rounded w-50">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ฟอร์มคำขอ</h5>
                    <form action="./request_actions.php" method="POST">
                        <div class="mb-3">
                            <label for="type" class="form-label">ประเภท</label>
                            <select name="type" class="form-select" required>
                                <option value="สินค้าเข้า" selected>สินค้าเข้า</option>
                                <option value="สินค้าออก">สินค้าออก</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">จำนวนยอดที่ปรับ</label>
                            <input name="quantity" type="number" class="form-control" placeholder="จำนวนยอดที่ปรับ" min="1" required>
                        </div>
                        <div class="mb-3">
                            <input name="productId" type="hidden" value="<?= $product['product_id']; ?>">
                            <input name="userId" type="hidden" value="<?= $_SESSION['myId']; ?>">
                            <input name="create" type="submit" class="btn btn-success" value="สร้างคำขอ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include_once('./components/footer.php') ?>