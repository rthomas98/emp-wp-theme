<?php
/**
 * Header Content Template Part
 * 
 * @package _emp
 */

// Get menu items from WordPress
$menu_items = wp_get_nav_menu_items('primary');
$menu_by_parent = array();

// Organize menu items by parent
if ($menu_items) {
    foreach ($menu_items as $item) {
        $parent_id = $item->menu_item_parent ? $item->menu_item_parent : 0;
        if (!isset($menu_by_parent[$parent_id])) {
            $menu_by_parent[$parent_id] = array();
        }
        $menu_by_parent[$parent_id][] = $item;
    }
}

// Get service pages
$service_pages = array();
$service_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => '_wp_page_template',
            'value' => 'service-template.php',
            'compare' => 'LIKE'
        )
    )
);

// Try to get service pages by slug pattern if template query doesn't work
if (empty($service_pages)) {
    $service_args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_name__in' => array(
            'services-overview',
            'application-services',
            'devops-services',
            'it-consulting-services',
            'maintenance-and-support',
            'smart-teams',
            'software-engineering-services'
        )
    );
}

$service_query = new WP_Query($service_args);
if ($service_query->have_posts()) {
    while ($service_query->have_posts()) {
        $service_query->the_post();
        $service_pages[] = array(
            'title' => get_the_title(),
            'url' => get_permalink(),
            'slug' => get_post_field('post_name')
        );
    }
    wp_reset_postdata();
}

// Manually define service pages if query returns no results
if (empty($service_pages)) {
    $base_url = 'http://localhost:10033/service/';
    $service_pages = array(
        array('title' => 'Services Overview', 'url' => $base_url . 'services-overview/', 'slug' => 'services-overview'),
        array('title' => 'Application Services', 'url' => $base_url . 'application-services/', 'slug' => 'application-services'),
        array('title' => 'DevOps Services', 'url' => $base_url . 'devops-services/', 'slug' => 'devops-services'),
        array('title' => 'IT Consulting Services', 'url' => $base_url . 'it-consulting-services/', 'slug' => 'it-consulting-services'),
        array('title' => 'Maintenance and Support', 'url' => $base_url . 'maintenance-and-support/', 'slug' => 'maintenance-and-support'),
        array('title' => 'Smart Teams', 'url' => $base_url . 'smart-teams/', 'slug' => 'smart-teams'),
        array('title' => 'Software Engineering Services', 'url' => $base_url . 'software-engineering-services/', 'slug' => 'software-engineering-services')
    );
}

// Map icons and descriptions to service pages
$service_icons = array(
    'services-overview' => array('icon' => 'layout-grid', 'description' => 'Explore our complete range of services'),
    'application-services' => array('icon' => 'app-window', 'description' => 'Custom application development and integration'),
    'devops-services' => array('icon' => 'git-merge', 'description' => 'Streamline your development and operations'),
    'it-consulting-services' => array('icon' => 'users', 'description' => 'Expert guidance for your technology needs'),
    'maintenance-and-support' => array('icon' => 'wrench', 'description' => 'Ongoing support for your digital solutions'),
    'smart-teams' => array('icon' => 'brain', 'description' => 'Dedicated teams for your complex projects'),
    'software-engineering-services' => array('icon' => 'code-2', 'description' => 'End-to-end software development solutions')
);

// Prepare service menu items
$service_menu_items = array();
foreach ($service_pages as $service) {
    $icon = isset($service_icons[$service['slug']]['icon']) ? $service_icons[$service['slug']]['icon'] : 'file';
    $description = isset($service_icons[$service['slug']]['description']) ? $service_icons[$service['slug']]['description'] : '';
    
    $service_menu_items[] = array(
        'title' => $service['title'],
        'url' => $service['url'],
        'icon' => $icon,
        'description' => $description
    );
}

// Get solution pages
$solution_pages = array();
$solution_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'meta_query' => array(
        array(
            'key' => '_wp_page_template',
            'value' => 'solution-template.php',
            'compare' => 'LIKE'
        )
    )
);

// Try to get solution pages by slug pattern if template query doesn't work
if (empty($solution_pages)) {
    $solution_args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'post_name__in' => array(
            'solutions-overview',
            'back-end-development',
            'front-end-development',
            'full-stack-development',
            'custom-software-development',
            'wordpress-development',
            'e-commerce-development',
            'hubspot-development',
            'mvp-development',
            'progressive-web-apps',
            'software-development-design',
            'react-native-development'
        )
    );
}

