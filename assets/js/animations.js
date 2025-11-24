document.addEventListener('DOMContentLoaded', () => {
	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/**
	 * Reveal on scroll
	 */
	const observer = new IntersectionObserver(
		(entries, io) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		},
		{
			root: null,
			rootMargin: '0px',
			threshold: 0.15,
		}
	);

	document.querySelectorAll('.reveal-on-scroll').forEach((el) => observer.observe(el));

	/**
	 * Parallax + header compression
	 */
	const header = document.querySelector('.site-header');
	const parallaxEls = prefersReducedMotion ? [] : document.querySelectorAll('[data-parallax]');
	let ticking = false;

	const onScroll = () => {
		const scrollY = window.scrollY || window.pageYOffset;

		if (header) {
			header.dataset.scrolled = scrollY > 60 ? 'true' : 'false';
		}

		if (!prefersReducedMotion && parallaxEls.length) {
			parallaxEls.forEach((el) => {
				const speed = parseFloat(el.dataset.parallax) || -0.1;
				const translateY = scrollY * speed;
				el.style.transform = `translate3d(0, ${translateY}px, 0)`;
			});
		}

		ticking = false;
	};

	const requestTick = () => {
		if (!ticking) {
			window.requestAnimationFrame(onScroll);
			ticking = true;
		}
	};

	window.addEventListener('scroll', requestTick, { passive: true });
	onScroll();
});
