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
                    <span class="font-bold text-gray-800">Bước 1</span> trong 3
                    <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                        <div class="bg-blue-600 h-1 rounded-full w-1/3"></div>
                    </div>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-6">Chia sẻ kiến thức của bạn</h1>

                <p class="text-gray-700 leading-relaxed mb-8">
                    Các khóa học trên Learnix là những trải nghiệm học tập dựa trên video...
                </p>

                <h2 class="text-xl font-semibold text-gray-800 mb-6">Bạn đã từng giảng dạy loại hình nào trước đây?
                </h2>

                <form class="space-y-4" id="experience-form">
                    <label
                        class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600" name="experience">
                        <span class="ml-3 text-lg text-gray-800">Trực tiếp, không chính thức</span>
                    </label>
                    <label
                        class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600" name="experience">
                        <span class="ml-3 text-lg text-gray-800">Trực tiếp, chuyên nghiệp</span>
                    </label>
                    <label
                        class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600" name="experience">
                        <span class="ml-3 text-lg text-gray-800">Trực tuyến</span>
                    </label>
                    <label
                        class="experience-option flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-200">
                        <input type="radio" class="form-radio h-5 w-5 text-purple-600" name="experience">
                        <span class="ml-3 text-lg text-gray-800">Khác</span>
                    </label>
                </form>

                <div class="mt-8">
                    <a href="?page=step&action=step2" id="continue-btn"
                        class="w-full md:w-auto px-8 py-3 bg-purple-700 text-white font-bold rounded-lg transition duration-200 focus:outline-none focus:ring-4 focus:ring-purple-300 opacity-50 pointer-events-none select-none">
                        Tiếp tục
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white flex justify-center items-center p-8 order-1 md:order-2">
            <img src="https://s.udemycdn.com/teaching/plan-your-curriculum-2x-v3.jpg" alt="Người đang làm việc trên máy tính"
                class="max-w-full h-auto object-contain" style="max-height: 400px;">
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
                    // Reset tất cả về mặc định
                    options.forEach(opt => {
                        opt.classList.remove(...selectedClasses);
                        opt.classList.add(...defaultClasses);
                    });

                    // Áp dụng selected vào option click
                    this.classList.remove(...defaultClasses);
                    this.classList.add(...selectedClasses);

                    // Check radio
                    this.querySelector('input[type="radio"]').checked = true;

                    // Kích hoạt nút tiếp tục (remove disable)
                    continueBtn.classList.remove("opacity-50", "pointer-events-none", "select-none");
                });
            });
        });
    </script>

</body>

</html>