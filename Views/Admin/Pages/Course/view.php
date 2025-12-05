<div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Chi tiết khóa học</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết khóa học</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="container my-5">
  <!-- Title & Info -->
  <div class="row">
    <div class="col-lg-8">
      <h2 class="fw-bold"><?= htmlspecialchars($course['course_name']) ?></h2>
      <div class="text-muted mb-1"><?= html_entity_decode($course['description']) ?></div>
      <p class="small">
        <i class="bi bi-star-fill text-warning"></i> <?= htmlspecialchars($avgRating) ?> (<?= number_format(count($reviews)) ?> lượt đánh giá) · <?= number_format($course['total_enroll']) ?> lượt bán · Được đăng bởi <a href="#" class="text-decoration-none"><?= htmlspecialchars($course['instructor']) ?></a>
      </p>
      <hr>

      <!-- What you'll learn -->
      <h5 class="fw-bold mt-4">Sau khi hoàn thành khóa học, bạn sẽ:</h5>
      <div class="row row-cols-1 row-cols-md-2">
        <?php foreach ($benefit as $item): ?>
          <div class="col mb-2">
            <i class="bi bi-check-circle-fill text-success me-2"></i><?= htmlspecialchars($item) ?>
          </div>
        <?php endforeach; ?>
      </div>

      <hr>

      <!-- Course content -->
      <h5 class="fw-bold mt-4">Nội dung khóa học</h5>
      <p class="text-muted"><?= count($lessons) ?> bài học • <?= $course['total_length'] ?> tổng thời lượng</p>

      <hr>

      <!-- Requirements -->
      <h5 class="fw-bold mt-4">Phù hợp cho ai?</h5>
      <ul>
        <?php foreach ($customer_object as $item): ?>
          <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
      </ul>

      <hr>

      <!-- Instructor -->
      <div class="mt-5">
        <h5 class="fw-bold">Giảng viên</h5>
        <div class="d-flex align-items-center mt-3">
          <img src="Uploads/Avatar/<?= htmlspecialchars($course['avatar'] ?? 'default.webp') ?>" alt="Instructor" class="rounded-circle me-3" width="60" height="60">
          <div>
            <h6 class="mb-0 fw-bold">Thầy <?= htmlspecialchars($course['instructor']) ?></h6>
            <small class="text-muted"></small>
          </div>
        </div>
        <p class="mt-3">
          <?= nl2br(htmlspecialchars($course['teacher_information']) == '' ? 'Người này quá lười biếng để viết thông tin' : htmlspecialchars($course['teacher_information'])) ?>
        </p>
      </div>

      <hr>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="card shadow-sm">
        <img src="Uploads/Courses/<?= htmlspecialchars($course['image'] ?? 'default.webp') ?>" class="card-img-top" alt="Course thumbnail">
        <div class="card-body">
          <h4 class="fw-bold"><?= number_format($course['sale_price'] == 0 ? $course['regular_price'] : $course['sale_price']) ?>đ</h4>
          <?php if ($course['sale_price'] < $course['regular_price'] && $course['sale_price'] != 0): ?>
            <p class="text-muted text-decoration-line-through"><?= number_format($course['regular_price']) ?>đ</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>