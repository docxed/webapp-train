<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$products_stmt = $conn->query("SELECT * FROM products");
$products_stmt->execute();
$products = $products_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nProducts = $conn->query("SELECT COUNT(*) FROM products")->fetchColumn(); ?>
    <p class="h2">รายการสต็อกสินค้า <span class="badge rounded-pill text-bg-primary"><?= $nProducts; ?></p>
    <hr><br>
    <?php
    if ($_SESSION['myRole'] == 'admin') {
    ?>
        <p class="text-end">
            <a href="./createproduct.php" class="btn btn-success">เพิ่มสต็อกใหม่</a>
        </p>
    <?php
    }
    ?>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">ราคาต่อหน่วย</th>
                        <th scope="col">จำนวนคงคลัง</th>
                        <th scope="col">ความจุ</th>
                        <th scope="col">หมวดสินค้า</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <tr>
                            <td>
                                <div>
                                    <img src="./uploads/<?= $product['product_img']; ?>" width="200" class="rounded">
                                </div>
                            </td>
                            <th scope="row"><?= $product['product_code']; ?></th>
                            <td>
                                <div><?= $product['product_name']; ?></div>
                                <div class="text-secondary"><?= $product['product_detail']; ?></div>
                            </td>
                            <td><?= number_format((float) $product['product_price'], 2); ?></td>
                            <td class="text-primary"><?= $product['product_quantity']; ?></td>
                            <td class="text-success"><?= $product['product_capacity']; ?></td>
                            <td><?= $product['product_category']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        ตัวเลือก
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./viewproduct.php?q=<?= $product['product_id']; ?>">รายละเอียด</a></li>
                                        <li><a class="dropdown-item" href="./createproductrequest.php?q=<?= $product['product_id']; ?>">ปรับยอดคงคลัง</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php include_once('./components/footer.php') ?>