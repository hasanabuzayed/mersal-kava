/**
 * Kava Theme JavaScript
 * Modernized with ES6+ and reduced jQuery dependency
 */

// Responsive menu - Modern vanilla JS implementation
const kavaResponsiveMenu = function(options = {}) {
	const defaults = {
		wrapper: '.main-navigation',
		menu: '.menu',
		threshold: 640,
		mobileMenuClass: 'mobile-menu',
		mobileMenuOpenClass: 'mobile-menu-open',
		mobileMenuToggleButtonClass: 'mobile-menu-toggle-button',
		toggleButtonTemplate: '<i class="mobile-menu-close fa-solid fa-bars" aria-hidden="true"></i><i class="mobile-menu-open fa-solid fa-times" aria-hidden="true"></i>'
	};

	const config = Object.assign({}, defaults, options);
	
	const wrapper = typeof config.wrapper === 'string' 
		? document.querySelector(config.wrapper)
		: config.wrapper;
	
	const menu = typeof config.menu === 'string'
		? document.querySelector(config.menu)
		: config.menu;

	if (!wrapper || !menu) {
		return;
	}

	let toggleButton;
	let toggleButtonOpenBlock;
	let toggleButtonCloseBlock;
	let isMobileMenu = false;
	let isMobileMenuOpen = false;

	// Initialize
	const init = () => {
		addToggleButton();
		checkScreenWidth();
		addResizeHandler();
	};

	const addToggleButton = () => {
		toggleButton = document.createElement('button');
		toggleButton.innerHTML = config.toggleButtonTemplate.trim();
		toggleButton.className = config.mobileMenuToggleButtonClass;
		toggleButton.setAttribute('aria-label', 'Toggle mobile menu');
		wrapper.insertBefore(toggleButton, wrapper.firstChild);

		toggleButtonOpenBlock = toggleButton.querySelector('.mobile-menu-open');
		toggleButtonCloseBlock = toggleButton.querySelector('.mobile-menu-close');

		toggleButton.addEventListener('click', mobileMenuToggle);
	};

	const switchToMobileMenu = () => {
		wrapper.classList.add(config.mobileMenuClass);
		toggleButton.style.display = 'block';
		isMobileMenuOpen = false;
		hideMenu();
	};

	const switchToDesktopMenu = () => {
		wrapper.classList.remove(config.mobileMenuClass);
		toggleButton.style.display = 'none';
		showMenu();
	};

	const mobileMenuToggle = () => {
		isMobileMenuOpen ? hideMenu() : showMenu();
		isMobileMenuOpen = !isMobileMenuOpen;
	};

	const hideMenu = () => {
		wrapper.classList.remove(config.mobileMenuOpenClass);
		menu.style.display = 'none';
		if (toggleButtonOpenBlock) toggleButtonOpenBlock.style.display = 'none';
		if (toggleButtonCloseBlock) toggleButtonCloseBlock.style.display = 'block';
	};

	const showMenu = () => {
		wrapper.classList.add(config.mobileMenuOpenClass);
		menu.style.display = 'block';
		if (toggleButtonOpenBlock) toggleButtonOpenBlock.style.display = 'block';
		if (toggleButtonCloseBlock) toggleButtonCloseBlock.style.display = 'none';
	};

	const checkScreenWidth = () => {
		const currentMobileMenuStatus = window.innerWidth < config.threshold;
		
		if (isMobileMenu !== currentMobileMenuStatus) {
			isMobileMenu = currentMobileMenuStatus;
			isMobileMenu ? switchToMobileMenu() : switchToDesktopMenu();
		}
	};

	const addResizeHandler = () => {
		let resizeTimer;
		window.addEventListener('resize', () => {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(() => {
				window.requestAnimationFrame(checkScreenWidth);
			}, 150);
		});
	};

	init();
};

// Main Theme JavaScript Object
const Kava_Theme_JS = {
	init() {
		// Wait for DOM to be ready
		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', () => this.initComponents());
		} else {
			this.initComponents();
		}
	},

	initComponents() {
		this.pagePreloaderInit();
		this.toTopInit();
		this.responsiveMenuInit();
		this.magnificPopupInit();
		this.swiperInit();
	},

	pagePreloaderInit() {
		const preloader = document.querySelector('.page-preloader-cover');
		if (preloader) {
			setTimeout(() => {
				preloader.style.transition = 'opacity 500ms';
				preloader.style.opacity = '0';
				setTimeout(() => preloader.remove(), 500);
			}, 500);
		}
	},

	toTopInit() {
		if (window.kavaConfig && window.kavaConfig.toTop) {
			this.toTop();
		}
	},

	toTop(options = {}) {
		const defaults = {
			buttonID: 'toTop',
			min: 200,
			inDelay: 600,
			outDelay: 400,
			scrollSpeed: 600
		};

		const settings = Object.assign({}, defaults, options);
		const buttonSelector = `#${settings.buttonID}`;
		
		// Check if button already exists
		if (document.querySelector(buttonSelector)) {
			return;
		}

		// Create button
		const button = document.createElement('div');
		button.id = settings.buttonID;
		button.setAttribute('role', 'button');
		button.setAttribute('aria-label', 'Scroll to top');
		button.style.display = 'none';
		document.body.appendChild(button);

		// Click handler
		button.addEventListener('click', (e) => {
			e.preventDefault();
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
		});

		// Scroll handler with throttling
		let scrollTimer;
		window.addEventListener('scroll', () => {
			clearTimeout(scrollTimer);
			scrollTimer = setTimeout(() => {
				const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
				const buttonEl = document.querySelector(buttonSelector);
				
				if (scrollTop > settings.min) {
					buttonEl.style.transition = `opacity ${settings.inDelay}ms`;
					buttonEl.style.opacity = '1';
					buttonEl.style.display = 'block';
				} else {
					buttonEl.style.transition = `opacity ${settings.outDelay}ms`;
					buttonEl.style.opacity = '0';
					setTimeout(() => {
						if (window.pageYOffset <= settings.min) {
							buttonEl.style.display = 'none';
						}
					}, settings.outDelay);
				}
			}, 10);
		});
	},

	responsiveMenuInit() {
		if (typeof kavaResponsiveMenu !== 'undefined') {
			kavaResponsiveMenu();
		}
	},

	magnificPopupInit() {
		// Magnific Popup requires jQuery, so we check for it
		if (typeof window.jQuery !== 'undefined' && typeof window.jQuery.magnificPopup !== 'undefined') {
			const $ = window.jQuery;
			$('[data-popup="magnificPopup"]').magnificPopup({
				type: 'image'
			});
		}
	},

	swiperInit() {
		if (typeof Swiper !== 'undefined') {
			// Swiper v12 uses .swiper class (not .swiper-container)
			const containers = document.querySelectorAll('.swiper');
			
			containers.forEach(container => {
				// Check if already initialized
				if (container.swiper) {
					return;
				}

				// Initialize Swiper v12 - all options are compatible
				new Swiper(container, {
					loop: true,
					spaceBetween: 10,
					autoHeight: true,
					navigation: {
						nextEl: container.querySelector('.swiper-button-next'),
						prevEl: container.querySelector('.swiper-button-prev')
					}
				});
			});
		}
	}
};

// Initialize when DOM is ready
Kava_Theme_JS.init();

// Export for potential external use
if (typeof module !== 'undefined' && module.exports) {
	module.exports = Kava_Theme_JS;
}
