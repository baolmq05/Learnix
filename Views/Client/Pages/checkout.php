

	<div class="max-w-6xl mx-auto py-10 px-4 md:px-8 lg:px-12">
		<div class="mb-8">
			<h1 class="text-3xl font-bold text-slate-900">Thanh toán</h1>
			<p class="text-slate-600 mt-2">Kiểm tra giỏ hàng của bạn và hoàn tất thanh toán.</p>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
			<!-- Giỏ hàng bên trái -->
			<div class="lg:col-span-2 bg-white shadow-sm rounded-2xl border border-slate-200">
				<div class="p-6 border-b border-slate-200 flex items-center justify-between">
					<h2 class="text-xl font-semibold text-slate-900">Giỏ hàng</h2>
					<span class="text-sm text-slate-500"><?= count($cartItems) ?> sản phẩm</span>
				</div>

				<?php if (empty($cartItems)) : ?>
					<div class="p-6 text-center text-slate-500">Giỏ hàng trống.</div>
				<?php else : ?>
					<div class="divide-y divide-slate-200">
						<?php foreach ($cartItems as $item) :
							$qty = (int) ($item['quantity'] ?? 0);
							$price = (float) ($item['price'] ?? 0);
							$lineTotal = $qty * $price;
						?>
							<div class="p-6 flex items-center gap-4">
								<img src="Uploads/Courses/<?=($item['image'] ?? '') ?>" alt="item" class="w-16 h-16 rounded-lg object-cover border border-slate-200">
								<div class="flex-1 min-w-0">
									<div class="flex items-start justify-between gap-3">
										<div>
											<p class="font-semibold text-slate-900 leading-snug"><?= htmlspecialchars($item['name'] ?? 'Sản phẩm') ?></p>
										</div>
										<div class="text-right">
											<p class="font-semibold text-slate-900"><?= formatCurrency($lineTotal) ?></p>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Tổng tiền bên phải -->
			<div class="bg-white shadow-sm rounded-2xl border border-slate-200 h-fit">
				<div class="p-6 border-b border-slate-200">
					<h2 class="text-xl font-semibold text-slate-900">Tóm tắt thanh toán</h2>
				</div>
				<div class="p-6 space-y-4">
					<div class="flex items-center justify-between text-sm text-slate-700">
						<span>Tạm tính</span>
						<span class="font-semibold text-slate-900"><?= formatCurrency($subTotal) ?></span>
					</div>
					<div class="border-t border-dashed border-slate-200 pt-4 flex items-center justify-between text-base">
						<span class="font-semibold text-slate-900">Tổng cộng</span>
						<span class="text-xl font-bold text-emerald-600" id="total-display"><?= formatCurrency($grandTotal) ?></span>
					</div>

					<form action="index.php?page=checkout&action=handleCheckout" method="POST">
						<input type="hidden" name="total_amount" id="total-amount-input" value="<?= $grandTotal ?>">
						<?php if (!empty($cartItems) && isset($cartItems[0]['course_id'])): ?>
							<?php if (count($cartItems) === 1 && isset($_POST['course_id'])): ?>
								<!-- Mua ngay: truyền course_id -->
								<input type="hidden" name="course_id" value="<?= $cartItems[0]['course_id'] ?>">
							<?php endif; ?>
						<?php endif; ?>
						<button type="submit" class="w-full mt-4 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-white font-semibold shadow-sm hover:bg-emerald-700 transition-colors">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18M7 7V5a2 2 0 012-2h6a2 2 0 012 2v2" />
							</svg>
							Thanh toán
						</button>
					</form>
					<p class="text-xs text-slate-500 text-center mt-3">Thanh toán từ ví của bạn. Nếu ví không đủ, hãy nạp tiền trước.</p>
				</div>
			</div>
		</div>
	</div>
