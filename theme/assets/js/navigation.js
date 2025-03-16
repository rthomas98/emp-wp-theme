// Navigation functionality
jQuery(function($) {
    'use strict';

    // Get icons from localized data
    const icons = (typeof window._empNav !== 'undefined' && window._empNav.icons) ? window._empNav.icons : {
        menu: 'menu',
        close: 'x',
        chevron: 'chevron-down',
        arrow: 'arrow-right'
    };

    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }

    // Header functionality
    const header = document.getElementById('site-header');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    let isOpen = false;
    let lastScroll = 0;

    if (header) {
        // Set initial header height variable
        document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');

        // Add padding to body to prevent content jump
        const adminBarHeight = document.getElementById('wpadminbar')?.offsetHeight || 0;
        document.body.style.paddingTop = (header.offsetHeight + adminBarHeight) + 'px';

        // Update header height on resize
        window.addEventListener('resize', () => {
            const currentAdminBarHeight = document.getElementById('wpadminbar')?.offsetHeight || 0;
            document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');
            document.body.style.paddingTop = (header.offsetHeight + currentAdminBarHeight) + 'px';
        });

        // Handle scroll behavior
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                header.classList.remove('-translate-y-full');
                return;
            }

            if (currentScroll > lastScroll && !isOpen && currentScroll > 100) {
                // Scrolling down & menu closed & scrolled past 100px
                header.classList.add('-translate-y-full');
            } else {
                // Scrolling up or menu open
                header.classList.remove('-translate-y-full');
            }

            lastScroll = currentScroll;
        });
    }

    // Mobile menu toggle
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            isOpen = !isOpen;
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            
            // Toggle icon
            const menuIcon = this.querySelector('[data-lucide]');
            if (menuIcon) {
                menuIcon.setAttribute('data-lucide', isExpanded ? icons.menu : icons.close);
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }
        });
    }

    // Handle mobile dropdown menus
    $('.mobile-menu .menu-item-has-children > a').on('click', function(e) {
        if (window.innerWidth >= 1024) return;
        e.preventDefault();
        e.stopPropagation();
        
        const $parent = $(this).parent();
        const $submenu = $parent.children('.sub-menu');
        const $icon = $(this).find(`[data-lucide="${icons.chevron}"]`);
        
        // Close other submenus at the same level
        const $siblings = $parent.siblings('.menu-item-has-children');
        $siblings.find('.sub-menu').slideUp(200);
        $siblings.find(`[data-lucide="${icons.chevron}"]`).removeClass('rotate-180');
        $siblings.removeClass('is-active');
        
        // Toggle current submenu
        $submenu.slideToggle(200);
        $icon.toggleClass('rotate-180');
        $parent.toggleClass('is-active');
    });

    // Desktop menu hover functionality
    $('.primary-menu .menu-item-has-children').hover(
        function() {
            if (window.innerWidth < 1024) return;
            const $submenu = $(this).children('.sub-menu');
            const $icon = $(this).find(`[data-lucide="${icons.chevron}"]`);
            
            $(this).addClass('hover');
            $submenu.stop().fadeIn(200);
            $icon.addClass('rotate-180');
        },
        function() {
            if (window.innerWidth < 1024) return;
            const $submenu = $(this).children('.sub-menu');
            const $icon = $(this).find(`[data-lucide="${icons.chevron}"]`);
            
            $(this).removeClass('hover');
            $submenu.stop().fadeOut(200);
            $icon.removeClass('rotate-180');
        }
    );

    // Handle keyboard navigation
    $('.primary-menu .menu-item-has-children > a').on('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            const $parent = $(this).parent();
            const $submenu = $parent.children('.sub-menu');
            const $icon = $(this).find(`[data-lucide="${icons.chevron}"]`);
            
            $parent.toggleClass('hover');
            $submenu.stop().fadeToggle(200);
            $icon.toggleClass('rotate-180');
        }
    });

    // Close submenus when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.menu-item-has-children').length) {
            $('.menu-item-has-children').removeClass('hover');
            $('.sub-menu').fadeOut(200);
            $(`[data-lucide="${icons.chevron}"]`).removeClass('rotate-180');
        }
    });

    // Accessibility: Close submenus when pressing Escape
    $(document).on('keyup', function(e) {
        if (e.key === 'Escape') {
            $('.menu-item-has-children').removeClass('hover');
            $('.sub-menu').fadeOut(200);
            $(`[data-lucide="${icons.chevron}"]`).removeClass('rotate-180');
            
            // Also close mobile menu if open
            if (isOpen && mobileMenuToggle) {
                mobileMenuToggle.click();
            }
        }
    });

    // Close mobile menu on window resize
    $(window).on('resize', function() {
        if (window.innerWidth >= 1024 && mobileMenu && mobileMenuToggle) {
            mobileMenu.classList.add('hidden');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            const menuIcon = mobileMenuToggle.querySelector('[data-lucide]');
            if (menuIcon) {
                menuIcon.setAttribute('data-lucide', icons.menu);
                if (window.lucide) {
                    window.lucide.createIcons();
                }
            }
            isOpen = false;

            // Reset mobile menu state
            $('.mobile-menu .menu-item-has-children').removeClass('is-active');
            $('.mobile-menu .sub-menu').hide();
            $(`[data-lucide="${icons.chevron}"]`).removeClass('rotate-180');
        }
    });
});
