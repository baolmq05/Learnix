<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnix - Chia sẻ kiến thức của bạn</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: 'Inter', sans-serif;
            }
        }
    </style>

    <style>
        /* Giả lập disable cho thẻ A */
        .disabled-link {
            pointer-events: none;
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col h-screen">

    <nav class="bg-white shadow-md w-full px-4 sm:px-6 lg:px-8" style="min-height: 65px;">
        <div class="max-w-7xl mx-auto h-full flex items-center justify-between">
            <div class="flex-1 min-w-0">
                <a href="#" class="flex items-center">
                    <span class="text-2xl font-bold text-stone-900">Learnix</span>
                </a>
            </div>

            <div class="flex-1 min-w-0 text-center px-4 hidden md:block">
                <a href="#" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Giảng dạy với Learnix
                </a>
            </div>

            <div class="flex-1 min-w-0 flex justify-end">
                <a href="/logout" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Thoát
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex flex-col md:flex-row overflow-y-auto">

        <div class="w-full md:w-1/2 bg-white p-8 md:p-16 lg:p-24 flex flex-col justify-center order-2 md:order-1">
            <div class="max-w-md mx-auto w-full">

                <div class="mb-8 text-gray-600 text-sm">
                    <span class="font-bold text-gray-800">Bước 2</span> trong 3
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                        <div class="bg-blue-600 h-1 rounded-full w-2/3"></div>
                    </div>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-6">Tạo một khóa học</h1>

                <p class="text-gray-700 leading-relaxed mb-8">
                    Trong nhiều năm qua, chúng tôi đã giúp hàng ngàn giảng viên học cách tự quay phim tại nhà...
                </p>

                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Bạn chuyên nghiệp đến mức nào trong lĩnh vực video?
                </h2>

                <form class="space-y-4" id="experience-form">
                    <label class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600 focus:ring-purple-500" name="01">
                        <span class="ml-3 text-lg text-gray-800">Tôi là người mới bắt đầu</span>
                    </label>

                    <label class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600 focus:ring-purple-500" name="01">
                        <span class="ml-3 text-lg text-gray-800">Tôi có một số kiến thức</span>
                    </label>

                    <label class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600 focus:ring-purple-500" name="01">
                        <span class="ml-3 text-lg text-gray-800">Tôi có kinh nghiệm</span>
                    </label>

                    <label class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600 focus:ring-purple-500" name="01">
                        <span class="ml-3 text-lg text-gray-800">Tôi có video sẵn sàng để tải lên</span>
                    </label>
                </form>

                <div class="mt-8 flex justify-between">
                    <a href="?page=step&action=step1" class="w-full md:w-auto px-8 py-3 border-purple-700 border text-purple-800 font-bold rounded-lg hover:opacity-[0.8] cursor-pointer transition duration-200">
                        Trở lại
                    </a>

                    <!-- LINK TIẾP TỤC -->
                    <a id="continue-btn"
                        href="?page=step&action=step3"
                        class="disabled-link w-full md:w-auto px-8 py-3 bg-purple-700 text-white font-bold rounded-lg hover:bg-purple-800 transition duration-200">
                        Tiếp tục
                    </a>
                </div>

            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white flex justify-center items-center p-8 order-1 md:order-2">
            <img src="https://s.udemycdn.com/teaching/record-your-video-2x-v3.jpg"
                alt="Người đang làm việc trên máy tính"
                class="max-w-full h-auto object-contain"
                style="max-height: 400px;">
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = document.querySelectorAll('.experience-option');
            const continueBtn = document.getElementById('continue-btn');

            const selectedClasses = ['border-purple-600', 'ring-2', 'ring-purple-200', 'bg-purple-50'];
            const defaultClasses = ['border-gray-300'];

            options.forEach(option => {
                option.addEventListener('click', function() {

                    options.forEach(opt => {
                        opt.classList.remove(...selectedClasses);
                        opt.classList.add(...defaultClasses);
                    });

                    this.classList.remove(...defaultClasses);
                    this.classList.add(...selectedClasses);

                    this.querySelector('input[type="radio"]').checked = true;

                    // Bật nút tiếp tục
                    continueBtn.classList.remove('disabled-link');
                });
            });
        });
    </script>

</body>

</html>