$solution_query = new WP_Query($solution_args);
if ($solution_query->have_posts()) {
    while ($solution_query->have_posts()) {
        $solution_query->the_post();
        $solution_pages[] = array(
            'title' => get_the_title(),
            'url' => get_permalink(),
            'slug' => get_post_field('post_name')
        );
    }
    wp_reset_postdata();
}

// Manually define solution pages if query returns no results
if (empty($solution_pages)) {
    $base_url = 'http://localhost:10033/solution/';
    $solution_pages = array(
        array('title' => 'Solutions Overview', 'url' => $base_url . 'solutions-overview/', 'slug' => 'solutions-overview'),
        array('title' => 'Back-End Development', 'url' => $base_url . 'back-end-development/', 'slug' => 'back-end-development'),
        array('title' => 'Front-End Development', 'url' => $base_url . 'front-end-development/', 'slug' => 'front-end-development'),
        array('title' => 'Full-Stack Development', 'url' => $base_url . 'full-stack-development/', 'slug' => 'full-stack-development'),
        array('title' => 'Custom Software Development', 'url' => $base_url . 'custom-software-development/', 'slug' => 'custom-software-development'),
        array('title' => 'WordPress Development', 'url' => $base_url . 'wordpress-development/', 'slug' => 'wordpress-development'),
        array('title' => 'E-commerce Development', 'url' => $base_url . 'e-commerce-development/', 'slug' => 'e-commerce-development'),
        array('title' => 'HubSpot Development', 'url' => $base_url . 'hubspot-development/', 'slug' => 'hubspot-development'),
        array('title' => 'MVP Development', 'url' => $base_url . 'mvp-development/', 'slug' => 'mvp-development'),
        array('title' => 'Progressive Web Apps', 'url' => $base_url . 'progressive-web-apps/', 'slug' => 'progressive-web-apps'),
        array('title' => 'Software Development & Design', 'url' => $base_url . 'software-development-design/', 'slug' => 'software-development-design'),
        array('title' => 'React Native Development', 'url' => $base_url . 'react-native-development/', 'slug' => 'react-native-development')
    );
}

// Map icons and descriptions to solution pages
$solution_icons = array(
    'solutions-overview' => array('icon' => 'layout-grid', 'description' => 'Explore our complete range of solutions'),
    'back-end-development' => array('icon' => 'server', 'description' => 'Robust server-side application development'),
    'front-end-development' => array('icon' => 'layout', 'description' => 'Beautiful and responsive user interfaces'),
    'full-stack-development' => array('icon' => 'layers', 'description' => 'End-to-end web application development'),
    'custom-software-development' => array('icon' => 'settings', 'description' => 'Tailored software solutions for your business'),
    'wordpress-development' => array('icon' => 'file-code', 'description' => 'Custom WordPress themes and plugins'),
    'e-commerce-development' => array('icon' => 'shopping-bag', 'description' => 'Online store and marketplace solutions'),
    'hubspot-development' => array('icon' => 'activity', 'description' => 'Custom HubSpot implementation and integration'),
    'mvp-development' => array('icon' => 'rocket', 'description' => 'Rapid prototype and MVP development'),
    'progressive-web-apps' => array('icon' => 'smartphone', 'description' => 'Fast, reliable, and engaging web applications'),
    'software-development-design' => array('icon' => 'pen-tool', 'description' => 'Beautiful and functional software design'),
    'react-native-development' => array('icon' => 'smartphone', 'description' => 'Cross-platform mobile app development')
);

// Prepare solution menu items
$solution_menu_items = array();
foreach ($solution_pages as $solution) {
    $icon = isset($solution_icons[$solution['slug']]['icon']) ? $solution_icons[$solution['slug']]['icon'] : 'file';
    $description = isset($solution_icons[$solution['slug']]['description']) ? $solution_icons[$solution['slug']]['description'] : '';
    
    $solution_menu_items[] = array(
        'title' => $solution['title'],
        'url' => $solution['url'],
        'icon' => $icon,
        'description' => $description
    );
}

// Get company pages
$company_pages = array();
$company_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_name__in' => array(
        'about-us',
        'partners'
    )
);

$company_query = new WP_Query($company_args);
if ($company_query->have_posts()) {
    while ($company_query->have_posts()) {
        $company_query->the_post();
        $company_pages[] = array(
            'title' => get_the_title(),
            'url' => get_permalink(),
            'slug' => get_post_field('post_name')
        );
    }
    wp_reset_postdata();
}

// Manually define company pages if query returns no results
if (empty($company_pages)) {
    $company_pages = array(
        array('title' => 'About Us', 'url' => 'http://localhost:10033/about-us/', 'slug' => 'about-us'),
        array('title' => 'Partners', 'url' => 'http://localhost:10033/partners/', 'slug' => 'partners')
    );
}

