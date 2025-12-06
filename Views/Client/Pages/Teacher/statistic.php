<div class="max-w-screen-2xl mx-auto px-4 py-8">
  <header class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Thống kê giảng viên</h1>
    <p class="text-sm text-gray-500 mt-1">Tổng quan nhanh về hiệu suất các khóa học của bạn</p>
  </header>

  <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white border rounded-lg p-5 shadow-sm">
      <div class="flex items-start gap-4">
        <div class="bg-indigo-50 text-indigo-600 p-3 rounded-full">
          <i class="bi bi-journals"></i>
        </div>
        <div class="flex-1">
          <div class="text-sm text-gray-500">Tổng số khóa học</div>
          <div class="mt-1 text-2xl font-bold text-gray-900">
            <?= number_format($totalCourses['total'] ?? 0, 0, ',', '.') ?></div>
          <div class="mt-2 text-xs text-gray-400">Khóa học đang hoạt động / đã xuất bản</div>
        </div>
      </div>
    </div>
    <div class="bg-white border rounded-lg p-5 shadow-sm">
      <div class="flex items-start gap-4">
        <div class="bg-green-50 text-green-600 p-3 rounded-full">
          <i class="bi bi-person-circle"></i>
        </div>
        <div class="flex-1">
          <div class="text-sm text-gray-500">Tổng số học viên</div>
          <div class="mt-1 text-2xl font-bold text-gray-900">
            <?= number_format($totalStudents['total'] ?? 0, 0, ',', '.') ?></div>
          <div class="mt-2 text-xs text-gray-400">Số học viên đã đăng ký vào tất cả các khóa học</div>
        </div>
      </div>
    </div>

    <div class="bg-white border rounded-lg p-5 shadow-sm">
      <div class="flex items-start gap-4">
        <div class="bg-yellow-50 text-yellow-600 p-3 rounded-full">
          <i class="bi bi-wallet"></i>
        </div>
        <div class="flex-1">
          <div class="text-sm text-gray-500">Tổng doanh thu</div>
          <div class="mt-1 text-2xl font-bold text-gray-900">
            <?= number_format($totalRevenue['total_revenue'] ?? 0, 0, ',', '.') ?> ₫</div>
          <div class="mt-2 text-xs text-gray-400">Tổng doanh thu từ tất cả khóa học</div>
        </div>
      </div>
    </div>
  </section>

  <section class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border rounded-lg p-5 shadow-sm">
      <h2 class="text-lg font-semibold">Doanh thu theo tháng </h2>
      <p class="text-sm text-gray-500 mt-1">Biểu đồ tổng doanh thu trong 12 tháng trong năm</p>
      
      <div class="mt-4" style="height: 350px;">
        <canvas id="myChart"></canvas>
      </div>
      </div>

    <aside class="bg-white border rounded-lg p-5 shadow-sm">
      <h3 class="text-md font-semibold">Tổng quan nhanh</h3>
      <ul class="mt-3 space-y-3 text-sm text-gray-600">
        <li class="flex justify-between"><span>Khóa học mới trong 30 ngày</span><span
            class="font-medium"><?= number_format($newCourses30Day['total'] ?? 0, 0, ',', '.') ?></span></li>
        <li class="flex justify-between"><span>Học viên mới (30 ngày)</span><span
            class="font-medium"><?= number_format($newStudents30Day['total'] ?? 0, 0, ',', '.') ?></span></li>
        <li class="flex justify-between"><span>Doanh thu (30 ngày)</span><span
            class="font-medium"><?= number_format($totalRevenueIn30Days['total_revenue'] ?? 0, 0, ',', '.') ?> ₫</span>
        </li>
      </ul>
      <div class="mt-4">
        <a href="index.php?page=teacher"
          class="inline-block w-full text-center bg-blue-600 text-white px-4 py-2 rounded">Quản lý khóa học</a>
      </div>
    </aside>
  </section>
</div>

 <!-- // Script Chart.js đã được tối ưu hóa giao diện (từ câu trả lời trước) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
  const labels = ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"];
  const data = <?= json_encode($finalData); ?>; 

  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Tổng doanh thu theo tháng',
        data: data,
        backgroundColor: "rgba(79, 70, 229, 0.8)", 
        borderColor: "rgba(79, 70, 229, 1)", 
        borderWidth: 1, 
        hoverBackgroundColor: "rgba(109, 40, 217, 1)", 
      }]
    },
    options: {
      legend: { display: false },
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        xAxes: [{
          gridLines: { display: false },
          scaleLabel: {
            display: true,
            labelString: 'Tháng',
            fontSize: 14,
            fontColor: '#333'
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true,
            min: 0,
            callback: function(value, index, values) {
              if(value >= 1000000) {
                 return (value / 1000000).toFixed(1) + ' Tr ₫';
              } else if (value >= 1000) {
                 return (value / 1000).toFixed(0) + ' K ₫';
              }
              return value + ' ₫';
            }
          },
          gridLines: {
            color: "rgba(200, 200, 200, 0.4)",
            lineWidth: 1
          },
          scaleLabel: {
            display: true,
            labelString: 'Doanh thu',
            fontSize: 14,
            fontColor: '#333'
          }
        }]
      },
      tooltips: {
        mode: 'index',
        intersect: false,
        backgroundColor: 'rgba(0,0,0,0.8)',
        titleFontSize: 14,
        bodyFontSize: 12,
        callbacks: {
          label: function(tooltipItem, data) {
            var label = data.datasets[tooltipItem.datasetIndex].label || '';
            if (label) {
              label += ': ';
            }
            label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' ₫';
            return label;
          }
        }
      }
    }
  });
</script>