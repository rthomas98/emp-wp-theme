<?php
/**
 * Header Content Template Part
 * 
 * @package _emp
 */

// Custom Walker class for the navigation menu
class EMP_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        // Default class
        $classes = array('sub-menu');

        // Add custom classes based on depth
        if ($depth === 0) {
            $classes[] = 'absolute';
            $classes[] = 'left-0';
            $classes[] = 'min-w-[220px]';
            $classes[] = 'bg-white';
            $classes[] = 'shadow-lg';
            $classes[] = 'rounded-md';
            $classes[] = 'p-2';
            $classes[] = 'z-50';
            $classes[] = 'opacity-0';
            $classes[] = 'invisible';
            $classes[] = 'group-hover:opacity-100';
            $classes[] = 'group-hover:visible';
            $classes[] = 'transition-all';
            $classes[] = 'duration-200';
            $classes[] = 'mt-2';
        }

        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        
        // Add custom classes based on depth and if item has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-dropdown';
            $classes[] = 'group';
        }
        
        if ($depth === 0) {
            $classes[] = 'relative';
            $classes[] = 'lg:px-2';
        } else {
            $classes[] = 'w-full';
        }

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Add custom attributes based on depth
        if ($depth === 0) {
            $atts['class'] = 'block py-2 px-4 text-purple hover:text-dark-purple transition-colors duration-300';
        } else {
            $atts['class'] = 'block w-full py-2 px-3 text-purple hover:text-dark-purple hover:bg-purple/5 transition-colors duration-300 rounded-md';
        }

        // Add dropdown toggle for items with children
        if (in_array('menu-item-has-children', $classes)) {
            $atts['aria-expanded'] = 'false';
            $atts['aria-haspopup'] = 'true';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        // Get icon and description for menu items if available
        $icon = get_field('menu_item_icon', $item->ID);
        $description = get_field('menu_item_description', $item->ID);

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        
        // Add icon if available
        if (!empty($icon) && $depth > 0) {
            $item_output .= '<span class="mr-2 inline-flex">';
            $item_output .= '<i data-lucide="' . esc_attr($icon) . '" class="size-5 text-purple"></i>';
            $item_output .= '</span>';
        }
        
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        
        // Add description if available
        if (!empty($description) && $depth > 0) {
            $item_output .= '<p class="mt-1 text-sm text-purple/80">' . esc_html($description) . '</p>';
        }
        
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
?>

<header id="masthead" class="sticky top-0 z-50 bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <?php if (has_custom_logo()) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                        <img src="<?php echo esc_url(get_theme_file_uri('/assets/images/emp-logo.svg')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-12 w-auto">
                    </a>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <button id="mobile-menu-toggle" class="[:not(:hover)]:text-purple hover:text-dark-purple focus:outline-none transition-colors duration-300 lg:hidden flex items-center p-2" aria-label="Toggle menu" aria-expanded="false">
                <i data-lucide="menu" class="menu-icon size-6"></i>
                <i data-lucide="x" class="close-icon size-6 hidden"></i>
            </button>

            <!-- Navigation -->
            <div id="nav-container" class="hidden lg:flex items-center justify-between flex-1 pl-8">
                <nav id="site-navigation" class="flex items-center justify-center flex-1" aria-label="<?php esc_attr_e('Main Navigation', '_emp'); ?>">
                    <?php
                    // Check if the menu exists and display it
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id'        => 'primary-menu',
                                'container'      => false,
                                'menu_class'     => 'flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-8',
                                'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
                                'walker'         => new EMP_Walker_Nav_Menu(),
                                'fallback_cb'    => false,
                            )
                        );
                    } else {
                        // Fallback menu if no menu is assigned
                        echo '<ul id="primary-menu" class="flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-8" aria-label="submenu">';
                        echo '<li class="relative"><a href="' . esc_url(home_url('/')) . '" class="block py-2 px-4 text-purple hover:text-dark-purple transition-colors duration-300">Home</a></li>';
                        echo '<li class="relative"><a href="#" class="block py-2 px-4 text-purple hover:text-dark-purple transition-colors duration-300">About</a></li>';
                        echo '<li class="relative"><a href="#" class="block py-2 px-4 text-purple hover:text-dark-purple transition-colors duration-300">Services</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </nav>

                <!-- CTA Buttons -->
                <div class="hidden lg:flex items-center space-x-4 ml-8">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('get-started'))); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-purple/10 bg-white px-5 py-2.5 text-purple hover:bg-purple/5 transition-colors font-body">
                        Get Started
                    </a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-pink bg-pink px-5 py-2.5 text-white hover:bg-pink/90 transition-colors font-body">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }
    
    /**
     * Mobile Menu Functionality
     */
    const initMobileMenu = () => {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const navContainer = document.getElementById('nav-container');
        const menuIcon = document.querySelector('.menu-icon');
        const closeIcon = document.querySelector('.close-icon');
        
        if (!mobileMenuToggle) return;
        
        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            
            navContainer.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            
            if (window.innerWidth < 1028) {
                navContainer.classList.toggle('mobile-menu-open');
            }
        });
        
        // Handle mobile dropdowns
        const dropdownLinks = document.querySelectorAll('#primary-menu .has-dropdown > a');
        
        dropdownLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.innerWidth >= 1028) return;
                
                const parent = this.parentNode;
                const submenu = parent.querySelector('.sub-menu');
                
                if (submenu) {
                    e.preventDefault();
                    
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !isExpanded);
                    
                    parent.classList.toggle('active');
                }
            });
        });
    };
    
    /**
     * Desktop Menu Functionality
     */
    const initDesktopMenu = () => {
        // Keyboard accessibility for desktop dropdowns
        const dropdownLinks = document.querySelectorAll('#primary-menu .has-dropdown > a');
        
        dropdownLinks.forEach(link => {
            link.addEventListener('keydown', function(e) {
                if (window.innerWidth < 1028) return;
                
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    
                    const parent = this.parentNode;
                    const submenu = parent.querySelector('.sub-menu');
                    
                    if (submenu) {
                        const isExpanded = this.getAttribute('aria-expanded') === 'true';
                        this.setAttribute('aria-expanded', !isExpanded);
                        
                        if (!isExpanded) {
                            // Close all other open submenus
                            document.querySelectorAll('#primary-menu .has-dropdown > a[aria-expanded="true"]').forEach(item => {
                                if (item !== this) {
                                    item.setAttribute('aria-expanded', 'false');
                                    const menu = item.parentNode.querySelector('.sub-menu');
                                    if (menu) {
                                        menu.classList.remove('opacity-100', 'visible');
                                        menu.classList.add('opacity-0', 'invisible');
                                    }
                                }
                            });
                            
                            // Open this submenu
                            submenu.classList.remove('opacity-0', 'invisible');
                            submenu.classList.add('opacity-100', 'visible');
                            
                            // Focus the first link in the submenu
                            const firstLink = submenu.querySelector('a');
                            if (firstLink) {
                                firstLink.focus();
                            }
                        } else {
                            // Close this submenu
                            submenu.classList.remove('opacity-100', 'visible');
                            submenu.classList.add('opacity-0', 'invisible');
                        }
                    }
                }
            });
        });
    };
    
    /**
     * Responsive Behavior
     */
    const handleResponsive = () => {
        const navContainer = document.getElementById('nav-container');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const menuIcon = document.querySelector('.menu-icon');
        const closeIcon = document.querySelector('.close-icon');
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1028) {
                navContainer.classList.remove('mobile-menu-open');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileMenuToggle.setAttribute('aria-expanded', 'false');
                
                if (!navContainer.classList.contains('lg:flex')) {
                    navContainer.classList.add('lg:flex');
                }
                
                // Reset any mobile-specific states
                document.querySelectorAll('#primary-menu .has-dropdown.active').forEach(item => {
                    item.classList.remove('active');
                });
            }
        });
        
        // Close submenus when pressing Escape
        document.addEventListener('keyup', function(e) {
            if (e.key === 'Escape') {
                // Close desktop dropdowns
                document.querySelectorAll('#primary-menu .has-dropdown > a[aria-expanded="true"]').forEach(item => {
                    item.setAttribute('aria-expanded', 'false');
                    const submenu = item.parentNode.querySelector('.sub-menu');
                    if (submenu) {
                        submenu.classList.remove('opacity-100', 'visible');
                        submenu.classList.add('opacity-0', 'invisible');
                    }
                });
                
                // Close mobile menu if open
                if (navContainer.classList.contains('mobile-menu-open')) {
                    mobileMenuToggle.click();
                }
            }
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth < 1028) return;
            
            const isDropdownLink = e.target.closest('#primary-menu .has-dropdown > a');
            const isSubmenu = e.target.closest('.sub-menu');
            
            if (!isDropdownLink && !isSubmenu) {
                document.querySelectorAll('#primary-menu .has-dropdown > a[aria-expanded="true"]').forEach(item => {
                    item.setAttribute('aria-expanded', 'false');
                    const submenu = item.parentNode.querySelector('.sub-menu');
                    if (submenu) {
                        submenu.classList.remove('opacity-100', 'visible');
                        submenu.classList.add('opacity-0', 'invisible');
                    }
                });
            }
        });
    };
    
    // Initialize all menu functionality
    initMobileMenu();
    initDesktopMenu();
    handleResponsive();
});
</script>

