<main>
    <section class="relative mb-10">
        <div class="image-banner-box lg:h-[500px]">
            <img class="w-full h-full lg:object-cover object-contain" src="./Assets/Client/Images/teacherregisterbanner.webp"
                alt="">
        </div>
        <div class="lg:px-0 px-5 lg:grid lg:grid-cols-10 lg:absolute relative top-0 w-full">
            <div class="lg:col-start-3 lg:col-end-5 lg:mt-20">
                <h2 class="lg:text-4xl text-2xl lg:mt-0 mt-3 font-bold mb-3">Hãy đến giảng dạy với chúng tôi</h2>
                <p class="mb-3">Trở thành giảng viên và thay đổi cuộc sống của mọi người, bao gồm cả cuộc sống của
                    chính bạn
                </p>
                <!-- Button open modal -->
                <button onclick="openModal()" class="block hover:opacity-[0.8] py-2 px-4 bg-purple-500 w-full text-white rounded-sm">
                    Đăng ký ngay
                </button>


                <!-- Modal overlay -->
                <div id="modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-lg overflow-hidden">
                        <!-- Modal header -->
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-xl font-semibold">Điều khoản & Chính sách cộng tác giảng viên</h2>
                        </div>


                        <!-- Modal body (scrollable) -->
                        <div class="px-6 py-4 max-h-[60vh] overflow-y-auto space-y-4 text-gray-700">
                            <p>
                                Khi đăng ký trở thành giảng viên trên nền tảng <b>Learnix</b>, bạn đồng ý tuân thủ các điều khoản sau:
                            </p>


                            <h3 class="font-semibold">1. Nội dung khóa học</h3>
                            <p>
                                Giảng viên chịu trách nhiệm hoàn toàn về nội dung giảng dạy, đảm bảo không vi phạm pháp luật,
                                bản quyền hoặc thuần phong mỹ tục.
                            </p>


                            <h3 class="font-semibold">2. Chia sẻ doanh thu</h3>
                            <p>
                                Khi học viên mua khóa học, <b>Learnix thu 10% phí dịch vụ</b> trên mỗi đơn hàng thành công.
                                Giảng viên nhận <b>90% doanh thu</b> còn lại.
                            </p>


                            <h3 class="font-semibold">3. Thanh toán</h3>
                            <p>
                                Doanh thu được đối soát và giảng viên có thể rút tiền mọi lúc theo chính sách của Learnix.
                                Giảng viên có trách nhiệm cung cấp thông tin thanh toán chính xác.
                            </p>


                            <h3 class="font-semibold">4. Chấm dứt hợp tác</h3>
                            <p>
                                Learnix có quyền tạm ngưng hoặc chấm dứt hợp tác nếu giảng viên vi phạm điều khoản hoặc
                                gây ảnh hưởng tiêu cực đến nền tảng.
                            </p>


                            <h3 class="font-semibold">5. Điều khoản chung</h3>
                            <p>
                                Learnix có quyền cập nhật chính sách và sẽ thông báo công khai trên website.
                            </p>
                        </div>


                        <!-- Modal footer -->
                        <div class="px-6 py-4 border-t flex items-center justify-between">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="checkbox" id="agreeCheckbox" class="w-4 h-4" onchange="toggleButton()" />
                                <span>Tôi đã đọc và đồng ý với điều khoản</span>
                            </label>


                            <div class="flex gap-3">
                                <button onclick="closeModal()" class="px-4 py-2 rounded-lg border">
                                    Hủy
                                </button>
                                <button
                                    id="continueBtn"
                                    disabled
                                    onclick="goNext()"
                                    class="block py-2 px-4 bg-purple-500 w-full text-white rounded-sm
                                    opacity-50 cursor-not-allowed transition">
                                    Bắt đầu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-10 mb-10">
        <div class="col-start-2 col-end-10">
            <h2 class="lg:text-4xl text-2xl font-bold text-center mb-5">Có quá nhiều lý do để bắt đầu</h2>
            <div class="grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-10">
                <div class="item text-center lg:my-5 md:my-5 my-3">
                    <div class="item-box h-[150px] text-center">
                        <img class="w-full h-full object-contain"
                            src="https://s.udemycdn.com/teaching/value-prop-teach-2x-v3.jpg" alt="">
                    </div>
                    <h3 class="font-bold text-xl">
                        Giảng dạy theo cách của bạn
                    </h3>
                    <p>
                        Xuất bản khóa học mong muốn, theo cách mong muốn và bạn luôn có quyền kiểm soát nội dung của
                        riêng mình.
                    </p>
                </div>

                <div class="item text-center lg:my-5 md:my-5 my-3">
                    <div class="item-box h-[150px] text-center">
                        <img class="w-full h-full object-contain"
                            src="https://s.udemycdn.com/teaching/value-prop-inspire-2x-v3.jpg" alt="">
                    </div>
                    <h3 class="font-bold text-xl">
                        Giảng dạy theo cách của bạn
                    </h3>
                    <p>
                        Xuất bản khóa học mong muốn, theo cách mong muốn và bạn luôn có quyền kiểm soát nội dung của
                        riêng mình.
                    </p>
                </div>
                <div class="item text-center lg:my-5 md:my-5 my-3">
                    <div class="item-box h-[150px] text-center">
                        <img class="w-full h-full object-contain"
                            src="https://s.udemycdn.com/teaching/value-prop-get-rewarded-2x-v3.jpg" alt="">
                    </div>
                    <h3 class="font-bold text-xl">
                        Giảng dạy theo cách của bạn
                    </h3>
                    <p>
                        Xuất bản khóa học mong muốn, theo cách mong muốn và bạn luôn có quyền kiểm soát nội dung của
                        riêng mình.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-10">
        <div class=" bg-[#5022c3] grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 p-15">
            <div class="text-white  lg:mb-0 mb-3 text-center">
                <h3 class="text-3xl font-bold">
                    80 triệu
                </h3>
                <p>Học viên</p>
            </div>

            <div class="text-white  lg:mb-0 mb-3 text-center">
                <h3 class="text-3xl font-bold">
                    Hơn 75
                </h3>
                <p>Ngôn ngữ</p>
            </div>

            <div class="text-white  lg:mb-0 mb-3 text-center">
                <h3 class="text-3xl font-bold">
                    1,1 tỉ
                </h3>
                <p>Lượt ghi danh</p>
            </div>

            <div class="text-white  lg:mb-0 mb-3 text-center">
                <h3 class="text-3xl font-bold">
                    Hơn 17200
                </h3>
                <p>Khách hàng doanh nghiệp</p>
            </div>
        </div>
    </section>

    <section class="hidden lg:grid grid-cols-10 mb-10">
        <div class="col-start-3 col-end-9">
            <h2 class="text-4xl font-bold text-center mb-3">Cách thức bắt đầu</h2>
            <div class="flex justify-between border-b">
                <h3 class="text-2xl font-bold cursor-pointer my-5 part part1" onclick="changeContentTutorial(this)">
                    Lên
                    kế
                    hoạch
                    cho khung chương trình</h3>
                <h3 class="text-2xl font-bold cursor-pointer opacity-[0.5] my-5 part part2"
                    onclick="changeContentTutorial(this)">Quay
                    video
                </h3>
                <h3 class="text-2xl font-bold cursor-pointer opacity-[0.5] my-5 part part3"
                    onclick="changeContentTutorial(this)">Ra
                    mắt
                    khóa học</h3>
            </div>
            <div class="flex justify-between items-center content content1">
                <p class="basis-[45%] text-lg leading-loose">Hãy bắt đầu với niềm đam mê và kiến thức của bạn. Sau
                    đó,
                    bạn
                    có thể chọn
                    một chủ
                    đề triển vọng với sự trợ giúp của công
                    cụ Thông tin chi tiết về thị trường.

                    Bạn là người quyết định phương pháp cũng như kiến thức giảng dạy.

                    Cách chúng tôi trợ giúp bạn
                    Chúng tôi cung cấp nhiều tài nguyên về cách tạo khóa học đầu tiên. Ngoài ra, bảng điều khiển của
                    giảng viên và trang
                    khung chương trình của chúng tôi sẽ giúp bạn tổ chức khóa học hiệu quả.</p>
                <div class="h-[500px] basis-[45%]">
                    <img class="w-full h-full object-cover"
                        src="https://s.udemycdn.com/teaching/plan-your-curriculum-2x-v3.jpg" alt="">
                </div>
            </div>

            <div class="justify-between items-center hidden content content2">
                <p class="basis-[45%] text-lg leading-loose">
                    Sử dụng các công cụ cơ bản như điện thoại thông minh hoặc camera DSLR. Thêm một chiếc micrô tốt
                    là
                    bạn đã sẵn sàng bắt
                    đầu.

                    Nếu không thích xuất hiện trên camera, bạn chỉ cần ghi lại màn hình của mình. Dù với cách nào
                    thì
                    bạn cũng nên quay
                    video dài từ 2 tiếng trở lên cho khóa học có trả phí.

                    Cách chúng tôi trợ giúp bạn
                    Nhóm Hỗ trợ của chúng tôi luôn sẵn sàng trợ giúp bạn trong suốt quá trình thực hiện và đưa ra
                    phản
                    hồi về video thử
                    nghiệm.
                </p>
                <div class="h-[500px] basis-[45%]">
                    <img class="w-full h-full object-cover"
                        src="https://s.udemycdn.com/teaching/record-your-video-2x-v3.jpg" alt="">
                </div>
            </div>

            <div class="justify-between items-center hidden content content3">
                <p class="basis-[45%] text-lg leading-loose">
                    Thu thập các xếp hạng và đánh giá đầu tiên bằng cách quảng bá khóa học trên mạng xã hội và mạng
                    lưới
                    nghề nghiệp của
                    bạn.

                    Người dùng sẽ dễ dàng khám phá khóa học của bạn trên cổng khóa học của chúng tôi. Đây là nơi bạn
                    kiếm được doanh thu từ
                    mỗi lượt ghi danh có trả phí.

                    Cách chúng tôi trợ giúp bạn
                    Công cụ coupon tùy chỉnh cho phép bạn đưa ra ưu đãi thu hút học viên ghi danh, đồng thời các
                    chương
                    trình quảng cáo toàn
                    cầu của chúng tôi giúp thúc đẩy lưu lượng truy cập vào khóa học. Thậm chí các khóa học còn có
                    nhiều
                    cơ hội được chúng
                    tôi lựa chọn cho tuyển tập Udemy Business.
                </p>
                <div class="h-[500px] basis-[45%]">
                    <img class="w-full h-full object-cover"
                        src="https://s.udemycdn.com/teaching/launch-your-course-2x-v3.jpg" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="lg:hidden mb-10">
        <div class="px-5">
            <h2 class="text-2xl lg:text-4xl font-bold text-center mb-3">Cách thức bắt đầu</h2>
            <div>
                <h3 class="text-xl font-bold mt-5 mb-3">Lên kế hoạch cho khung chương trình</h3>
                <div class="h-[500px] overflow-hidden">
                    <img class="w-full h-full object-cover"
                        src="https://s.udemycdn.com/teaching/plan-your-curriculum-2x-v3.jpg" alt="">
                </div>
                <p>
                    Hãy bắt đầu với niềm đam mê và kiến thức của bạn. Sau đó, bạn có thể chọn một chủ đề triển vọng
                    với
                    sự trợ giúp của công
                    cụ Thông tin chi tiết về thị trường.

                    Bạn là người quyết định phương pháp cũng như kiến thức giảng dạy.

                    Cách chúng tôi trợ giúp bạn
                    Chúng tôi cung cấp nhiều tài nguyên về cách tạo khóa học đầu tiên. Ngoài ra, bảng điều khiển của
                    giảng viên và trang
                    khung chương trình của chúng tôi sẽ giúp bạn tổ chức khóa học hiệu quả.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold mt-5 mb-3">Quay video</h3>
                <div class="h-[500px] overflow-hidden">
                    <img class="w-full h-full object-cover"
                        src="https://s.udemycdn.com/teaching/record-your-video-2x-v3.jpg" alt="">
                </div>
                <p>
                    Sử dụng các công cụ cơ bản như điện thoại thông minh hoặc camera DSLR. Thêm một chiếc micrô tốt
                    là
                    bạn đã sẵn sàng bắt
                    đầu.

                    Nếu không thích xuất hiện trên camera, bạn chỉ cần ghi lại màn hình của mình. Dù với cách nào
                    thì
                    bạn cũng nên quay
                    video dài từ 2 tiếng trở lên cho khóa học có trả phí.

                    Cách chúng tôi trợ giúp bạn
                    Nhóm Hỗ trợ của chúng tôi luôn sẵn sàng trợ giúp bạn trong suốt quá trình thực hiện và đưa ra
                    phản
                    hồi về video thử
                    nghiệm.
                </p>
            </div>
            <div>
                <h3 class="text-xl font-bold mt-5 mb-3">Ra mắt khóa học</h3>
                <div class="h-[500px] overflow-hidden">
                    <img class="w-full h-full object-cover"
                        src="https://s.udemycdn.com/teaching/launch-your-course-2x-v3.jpg" alt="">
                </div>
                <p>
                    Thu thập các xếp hạng và đánh giá đầu tiên bằng cách quảng bá khóa học trên mạng xã hội và mạng
                    lưới
                    nghề nghiệp của
                    bạn.

                    Người dùng sẽ dễ dàng khám phá khóa học của bạn trên cổng khóa học của chúng tôi. Đây là nơi bạn
                    kiếm được doanh thu từ
                    mỗi lượt ghi danh có trả phí.

                    Cách chúng tôi trợ giúp bạn
                    Công cụ coupon tùy chỉnh cho phép bạn đưa ra ưu đãi thu hút học viên ghi danh, đồng thời các
                    chương
                    trình quảng cáo toàn
                    cầu của chúng tôi giúp thúc đẩy lưu lượng truy cập vào khóa học. Thậm chí các khóa học còn có
                    nhiều
                    cơ hội được chúng
                    tôi lựa chọn cho tuyển tập Udemy Business.
                </p>
            </div>
        </div>
    </section>

    <section class="flex justify-between gap-6 items-center lg:flex-row flex-col lg:px-0 px-5 mb-10">
        <div class="h-[400px] overflow-hidden basis-[20%]">
            <img class="w-full h-full object-cover" src="https://s.udemycdn.com/teaching/support-1-2x-v3.jpg"
                alt="">
        </div>

        <div class="text-center basis-[60%]">
            <h2 class="lg:text-4xl text-2xl font-bold mb-3">Bạn sẽ không làm việc này một mình</h2>
            <p class="text-lg leading-loose">Nhóm Hỗ trợ giảng viên luôn có mặt để giải đáp thắc mắc cũng như đánh
                giá
                video thử
                nghiệm của bạn. Đồng
                thời, Teaching
                Center cung cấp cho bạn nhiều tài nguyên để giúp bạn trong suốt quá trình làm việc. Ngoài ra, bạn sẽ
                nhận được sự hỗ trợ
                từ các giảng viên giàu kinh nghiệm trong cộng đồng online.</p>
        </div>

        <div class="h-[400px] overflow-hidden basis-[20%]">
            <img class="w-full h-full object-cover" src="https://s.udemycdn.com/teaching/support-2-2x-v3.jpg"
                alt="">
        </div>
    </section>

    <section class="">
        <div class="bg-[#cccccc50] text-center p-30">
            <h2 class="lg:text-4xl text-2xl font-bold text-center mb-3">Trở thành giảng viên ngay hôm này</h2>
            <p class="text-lg leading-loose text-center mb-3">Tham gia một trong những thị trường học tập trực tuyến
                lớn
                nhất
                thế
                giới.</p>
            <button onclick="openModal()" class="inline-block hover:opacity-[0.8] py-2 px-4 bg-purple-500 text-white rounded-sm cursor-pointer">
                Đăng ký ngay
            </button>
        </div>
    </section>
