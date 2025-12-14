<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$isLoggedIn = false;
if (!empty($_SESSION['client'])) {
    $isLoggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnix</title>
    <link rel="shortcut icon" href="https://res.cloudinary.com/dfmoftnpw/image/upload/v1765528592/logo_sajaxq.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./Assets/Client/css/header.css">
    <link rel="stylesheet" href="./Assets/Client/css/style.css">
    <link rel="stylesheet" href="./Assets/Client/css/Alert.css" />

</head>

<style>
    .dot {
        width: 6px;
        height: 6px;
        background: #6b7280;
        border-radius: 9999px;
        animation: bounce 1.4s infinite ease-in-out;
    }

    .dot:nth-child(2) {
        animation-delay: .2s;
    }

    .dot:nth-child(3) {
        animation-delay: .4s;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: translateY(0);
            opacity: .3
        }

        40% {
            transform: translateY(-6px);
            opacity: 1
        }
    }
</style>

<body class="">
    <!-- Chat Bot -->
    <button
        id="chatToggle"
        class="fixed bottom-6 right-6 w-14 h-14 rounded-full
         bg-gradient-to-r from-purple-500 to-blue-400
         text-white flex items-center justify-center
         shadow-xl hover:scale-105 transition z-50">
        <img src="https://res.cloudinary.com/dfmoftnpw/image/upload/v1765528592/logo_sajaxq.jpg" class="w-8 h-8 rounded-full">
    </button>

    <div
        id="chatBox" class="fixed bottom-24 right-6 w-[360px] h-[520px]
                            bg-white rounded-2xl shadow-xl
                            flex flex-col overflow-hidden
                            transition-all duration-300
                            scale-0 opacity-0 origin-bottom-right z-40">
        <!-- Header -->
        <div class="flex justify-between bg-gradient-to-r from-purple-500 to-blue-400 text-white px-4 py-3 font-semibold flex items-center gap-2">
            <p>Learnix Chatbot</p>
            <button id="close_chat"><i class="bi bi-x-lg hover:text-black"></i></button>
        </div>

        <!-- Chat body -->
        <div id="chatBody" class="flex-1 flex flex-col gap-3 p-4 overflow-y-auto bg-slate-50">
            <div class="max-w-[75%] bg-slate-200 text-slate-800 px-4 py-2 rounded-2xl text-sm">
                Chào bạn, mình có thể giúp bạn chọn khóa học phù hợp!
            </div>
            <?php
            if (isset($_SESSION["history_chat"])):
                $historyResult = json_decode($_SESSION["history_chat"], true) ?? "";
                foreach ($historyResult as $value):
            ?>
                    <?php
                    if ($value["role"] == "model"):
                    ?>
                        <div class="max-w-[75%] bg-slate-200 text-slate-800 px-4 py-2 rounded-2xl text-sm">
                            <?= $value["text"] ?? "" ?>
                        </div>
                    <?php
                    else:
                    ?>
                        <div class="ml-auto max-w-[75%] bg-gradient-to-r from-purple-500 to-blue-400 text-white px-4 py-2 rounded-2xl text-sm shadow">
                            <?= $value["text"] ?? "" ?>
                        </div>
                    <?php
                    endif;
                    ?>
            <?php
                endforeach;
            endif;
            ?>
            <div id="typingIndicator" class="hidden self-start max-w-[60px] bg-slate-200 px-3 py-2 rounded-2xl">
                <div class="flex gap-1"> <span class="dot"></span> <span class="dot"></span> <span class="dot"></span> </div>
            </div>
        </div>

        <!-- Input -->
        <div class="border-t p-3 flex gap-2 bg-white">
            <input
                id="messageInput"
                type="text"
                placeholder="Nhập câu hỏi..."
                class="flex-1 px-4 py-2 text-sm rounded-full border focus:outline-none focus:ring-2 focus:ring-purple-400">
            <button
                id="sendBtn"
                type="button"
                class="bg-gradient-to-r from-purple-500 to-blue-400 text-white px-4 rounded-full hover:opacity-90 transition">
                Gửi
            </button>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        var historyChat;

        <?php
        if (isset($_SESSION['history_chat'])):
        ?>
            historyChat = <?= $_SESSION['history_chat'] ?>;
        <?php
        else:
        ?>
            historyChat = [];
        <?php
        endif;
        ?>

        const messageInput = document.getElementById('messageInput');
        const chatBody = document.getElementById('chatBody');
        const sendBtn = document.getElementById('sendBtn');
        const chatToggle = document.getElementById('chatToggle');
        const chatBox = document.getElementById('chatBox');
        const typingIndicator = document.getElementById('typingIndicator');
        const closeChat = document.getElementById("close_chat");

        let isBotTyping = false;

        /* Toggle chat */
        chatToggle.addEventListener('click', () => {
            chatBox.classList.toggle('scale-0');
            chatBox.classList.toggle('opacity-0');
            scrollChatToBottom();
        });

        closeChat.addEventListener('click', () => {
            chatBox.classList.toggle('scale-0');
            chatBox.classList.toggle('opacity-0');
            scrollChatToBottom();
        });

        /* Typing control */
        function showTyping() {
            isBotTyping = true;
            messageInput.disabled = true;
            sendBtn.disabled = true;

            typingIndicator.classList.remove('hidden');
            chatBody.appendChild(typingIndicator);
            
            scrollChatToBottom(true);
        }

        function hideTyping() {
            isBotTyping = false;
            messageInput.disabled = false;
            sendBtn.disabled = false;

            typingIndicator.classList.add('hidden');
        }

        /* Add message */
        function addMessage(text, role) {
            const wrapper = document.createElement('div');

            if (role === 'user') {
                wrapper.className =
                    'ml-auto max-w-[75%] bg-gradient-to-r from-purple-500 to-blue-400 text-white px-4 py-2 rounded-2xl text-sm shadow';
                wrapper.textContent = text;
                saveHistory(text, "user");
            } else {
                wrapper.className = 'max-w-[75%] bg-slate-200 text-slate-800 px-4 py-2 rounded-2xl text-sm';
                wrapper.innerHTML = text; // HTML từ AI
                saveHistory(text, "model");
            }

            chatBody.appendChild(wrapper);
            scrollChatToBottom(true);
        }

        function scrollChatToBottom(force = false) {
            // Đợi DOM render xong (rất quan trọng)
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    chatBody.scrollTop = chatBody.scrollHeight;

                    // fallback nếu browser lag
                    if (force) {
                        setTimeout(() => {
                            chatBody.scrollTop = chatBody.scrollHeight;
                        }, 50);
                    }
                });
            });
        }

        /* Send message */
        function handleSend() {
            if (isBotTyping) return;

            const message = messageInput.value.trim();
            if (!message) return;

            addMessage(message, 'user');
            messageInput.value = '';

            showTyping();

            ajaxControl();
        }

        /* Enter key */
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                handleSend();
            }
        });

        /* Button */
        sendBtn.addEventListener('click', handleSend);

        /* AJAX */
        function ajaxControl() {
            $.ajax({
                url: "../../../Controllers/Client/Ajax/AjaxChatBotController.php",
                type: "POST",
                data: {
                    history: JSON.stringify(historyChat)
                },
                success: function(response) {
                    console.log(response)

                    let resultMessage = cleanBotResponse(response)

                    hideTyping();
                    console.log(response);
                    addMessage(resultMessage, 'bot');

                    scrollChatToBottom(true);
                },
                error: function() {
                    hideTyping();
                    addMessage('Có lỗi xảy ra, vui lòng thử lại.', 'bot');
                }
            });
        }

        function cleanBotResponse(html) {
            return html
                .replace(/```html/gi, '')
                .replace(/```/g, '')
                .replace(/^"+|"+$/g, '') // bỏ dấu "
                .trim();
        }

        function saveHistory(text, role) {
            if (role == "user") {
                historyChat.push({
                    role: "user",
                    text: text
                })
            } else {
                historyChat.push({
                    role: "model",
                    text: text
                })
            }

            $.ajax({
                url: "../../../Controllers/Client/Ajax/AjaxChatBotHistory.php",
                type: "POST",
                data: {
                    history: JSON.stringify(historyChat)
                },
                success: function(response) {
                    console.log("Kết quả của session");
                    console.log(JSON.parse(response));
                },
                error: function() {
                    hideTyping();
                    addMessage('Có lỗi xảy ra, vui lòng thử lại.', 'bot');
                }
            });
        }
    </script>
    <nav class="bg-white shadow px-6 pt-3 pb-2 relative">
        <div class="max-w-full mx-auto flex items-center justify-between mb-3">

            <div class="flex space-x-4">
                <button id="mobile-menu-btn" class="text-2xl text-gray-700 md:hidden" aria-label="Open menu">
                    <i class="bi bi-list"></i>
                </button>
                <a href="index.php?page=home" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-stone-900">Learnix</span>
                </a>
            </div>
            <div class="relative inline-block hidden md:block">
                <ul class="flex items-center">
                    <li class="relative hidden md:inline-block" data-dropdown-target="explore-dropdown">
                        <a href="?page=category_product"
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
            <!-- Search -->
            <div class="relative">
                <div
                    class="hidden md:flex items-center border rounded-full overflow-hidden w-40 h-11 sm:w-64 md:w-96 bg-white focus-within:ring-[0.5px]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-gray-500 ml-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                    </svg>
                    <input type="text" id="searchInput" placeholder="Tìm khóa học..." name="q"
                        class="flex-1 px-3 py-1 outline-none text-gray-700 text-sm" autocomplete="off" />
                </div>

                <!-- Box gợi ý -->
                <div id="suggestBox"
                    class="absolute left-0 w-full bg-white border border-gray-300 rounded-lg shadow hidden max-h-64 overflow-y-auto z-50 mt-1">
                </div>
            </div>
            <!-- end Search -->
            <div class="relative inline-block hidden md:block">
                <ul class="flex items-center space-x-6">
                    <li class="relative hidden md:inline-block" data-dropdown-target="teach-dropdown">
                        <a href="<?= (
                                        !$isLoggedIn
                                        ? '?page=login'
                                        : (
                                            (($_SESSION['client']['role'] ?? 0) == 1)
                                            ? '?page=about_teacher'
                                            : (
                                                (
                                                    ($_SESSION['client']['information'] ?? null) === null ||
                                                    ($_SESSION['client']['bank_name'] ?? null) === null ||
                                                    ($_SESSION['client']['bank_number'] ?? null) === null
                                                )
                                                ? '?page=teacher&action=editProfile'
                                                : (
                                                    (($_SESSION['client']['role'] ?? 0) == 2)
                                                    ? '?page=teacher'
                                                    : '?page=about_teacher'
                                                )
                                            )
                                        )
                                    ) ?>" class="inline-flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="dropdown-trigger">Giảng dạy với Learnix</span>
                        </a>

                    </li>
                    <li class="relative hidden md:inline-block" data-dropdown-target="learning-dropdown">
                        <a href="?page=course_learning"
                            class="inline-flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition-colors duration-200"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="dropdown-trigger">Học tập</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <ul class="flex item-center space-x-4 md:space-x-6">
                    <!-- <li class="md:block" data-dropdown-target="wishlist-dropdown">
                        <i class="bi bi-heart text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                    </li> -->
                    <li class="md:block" data-dropdown-target="cart-dropdown">
                        <a href="?page=cart">
                            <i class="bi bi-cart3 text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                        </a>
                    </li>
                    <!-- <li class="hidden md:block" data-dropdown-target="notification-dropdown">
                        <a href="?page=notification">
                            <i class="bi bi-bell text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                        </a>
                    </li> -->
                    <li class="hidden md:block" data-dropdown-target="profile-dropdown">
                        <?php
                        $avatar = $_SESSION["client"]["avatar"] ?? "";
                        $hasAvatar = !empty($avatar);
                        ?>

                        <a href="<?= $isLoggedIn ? '?page=profile' : '?page=login' ?>">
                            <?php if ($hasAvatar): ?>
                                <img
                                    src="<?= htmlspecialchars('./Uploads/Avatar/' . $avatar) ?>"
                                    alt="Avatar"
                                    class="w-8 h-8 rounded-full object-cover border border-gray-300 cursor-pointer">
                            <?php else: ?>
                                <i class="bi bi-person-circle text-2xl text-gray-700 hover:text-blue-600 cursor-pointer"></i>
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="explore-dropdown"
            class="dropdown-menu absolute w-56 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-55">
            <ul class="max-h-100 overflow-y-auto">
                <li>
                    <a href="?page=category_product" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tất
                        cả khóa học</a>
                </li>
                <?php foreach ($categories as $cat): ?>
                    <li>
                        <a href="?page=category_product&category_id=<?= $cat['id'] ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?= $cat['name'] ?> (<?= $cat['total_courses'] ?>)</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="wishlist-dropdown"
            class="dropdown-menu absolute w-100 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <div class="p-4 text-center text-sm text-gray-700">
                <p class="mb-2">Danh sách yêu thích trống</p>
                <a href="#" class="text-blue-600 font-medium">Khám phá các khóa học</a>
            </div>
        </div>
        <!-- Cart here -->
        <div id="cart-dropdown"
            class="dropdown-menu absolute right-0 w-72 bg-white rounded shadow-xl border border-gray-300 
     opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50 m-0">
            <div id="cart-icon" class="p-3 text-sm text-gray-700">
                <p class="font-medium mb-2">Giỏ hàng</p>
                <div id="cartDropdownItems">
                    <?php if (empty($cartItems)) : ?>
                        <div class="text-gray-500">Chưa có sản phẩm trong giỏ hàng.</div>
                    <?php endif; ?>
                    <ul class="overflow-y-auto scrollbar-hide max-h-[150px]">

                        <?php foreach ($cartItems as $item) : ?>
                            <li class="flex items-center mb-3">
                                <a href="?page=course_detail&id=<?= $item['id'] ?>" class="flex items-center flex-1">
                                    <img src="Uploads/Courses/<?= $item['image'] ?>"
                                        alt="<?= $item['course_name'] ?>"
                                        class="w-12 h-12 rounded mr-3 object-cover">
                                    <div class="flex-1">
                                        <p class="font-bold text-sm two-line-ellipsis me-3"><?= $item['course_name'] ?></p>
                                    </div>
                                </a>
                                <div class="text-wrap">
                                    <?php if ($item['sale_price'] != 0): ?>
                                        <div class="text-gray-800 font-medium">
                                            <?= number_format($item['sale_price'], 0, ',', '.') . '₫' ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-gray-800 font-medium <?= $item['sale_price'] != 0 ? 'line-through text-gray-400' : '' ?>">
                                        <?= number_format($item['regular_price'], 0, ',', '.') . '₫' ?>
                                    </div>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="mt-3 text-right">
                    <a href="?page=cart" class="inline-block px-3 py-1 bg-blue-600 text-white rounded text-sm">
                        Xem giỏ hàng
                    </a>
                </div>
            </div>
        </div>
        <!-- end cart -->
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
        <div id="profile-dropdown"
            class="dropdown-menu absolute w-48 bg-white rounded border-t border-gray-200 shadow-sm opacity-0 invisible translate-y-0 transition-all duration-200 pointer-events-none z-50">
            <ul class="py-1 text-sm text-gray-700">
                <?php if ($isLoggedIn): ?>
                    <li><a href="?page=profile" class="block px-4 py-2 hover:bg-gray-100">Thông tin cá nhân</a></li>
                    <li><a href="?page=my_courses" class="block px-4 py-2 hover:bg-gray-100">Khóa học của tôi</a></li>
                    <li><a href="?page=payments" class="block px-4 py-2 hover:bg-gray-100">Lịch sử thanh toán</a></li>
                    <li>
                        <hr class="my-1 border-gray-200">
                    </li>
                    <li><a href="?page=logout" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Đăng xuất</a></li>
                <?php else: ?>
                    <li><a href="?page=login" class="block px-4 py-2 hover:bg-gray-100">Đăng nhập</a></li>
                    <li><a href="?page=register" class="block px-4 py-2 hover:bg-gray-100">Đăng ký</a></li>
                <?php endif; ?>
            </ul>
        </div>

    </nav>
    <div class="bg-white shadow hidden md:block">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="relative w-[90%] mx-auto">
                <!-- Nút trái -->
                <button id="btnLeft"
                    class="absolute lg:left-[-40px] px-3 left-0 top-1/2 -translate-y-1/2 bg-white border border-gray-300 shadow p-2 rounded-full z-10">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <!-- Thanh category cuộn ngang -->
                <nav id="catSlider"
                    class="flex items-center justify-center overflow-x-auto space-x-6 py-3 text-sm scroll-smooth no-scrollbar">
                    <?php foreach ($categories as $cat) : ?>
                        <a href="?page=category_product&category_id=<?= $cat['id'] ?>"
                            class="text-gray-600 hover:text-blue-600 whitespace-nowrap px-2">
                            <?= $cat['name'] ?>(<?= $cat['total_courses'] ?>)
                        </a>
                    <?php endforeach; ?>
                </nav>

                <!-- Nút phải -->
                <button id="btnRight"
                    class="absolute lg:right-[-40px] px-3 right-0 top-1/2 -translate-y-1/2 bg-white shadow border border-gray-300 p-2 rounded-full z-10">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

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
                <a href="?page=category_product"
                    class="block py-2 text-lg font-medium text-gray-700 hover:text-blue-600">Khám phá</a>
                <a href="?page=about_teacher" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Giảng dạy với
                    Learnix</a>
                <a href="?page=course_learning" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Khóa học
                    của tôi</a>
                <a href="#" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Danh sách yêu thích</a>
                <a href="?page=notification" class="block py-2 text-lg text-gray-700 hover:text-blue-600">Thông báo</a>
                <hr class="my-3 border-gray-200">
                <?php if ($isLoggedIn): ?>
                    <a href="?page=profile" class="block py-2 text-base text-gray-700 hover:bg-gray-100 px-4">Thông tin cá
                        nhân</a>
                    <a href="?page=payments" class="block py-2 text-base text-gray-700 hover:bg-gray-100 px-4">Lịch sử thanh
                        toán</a>
                    <a href="?page=logout" class="block py-2 text-base text-red-600 hover:bg-gray-100 px-4">Đăng xuất</a>
                <?php else: ?>
                    <a href="?page=login" class="block py-2 text-base text-gray-700 hover:bg-gray-100 px-4">Đăng nhập</a>
                    <a href="?page=register" class="block py-2 text-base text-gray-700 hover:bg-gray-100 px-4">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="mobile-menu-overlay"
        class="fixed inset-0 bg-black opacity-0 invisible transition-opacity duration-300 z-[9998] md:hidden">
    </div>