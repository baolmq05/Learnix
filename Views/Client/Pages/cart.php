    <main>
        <section class="mx-0 grid justify-center m-5">
            <h2 class="text-4xl font-bold my-5">Giỏ hàng</h2>
            <!-- <p class="text-gray-600">Giỏ hàng của bạn hiện đang trống.</p> -->
            <div class="grid lg:grid-cols-3 sm:grid-cols-1 gap-4">
                <div class="col-span-2 gap-4">
                    <p class="border-b-2 border-gray-300 my-5 pb-5">Khóa học trong giỏ hàng</p>
                    <div class="cart flex justify-between border-b-2 border-gray-300 pb-5 gap-16">
                        <a href="#" class="flex">
                            <div class="lg:w-1/3 md:w-1/3 sm:w-[250px] h-[100px]">
                                <img src="https://r2s.edu.vn/wp-content/uploads/2023/04/1.cac-khoa-hoc-cntt-online-co-chung-chi-cho-dan-it.png"
                                    alt="Course Image" class="w-full h-full object-cover">
                            </div>
                            <div class="flex flex-col mx-4">
                                <p class="text-xl font-bold max-w-[250px] text-justify">Khóa học PHP cơ bản do cô Chi giảng dạy</p>
                                <p class="text-gray-700 text-sm">Nguyễn Hoàng Bảo</p>
                                <div class="lg:flex align-center">
                                    <p class="bg-green-500 rounded text-white w-30 px-2 my-1">Bán chạy nhất</p>
                                    <div class="flex">
                                        <p class="ms-3">4.0</p>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <ul class="grid sm:grid-cols-3 gap-2 text-sm text-gray-600 list-disc sm:py-5">
                                    <li>Tổng số 25 giờ</li>
                                    <li>200 bài giảng</li>
                                    <li>Sơ cấp</li>
                                </ul>
                            </div>
                        </a>
                        <div class="flex flex-col justify-center">
                            <!-- Nút mở modal -->
                            <button id="openModalBtn"
                                class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 shadow">
                                Xóa
                            </button>
                            <!-- Modal -->
                            <div id="modal-id"
                                class="hidden min-w-screen h-screen animated fadeIn faster fixed left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
                                <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
                                <div class="w-full max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg bg-white">
                                    <div class="text-center p-5 flex-auto justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h2 class="text-xl font-bold py-4">Thông báo</h2>
                                        <p class="text-sm text-gray-500 px-8">
                                            Bạn có chắc muốn xóa <b>Khóa học PHP cơ bản</b> khỏi giỏ hàng không?
                                        </p>
                                    </div>

                                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                                        <button id="cancelBtn"
                                            class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                                            Hủy
                                        </button>
                                        <a class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600"
                                            href="#">Xóa</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mx-auto">
                            <div class="font-bold text-xl">10.309.000₫</div>
                            <s class="text-gray-500 text-sm">399.000 ₫</s>
                        </div>
                    </div>
                </div>
                <div class="sm:mx-3 grid grid-cols-1 w-screen sm:w-full bottom-0 left-0 fixed sm:static bg-white rounded p-5">
                    <p class="my-1 sm:my-5 sm:py-5">Tổng giá:</p>
                    <div class="grid grid-cols-1">
                        <p class="font-bold text-4xl">309.000 ₫</p>
                        <s class="text-gray-500 text-xl">399.000 ₫</s>
                        <p class="text-xl italic my-2">Giảm 10%</p>
                        <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded sm:mt-10">Thanh toán
                            ngay</button>
                        <small class="text-gray-400 my-2 text-center">Bạn sẽ không bị tính phí ngay bây giờ</small>
                    </div>
                </div>
            </div>
        </section>
    </main>