</main>

<script>
    function changeContentTutorial(item) {
        let partList = document.querySelectorAll(".part");
        changeStyleContentTutorial();
        partList.forEach(element => {
            if (element == item) {
                element.classList.remove("opacity-[0.5]");
                turnOffContentAll();
                if (item.classList.contains("part1")) {
                    turnOnContent(1);
                } else if (item.classList.contains("part2")) {
                    turnOnContent(2);
                } else {
                    turnOnContent(3);
                }
            }
        });
    }

    function changeStyleContentTutorial() {
        let partList = document.querySelectorAll(".part");
        partList.forEach(element => {
            element.classList.add("opacity-[0.5]");
        });
    }

    function turnOnContent(key) {
        if (key == 1) {
            document.querySelector(".content1").classList.remove("hidden");
            document.querySelector(".content1").classList.add("flex");
        } else if (key == 2) {
            document.querySelector(".content2").classList.remove("hidden");
            document.querySelector(".content2").classList.add("flex");
        } else {
            document.querySelector(".content3").classList.remove("hidden");
            document.querySelector(".content3").classList.add("flex");
        }
    }

    function turnOffContentAll() {
        let contentList = document.querySelectorAll(".content");
        contentList.forEach(element => {
            element.classList.remove("hidden");
            element.classList.remove("flex");
            element.classList.add("hidden");
        });
    }

    const modal = document.getElementById('modal');
    const checkbox = document.getElementById('agreeCheckbox');
    const continueBtn = document.getElementById('continueBtn');


    function openModal() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        checkbox.checked = false;
        toggleButton();
    }


    function toggleButton() {
        if (checkbox.checked) {
            continueBtn.disabled = false;
            continueBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            continueBtn.disabled = true;
            continueBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    function goNext() {
        if (!document.getElementById('continueBtn').disabled) {
            window.location.href = "?page=step&action=step1";
        }
    }
</script>