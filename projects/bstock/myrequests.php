<?php session_start() ?>
<?php require_once './config/db.php'; ?>
<?php include_once('./middlewares/is_loggedin.php') ?>
<?php include_once('./components/header.php') ?>
<?php include_once('./components/nav-bar.php') ?>
<?php
$userId = $_SESSION['myId'];
$requests_stmt = $conn->query("SELECT * FROM requests INNER JOIN products ON requests.product_id=products.product_id WHERE requests.user_id = $userId");
$requests_stmt->execute();
$requests = $requests_stmt->fetchAll();
?>
<div class="container my-5">
    <?php $nRequests = $conn->query("SELECT COUNT(*) FROM requests WHERE user_id = $userId")->fetchColumn(); ?>
    <p class="h2">รายการคำขอของฉัน <span class="badge rounded-pill text-bg-primary"><?= $nRequests; ?></p>
    <hr><br>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">หมวดสินค้า</th>
                        <th scope="col">ราคาต่อหน่วย</th>
                        <th scope="col">ประเภท</th>
                        <th scope="col">จำนวนยอดที่ปรับ</th>
                        <th scope="col">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($requests as $request) {
                    ?>
                        <tr>
                            <td>
                                <div>
                                    <img src="./uploads/<?= $request['product_img']; ?>" width="200" class="rounded">
                                </div>
                            </td>
                            <th scope="row"><?= $request['product_code']; ?></th>
                            <td>
                                <div><?= $request['product_name']; ?></div>
                                <div class="text-secondary"><?= $request['product_detail']; ?></div>
                            </td>
                            <td><?= $request['product_category']; ?></td>
                            <td><?= number_format((float) $request['product_price'], 2); ?></td>
                            <td class="<?php if ($request['request_type'] == 'สินค้าเข้า') {
                                            echo 'text-success';
                                        } else {
                                            echo 'text-danger';
                                        } ?>"><?= $request['request_type']; ?></td>
                            <td class="text-primary"><?= $request['request_quantity']; ?></td>
                            <td>
                                <span class="badge text-bg-<?php
                                                            if ($request['request_status'] == 'รอตรวจสอบ') {
                                                                echo 'warning';
                                                            } else if ($request['request_status'] == 'อนุมัติ') {
                                                                echo 'success';
                                                            } else {
                                                                echo 'danger';
                                                            }
                                                            ?>"><?= $request['request_status']; ?></span>
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