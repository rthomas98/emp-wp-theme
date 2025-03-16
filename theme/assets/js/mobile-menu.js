document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navContent = document.getElementById('nav-content');
    
    if (!mobileMenuToggle || !navContent) return;

    const menuLines = mobileMenuToggle.querySelectorAll('span');
    let isAnimating = false;

    // Function to prevent body scroll
    function toggleBodyScroll(disable) {
        // Don't disable scroll if we're showing the admin bar on mobile
        if (document.body.classList.contains('admin-bar') && window.innerWidth <= 600) {
            document.body.style.overflow = '';
            document.body.style.touchAction = '';
            return;
        }
        
        document.body.style.overflow = disable ? 'hidden' : '';
        document.body.style.touchAction = disable ? 'none' : '';
    }

    // Handle mobile menu toggle
    mobileMenuToggle.addEventListener('click', function() {
        if (isAnimating) return;
        isAnimating = true;

        const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
        mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
        
        // Toggle menu visibility with slide animation
        if (!isExpanded) {
            navContent.style.display = 'block';
            toggleBodyScroll(true);
            requestAnimationFrame(() => {
                navContent.classList.add('open');
                menuLines[0].style.transform = 'translateY(8px) rotate(-45deg)';
                menuLines[1].style.width = '0';
                menuLines[2].style.transform = 'translateY(-8px) rotate(45deg)';
            });
        } else {
            navContent.classList.remove('open');
            menuLines[0].style.transform = 'none';
            menuLines[1].style.width = '1.5rem';
            menuLines[2].style.transform = 'none';
            toggleBodyScroll(false);
            
            // Wait for slide animation to complete
            setTimeout(() => {
                if (!navContent.classList.contains('open')) {
                    navContent.style.display = 'none';
                }
            }, 400);
        }

        setTimeout(() => {
            isAnimating = false;
        }, 400);
    });

    // Handle dropdowns in mobile menu
    const dropdowns = document.querySelectorAll('.nav-dropdown');
    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('button');
        const content = dropdown.querySelector('.nav-dropdown-content');
        const chevron = button?.querySelector('[data-lucide="chevron-down"]');
        
        if (!button || !content || !chevron) return;

        button.addEventListener('click', function(e) {
            if (window.innerWidth >= 1024) return; // Only handle clicks on mobile
            
            e.preventDefault();
            e.stopPropagation();
            
            if (isAnimating) return;
            isAnimating = true;

            const isOpen = content.classList.contains('open');
            
            // Close other open dropdowns
            dropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown) {
                    const otherContent = otherDropdown.querySelector('.nav-dropdown-content');
                    const otherChevron = otherDropdown.querySelector('[data-lucide="chevron-down"]');
                    if (otherContent?.classList.contains('open')) {
                        otherContent.classList.remove('open');
                        otherContent.style.display = 'none';
                        otherChevron.style.transform = 'rotate(0deg)';
                    }
                }
            });
            
            // Toggle dropdown visibility with smooth animation
            if (!isOpen) {
                content.style.display = 'block';
                chevron.style.transform = 'rotate(180deg)';
                requestAnimationFrame(() => {
                    content.classList.add('open');
                });
            } else {
                content.classList.remove('open');
                chevron.style.transform = 'rotate(0deg)';
                setTimeout(() => {
                    if (!content.classList.contains('open')) {
                        content.style.display = 'none';
                    }
                }, 200);
            }

            setTimeout(() => {
                isAnimating = false;
            }, 200);
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth >= 1024) return; // Only handle clicks on mobile
        
        dropdowns.forEach(dropdown => {
            const content = dropdown.querySelector('.nav-dropdown-content');
            const chevron = dropdown.querySelector('[data-lucide="chevron-down"]');
            
            if (!dropdown.contains(e.target) && content?.classList.contains('open')) {
                content.classList.remove('open');
                content.style.display = 'none';
                chevron.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Close mobile menu on window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth >= 1024) {
                navContent.classList.remove('open');
                navContent.style.display = 'none';
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
                menuLines[0].style.transform = 'none';
                menuLines[1].style.width = '1.5rem';
                menuLines[2].style.transform = 'none';
                toggleBodyScroll(false);
                
                // Reset all dropdowns
                dropdowns.forEach(dropdown => {
                    const content = dropdown.querySelector('.nav-dropdown-content');
                    const chevron = dropdown.querySelector('[data-lucide="chevron-down"]');
                    if (content) {
                        content.classList.remove('open');
                        content.style.display = 'none';
                    }
                    if (chevron) {
                        chevron.style.transform = 'rotate(0deg)';
                    }
                });
            }
        }, 300);
    });
});
