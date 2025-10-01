// Real-time account status and notifications (mock demo)
document.addEventListener('DOMContentLoaded', function () {
	// Simulate account balance update
	setTimeout(() => {
		const balanceEl = document.querySelector('.account-balance-amount');
		if (balanceEl) balanceEl.textContent = '$1,250.75';
	}, 1200);

	// Simulate notification update
	setTimeout(() => {
		const notifCount = document.querySelector('.notif-count');
		const notifMenu = document.querySelector('#realtimeNotifications .dropdown-menu');
		if (notifCount) notifCount.textContent = '2';
		if (notifMenu) {
			notifMenu.innerHTML = '<li><a class="dropdown-item" href="#">Payment received: $500</a></li>' +
				'<li><a class="dropdown-item" href="#">Refund processed: $50</a></li>';
		}
	}, 1800);
	// TODO: Replace with Laravel Echo event listeners for live updates
});
import './bootstrap';

// Floating header scroll effect
document.addEventListener('DOMContentLoaded', function () {
	const header = document.getElementById('floatingHeader');
	if (!header) return;
	let lastScrollY = window.scrollY;
	window.addEventListener('scroll', function () {
		if (window.scrollY > 40) {
			header.classList.add('scrolled');
		} else {
			header.classList.remove('scrolled');
		}
		lastScrollY = window.scrollY;
	});
});
