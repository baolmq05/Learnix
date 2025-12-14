<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Khóa học đã tham gia</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Khóa học đã tham gia</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã đơn hàng</th>
                            <th>Tên học viên</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td><?= $count++; ?></td>
                            <td><?= htmlspecialchars($order['transaction_code']); ?></td>
                            <td><?= htmlspecialchars($order['user_name']); ?></td>
                            <td><?= number_format($order['price']); ?></td>
                            <td>
                                <span class="badge bg-success">Đã thanh toán</span>
                            </td>
                            <td>
                                <a href="?page=order&action=view&id=<?= htmlspecialchars($order['id']); ?>" class="btn btn-outline-info d-inline-flex align-items-center p-2"><i class="bi bi-eye"></i></a> 
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</div>