<style>
/* Mobile Menu Styles */
@media (max-width: 1027px) {
    #nav-container.mobile-menu-open {
        display: flex !important;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: white;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        z-index: 50;
        border-top: 1px solid rgba(128, 70, 165, 0.1);
    }

    #nav-container.mobile-menu-open #site-navigation {
        margin-bottom: 1.5rem;
        width: 100%;
    }

    #nav-container.mobile-menu-open .flex.flex-col {
        width: 100%;
        gap: 0.5rem;
    }

    #nav-container.mobile-menu-open #primary-menu > li > a {
        padding: 0.875rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }

    #nav-container.mobile-menu-open #primary-menu > li:hover > a {
        background-color: rgba(128, 70, 165, 0.05);
    }
    
    /* Mobile dropdown styles */
    .has-dropdown .sub-menu {
        display: none;
        padding: 0.5rem 0 0.5rem 1rem;
        margin: 0.5rem 0;
        border-left: 2px solid #8046A5;
        background-color: rgba(128, 70, 165, 0.02);
        border-radius: 0 0.375rem 0.375rem 0;
    }
    
    .has-dropdown.active .sub-menu {
        display: block;
        position: relative;
        animation: slideDown 0.2s ease-out;
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .sub-menu .menu-item {
        margin-bottom: 0.5rem;
    }

    .sub-menu .menu-item:last-child {
        margin-bottom: 0;
    }

    .sub-menu .menu-item a {
        padding: 0.5rem 1rem;
        display: block;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .has-dropdown .sub-menu > li:hover > a {
        opacity: 1;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Mobile CTA buttons */
    #nav-container.mobile-menu-open .hidden.lg\:flex {
        display: flex !important;
        flex-direction: column;
        gap: 0.75rem;
        width: 100%;
    }

    #nav-container.mobile-menu-open .hidden.lg\:flex a {
        width: 100%;
        justify-content: center;
    }
}

