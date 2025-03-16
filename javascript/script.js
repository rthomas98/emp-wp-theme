/**
 * Front-end JavaScript
 *
 * The JavaScript code you place here will be processed by esbuild. The output
 * file will be created at `../theme/js/script.min.js` and enqueued in
 * `../theme/functions.php`.
 *
 * For esbuild documentation, please see:
 * https://esbuild.github.io/
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }

    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const siteNavigation = document.getElementById('site-navigation');

    function toggleMobileMenu(show) {
        mobileMenuToggle.setAttribute('aria-expanded', show);
        if (show) {
            siteNavigation.classList.remove('hidden');
            requestAnimationFrame(() => {
                siteNavigation.classList.add('is-active');
            });
        } else {
            siteNavigation.classList.remove('is-active');
            setTimeout(() => {
                siteNavigation.classList.add('hidden');
            }, 300);
        }
    }

    if (mobileMenuToggle && siteNavigation) {
        mobileMenuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            toggleMobileMenu(!isExpanded);
        });
    }

    // Dropdown functionality
    const dropdowns = document.querySelectorAll('.dropdown');
    
    function closeDropdown(dropdown) {
        dropdown.classList.remove('is-active');
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const subMenu = dropdown.querySelector('.sub-menu');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        if (subMenu) subMenu.setAttribute('aria-hidden', 'true');
    }

    function openDropdown(dropdown) {
        dropdown.classList.add('is-active');
        const toggle = dropdown.querySelector('.dropdown-toggle');
        const subMenu = dropdown.querySelector('.sub-menu');
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
        if (subMenu) subMenu.setAttribute('aria-hidden', 'false');
    }

    function closeOtherDropdowns(currentDropdown) {
        const parentUl = currentDropdown.closest('ul');
        if (parentUl) {
            parentUl.querySelectorAll(':scope > li.dropdown.is-active').forEach(el => {
                if (el !== currentDropdown) closeDropdown(el);
            });
        }
    }

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.dropdown-toggle');
        if (!toggle) return;
        
        // Mobile click handling
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth < 1024) {
                e.preventDefault();
                e.stopPropagation();
                
                closeOtherDropdowns(dropdown);
                
                const isActive = dropdown.classList.contains('is-active');
                if (isActive) {
                    closeDropdown(dropdown);
                } else {
                    openDropdown(dropdown);
                }
            }
        });

        // Prevent clicks on the menu link from toggling the dropdown on mobile
        const menuLink = dropdown.querySelector('.menu-link');
        if (menuLink) {
            menuLink.addEventListener('click', function(e) {
                if (window.innerWidth < 1024) {
                    e.stopPropagation();
                }
            });
        }

        // Keyboard navigation
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth < 1024 && !e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown.is-active').forEach(el => closeDropdown(el));
        }
    });

    // Handle resize events
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const isDesktop = window.innerWidth >= 1024;
            
            // Reset mobile menu
            if (isDesktop) {
                siteNavigation.classList.remove('hidden', 'is-active');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
            }
            
            // Reset all dropdowns
            document.querySelectorAll('.dropdown.is-active').forEach(el => closeDropdown(el));
        }, 250);
    });
});
