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
