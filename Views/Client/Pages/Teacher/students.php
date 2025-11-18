<?php ?>
<?php
  $courseId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

  $courseTitle = "Lập trình HTML/CSS từ Zero đến Hero";

  $students = [
    ['id'=>101,'name'=>'Nguyễn Văn A','email'=>'nva@example.com','enrolled'=>'2025-01-12','progress'=>75,'status'=>'active'],
    ['id'=>102,'name'=>'Trần Thị B','email'=>'ttb@example.com','enrolled'=>'2025-03-04','progress'=>40,'status'=>'active'],
    ['id'=>103,'name'=>'Lê Văn C','email'=>'lvc@example.com','enrolled'=>'2025-02-20','progress'=>100,'status'=>'completed'],
  ];
?>

<div class="max-w-screen-2xl mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-semibold text-gray-900">Danh sách học viên</h1>
      <p class="text-sm text-gray-500">Khóa: <?= htmlspecialchars($courseTitle) ?> (ID: <?= $courseId ?>)</p>
    </div>

    <div class="flex items-center gap-2">
      <label class="relative block">
        <span class="sr-only">Search</span>
        <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Tìm kiếm tên hoặc email..." type="text" name="q" />
        <svg class="absolute left-2 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
      </label>
    </div>
  </div>

  <div class="overflow-x-auto bg-white rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Họ và tên</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày đăng ký</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tiến độ</th>
          <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <?php foreach($students as $i => $s): ?>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-3 text-sm text-gray-700"><?= $i+1 ?></td>
            <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($s['name']) ?></td>
            <td class="px-4 py-3 text-sm text-gray-600"><?= htmlspecialchars($s['email']) ?></td>
            <td class="px-4 py-3 text-sm text-gray-600"><?= date('d/m/Y', strtotime($s['enrolled'])) ?></td>
            <td class="px-4 py-3 text-sm text-gray-600">
              <div class="w-40 bg-gray-100 rounded-full h-3 overflow-hidden">
                <div class="h-2 bg-linear-to-r from-purple-600 via-blue-400 to-purple-600 rounded-full transition-all duration-700 ease-out" style="width: <?= max(0,min(100,(int)$s['progress'])) ?>%;"></div>
              </div>
              <div class="text-xs text-gray-500 mt-1"><?= (int)$s['progress'] ?>%</div>
            </td>
            <td class="px-4 py-3 text-sm">
              <?php if($s['status']==='completed'): ?>
                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 text-green-800">Hoàn thành</span>
              <?php else: ?>
                <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800">Đang học</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  </div>
</div>
