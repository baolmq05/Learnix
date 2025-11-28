<?php ?>

<section class="max-w-screen-xl mx-auto px-5 py-8">
    <div>
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-900"><?= isset($category) ? 'Tất cả khóa học' : '' ?>
            <?= $category['name'] ?? 'Tất cả khóa học' ?></h1>
        <p class="mt-2 text-sm text-gray-600"><?= $category['description'] ?? 'Toàn bộ khóa học' ?></p>
    </div>

    <div class="mt-6 flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-3 flex-wrap">
            <button id="filter-toggle-button" type="button" aria-pressed="false" aria-expanded="true"
                class="inline-flex items-center gap-2 px-4 py-2 border rounded text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600"
                aria-label="Toggle filters">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                </svg>
                <span>Bộ lọc</span>
            </button>

            <div class="relative overflow-visible">
                <label for="sort" class="sr-only">Sắp xếp theo</label>
                <select id="sort" name="sort"
                    class="block w-full md:w-53 px-4 py-2 text-sm border rounded text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 z-50"
                    aria-label="Sort courses">
                    <option value="rating_desc">Đánh giá từ cao đến thấp</option>
                    <option value="rating_asc">Đánh giá từ thấp đến cao</option>
                    <option value="price_asc">Giá: Thấp đến Cao</option>
                    <option value="price_desc">Giá: Cao đến Thấp</option>
                </select>
            </div>
            <button id="reset-filters" type="button"
                class="inline-flex items-center gap-2 hover:cursor-pointer px-4 py-2 border rounded text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>Đặt lại bộ lọc</span>
            </button>
        </div>
    </div>

    <div id="main-wrapper" class="mt-6 md:flex md:items-start gap-6">
        <aside id="filters-panel" class="hidden md:block bg-white p-4 md:w-64 w-full overflow-hidden z-50">


            <div class="md:hidden flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold">Bộ lọc</h3>
                <button id="mobile-filters-close" aria-label="Close filters"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="border-t pt-3">
                <h4 class="text-sm font-medium">Đánh giá</h4>
                <ul class="mt-2 space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <input id="r1" type="radio" name="rating" class="w-4 h-4" value="4.5" />
                        <label for="r1"><span class="text-yellow-600"><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span> 4.5 trở
                            lên</label>
                    </li>
                    <li class="flex items-center gap-2">
                        <input id="r2" type="radio" name="rating" class="w-4 h-4" value="4" />
                        <label for="r2"><span class="text-yellow-600"><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i></span> 4.0 trở lên</label>
                    </li>
                    <li class="flex items-center gap-2">
                        <input id="r3" type="radio" name="rating" class="w-4 h-4" value="3.5" />
                        <label for="r3"><span class="text-yellow-600"><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-half"></i></span> 3.5 trở lên</label>
                    </li>
                </ul>
            </div>

            <div class="border-t pt-3 mt-3">
                <h4 class="text-sm font-medium">Thời lượng</h4>
                <ul class="mt-2 space-y-2 text-sm text-gray-600">
                    <li class="flex items-center gap-2">
                        <input id="d1" type="radio" name="duration" data-min="0" data-max="1" class="w-4 h-4" />
                        <label for="d1">0-1 Giờ</label>
                    </li>
                    <li class="flex items-center gap-2">
                        <input id="d2" type="radio" name="duration" data-min="1" data-max="3" class="w-4 h-4" />
                        <label for="d2">1-3 Giờ</label>
                    </li>
                    <li class="flex items-center gap-2">
                        <input id="d2" type="radio" name="duration" data-min="1" data-max="3" class="w-4 h-4" />
                        <label for="d2">3-7 Giờ</label>
                    </li>
                    <li class="flex items-center gap-2">
                        <input id="d2" type="radio" name="duration" data-min="7" data-max="1000" class="w-4 h-4" />
                        <label for="d2">7+ Giờ</label>
                    </li>
                </ul>
            </div>
            <input type="hidden" id="category_id" value="<?= isset($category_id) ? $category_id : '' ?>">
            <div class="md:hidden mt-6 pt-4 border-t">
                <button id="apply-filters"
                    class="w-full bg-blue-600 text-white py-3 rounded-md font-medium fixed-bottom">Áp dụng</button>
            </div>
        </aside>

        <main class="flex-1" id="course_list">
            <div class="text-sm text-gray-600 text-right">
                <span id="results-count"><?= count($courses) ?> kết quả</span>
            </div>
            <div class="space-y-6">
                <?php
                foreach ($courses as $course): ?>
                    <article class="flex items-center gap-4 border-b py-3 min-w-0">
                        <a href="#" class="flex items-center gap-3 flex-1 group min-w-0">
                            <div class="flex-shrink-0 w-20 h-14 md:w-56 md:h-32 bg-gray-100 overflow-hidden rounded-sm">
                                <img src="<?= $course['image'] ?>" alt="<?= htmlspecialchars($course['image']) ?>"
                                    class="object-cover w-full h-full" />
                            </div>

                            <div class="flex-1 min-w-0">
                                <h3
                                    class="text-sm md:text-base font-semibold text-gray-900 whitespace-nowrap overflow-hidden text-ellipsis truncate group-hover:text-primary">
                                    <?= htmlspecialchars($course['course_name']) ?></h3>
                                <p
                                    class="mt-1 text-xs md:text-sm text-gray-600 whitespace-nowrap overflow-hidden text-ellipsis truncate">
                                    <?= htmlspecialchars($course['instructor']) ?> · <span
                                        class="text-yellow-600"><?= $course['rating'] == 0 ? 'Chưa có' : $course['rating'] ?>&nbsp;<i
                                            class="bi bi-star-fill text-xs"></i></span></p>
                                <p class="mt-1 text-xs text-gray-500 hidden md:block"> Tổng thời lượng :
                                    <?= $course['total_length'] ?? '0' ?> giờ</p>
                            </div>
                        </a>

                        <div class="w-24 flex-shrink-0 text-right">
                            <div class="text-sm md:text-lg font-semibold text-gray-900 truncate">
                                <?= number_format($course['regular_price']) ?>₫</div>
                            <?php if (!empty($course['old'])): ?>
                                <div class="text-xs text-gray-400 line-through truncate"><?= $course['old'] ?>₫</div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
    <div id="mobile-filters-overlay" class="hidden fixed inset-0 bg-white/60 backdrop-blur-sm z-40"
        style="-webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px);"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let getData = function () {
            let rating = $('input[name="rating"]:checked').val();
            let durationMin = $('input[name="duration"]:checked').data('min');
            let durationMax = $('input[name="duration"]:checked').data('max');
            let sort = $('#sort').val();
            let category_id = $('#category_id').val();
            let reset = $('#reset-filters').val();
            $.ajax({
                url: 'Controllers/Client/Ajax/AjaxCourseFilter.php',
                type: 'GET',
                data: {
                    rating: rating,
                    durationMin: durationMin,
                    durationMax: durationMax,
                    sort: sort,
                    category_id: category_id,
                    reset: reset
                },
                success: function (data) {
                    $('#course_list').html(data);
                }
            });
        };

        $(document).ready(function () {
            $('input[name="rating"], input[name="duration"]').on('change', getData);
            $('#sort').on('change', getData);
            $('#reset-filters').on('click', function () {
                $('input[name="rating"]').prop('checked', false);
                $('input[name="duration"]').prop('checked', false);
                $('#sort').val('rating_desc');
                getData();
            });
        });
    </script>
    <script>
        (function () {
            const btn = document.getElementById('filter-toggle-button');
            const panel = document.getElementById('filters-panel');
            const overlay = document.getElementById('mobile-filters-overlay');
            const mobileClose = document.getElementById('mobile-filters-close');
            const applyBtn = document.getElementById('apply-filters');
            const wrapper = document.getElementById('main-wrapper');
            if (!btn || !panel || !wrapper) return;

            const isDesktop = () => window.innerWidth >= 768;

            let cleanupTimeout = null;

            function setAria(visible) {
                btn.setAttribute('aria-pressed', String(visible));
                btn.setAttribute('aria-expanded', String(visible));
            }

            function hidePanelDesktop() {
                if (getComputedStyle(wrapper).position === 'static') wrapper.style.position = 'relative';

                const width = panel.offsetWidth + 'px';
                panel.style.width = width;
                panel.style.position = 'absolute';
                panel.style.left = '0';
                panel.style.top = '0';
                panel.style.bottom = '0';
                panel.style.transform = 'translateX(0)';
                panel.style.opacity = '1';
                panel.style.pointerEvents = 'auto';

                panel.style.willChange = 'transform, opacity';
                panel.style.transition = 'transform .36s cubic-bezier(.2,.8,.2,1), opacity .22s linear';

                panel.style.display = '';

                requestAnimationFrame(() => {
                    panel.style.transform = 'translateX(-100%)';
                    panel.style.opacity = '0';
                });

                const onEnd = () => {
                    panel.removeEventListener('transitionend', onEnd);
                    panel.style.pointerEvents = 'none';
                };
                panel.addEventListener('transitionend', onEnd);

                setAria(false);
            }

            function showPanelDesktop() {
                panel.style.pointerEvents = 'auto';
                panel.style.display = '';

                panel.style.willChange = 'transform, opacity';
                panel.style.transition = 'transform 0.15s cubic-bezier(.2,.8,.2,1), opacity .22s linear';

                panel.style.transform = 'translateX(-100%)';
                panel.style.opacity = '0';

                requestAnimationFrame(() => {
                    panel.style.transform = 'translateX(0)';
                    panel.style.opacity = '1';
                });

                const onEnd = () => {
                    panel.removeEventListener('transitionend', onEnd);
                    panel.style.position = '';
                    panel.style.left = '';
                    panel.style.top = '';
                    panel.style.bottom = '';
                    panel.style.width = '';
                    panel.style.transition = '';
                    panel.style.transform = '';
                    panel.style.opacity = '';
                    panel.style.willChange = '';
                    if (wrapper.style.position === 'relative') wrapper.style.position = '';
                };

                panel.addEventListener('transitionend', onEnd);

                setAria(true);
            }

            btn.addEventListener('click', function () {
                if (isDesktop()) {
                    const style = getComputedStyle(panel);
                    const isHidden = style.opacity === '0' || style.transform.includes('-110%');

                    if (!isHidden) {
                        hidePanelDesktop();
                    } else {
                        showPanelDesktop();
                    }
                } else {
                    showPanelMobile();
                }
            });

            function showPanelMobile() {
                if (overlay) overlay.classList.remove('hidden');

                panel.classList.remove('hidden');
                panel.style.position = 'fixed';
                panel.style.top = '0';
                panel.style.right = '0';
                panel.style.bottom = '0';
                panel.style.width = '85%';
                panel.style.maxWidth = '320px';
                panel.style.transform = 'translateX(100%)';
                panel.style.opacity = '0';
                panel.style.zIndex = '50';
                panel.style.transition = 'transform .36s cubic-bezier(.2,.8,.2,1), opacity .22s linear';

                requestAnimationFrame(() => {
                    panel.style.transform = 'translateX(0)';
                    panel.style.opacity = '1';
                });

                setAria(true);
            }

            function hidePanelMobile() {
                if (overlay) overlay.classList.add('hidden');
                panel.style.transform = 'translateX(100%)';
                panel.style.opacity = '0';

                const cleanup = () => {
                    panel.removeEventListener('transitionend', cleanup);
                    panel.classList.add('hidden');
                    panel.style.position = '';
                    panel.style.top = '';
                    panel.style.right = '';
                    panel.style.bottom = '';
                    panel.style.width = '';
                    panel.style.maxWidth = '';
                    panel.style.transform = '';
                    panel.style.opacity = '';
                    panel.style.transition = '';
                    panel.style.zIndex = '';
                };
                panel.addEventListener('transitionend', cleanup);

                setAria(false);
            }

            if (mobileClose) mobileClose.addEventListener('click', hidePanelMobile);
            if (overlay) overlay.addEventListener('click', hidePanelMobile);
            if (applyBtn) applyBtn.addEventListener('click', function () {
                hidePanelMobile();
            });

            window.addEventListener('resize', function () {
                if (!isDesktop()) {
                    if (overlay) overlay.classList.add('hidden');
                    panel.style.transition = '';
                    panel.style.transform = '';
                    panel.style.opacity = '';
                    panel.style.position = '';
                    panel.style.width = '';
                    panel.style.left = '';
                    panel.style.top = '';
                    panel.style.bottom = '';
                    panel.style.right = '';
                    panel.style.maxWidth = '';
                    panel.style.zIndex = '';
                    wrapper.style.position = '';
                    panel.classList.add('hidden');
                    setAria(false);
                } else {
                    panel.classList.remove('hidden');
                    if (overlay) overlay.classList.add('hidden');
                    panel.style.transition = '';
                    panel.style.transform = '';
                    panel.style.opacity = '';
                    panel.style.position = '';
                    panel.style.width = '';
                    panel.style.left = '';
                    panel.style.top = '';
                    panel.style.bottom = '';
                    panel.style.right = '';
                    panel.style.maxWidth = '';
                    panel.style.zIndex = '';
                    wrapper.style.position = '';
                    setAria(true);
                }
            });
        })();
    </script>
</section>

<?php ?>