<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ biểu mẫu
    $order_name = $_POST['order_name'];
    $address = $_POST['address'];
    $city_address = $_POST['city_address'];
    $district_address = $_POST['district_address'];
    $phone = $_POST['phone'];
    $email_address = $_POST['email_address'];

    // Tính tổng giỏ hàng
    $query = "
        SELECT SUM(p.price * c.quantity_of_products) as cart_total
        FROM cart AS c
        INNER JOIN product AS p ON c.product_id = p.product_id
        WHERE c.user_id = :user_id
    ";
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $cart_total = $result['cart_total'];

    // Tiến hành thêm dữ liệu vào bảng $order, bao gồm tổng giá tiền
    $query = "INSERT INTO `order` (order_name, address, city_address, district_address, phone, email_address, cart_total) 
              VALUES (:order_name, :address, :city_address, :district_address, :phone, :email_address, :cart_total)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':order_name', $order_name);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city_address', $city_address);
    $stmt->bindParam(':district_address', $district_address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email_address', $email_address);
    $stmt->bindParam(':cart_total', $cart_total, PDO::PARAM_INT); // Đảm bảo giá trị được truyền vào dưới dạng số nguyên

    if ($stmt->execute()) {
        // Thêm hóa đơn thành công, giờ ta sẽ xóa đơn hàng từ bảng cart
        $deleteQuery = "DELETE FROM cart WHERE user_id = :user_id";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':user_id', $user_id);
        $deleteStmt->execute();

        echo "Thêm hóa đơn và xóa đơn hàng thành công!";
    } else {
        echo "Lỗi khi thêm hóa đơn: " . $stmt->errorInfo()[2];
    }
}
?>
<?php
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "
        SELECT SUM(p.price * c.quantity_of_products) as cart_total
        FROM cart AS c
        INNER JOIN product AS p ON c.product_id = p.product_id
        WHERE c.user_id = :user_id
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $cart_total = $result['cart_total'];
} else {
    $cart_total = 0; 
}
?>


<!-- Phần HTML không thay đổi -->



<section class="ftco-section">
    <div class="container">
        <form action="#" method="POST" class="billing-form">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <h3 class="mb-4 billing-heading">Hóa Đơn Thanh Toán</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="order_name">Họ Và Tên Người Nhận</label>
                                <input type="text" class="form-control" name="order_name" placeholder="Nhập Tên Người Nhận">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Địa Chỉ</label>
                                <input type="text" class="form-control" name="address" placeholder="Nhập Địa Chỉ Nhận Hàng">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city_address">Thành Phố</label>
                                <input type="text" class="form-control" name="city_address" placeholder="Nhập Thành Phố">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district_address">Huyện</label>
                                <input type="text" class="form-control" name="district_address" placeholder="Nhập Huyện">
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số Điện Thoại</label>
                                <input type="text" class="form-control" name="phone" placeholder="Nhập Số Điện Thoại">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_address">Email</label>
                                <input type="text" class="form-control" name="email_address" placeholder="Nhập Email">
                            </div>
                        </div>
                        <div class="w-100"></div>
                    </div>

                </div>
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        <div class="cart-total mb-3">
                            <h3>Tổng Giỏ Hàng</h3>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Tổng Số Tiền</span>
                            <p class="total">
                                <?php echo number_format($cart_total, 0, ',', '.'); ?>.000 vnđ
                            </p>
                            <div class="cart-detail p-3 p-md-4">
                                <p><button type="submit" class="btn btn-primary py-3 px-4">Đặt Hàng</button></p>
                            </div>
                            </p>
                        </div>
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>