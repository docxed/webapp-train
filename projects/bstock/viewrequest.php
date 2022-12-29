<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$requestId = $_GET['q'];
$request_stmt = $conn->query("SELECT * FROM requests INNER JOIN products ON requests.product_id=products.product_id WHERE request_id = $requestId");
$request_stmt->execute();
$request = $request_stmt->fetch();

if ($request['request_type'] == 'สินค้าเข้า') {
    $result_quantity = $request['product_quantity'] + $request['request_quantity'];
} else {
    $result_quantity = $request['product_quantity'] - $request['request_quantity'];
}

$isOverQuantity = false;

if ($request['request_quantity'] > $request['product_capacity'] || $result_quantity < 0) {
    $isOverQuantity = true;
}

?>
<div class="container my-5">
    <p class="h2">ข้อมูลคำขอ</p>
    <hr><br>
    <div class="row">
        <div class="col-sm-12 col-md-7 col-lg-7 mx-auto">
            <?php
            if ($isOverQuantity) {
            ?>
                <div class="alert alert-warning" role="alert">
                    ความจุสินค้าไม่เพียงพอในการดำเนินการ
                </div>
            <?php
            }
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลสินค้า</h5>
                    <div>รหัสสินค้า : <?= $request['product_code']; ?></div>
                    <div>ชื่อสินค้า : <strong><?= $request['product_name']; ?></strong></div>
                    <div>รายละเอียด : <?= $request['product_detail']; ?></div>
                    <div>หน่วยสินค้า : <?= $request['product_unit']; ?></div>
                    <div>หมวดสินค้า : <?= $request['product_category']; ?></div>
                    <div>ราคาขาย : <?= number_format($request['product_price'], 2); ?> บาท</div>
                    <div>จำนวนคงคลัง : <strong class="text-primary"><?= $request['product_quantity']; ?></strong></div>
                    <div>ความจุ : <strong class="text-success"><?= $request['product_capacity']; ?></strong></div>
                    <div class="text-center">
                        <img src="./uploads/<?= $request['product_img']; ?>" alt="" class="rounded w-50">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลคำขอ</h5>
                    <div>ประเภท : <span class="text-<?php
                                                    if ($request['request_type'] == 'สินค้าเข้า') {
                                                        echo 'success';
                                                    } else {
                                                        echo 'danger';
                                                    }
                                                    ?>"><?= $request['request_type']; ?></span></div>
                    <div>จำนวนยอดที่ปรับ : <strong class="text-primary"><?= $request['request_quantity']; ?></strong></div>
                    <div class="mt-3 text-center">
                        <?php
                        if ($request['request_status'] == 'รอตรวจสอบ') {
                        ?>
                            <a href="./request_actions.php?reqeustId=<?= $request['request_id']; ?>&productId=<?= $request['product_id']; ?>&approve=approve&result_quantity=<?= $result_quantity; ?>" class="btn btn-success">อนุมัติ</a>
                            <a href="./request_actions.php?reqeustId=<?= $request['request_id']; ?>&cancel=cancel" class="btn btn-outline-danger">ยกเลิก</a>
                        <?php
                        } else {
                        ?>
                            <span class="badge text-bg-<?php
                                                        if ($request['request_status'] == 'รอตรวจสอบ') {
                                                            echo 'warning';
                                                        } else if ($request['request_status'] == 'อนุมัติ') {
                                                            echo 'success';
                                                        } else {
                                                            echo 'danger';
                                                        }
                                                        ?>"><?= $request['request_status']; ?></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include_once('./components/footer.php') ?>