// Map icons and descriptions to company pages
$company_icons = array(
    'about-us' => array('icon' => 'users', 'description' => 'Learn more about our team and mission'),
    'partners' => array('icon' => 'handshake', 'description' => 'Our trusted technology partners')
);

// Prepare company menu items
$company_menu_items = array();
foreach ($company_pages as $company) {
    $icon = isset($company_icons[$company['slug']]['icon']) ? $company_icons[$company['slug']]['icon'] : 'building';
    $description = isset($company_icons[$company['slug']]['description']) ? $company_icons[$company['slug']]['description'] : '';
    
    $company_menu_items[] = array(
        'title' => $company['title'],
        'url' => $company['url'],
        'icon' => $icon,
        'description' => $description
    );
}

// Get resource pages
$resource_pages = array();
$resource_args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_name__in' => array(
        'insights',
        'case-studies',
        'frequently-asked-questions'
    )
);

$resource_query = new WP_Query($resource_args);
if ($resource_query->have_posts()) {
    while ($resource_query->have_posts()) {
        $resource_query->the_post();
        $resource_pages[] = array(
            'title' => get_the_title(),
            'url' => get_permalink(),
            'slug' => get_post_field('post_name')
        );
    }
    wp_reset_postdata();
}

// Manually define resource pages if query returns no results
if (empty($resource_pages)) {
    $resource_pages = array(
        array('title' => 'Insights', 'url' => 'http://localhost:10033/insights/', 'slug' => 'insights'),
        array('title' => 'Case Studies', 'url' => 'http://localhost:10033/case-studies/', 'slug' => 'case-studies'),
        array('title' => 'Frequently Asked Questions', 'url' => 'http://localhost:10033/frequently-asked-questions/', 'slug' => 'frequently-asked-questions')
    );
}

// Map icons and descriptions to resource pages
$resource_icons = array(
    'insights' => array('icon' => 'lightbulb', 'description' => 'Industry insights and thought leadership'),
    'case-studies' => array('icon' => 'file-text', 'description' => 'Success stories from our clients'),
    'frequently-asked-questions' => array('icon' => 'help-circle', 'description' => 'Answers to common questions')
);

// Prepare resource menu items
$resource_menu_items = array();
foreach ($resource_pages as $resource) {
    $icon = isset($resource_icons[$resource['slug']]['icon']) ? $resource_icons[$resource['slug']]['icon'] : 'file';
    $description = isset($resource_icons[$resource['slug']]['description']) ? $resource_icons[$resource['slug']]['description'] : '';
    
    $resource_menu_items[] = array(
        'title' => $resource['title'],
        'url' => $resource['url'],
        'icon' => $icon,
        'description' => $description
    );
}

// Sample menu items for demonstration
$sample_menu = array(
    array(
        'title' => 'Services',
        'url' => !empty($service_pages) ? $service_pages[0]['url'] : '#',
        'children' => $service_menu_items
    ),
    array(
        'title' => 'Solutions',
        'url' => !empty($solution_pages) ? $solution_pages[0]['url'] : '#',
        'children' => $solution_menu_items
    ),
    array(
        'title' => 'Company',
        'url' => !empty($company_pages) ? $company_pages[0]['url'] : '#',
        'children' => $company_menu_items
    ),
    array(
        'title' => 'Resources',
        'url' => !empty($resource_pages) ? $resource_pages[0]['url'] : '#',
        'children' => $resource_menu_items
    )
);

// URLs for CTA buttons
$get_started_url = '/get-started';
$contact_url = '/contact';

// Get page URLs
$about_url = get_permalink(get_page_by_path('about'));
$services_url = get_permalink(get_page_by_path('services'));
$resources_url = get_permalink(get_page_by_path('resources'));
$contact_url = get_permalink(get_page_by_path('contact'));
$get_started_url = get_permalink(get_page_by_path('get-started'));
?>