/* Desktop Menu Styles */
@media (min-width: 1028px) {
    .menu-item-has-children {
        position: relative;
        z-index: 10;
    }

    .menu-item-has-children:hover {
        z-index: 20;
    }

    .sub-menu {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(128, 70, 165, 0.1);
        padding: 0.5rem;
        position: absolute;
        top: calc(100% - 5px);
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        visibility: hidden;
        z-index: 30;
        transition: opacity 0.2s ease, visibility 0.2s ease;
    }

    .menu-item-has-children:hover > .sub-menu {
        opacity: 1;
        visibility: visible;
    }

    /* Add a small triangle indicator */
    .sub-menu::before {
        content: '';
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%) rotate(45deg);
        width: 10px;
        height: 10px;
        background-color: white;
        border-left: 1px solid rgba(128, 70, 165, 0.1);
        border-top: 1px solid rgba(128, 70, 165, 0.1);
    }
    
    /* Active state for current page */
    .current-menu-item > a,
    .current-page-ancestor > a,
    .current_page_parent > a {
        color: #5D2E85 !important;
        font-weight: 600;
    }
    
    /* Active state for submenu items */
    .sub-menu .current-menu-item > a {
        background-color: rgba(128, 70, 165, 0.1);
        color: #5D2E85 !important;
        font-weight: 600;
    }
    
    /* Ensure the dropdown doesn't go off-screen on the right */
    .menu-item-has-children:last-child .sub-menu,
    .menu-item-has-children:nth-last-child(2) .sub-menu {
        left: auto;
        right: 0;
        transform: none;
    }

    .menu-item-has-children:last-child .sub-menu::before,
    .menu-item-has-children:nth-last-child(2) .sub-menu::before {
        left: auto;
        right: 2rem;
    }

    /* Ensure the dropdown doesn't go off-screen on the left */
    .menu-item-has-children:first-child .sub-menu {
        left: 0;
        transform: none;
    }

    .menu-item-has-children:first-child .sub-menu::before {
        left: 2rem;
        transform: rotate(45deg);
    }

    .sub-menu .menu-item {
        display: block;
        width: 100%;
    }

    .sub-menu .menu-item a {
        padding: 0.625rem 1rem;
        display: block;
        width: 100%;
        white-space: nowrap;
        border-radius: 0.375rem;
        font-size: 0.9375rem;
    }

    .sub-menu .menu-item a:hover {
        background-color: rgba(128, 70, 165, 0.05);
    }
    
    /* Hover effect for desktop menu items */
    .menu-item-has-children > a {
        color: #5D2E85; /* dark-purple */
    }

    /* Animation for dropdown menus */
    .menu-item-has-children:hover .sub-menu {
        animation: fadeIn 0.2s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
}

/* Focus styles for accessibility */
#primary-menu a:focus-visible {
    outline: 2px solid #8046A5;
    outline-offset: 2px;
    border-radius: 0.25rem;
}

/* Animation for dropdown menus */
.sub-menu {
    transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out, transform 0.2s ease-in-out;
}
</style>
