<?php
$currentTimestamp = time();

if (isset($_POST['update_is_active'])) {
    $product_bid_id = $_POST['product_bid_id'];

    $sql = "UPDATE product_bid SET is_active = 2 WHERE product_bid_id = :product_bid_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':product_bid_id', $product_bid_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

$sql = "SELECT pb.*, u.fullname AS winner_fullname, u.user_id AS winner_user_id, b.business_id, b.city_address, b.district_address, b.address, b.phone, b.email_address
        FROM product_bid pb
        LEFT JOIN user u ON pb.winner_id = u.user_id
        LEFT JOIN business b ON u.user_id = b.user_id
        WHERE pb.user_id = :user_id
        AND pb.real_end_time < NOW()
        AND pb.is_active = 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$productList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <?php if (!empty($productList)) : ?>
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Tên Phiên</th>
                                    <th>Giá Khởi Điểm</th>
                                    <th>Giá Hiện Tại</th>
                                    <th>Người ra giá gần đây</th>
                                    <th>Thông Tin Doanh Nghiệp</th>
                                    <th>Giao Hàng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($productList as $product) : ?>
                                    <tr class="text-center">
                                        <td class="product_bid_name">
                                            <h5><?php echo $product['product_bid_name']; ?></h5>
                                        </td>
                                        <td class="start_price">
                                            <h5><?php echo number_format($product['start_price'], 0, ',', '.'); ?>.000vnđ</h5>
                                        </td>
                                        <td class="current_price">
                                            <h5><?php echo number_format($product['current_price'], 0, ',', '.'); ?>.000vnđ</h5>
                                        </td>
                                        <td class="winner_fullname">
                                            <?php if ($product['winner_fullname']) : ?>
                                                <h5><?php echo $product['winner_fullname']; ?></h5>
                                            <?php else : ?>
                                                <h5>Chưa có người ra giá.</h5>
                                            <?php endif; ?>
                                        </td>
                                        <td class="business_info">
                                            <ul style="list-style-type: none; padding: 0;">
                                                <li><strong>Thành Phố:</strong> <?php echo $product['city_address']; ?></li>
                                                <li><strong>Huyện:</strong> <?php echo $product['district_address']; ?></li>
                                                <li><strong>Địa chỉ:</strong> <?php echo $product['address']; ?></li>
                                                <li><strong>Điện Thoại:</strong> <?php echo $product['phone']; ?></li>
                                                <li><strong>Email:</strong> <?php echo $product['email_address']; ?></li>
                                            </ul>
                                        </td>
                                        <td class="cart_total">
                                            <?php if ($product['winner_user_id'] == 0) : ?>
                                                <form action="delete_bid2.php" method="POST">
                                                    <input type="hidden" name="product_bid_id" value="<?php echo $product['product_bid_id']; ?>">
                                                    <button type="submit" class="action-button px-3" onclick="return confirm('Bạn Muốn Xóa Phiên Đấu Giá Này?')" style="cursor: pointer;">
                                                        <i class="fas fa-trash-alt" style="color: red;"></i> Xóa Phiên
                                                    </button>
                                                </form>
                                            <?php else : ?>
                                                <form method="post">
                                                    <input type="hidden" name="product_bid_id" value="<?php echo $product['product_bid_id']; ?>">
                                                    <button type="submit" class="action-button px-3" name="update_is_active" style="cursor: pointer;">
                                                    <i class="fas fa-check" style="color: green;"></i> Xác Nhận
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>


                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <p>Không có phiên đấu giá nào thỏa mãn điều kiện.</p>
            <?php endif; ?>
        </div>
    </div>
</section>