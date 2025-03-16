document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }

    // Mobile menu state
    let isMobileMenuOpen = false;
    const isMobile = window.innerWidth < 992;

    // Mobile menu elements
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navContent = document.getElementById('nav-content');
    
    if (!mobileMenuToggle || !navContent) return;
    
    const menuLines = mobileMenuToggle.querySelectorAll('span');

    // Animation variants
    const topLineVariants = {
        open: { transform: 'translateY(8px) rotate(-45deg)' },
        closed: { transform: 'none' }
    };

    const middleLineVariants = {
        open: { width: '0' },
        closed: { width: '1.5rem' }
    };

    const bottomLineVariants = {
        open: { transform: 'translateY(-8px) rotate(45deg)' },
        closed: { transform: 'none' }
    };

    // Toggle mobile menu
    function toggleMobileMenu() {
        isMobileMenuOpen = !isMobileMenuOpen;

        // Animate hamburger icon
        if (isMobileMenuOpen) {
            menuLines[0].style.transform = topLineVariants.open.transform;
            menuLines[1].style.width = middleLineVariants.open.width;
            menuLines[2].style.transform = bottomLineVariants.open.transform;
            
            // Show mobile menu with animation
            navContent.style.display = 'block';
            requestAnimationFrame(() => {
                navContent.style.height = '100dvh';
                navContent.style.opacity = '1';
                document.body.style.overflow = 'hidden';
            });
        } else {
            menuLines[0].style.transform = topLineVariants.closed.transform;
            menuLines[1].style.width = middleLineVariants.closed.width;
            menuLines[2].style.transform = bottomLineVariants.closed.transform;
            
            // Hide mobile menu with animation
            navContent.style.height = 'auto';
            navContent.style.opacity = '0';
            document.body.style.overflow = '';
            setTimeout(() => {
                if (!isMobileMenuOpen) {
                    navContent.style.display = 'none';
                }
            }, 400);
        }
    }

    // Handle mobile menu toggle
    mobileMenuToggle.addEventListener('click', toggleMobileMenu);

    // Handle header scroll state
    const header = document.getElementById('relume');
    if (header) {
        let lastScrollY = window.scrollY;
        let isHeaderVisible = true;
        let scrollTimer;

        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(() => {
                const currentScrollY = window.scrollY;
                const scrollingDown = currentScrollY > lastScrollY;
                const scrollAmount = Math.abs(currentScrollY - lastScrollY);
                const mobileMenuOpen = document.getElementById('nav-content')?.classList.contains('open');

                // Only hide/show header if scroll amount is significant and mobile menu is closed
                if (scrollAmount > 5 && !mobileMenuOpen) {
                    if (scrollingDown && isHeaderVisible && currentScrollY > header.offsetHeight) {
                        header.style.transform = 'translateY(-100%)';
                        isHeaderVisible = false;
                    } else if (!scrollingDown && !isHeaderVisible) {
                        header.style.transform = 'translateY(0)';
                        isHeaderVisible = true;
                    }
                }

                lastScrollY = currentScrollY;
            }, 50); // Debounce scroll events
        });
    }

    // Handle desktop dropdowns
    const dropdowns = document.querySelectorAll('.nav-dropdown');
    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const content = dropdown.querySelector('.nav-dropdown-content');
        const chevron = button?.querySelector('[data-lucide="chevron-down"]');
        
        if (!button || !content || !chevron) return;
        
        let hoverTimeout;
        let isOpen = false;

        function showDropdown() {
            clearTimeout(hoverTimeout);
            if (!isOpen) {
                isOpen = true;
                content.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
                requestAnimationFrame(() => {
                    content.classList.add('open');
                });
            }
        }

        function hideDropdown() {
            clearTimeout(hoverTimeout);
            hoverTimeout = setTimeout(() => {
                if (isOpen) {
                    isOpen = false;
                    content.classList.remove('open');
                    chevron.style.transform = 'rotate(0deg)';
                    setTimeout(() => {
                        if (!isOpen) {
                            content.style.display = 'none';
                        }
                    }, 200);
                }
            }, 100); // Small delay to prevent flickering
        }

        // Desktop hover events
        if (window.innerWidth >= 1024) {
            dropdown.addEventListener('mouseenter', showDropdown);
            dropdown.addEventListener('mouseleave', hideDropdown);
            
            // Keep dropdown open while hovering on content
            content.addEventListener('mouseenter', () => {
                clearTimeout(hoverTimeout);
                isOpen = true;
            });
            
            content.addEventListener('mouseleave', hideDropdown);
        }
    });

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Refresh Lucide icons
            if (window.lucide) {
                window.lucide.createIcons();
            }

            // Reset dropdowns on desktop
            if (window.innerWidth >= 1024) {
                dropdowns.forEach(dropdown => {
                    const content = dropdown.querySelector('.nav-dropdown-content');
                    const chevron = dropdown.querySelector('[data-lucide="chevron-down"]');
                    if (content) {
                        content.style.display = 'none';
                        content.classList.remove('open');
                    }
                    if (chevron) {
                        chevron.style.transform = 'rotate(0deg)';
                    }
                });
            }
        }, 100);
    });
});
