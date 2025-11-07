<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnix</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <nav class="bg-white shadow px-4 py-3 relative">
        <div class="max-w-full  mx-auto flex items-center justify-between mb-3">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-2">
                <span class="text-2xl font-bold text-stone-900">Learnix</span>
            </a>

            <!-- Ô tìm kiếm -->
            <div
                class="flex items-center border rounded-full overflow-hidden w-2xl bg-white focus-within:ring-2 focus-within:ring-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 text-gray-500 ml-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z" />
                </svg>

                <input type="text" placeholder="Tìm khóa học..." class="flex-1 px-3 py-2 outline-none text-gray-700" />
            </div>

            <div>
                <a href="">
                    <span class="text-gray-700 hover:text-blue-600 transition-colors duration-200">Khám phá</span>
                </a>

            </div>

            <!-- Icon -->
            <div class="flex items-center space-x-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-gray-700 hover:text-blue-600 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </div>
        </div>
        <hr class="absolute bottom-2 left-0 w-full border-t-2 border-stone-300">

    </nav>
</body>

</html>