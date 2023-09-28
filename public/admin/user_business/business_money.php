<?php
session_start();

require_once '../../../config.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // Bây giờ bạn có thể sử dụng biến $user_id trong mã HTML của trang này.
} else {
    // Xử lý khi không có tham số user_id trong URL, ví dụ: Hiển thị thông báo lỗi hoặc chuyển hướng người dùng.
    echo "Lỗi: Không tìm thấy user_id trong URL.";
    exit;
}

$sql = "SELECT * FROM business WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$businessInfo = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM user WHERE role = 2";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Khởi tạo biến lưu thông báo lỗi hoặc thành công
$error = $success = '';

// Xử lý khi form nạp tiền được gửi đi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $amount = $_POST['amount'];


    if (is_numeric($amount)) {
        // Chuyển đổi $amount từ chuỗi thành số thực (float)
        $amount = floatval($amount);

        // Chuyển đổi $businessInfo['money'] từ chuỗi thành số thực (float)
        $currentBalance = floatval($businessInfo['money']);

        // Thực hiện phép cộng để nạp tiền
        $newBalance = $currentBalance + $amount;

        // Cập nhật số tiền trong tài khoản
        $sql = "UPDATE business SET money = :money WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':money', $newBalance);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            header("Location: ./index_business.php");
        } else {
            echo "Lỗi khi cập nhật số tiền trong tài khoản.";
        }
    } else {
        $error = "Số tiền nạp không hợp lệ.";
    }
}


?>

<!-- Phần HTML hiển thị thông tin người dùng và nạp tiền -->


<?php
include("../include/head.php");
?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include("../include/sidebar.php");
        ?>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Nạp Tiền</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin người dùng</h3>
                                </div>
                                <div class="card-body">
                                    <?php if (!empty($users) && isset($user_id)) : ?>
                                        <?php foreach ($users as $user) : ?>
                                            <?php if ($user['user_id'] == $user_id) : ?>
                                                <strong>Tên người dùng:</strong> <?php echo $user['fullname']; ?><br>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <?php if (isset($businessInfo)) : ?>
                                        <strong>Số tiền trong tài khoản:</strong> <?php echo $businessInfo['money']; ?><br>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Thanh nạp tiền -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Nạp Tiền</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="amount">Số tiền cần nạp:</label>
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Nhập số tiền">
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="nap_tien">Nạp Tiền</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


    </div>


    <?php
    include("../include/footer.php");
    ?>
</body>

</html>