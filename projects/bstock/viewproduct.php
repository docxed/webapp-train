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

$requests_stmt = $conn->query("SELECT * FROM requests INNER JOIN users ON requests.user_id=users.user_id WHERE product_id = $productId AND request_status = 'อนุมัติ'");
$requests_stmt->execute();
$requests = $requests_stmt->fetchAll();

?>
<div class="container my-5">
    <p class="h2">ข้อมูลคำขอ</p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-10 mx-auto">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลสินค้า</h5>
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <div class="text-light bg-secondary w-100 p-3" style="height: 300; border-radius: 8px;">
                                <div class="text-end">
                                    จำนวนคงเหลือ
                                </div>
                                <h2 class="text-center">
                                    <?= $product['product_quantity']; ?>
                                </h2>
                                <div class="text-end">
                                    <?= $product['product_unit']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-light bg-info w-100 p-3" style="height: 300; border-radius: 8px;">
                                <div class="text-end">
                                    ราคาขายเฉลี่ย
                                </div>
                                <h2 class="text-center">
                                    <?php
                                    $total_price = 0;
                                    $total_quantiy = 0;
                                    foreach ($requests as $request) {
                                        if ($request['request_type'] == 'สินค้าออก') {
                                            $total_price += $request['request_quantity'] * $product['product_price'];
                                            $total_quantiy += $request['request_quantity'];
                                        }
                                    }
                                    if ($total_quantiy == 0) {
                                        echo 0;
                                    } else {
                                        echo number_format($total_price / $total_quantiy, 2);
                                    }
                                    ?>
                                </h2>
                                <div class="text-end">
                                    บาท
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-light bg-primary w-100 p-3" style="height: 300; border-radius: 8px;">
                                <div class="text-end">
                                    ราคาซื้อเฉลี่ย
                                </div>
                                <h2 class="text-center">
                                    <?php
                                    $total_price = 0;
                                    $total_quantiy = 0;
                                    foreach ($requests as $request) {
                                        if ($request['request_type'] == 'สินค้าเข้า') {
                                            $total_price += $request['request_quantity'] * $product['product_price'];
                                            $total_quantiy += $request['request_quantity'];
                                        }
                                    }
                                    if ($total_quantiy == 0) {
                                        echo 0;
                                    } else {
                                        echo number_format($total_price / $total_quantiy, 2);
                                    }
                                    ?>
                                </h2>
                                <div class="text-end">
                                    บาท
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <h5 class="card-title">ความเคลื่อนไหวสินค้า</h5>
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <div class="text-light bg-primary w-100 p-3" style="height: 300; border-radius: 8px;">
                                <div class="text-end">
                                    มูลค่าสินค้าคงเหลือ
                                </div>
                                <h2 class="text-center">
                                    <?= number_format($product['product_price'] * $product['product_quantity'], 2) ?>
                                </h2>
                                <div class="text-end">
                                    บาท
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">วันที่</th>
                            <th scope="col">ผู้ติดต่อ</th>
                            <th scope="col">ราคาต่อหน่วย</th>
                            <th scope="col">รวมเป็นเงิน</th>
                            <th scope="col">จำนวนเข้า</th>
                            <th scope="col">จำนวนออก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($requests as $request) {
                        ?>
                            <tr>
                                <th scope="row" class="text-<?php
                                                            if ($request['request_type'] == 'สินค้าเข้า') {
                                                                echo 'success';
                                                            } else {
                                                                echo 'danger';
                                                            }
                                                            ?>"><?= $request['request_type']; ?></th>
                                <th><?= date_format(date_create($request['request_timestamp']), "Y-m-d"); ?></th>
                                <td><?= $request['user_firstname'] . ' ' . $request['user_lastname']; ?></td>
                                <td><?= number_format($product['product_price'], 2); ?></td>
                                <td><?= number_format($product['product_price'] * $request['request_quantity'], 2); ?></td>
                                <td><?php if ($request['request_type'] == 'สินค้าเข้า') {
                                        echo $request['request_quantity'];
                                    } ?></td>
                                <td><?php if ($request['request_type'] == 'สินค้าออก') {
                                        echo $request['request_quantity'];
                                    } ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php include_once('./components/footer.php') ?>