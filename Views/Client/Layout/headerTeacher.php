<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./Assets/Client/css/style.css">

</head>

<header class="bg-white border-b border-gray-200 relative shadow-sm z-10">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <button id="teacher-menu-btn" aria-label="Toggle menu"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <a href="index.php?page=teacher" class="flex items-center gap-3 text-gray-900 no-underline">
                    <span class="hidden sm:inline-block font-semibold">Learnix - Giảng viên</span>
                </a>

                <nav class="hidden md:flex items-center space-x-3 ml-6">
                    <a href="index.php?page=teacher"
                        class="px-3 py-2 rounded text-sm font-medium text-gray-700 hover:text-blue-600">Khóa học của
                        tôi</a>
                    <a href="index.php?page=teacher&action=statistic"
                        class="px-3 py-2 rounded text-sm font-medium text-gray-700 hover:text-blue-600">Thống kê</a>
                </nav>
            </div>

            <div class="flex items-center gap-3">



                <div>
                    <button id="teacher-profile-btn" aria-haspopup="true" aria-expanded="false"
                        class="hidden md:inline-flex items-center gap-2 px-2 py-1 rounded-md hover:text-blue-600 focus:outline-none">
                        <span class="hidden sm:inline-block text-sm text-gray-700">Giảng viên</span>
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="teacher-profile-menu"
                        class="absolute hidden top-full mt-0 right-0 w-56 rounded-md shadow bg-white border border-gray-200 z-50"
                        style="top:calc(100% - 1px);">
                        <div class="py-1">
                            <a href="index.php?page=teacher&action=profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Thông tin cá nhân</a>
                            <a href="index.php?page=logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="teacher-mobile-panel" class="hidden md:hidden">
        <div class="border-t bg-white">
            <div class="px-4 py-3 flex flex-col space-y-1">
                <a href="index.php?page=myCourses"
                    class="px-3 py-2 rounded text-sm font-medium text-gray-700 hover:text-blue-600">Khóa học của tôi</a>
                <a href="index.php?page=statistics"
                    class="px-3 py-2 rounded text-sm font-medium text-gray-700 hover:text-blue-600">Thống kê</a>
                <a href="index.php?page=profile"
                    class="px-3 py-2 rounded text-sm font-medium text-gray-700 hover:text-blue-600">Thông tin cá nhân</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const menuBtn = document.getElementById('teacher-menu-btn');
            const mobilePanel = document.getElementById('teacher-mobile-panel');
            const profileBtn = document.getElementById('teacher-profile-btn');
            const profileMenu = document.getElementById('teacher-profile-menu');

            if (menuBtn && mobilePanel) {
                menuBtn.addEventListener('click', function () {
                    mobilePanel.classList.toggle('hidden');
                });
            }

            if (profileBtn && profileMenu) {
                profileBtn.addEventListener('click', function (e) {
                    const expanded = profileBtn.getAttribute('aria-expanded') === 'true';
                    profileBtn.setAttribute('aria-expanded', String(!expanded));
                    profileMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function (e) {
                    if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
                        profileMenu.classList.add('hidden');
                        profileBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        })();
    </script>
</header>