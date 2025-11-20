<section class="m-5">
        <div class="grid gap-5 order-2 sm:order-1 sm:grid-cols-2">
            <div class="grid sm:justify-end order-2 sm:order-1">
                <div class="col-span-1 w-full border-2 border-gray-500 rounded-lg p-5 sm:m-5">
                    <p class="text-3xl font-bold mb-3">Nạp tiền</p>
                    <div class="mb-3">
                        <div class="relative">
                            <input type="text" id="price" aria-describedby="price-help"
                                class="block rounded-t-base px-2.5 pb-2.5 pt-5 w-full text-sm text-heading bg-success-soft border-0 border-b-2 border-success appearance-none focus:outline-none focus:ring-0 focus:border-success peer"
                                placeholder=" " />
                            <label for="price"
                                class="absolute text-sm text-fg-success-strong duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto flex items-center gap-2">
                                Nhập số tiền</label>
                        </div>
                        <p id="price-help" class="mt-2 text-xs text-gray-700 text-fg-success-strong"><span
                                class="font-medium">Nhập số
                                tiền
                                tối đa 3.000.000₫</span></p>
                        <div class="grid grid-cols-4  sm:grid-cols-3 md:grid-cols-4 mt-3 gap-3">
                            <button
                                class="amount-btn border border-gray-300 rounded-lg p-2 text-sm hover:bg-gray-200 transition-colors duration-300">100.000₫</button>

                            <button
                                class="amount-btn border border-gray-300 rounded-lg p-2 text-sm hover:bg-gray-200 transition-colors duration-300">500.000₫</button>

                            <button
                                class="amount-btn border border-gray-300 rounded-lg p-2 text-sm hover:bg-gray-200 transition-colors duration-300">1.000.000₫</button>

                            <button
                                class="amount-btn border border-gray-300 rounded-lg p-2 text-sm hover:bg-gray-200 transition-colors duration-300">2.000.000₫</button>

                            <button
                                class="amount-btn border border-gray-300 rounded-lg p-2 text-sm hover:bg-gray-200 transition-colors duration-300">3.000.000₫</button>
                        </div>
                    </div>
                    <form action="#">
                        <button
                            class="mt-5 w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                            Nạp tiền
                            </button>
                    </form>

                </div>
            </div>
            <div class="grid order-1 sm:order-2 sm:justify-start">
                <div class="col-span-1 w-full md:w-[500px] p-5">
                    <div class="border-2 border-gray-500 rounded-lg p-4">
                        <p class="text-2xl font-bold text-center">Thông tin chi tiết</p>
                        <p class="mt-3"><span class="font-semibold">Số tài khoản:</span> 123456789</p>
                        <p class="mt-3"><span class="font-semibold">Số dư hiện tại:</span> 500.000₫</p>
                        <p class="mt-3"><span class="font-semibold">Người nạp:</span> Nguyễn Hoàng Bảo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    const input = document.getElementById('price');
    const amountButtons = document.querySelectorAll('.amount-btn');

    const defaultClass = "border border-gray-300 rounded-lg p-2 text-sm hover:bg-gray-200 transition-colors duration-300";
    const activeClass = "border border-blue-600 rounded-lg p-2 text-sm bg-blue-100 text-blue-700";

    amountButtons.forEach(btn => {
        btn.addEventListener('click', () => {

            amountButtons.forEach(b => b.className = defaultClass);

            btn.className = activeClass;

            btn.focus();

            const value = btn.textContent.replace(/[^\d]/g, "");
            input.value = value;

            input.focus();
        });
    });
</script>