<style>
    /* Base styles */
    :root {
        --header-height: 4rem;
        --header-height-md: 4.5rem;
        --wp-admin-bar-height: 32px;
        --wp-admin-bar-height-mobile: 46px;
    }

    /* Admin bar adjustments */
    .admin-bar #relume {
        top: var(--wp-admin-bar-height);
    }

    @media screen and (max-width: 782px) {
        .admin-bar #relume {
            top: var(--wp-admin-bar-height-mobile);
        }
    }

    @media screen and (max-width: 600px) {
        .admin-bar #nav-content {
            height: calc(100vh - var(--header-height) - var(--wp-admin-bar-height-mobile));
        }
    }

    /* Transitions */
    .nav-dropdown-content {
        transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        opacity: 0;
        transform: translateY(-10px);
    }

    .nav-dropdown-content.open {
        opacity: 1;
        transform: translateY(0);
    }

    /* Mobile menu animations */
    #nav-content {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(100%);
        opacity: 1;
        display: none;
    }

    #nav-content.open {
        transform: translateX(0);
        display: block;
    }

    /* Mobile menu toggle */
    .mobile-menu-toggle span {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), 
                    width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @media (max-width: 1023px) {
        #nav-content {
            position: fixed;
            top: var(--header-height);
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: calc(100vh - var(--header-height));
            background-color: white;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            z-index: 50;
            padding: 1rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        #nav-content .nav-dropdown-content {
            position: static;
            width: 100%;
            border: none;
            padding: 0.5rem 1.5rem;
            background: transparent;
            transform: none;
        }

        #nav-content .nav-dropdown-content.open {
            transform: none;
        }

        #nav-content .nav-dropdown button {
            padding: 1rem 1.5rem;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #nav-content a:not(.nav-dropdown a) {
            padding: 1rem 1.5rem;
            width: 100%;
            display: block;
        }

        #nav-content .nav-dropdown-content a {
            padding: 0.75rem 0;
        }

        #nav-content .cta-buttons {
            padding: 1rem 1.5rem;
            margin-top: 1rem;
            border-top: 1px solid var(--border-primary);
        }
    }

    @media (min-width: 1024px) {
        #nav-content {
            transform: none;
            opacity: 1;
            display: flex;
        }
    }
</style>

