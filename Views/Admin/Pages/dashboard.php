<?php
$success = $_SESSION['login_success'] ?? null;
unset($_SESSION['login_success']);
?>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <h3>Thống kê</h3>
</div>
<?php if (!empty($success)): ?>
    <div id="alert_success" class="alert alert-success d-flex align-items-center" role="alert">
        <div>
            <?= $success ?>
        </div>
    </div>
<?php endif; ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row mb-1">
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card h-100 mb-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between align-items-center text-center px-1 py-1">
                            <div class="">
                                <i class="text-primary bi bi-person-fill" style="font-size: 40px;"></i>
                            </div>
                            <div class="text-muted">Tổng số học viên</div>
                            <div class="h6 fw-bold mb-0"><?php echo number_format($totalStudents); ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card h-100 mb-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between align-items-center text-center px-1 py-1">
                            <div class="">
                                <i class="text-primary bi bi-person-plus-fill" style="font-size: 40px;"></i>
                            </div>
                            <div class="text-muted">Số học viên mới trong tuần</div>
                            <div class="h6 fw-bold mb-0"> <span><?php echo $newStudentsInWeek; ?></span></div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card h-100 mb-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between align-items-center text-center px-1 py-1">
                            <div class="">
                                <i class="text-primary bi bi-percent" style="font-size: 40px;"></i>
                            </div>
                            <div class="text-muted">Tỷ lệ hoàn thành khóa học của học viên</div>
                            <div class="h6 fw-bold mb-0"><span><?php echo $completionRate; ?>%</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card h-100 mb-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between align-items-center text-center px-1 py-1">
                            <div class="">
                                <i class="text-primary bi bi-file-slides-fill" style="font-size: 40px;"></i>
                            </div>
                            <div class="text-muted">Tổng số khóa học</div>
                            <div class="h6 fw-bold mb-0"><?php echo number_format($totalCourses); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card h-100 mb-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between align-items-center text-center px-1 py-1">
                            <div class="">
                                <i class="text-primary bi bi-hourglass-top" style="font-size: 40px;"></i>
                            </div>
                            <div class="text-muted">Khóa học đang chờ duyệt</div>
                            <div class="h6 fw-bold mb-0"><?php echo number_format($pendingCourses); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-2 col-md-6">
                    <div class="card h-100 mb-0">
                        <div
                            class="card-body d-flex flex-column justify-content-between align-items-center text-center px-1 py-1">
                            <div class="">
                                <i class="text-primary bi bi-person-circle" style="font-size: 40px;"></i>
                            </div>
                            <div class="text-muted">Tổng số giảng viên</div>
                            <div class="h6 fw-bold mb-0"><?php echo number_format($totalTeachers); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Nav tabs -->
                        <div class="mt-2 ms-2">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item mx-2" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                        aria-selected="true">Thống kê</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                        aria-selected="false">Top 10</button>
                                </li>
                            </ul>

                        </div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-header">
                                    <h4>Thống kê số lượng học viên mới theo tháng</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" width="600" height="300"></canvas>

                                </div>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="card-header">
                                    <h4>Top 10 khóa học</h4>
                                </div>
                                <div class="card-body">
                                    <div id="line"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Chart Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    const labels = ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"];
    const data = <?php echo json_encode($finalData); ?>;

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Tổng số học viên theo tháng',
                data: data,
                fill: false,
                lineTension: 0,
                backgroundColor: "rgba(54,162,235,0.6)",
                borderColor: "rgba(255, 0, 200, 0.33)",
                borderWidth: 2
            }]

        },
        options: {
            legend: {
                display: true,
                labels: {
                    fontSize: 14
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0
                    }
                }]
            }
        }
    });
</script>

<!-- top10 -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const labelsTop10 = <?php echo json_encode($labelsTop10Courses); ?>;
    const dataTop10 = <?php echo json_encode($dataTop10Courses); ?>;
    const maxValue = Math.max(...dataTop10);
    const xAxisMax = maxValue + 1;
    var profileTab = document.getElementById('profile-tab');
    profileTab.addEventListener('shown.bs.tab', function(event) {
        if (!window.top10Chart) { // render ra 1 lần duy I
            var options = {
                series: [{
                    data: dataTop10
                }],
                chart: {
                    type: 'bar',
                    height: 250
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        borderRadiusApplication: 'end',
                        horizontal: true
                    }
                },
                colors: ['rgba(54,162,235,0.6)'],

                dataLabels: {
                    enabled: true
                },
                xaxis: {
                    categories: labelsTop10,
                    tickAmount: xAxisMax,
                    max: xAxisMax
                }
            };
            window.top10Chart = new ApexCharts(document.querySelector("#line"), options);
            window.top10Chart.render();
        }
    });
</script>