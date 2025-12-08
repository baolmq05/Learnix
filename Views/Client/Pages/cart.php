<main>
    <section class="mx-0 grid justify-center m-5" id="cart-default">
        <?php if (count($cartItems) == 0): ?>
            <h2 class="text-center text-4xl font-bold my-5">Giỏ hàng</h2>
            <p class="text-center text-gray-600 h-[250px]">Giỏ hàng của bạn hiện đang trống.</p>
        <?php else: ?>
            <h2 class="text-4xl font-bold my-5">Giỏ hàng</h2>
            <div class="grid lg:grid-cols-3 sm:grid-cols-1 gap-4">
                <div class="col-span-2 gap-4">
                    <p class="border-b-2 border-gray-300 my-5 pb-5 text-gray-700">Khóa học trong giỏ hàng</p>
                    <div id="cart-list-container">
                        <?php foreach ($cartItems as $item): ?>
                            <?php $modalId = "modal-" . $item['id']; ?>
                            <div class="cart grid grid-cols-12 border-b-2 border-gray-300 pb-5 mb-3 w-full items-center"
                                data-cart-id="<?= $item['id'] ?>">
                                <div class="col-span-9 flex">
                                    <div class="w-[45%] h-[180px] overflow-hidden rounded">
                                        <img src="<?= $item['image'] ?>" class="w-full h-full object-cover">
                                    </div>
                                    <div class="ml-4 w-[55%]">
                                        <a href="index.php?page=course_detail&id=<?= $item['id'] ?>">
                                            <p class="text-sm font-bold"><?= $item['course_name'] ?></p>
                                        </a>
                                        <p class="text-gray-700 text-sm"><?= $item['instructor'] ?></p>
                                        <div class="flex items-center mt-1">
                                            <p><?= $item['rating'] ?></p>
                                            <svg class="w-4 h-4 text-yellow-300 ml-1" fill="currentColor" viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        </div>
                                        <ul class="grid sm:grid-cols-2 text-sm text-gray-600 list-disc py-2 ms-4">
                                            <li>Tổng số <?= $item['total_length'] ?> giờ</li>
                                            <li><?= $item['total_lesson'] ?> bài giảng</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-span-3 flex flex-col items-end gap-2">
                                    <button onclick="document.getElementById('<?= $modalId ?>').classList.remove('hidden')"
                                        class="bg-red-500 text-white px-6 py-2 rounded-full hover:bg-red-600 shadow">
                                        Xóa
                                    </button>
                                    <div class="text-right">
                                        <div class="<?= ($item['sale_price'] != 0) ? 'font-bold text-xl' : 'hidden' ?>">
                                            <?= number_format($item['sale_price'], 0, ',', '.') ?>₫</div>
                                        <p
                                            class=" <?= ($item['sale_price'] != 0) ? 'line-through text-gray-500 text-sm' : 'font-bold text-xl' ?> ">
                                            <?= number_format($item['regular_price'], 0, ',', '.') ?> ₫</p>
                                    </div>
                                </div>
                            </div>
                            <div id="<?= $modalId ?>"
                                class="hidden min-w-screen h-screen fixed left-0 top-0 flex justify-center items-center z-50 bg-black/60">
                                <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 relative">
                                    <div class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-red-500 mx-auto"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <h2 class="text-xl font-bold py-4">Xác nhận xóa</h2>
                                        <p class="text-gray-500 text-sm">
                                            Bạn có chắc muốn xóa <b><?= $item['course_name'] ?></b> khỏi giỏ hàng không?
                                        </p>
                                    </div>
                                    <div class="text-center mt-6 space-x-3">
                                        <button onclick="document.getElementById('<?= $modalId ?>').classList.add('hidden')"
                                            class="bg-gray-200 px-5 py-2 rounded-full hover:bg-gray-300">
                                            Hủy
                                        </button>
                                        <button onclick="removeCartItem(<?= $item['id'] ?>, '<?= $modalId ?>')"
                                            class="bg-red-500 text-white px-5 py-2 rounded-full hover:bg-red-600">
                                            Xóa
                                        </button>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="sm:mx-3 w-full sm:w-full bottom-0 left-0 fixed sm:static bg-white rounded p-5" id="total_price">
                    <p class="my-1 sm:my-5 sm:py-5">Tổng giá:</p>
                    <div class="grid grid-cols-1">
                        <p class="font-bold text-green-700 text-4xl" id="total-price">
                            <?= number_format($totalPrice, 0, ',', '.') ?>₫
                        </p>

                        <s class="text-gray-500 font-bold text-xl" id="total-no-sale">
                            <?= number_format($totalNoSale, 0, ',', '.') ?>₫
                        </s>
                        <form action="?page=checkout&action=viewCheckout" method="POST">
                            <button type="submit" name="cart" class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors sm:mt-10">
                                Thanh toán ngay
                            </button>
                        </form>

                        <small class="text-gray-400 my-2 text-center">Bạn sẽ không bị tính phí ngay bây giờ</small>
                    </div>`
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function removeCartItem(id, modalId) {
        let userId = <?= $_SESSION['client']['id'] ?? 'null' ?>;
        let courseId = id;

        if (userId === null) {
            showToast("Bạn cần đăng nhập!", "error");
            return;
        }

        $.ajax({
            url: "Controllers/Client/Ajax/AjaxDeleteCart.php",
            type: "POST",
            data: {
                userId: userId,
                courseId: courseId
            },
            success: function (response) {
                let data;
                if (typeof response === "string") {
                    try {
                        data = JSON.parse(response);
                    } catch (e) {
                        console.error("JSON parse lỗi:", e);
                        showToast("Lỗi server!", "error");
                        return;
                    }
                } else {
                    data = response;
                }
                document.getElementById(modalId).classList.add("hidden");

                if (data.status === "success") {
                    showToast(data.message, "success");
                    const cartItem = document.querySelector(`.cart[data-cart-id="${courseId}"]`);
                    if (cartItem) cartItem.remove();
                    $("#total-price").text(data.totalPrice);
                    $("#total-no-sale").text(data.totalNoSale);
                    loadCartHeader();
                    if (!data.hasItems) {
                        $("#cart-default").html(`
                                <h2 class="text-center text-4xl font-bold my-5">Giỏ hàng</h2>
                                <p class="text-center text-gray-600 h-[250px]">Giỏ hàng của bạn hiện đang trống.</p>
                            `);
                        $("#total_price").html("");
                    }

                } else {
                    showToast(data.message, "error");
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                showToast("Lỗi server!", "error");
            }
        });
    }


    function loadCartHeader() {
        $.ajax({
            url: "Controllers/Client/Ajax/AjaxLoadCartHeader.php",
            method: "GET",
            dataType: "json",
            success: function (data) {

                if (data.status === "error") {
                    $("#cartDropdownItems").html(`
                    <div class="p-3 text-center text-sm text-gray-600">
                    Giỏ hàng trống
                    </div>
                    `);
                    $("#cartCount").text(0);
                    return;
                }

                $("#cartDropdownItems").html(data.html);

                $("#cartCount").text(data.count);
            },
            error: function (xhr, status, error) {
                console.error("Load Cart Error:", error);
            }
        });
    }


    function showToast(message, type = "success") {
        const toast = document.createElement("div");

        toast.className =
            "fixed top-5 right-5 px-5 py-3 rounded shadow-lg text-white z-50 animate-slideIn";

        toast.style.background =
            type === "success" ? "#22c55e" : "#ef4444";

        toast.innerText = message;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transition = "0.5s";
            setTimeout(() => toast.remove(), 500);
        }, 2000);
    }
</script>