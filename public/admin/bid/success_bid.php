<?php
session_start();

require_once '../../../config.php';

$items_per_page = 10;

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$start_index = ($current_page - 1) * $items_per_page;

$sql = "SELECT pb.*, u.fullname AS winner_name
        FROM product_bid AS pb
        LEFT JOIN user AS u ON pb.winner_id = u.user_id
        WHERE pb.is_active = 3
        LIMIT :start, :items_per_page";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':start', $start_index, PDO::PARAM_INT);
$stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);
$stmt->execute();
$product_bids = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count_query = $conn->query('SELECT COUNT(*) FROM product_bid');
$total_items = $count_query->fetchColumn();

$total_pages = ceil($total_items / $items_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<?php include("../include/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("../include/sidebar.php"); ?>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Đơn Hàng</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <?php if (isset($product_bids) && !empty($product_bids)) : ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="orderTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tên Sản Phẩm</th>                                                  
                                                    <th>Giá Khởi Điểm</th>
                                                    <th>Giá Cuối Cùng</th>
                                                    <th>Tiền Lời</th>
                                                    <th>Thời Gian Kết Thúc</th>
                                                    
                                                    <th>Người Thắng Cuộc</th>
                                                    <th>Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($product_bids as $product) : ?>
                                                    <tr>
                                                        <td><?php echo $product['product_bid_name']; ?></td>                                                     
                                                        <td><?php echo $product['start_price']; ?></td>
                                                        <td><?php echo $product['current_price']; ?></td>
                                                        <td>
                                                            <?php
                                                            $warehouse_bid_id = $product['warehouse_bid_id'];
                                                            $sql = "SELECT purchase_price FROM warehouse_bid WHERE warehouse_bid_id = :warehouse_bid_id";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->bindParam(':warehouse_bid_id', $warehouse_bid_id, PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            $warehouse_bid = $stmt->fetch(PDO::FETCH_ASSOC);

                                                            $purchase_price = $warehouse_bid['purchase_price'];
                                                            $current_price = $product['current_price'];
                                                            $profit = $current_price - $purchase_price;
                                                            ?>
                                                            <?= $profit; ?>
                                                        </td>
                                                        <td><?php echo $product['end_time']; ?></td>
                                                        <td><?php echo $product['winner_name']; ?></td>
                                                        <td>
                                                            <form action="delete.php" method="POST">
                                                                <input type="hidden" name="product_bid_id" value="<?php echo $product['product_bid_id']; ?>">
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn Muốn Xóa Phiên Đấu Giá Này?')">Xóa</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                                    <li class="page-item <?php echo ($page == $current_page) ? 'active' : ''; ?>">
                                                        <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <p>Không có phiên đấu giá nào.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
    <?php include("../include/footer.php"); ?>
</body>

</html>
