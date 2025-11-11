<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <nav class="bg-white shadow px-6 pt-3 pb-2 relative">
        <div class="max-w-full mx-auto flex items-center justify-between mb-3">

            <div class="flex space-x-4">
                <button id="mobile-menu-btn" class="text-2xl text-gray-700 md:hidden" aria-label="Open menu">
                    <i class="bi bi-list"></i>
                </button>
                <a href="#" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-stone-900">Learnix</span>
                </a>
            </div>
            <div class="relative inline-block hidden md:block">
                <ul class="flex items-center">
                    <li class="relative hidden md:inline-block" data-dropdown-target="explore-dropdown">
                        <a href="#"
                            class="inline-flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="dropdown-trigger">Khám phá</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="hidden md:flex items-center border rounded-full overflow-hidden w-40 h-11 sm:w-64 md:w-96 bg-white focus-within:ring-2 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 text-gray-500 ml-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                </svg>
                <input type="text" placeholder="Tìm khóa học..." name="q"
                    class="flex-1 px-3 py-1 outline-none text-gray-700 text-sm" />
            </div>





            <div class="relative inline-block hidden md:block">
                <ul class="flex items-center space-x-6">
                    <li class="relative hidden md:inline-block" data-dropdown-target="teach-dropdown">
                        <a href="#"
                            class="inline-flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="dropdown-trigger">Giảng dạy với Learnix</span>
                        </a>
                    </li>
                    <li class="relative hidden md:inline-block" data-dropdown-target="learning-dropdown">
                        <a href="#"
                            class="inline-flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="dropdown-trigger">Khóa học của tôi</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <ul class="flex item-center space-x-4 md:space-x-6">
                    <li class="md:block" data-dropdown-target="wishlist-dropdown">
                        <i class="bi bi-heart text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                    </li>
                    <li class="md:block" data-dropdown-target="cart-dropdown">
                        <i class="bi bi-cart3 text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                    </li>
                    <li class="hidden md:block" data-dropdown-target="notification-dropdown">
                        <i class="bi bi-bell text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                    </li>
                    <li class="hidden md:block" data-dropdown-target="profile-dropdown">
                        <i class="bi bi-person-circle text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                    </li>
                </ul>
            </div>
        </div>

        <div id="explore-dropdown"
            class="dropdown-menu absolute w-56 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <ul>
                <li>
                    <a href="?page=categoryProduct" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tất
                        cả khóa học</a>
                </li>
                <li>
                    <a href="?page=categoryProduct" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lập
                        trình</a>
                </li>
            </ul>
        </div>
        <div id="wishlist-dropdown"
            class="dropdown-menu absolute w-100 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <div class="p-4 text-center text-sm text-gray-700">
                <p class="mb-2">Danh sách yêu thích trống</p>
                <a href="#" class="text-blue-600 font-medium">Khám phá các khóa học</a>
            </div>
        </div>
        <div id="cart-dropdown"
            class="dropdown-menu absolute w-72 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <div class="p-3 text-sm text-gray-700">
                <p class="font-medium mb-2">Giỏ hàng</p>
                <div class="text-gray-500">Chưa có sản phẩm trong giỏ hàng.</div>
                <div class="mt-3 text-right">
                    <a href="#" class="inline-block px-3 py-1 bg-blue-600 text-white rounded text-sm">Xem giỏ
                        hàng</a>
                </div>
            </div>
        </div>
        <div id="notification-dropdown"
            class="dropdown-menu absolute w-72 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <div class="p-3 text-sm text-gray-700">
                <p class="font-medium mb-2">Thông báo</p>
                <div class="text-gray-500">Bạn không có thông báo mới.</div>
                <ul class="mt-2">
                    <li class="text-xs text-gray-400">—</li>
                </ul>
            </div>
        </div>
        <div id="learning-dropdown"
            class="dropdown-menu absolute w-100 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <div class="p-4 text-center  text-gray-700">
                <p class="mb-2 text-xl">Bắt đầu học ngay hôm nay</p>
                <a href="#"
                    class="inline-block px-3 py-1 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white rounded text-lg">Tìm
                    kiếm</a>
            </div>
        </div>
        <div id="profile-dropdown"
            class="dropdown-menu absolute w-48 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <ul class="py-1 text-sm text-gray-700">
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Thông tin cá nhân</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Khóa học của tôi</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Lịch sử thanh toán</a></li>
                <li>
                    <hr class="my-1 border-gray-200">
                </li>
                <li><a href="/logout" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Đăng xuất</a></li>
            </ul>
        </div>

    </nav>
    <div class="bg-white shadow hidden md:block">
        <div class="max-w-screen-xl mx-auto px-4">
            <nav class="flex items-center overflow-x-auto space-x-6 py-3 text-sm md:justify-center">
                <a href="?page=categoryProduct" class="text-gray-600 hover:text-blue-600 whitespace-nowrap">Lập trình
                    web</a>
                <a href="?page=categoryProduct" class="text-gray-600 hover:text-blue-600 whitespace-nowrap">Lập trình
                    phần mềm</a>
                <a href="?page=categoryProduct" class="text-gray-600 hover:text-blue-600 whitespace-nowrap">Lập trình
                    game</a>
                <a href="?page=categoryProduct" class="text-gray-600 hover:text-blue-600 whitespace-nowrap">Khoa học máy
                    tính</a>
            </nav>
        </div>
    </div>

    <div id="mobile-menu-drawer"
        class="fixed top-0 left-0 h-full w-64 bg-white shadow-2xl z-[9999] transform -translate-x-full transition-transform duration-300 md:hidden">
        <div class="p-4">
            <button id="close-mobile-menu" class="float-right text-2xl text-gray-700" aria-label="Close menu">
                <i class="bi bi-x-lg"></i>
            </button>
            <div class="mt-4 mb-4 md:hidden">
                <form action="/search" method="GET"
                    class="flex items-center border rounded-full overflow-hidden bg-white h-10 ">
                    <input name="q" type="text" placeholder="Tìm khóa học..."
                        class="flex-1 min-w-0 px-3 text-sm outline-none text-gray-700" />
                    <button type="submit"
                        class="px-3 bg-black text-white h-full flex items-center justify-center rounded-r-md"> <svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                        </svg></button>
                </form>
            </div>
            <div class="mt-8 clear-right">
                <a href="#" class="block py-2 text-lg font-medium text-gray-700 hover:text-blue-600">Khám phá</a>
                <a href="#" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Giảng dạy với Learnix</a>
                <a href="#" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Khóa học của tôi</a>
                <a href="#" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Danh sách yêu thích</a>
                <a href="#" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Thông báo</a>
                <hr class="my-3 border-gray-200">
                <a href="#" class="block py-2 text-base text-gray-700 hover:bg-gray-100 px-4">Thông tin cá nhân</a>
                <a href="#" class="block py-2 text-base text-gray-700 hover:bg-gray-100 px-4">Lịch sử thanh toán</a>
                <a href="/logout" class="block py-2 text-base text-red-600 hover:bg-gray-100 px-4">Đăng xuất</a>
            </div>
        </div>
    </div>

    <div id="mobile-menu-overlay"
        class="fixed inset-0 bg-black opacity-0 invisible transition-opacity duration-300 z-[9998] md:hidden">
    </div>