<?php ?>

<main>
    <?php
    $course = [
        'id' => 1,
        'title' => 'Lập trình HTML/CSS từ Zero đến Hero',
        'instructor' => 'Phan Văn Tính',
        'hours' => 24,
        'sections' => 5,
        'lectures' => 20,
        'students' => 850000,
        'rating' => 4.7,
        'reviews' => 11000,
        'price' => '300.000',
        'image' => 'https://files.fullstack.edu.vn/f8-prod/courses/15/62f13d2424a47.png',
        'description' => 'Khóa học thiết kế cho người mới bắt đầu, bao gồm HTML, CSS và responsive layout.'
    ];

    $reviews = [
        ['avatar' => 'https://scontent.fvca1-2.fna.fbcdn.net/v/t39.30808-6/554859956_1837671740460192_114735253258849538_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=a5f93a&_nc_ohc=0XfBFxrLRLEQ7kNvwFmZTsp&_nc_oc=AdnrImhfPhbh3JkeZN5kuAcP5SHCyREhZSpowji3WeLWBjJlH52aY-_eYrdIkuEKaGg&_nc_zt=23&_nc_ht=scontent.fvca1-2.fna&_nc_gid=HEGUDVxWEAkjM9mv7XwgQA&oh=00_AfhW6zUllyMV2UU2U6el6_SCgu_cCihn0BLkzK0lYKfkQA&oe=691FE6BE', 'name' => 'Nguyễn Hoàng Bảo', 'rating' => 5, 'text' => 'Khóa học tuyệt vời và sâu sắc về HTML/CSS.', 'date' => '2025-11-08'],
        ['avatar' => 'https://res.cloudinary.com/dfmoftnpw/image/upload/v1761701354/js-nangcao-images/zoms8n5lnlotl3xc1ytg.jpg', 'name' => 'Đinh Quốc Toàn', 'rating' => 4.5, 'text' => 'Giảng viên dễ hiểu, ví dụ thực tế.', 'date' => '2025-11-01'],
    ];
    ?>

    <div class="bg-[#16161d] text-white py-12">
        <div class="max-w-screen-2xl mx-auto px-4 grid lg:grid-cols-10 gap-8">
            <div class="lg:col-start-2 lg:col-span-5 col-span-8">
                <h1 class="text-3xl font-bold"><?= htmlspecialchars($course['title']) ?></h1>
                <p class="mt-4 text-sm leading-7 text-gray-300"><?= htmlspecialchars($course['description']) ?></p>

                <div class="mt-4 flex items-center gap-4 text-gray-300 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-star-fill text-yellow-400"></i>
                        <span class="font-medium"><?= $course['rating'] ?></span>
                        <span class="text-gray-400">(<?= number_format($course['reviews']) ?> đánh giá)</span>
                    </div>
                    <div class="border-l border-gray-700 pl-4">
                        <span><?= number_format($course['students']) ?> lượt tham gia</span>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="index.php?page=teacherEditCourse&id=<?= $course['id'] ?>"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mr-2">Chỉnh sửa
                        khóa học</a>
                    <a href="index.php?page=teacher&action=viewStudents&id=<?= $course['id'] ?>"
                        class="inline-block border border-white text-white px-4 py-2 rounded">Danh sách học viên</a>
                </div>
            </div>

            <div class="lg:col-span-3 col-span-6 col-start-3">
                <div class="p-3 rounded bg-white text-black">
                    <img src="<?= $course['image'] ?>" alt="" class="w-full h-44 object-cover rounded" />
                    <h3 class="font-bold text-2xl mt-4"><?= $course['price'] ?> ₫</h3>
                    <div class="mt-3">
                        <a href="index.php?page=teacherPreview&id=<?= $course['id'] ?>"
                            class="w-full inline-block text-center bg-[#6d28d2] text-white px-4 py-2 rounded mb-2">Xem
                            trước khóa học</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-screen-2xl mx-auto px-4 py-8 grid lg:grid-cols-10 gap-8">
        <div class="lg:col-start-2 lg:col-span-5 col-span-8">
            <div class="border p-5">
                <h2 class="text-xl font-semibold mb-4">Mô tả ngắn</h2>
                <p class="text-gray-700"><?= htmlspecialchars($course['description']) ?></p>
            </div>

            <h2 class="text-2xl font-bold mt-6">Nội dung khóa học</h2>
            <p class="text-sm text-gray-500"><?= $course['sections'] ?> phần • <?= $course['lectures'] ?> bài giảng •
                Tổng thời lượng <?= $course['hours'] ?> giờ</p>

            <?php for ($s = 1; $s <= $course['sections']; $s++): ?>
                <details class="group border rounded mt-4">
                    <summary class="flex justify-between p-3 bg-gray-50 group-open:bg-gray-100">
                        <div class="font-medium"><i
                                class="fa-solid fa-chevron-down me-2 transition-transform duration-300 group-open:rotate-180"></i>Phần
                            <?= $s ?>: Tiêu đề phần <?= $s ?>
                        </div>
                        <div class="text-sm text-gray-600">3 bài giảng • 26 phút</div>
                    </summary>
                    <div class="p-3 border-t">
                        <ul class="space-y-2">
                            <li class="flex justify-between items-center">
                                <div>1. Bài học ví dụ</div>
                                <div class="flex gap-2">
                                    <a href="#" class="text-sm text-blue-600">Sửa</a>
                                    <button class="text-sm text-red-600">Xóa</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </details>
            <?php endfor; ?>

            <div class="mt-8">
                <h3 class="text-lg font-semibold">Đánh giá của học viên</h3>
                <p class="text-sm text-gray-500">Bạn có thể quản lý và trả lời đánh giá ở đây.</p>

                <div class="mt-4 space-y-4">
                    <?php foreach ($reviews as $r): ?>
                        <div class="border w-full p-5">
                            <div class="flex gap-5">
                                <div class="w-15 h-15">
                                    <img class="rounded-full"
                                        src="<?= $r['avatar'] ?>"
                                        alt="" />
                                </div>
                                <div>
                                    <p><?= htmlspecialchars($r['name']) ?></p>
                                    <p class="text-xs mt-3">
                                    <p>Đánh giá: <?= htmlspecialchars($r['rating']) ?> <i class="bi bi-star-fill text-yellow-400"></i>
                                        <span class="ms-2"><?= htmlspecialchars(date($r['date'])) ?></span>
                                    </p>
                                </div>
                            </div>
                            <p class="mt-3 text-justify">
                                <?= htmlspecialchars($r['text']) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-span-3 hidden lg:block">
            <div class="sticky top-4 h-max p-4 shadow-md">
                <div>
                    <h3 class="text-[1.2rem] mb-3">Khóa học này bao gồm:</h3>
                    <div class="grid grid-cols-10 gap-y-2">
                        <p class="col-span-1"><i class="fa-solid fa-video"></i></p>
                        <p class="col-span-9">24 giờ video</p>
                        <p class="col-span-1"><i class="fa-solid fa-book"></i></p>
                        <p class="col-span-9">20 bài học</p>
                        <p class="col-span-1">
                            <i class="fa-solid fa-mobile-screen"></i>
                        </p>
                        <p class="col-span-9">Truy cập trên di động và máy tính</p>
                        <p class="col-span-1"><i class="fa-solid fa-infinity"></i></p>
                        <p class="col-span-9">Truy cập trọn đời</p>
                        <p class="col-span-1"><i class="fa-solid fa-trophy"></i></p>
                        <p class="col-span-9">Chứng nhận hoàn thành</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>