<section id="relume" class="fixed top-0 left-0 right-0 z-[999] flex min-h-16 w-full items-center bg-white px-[5%] md:min-h-18">
    <div class="mx-auto flex size-full max-w-full items-center justify-between">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="relative z-10">
            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/emp-logo.svg')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-9 w-auto">
        </a>

        <!-- Desktop Navigation -->
        <div id="nav-content" class="lg:static lg:ml-6 lg:flex lg:h-auto lg:flex-1 lg:transform-none lg:items-center lg:justify-between lg:border-none lg:bg-transparent lg:px-0">
            <div class="flex flex-col items-start lg:flex-row lg:items-center">
                <?php if ($menu_items): ?>
                    <?php foreach ($menu_by_parent[0] as $item): ?>
                        <?php 
                        $has_children = isset($menu_by_parent[$item->ID]);
                        $item_classes = array(
                            'relative',
                            'block',
                            'w-full',
                            'text-md',
                            'text-purple',
                            'hover:text-dark-purple',
                            'transition-colors',
                            'lg:inline-block',
                            'lg:w-auto',
                            'lg:px-4',
                            'lg:py-6',
                            'lg:text-base'
                        );
                        
                        if ($has_children) {
                            $item_classes[] = 'nav-dropdown';
                        }
                        ?>

                        <?php if ($has_children): ?>
                            <div class="<?php echo esc_attr(implode(' ', $item_classes)); ?>" data-dropdown="<?php echo esc_attr($item->title); ?>">
                                <button class="relative flex w-full items-center justify-between whitespace-nowrap text-md text-purple hover:text-dark-purple transition-colors lg:w-auto lg:justify-start lg:gap-2 lg:px-4 lg:py-6 lg:text-base">
                                    <span><?php echo esc_html($item->title); ?></span>
                                    <i data-lucide="chevron-down" class="size-4 transition-transform duration-300"></i>
                                </button>
                                <nav class="nav-dropdown-content hidden lg:absolute lg:left-0 lg:top-full lg:w-screen lg:border-b lg:border-border-primary lg:bg-white lg:shadow-lg">
                                    <div class="mx-auto w-full max-w-screen-2xl px-[5%] py-8">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                            <?php foreach ($menu_by_parent[$item->ID] as $child): ?>
                                                <a href="<?php echo esc_url($child->url); ?>" class="grid w-full auto-cols-fr grid-cols-[max-content_1fr] items-start gap-x-3 py-2 text-purple hover:text-dark-purple hover:bg-purple/5 transition-colors rounded-md">
                                                    <div class="flex size-6 flex-col items-center justify-center">
                                                        <?php 
                                                        $icon = get_field('menu_item_icon', $child->ID);
                                                        if ($icon): 
                                                        ?>
                                                            <i data-lucide="<?php echo esc_attr($icon); ?>" class="size-5 text-purple"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="flex flex-col items-start justify-center">
                                                        <h5 class="font-semibold font-heading text-purple"><?php echo esc_html($child->title); ?></h5>
                                                        <?php 
                                                        $description = get_field('menu_item_description', $child->ID);
                                                        if ($description): 
                                                        ?>
                                                            <p class="hidden text-sm md:block font-body text-purple/80"><?php echo esc_html($description); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo esc_url($item->url); ?>" class="<?php echo esc_attr(implode(' ', $item_classes)); ?>">
                                <?php echo esc_html($item->title); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Sample menu items for demonstration -->
                    <?php foreach ($sample_menu as $item): ?>
                        <?php 
                        $has_children = !empty($item['children']);
                        $item_classes = array(
                            'relative',
                            'block',
                            'w-full',
                            'text-md',
                            'text-purple',
                            'hover:text-dark-purple',
                            'transition-colors',
                            'lg:inline-block',
                            'lg:w-auto',
                            'lg:px-4',
                            'lg:py-6',
                            'lg:text-base'
                        );
                        
                        if ($has_children) {
                            $item_classes[] = 'nav-dropdown';
                        }
                        ?>

                        <?php if ($has_children): ?>
                            <div class="<?php echo esc_attr(implode(' ', $item_classes)); ?>" data-dropdown="<?php echo esc_attr($item['title']); ?>">
                                <button class="relative flex w-full items-center justify-between whitespace-nowrap text-md text-purple hover:text-dark-purple transition-colors lg:w-auto lg:justify-start lg:gap-2 lg:px-4 lg:py-6 lg:text-base">
                                    <span><?php echo esc_html($item['title']); ?></span>
                                    <i data-lucide="chevron-down" class="size-4 transition-transform duration-300"></i>
                                </button>
                                <nav class="nav-dropdown-content hidden lg:absolute lg:left-0 lg:top-full lg:w-screen lg:border-b lg:border-border-primary lg:bg-white lg:shadow-lg">
                                    <div class="mx-auto w-full max-w-screen-2xl px-[5%] py-8">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                            <?php foreach ($item['children'] as $child): ?>
                                                <a href="<?php echo esc_url($child['url']); ?>" class="grid w-full auto-cols-fr grid-cols-[max-content_1fr] items-start gap-x-3 py-2 text-purple hover:text-dark-purple hover:bg-purple/5 transition-colors rounded-md">
                                                    <div class="flex size-6 flex-col items-center justify-center">
                                                        <?php if (!empty($child['icon'])): ?>
                                                            <i data-lucide="<?php echo esc_attr($child['icon']); ?>" class="size-5 text-purple"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="flex flex-col items-start justify-center">
                                                        <h5 class="font-semibold font-heading text-purple"><?php echo esc_html($child['title']); ?></h5>
                                                        <?php if (!empty($child['description'])): ?>
                                                            <p class="hidden text-sm md:block font-body text-purple/80"><?php echo esc_html($child['description']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo esc_url($item['url']); ?>" class="<?php echo esc_attr(implode(' ', $item_classes)); ?>">
                                <?php echo esc_html($item['title']); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- CTA Buttons -->
            <div class="cta-buttons flex items-center justify-center gap-4">
                <a href="<?php echo esc_url($get_started_url); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-purple/10 bg-white px-5 py-2.5 text-purple hover:bg-purple/5 transition-colors font-body">
                    Get Started
                </a>
                <a href="<?php echo esc_url($contact_url); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-pink bg-pink px-5 py-2.5 text-white hover:bg-pink/90 transition-colors font-body">
                    Contact Us
                </a>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button type="button" class="mobile-menu-toggle -mr-2 flex size-12 cursor-pointer flex-col items-center justify-center lg:hidden">
            <span class="my-[3px] h-0.5 w-6 bg-purple transition-transform duration-300"></span>
            <span class="my-[3px] h-0.5 w-6 bg-purple transition-all duration-300"></span>
            <span class="my-[3px] h-0.5 w-6 bg-purple transition-transform duration-300"></span>
        </button>
    </div>
</section>

<!-- Add spacing for fixed header -->
<div class="h-16 md:h-18 wp-admin-spacer"></div>

<script>
// Add this script to dynamically adjust the spacer height for admin bar
document.addEventListener('DOMContentLoaded', function() {
    const spacer = document.querySelector('.wp-admin-spacer');
    const isAdminBar = document.body.classList.contains('admin-bar');
    
    if (spacer && isAdminBar) {
        const adminBarHeight = window.innerWidth > 782 ? 32 : 46;
        spacer.style.marginTop = adminBarHeight + 'px';
    }
});
</script>
