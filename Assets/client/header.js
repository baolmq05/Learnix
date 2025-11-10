(function header() {
	const nav = document.querySelector('nav');
	const triggers = document.querySelectorAll('[data-dropdown-target]');
	if (!nav || !triggers.length) return;

	const closeTimers = new Map();

	function openDropdownFor(dropdown, triggerEl) {
		const navRect = nav.getBoundingClientRect();
		const trigRect = triggerEl.getBoundingClientRect();

		const top = nav.offsetHeight;
		const ddWidth = dropdown.offsetWidth || 224;
		let left = Math.round(trigRect.left - navRect.left + (trigRect.width / 2) - (ddWidth / 2));

		const navWidth = Math.round(navRect.width);
		if (left + ddWidth > navWidth) left = Math.max(8, navWidth - ddWidth - 8);
		if (left < 8) left = 8;

		dropdown.style.top = top + 'px';
		dropdown.style.left = left + 'px';

		dropdown.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
		dropdown.classList.add('opacity-100', 'visible', 'pointer-events-auto');
	}

	function closeDropdown(dropdown) {
		dropdown.classList.add('opacity-0', 'invisible', 'pointer-events-none');
		dropdown.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
	}

	triggers.forEach(function (trigger) {
		const targetId = trigger.getAttribute('data-dropdown-target');
		const dropdown = document.getElementById(targetId);
		if (!dropdown) return;

		trigger.addEventListener('mouseenter', function () {
			clearTimeout(closeTimers.get(dropdown));
			if (window.innerWidth >= 768) {
				openDropdownFor(dropdown, trigger);
			}
		});
		trigger.addEventListener('mouseleave', function () {
			clearTimeout(closeTimers.get(dropdown));
			closeTimers.set(dropdown, setTimeout(function () { closeDropdown(dropdown); }, 150));
		});

		dropdown.addEventListener('mouseenter', function () {
			clearTimeout(closeTimers.get(dropdown));
		});
		dropdown.addEventListener('mouseleave', function () {
			clearTimeout(closeTimers.get(dropdown));
			closeTimers.set(dropdown, setTimeout(function () { closeDropdown(dropdown); }, 150));
		});

		trigger.addEventListener('click', function (e) {
			if (window.innerWidth < 768) {
				e.preventDefault();
				clearTimeout(closeTimers.get(dropdown));
				if (dropdown.classList.contains('invisible')) {
					openDropdownFor(dropdown, trigger);
				} else {
					closeDropdown(dropdown);
				}
			}
		});
	});

	document.addEventListener('click', function (e) {
		triggers.forEach(function (trigger) {
			const id = trigger.getAttribute('data-dropdown-target');
			const dropdown = document.getElementById(id);
			if (!dropdown) return;
			if (!dropdown.contains(e.target) && !trigger.contains(e.target)) {
				closeDropdown(dropdown);
			}
		});
	});

	window.addEventListener('resize', function () {
		triggers.forEach(function (trigger) {
			const id = trigger.getAttribute('data-dropdown-target');
			const dropdown = document.getElementById(id);
			if (!dropdown) return;
			if (!dropdown.classList.contains('invisible')) openDropdownFor(dropdown, trigger);
		});
	});

	const mobileMenuBtn = document.getElementById('mobile-menu-btn');
	const closeMobileMenuBtn = document.getElementById('close-mobile-menu');
	const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
	const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

	function openMobileMenu() {
		mobileMenuDrawer.classList.remove('-translate-x-full');
		mobileMenuOverlay.classList.remove('invisible', 'opacity-0');
		mobileMenuOverlay.classList.add('visible', 'opacity-50');
		document.body.style.overflow = 'hidden'; 
	}

	function closeMobileMenu() {
		mobileMenuDrawer.classList.add('-translate-x-full');
		mobileMenuOverlay.classList.remove('visible', 'opacity-50');
		mobileMenuOverlay.classList.add('invisible', 'opacity-0');
		document.body.style.overflow = '';
	}

	if (mobileMenuBtn && mobileMenuDrawer) {
		mobileMenuBtn.addEventListener('click', openMobileMenu);
		closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
		mobileMenuOverlay.addEventListener('click', closeMobileMenu);
	}
})();

