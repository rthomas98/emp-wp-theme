<?php
/**
 * _emp functions and definitions
 *
 * @package _emp
 */

if ( ! defined( '_EMP_VERSION' ) ) {
    define( '_EMP_VERSION', '0.1.0' );
}

if ( ! defined( '_EMP_TYPOGRAPHY_CLASSES' ) ) {
    define(
        '_EMP_TYPOGRAPHY_CLASSES',
        'prose prose-neutral max-w-none prose-a:text-primary'
    );
}

if ( ! function_exists( '_emp_setup' ) ) :
    function _emp_setup() {
        load_theme_textdomain( '_emp', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );

        // Register navigation menus
        register_nav_menus(
            array(
                'primary' => esc_html__( 'Primary Menu', '_emp' ),
                'footer-legal' => esc_html__( 'Footer Legal', '_emp' ),
                'footer-company' => esc_html__( 'Footer Company', '_emp' ),
            )
        );

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        add_theme_support( 'customize-selective-refresh-widgets' );
        add_editor_style( 'style-editor.css' );
        add_editor_style( 'style-editor-extra.css' );
        add_theme_support( 'responsive-embeds' );
        remove_theme_support( 'block-templates' );
    }
endif;
add_action( 'after_setup_theme', '_emp_setup' );

/**
 * Register ACF Fields for Mega Menu
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
    acf_add_local_field_group( array(
        'key' => 'group_mega_menu_settings',
        'title' => 'Mega Menu Settings',
        'fields' => array(
            array(
                'key' => 'field_featured_section_heading',
                'label' => 'Featured Section Heading',
                'name' => 'featured_section_heading',
                'type' => 'text',
                'instructions' => 'Enter the heading for the featured section',
                'required' => 0,
                'default_value' => 'Featured Post',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_featured_post',
                'label' => 'Featured Post',
                'name' => 'featured_post',
                'type' => 'post_object',
                'instructions' => 'Select a post to feature in the mega menu',
                'required' => 0,
                'conditional_logic' => 0,
                'post_type' => array(
                    0 => 'post',
                ),
                'taxonomy' => '',
                'allow_null' => 1,
                'multiple' => 0,
                'return_format' => 'id',
                'ui' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'nav_menu',
                    'operator' => '==',
                    'value' => 'primary',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));

    acf_add_local_field_group( array(
        'key' => 'group_menu_item_settings',
        'title' => 'Menu Item Settings',
        'fields' => array(
            array(
                'key' => 'field_menu_icon',
                'label' => 'Menu Icon',
                'name' => 'menu_icon',
                'type' => 'text',
                'instructions' => 'Enter a Lucide icon name (e.g., "home", "users", "settings")',
                'required' => 0,
                'default_value' => '',
                'placeholder' => 'Enter icon name',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'nav_menu_item',
                    'operator' => '==',
                    'value' => 'all',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}

/**
 * Force create or update primary menu
 */
function _emp_force_create_primary_menu() {
    // Check if menu 1 exists
    $existing_menu = get_term_by('name', 'menu 1', 'nav_menu');
    
    // Only create default menu if menu 1 doesn't exist
    if (!$existing_menu) {
        // Create new menu
        $menu_id = wp_create_nav_menu('menu 1');
        
        if (!is_wp_error($menu_id)) {
            // Add Solutions menu item with children
            $solutions_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Solutions',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'custom'
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Digital Marketing',
                'menu-item-url' => home_url('/solutions/digital-marketing/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $solutions_id
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Web Development',
                'menu-item-url' => home_url('/solutions/web-development/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $solutions_id
            ));

            // Add Services menu item with children
            $services_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Services',
                'menu-item-url' => '#',
                'menu-item-status' => 'publish',
                'menu-item-type' => 'custom'
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'SEO',
                'menu-item-url' => home_url('/services/seo/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $services_id
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'PPC',
                'menu-item-url' => home_url('/services/ppc/'),
                'menu-item-status' => 'publish',
                'menu-item-parent-id' => $services_id
            ));

            // Add standalone menu items
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'About',
                'menu-item-url' => home_url('/about/'),
                'menu-item-status' => 'publish'
            ));

            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => 'Contact',
                'menu-item-url' => home_url('/contact/'),
                'menu-item-status' => 'publish'
            ));
        }
    } else {
        $menu_id = $existing_menu->term_id;
    }

    // Force assign menu to primary location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
}
// Force create menu on init
add_action('init', '_emp_force_create_primary_menu');

/**
 * Add custom CSS classes to menu items
 */
function _emp_add_menu_classes($classes, $item, $args) {
    if ($args->theme_location === 'primary') {
        // Add font classes
        $classes[] = 'font-body';
        
        // Add transition classes
        $classes[] = 'transition-colors';
        $classes[] = 'duration-200';
        
        // Add responsive classes
        $classes[] = 'w-full';
        $classes[] = 'lg:w-auto';
    }
    return $classes;
}
add_filter('nav_menu_css_class', '_emp_add_menu_classes', 10, 3);

/**
 * Add custom attributes to menu items
 */
function _emp_add_menu_link_attributes($atts, $item, $args, $depth) {
    if ($args->theme_location === 'primary') {
        $atts['class'] = 'menu-link font-body text-purple hover:text-dark-purple transition-colors duration-200';
        
        if ($depth === 0) {
            $atts['class'] .= ' lg:px-4 lg:py-2';
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', '_emp_add_menu_link_attributes', 10, 4);

/**
 * Register ACF Options Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title'     => esc_html__( 'Theme Options', '_emp' ),
            'menu_title'     => esc_html__( 'Theme Options', '_emp' ),
            'menu_slug'      => 'acf-options',
            'capability'     => 'edit_posts',
            'redirect'       => false,
            'position'      => '2',
            'icon_url'      => 'dashicons-admin-customizer',
            'update_button' => esc_html__( 'Update', '_emp' ),
            'updated_message' => esc_html__( 'Options Updated', '_emp' ),
        )
    );
}

/**
 * Register ACF Fields for Footer
 */
function _emp_register_footer_acf_fields() {
    if ( function_exists( 'acf_add_local_field_group' ) ) {
        acf_add_local_field_group(
            array(
                'key' => 'group_footer_settings',
                'title' => 'Footer Settings',
                'fields' => array(
                    array(
                        'key' => 'field_footer_heading',
                        'label' => 'Footer Heading',
                        'name' => 'footer_heading',
                        'type' => 'text',
                        'default_value' => 'Explore Our Comprehensive Technology Solutions',
                    ),
                    array(
                        'key' => 'field_footer_description',
                        'label' => 'Footer Description',
                        'name' => 'footer_description',
                        'type' => 'textarea',
                        'default_value' => 'Empuls3 delivers innovative solutions tailored to your business needs, ensuring growth and digital excellence.',
                    ),
                    array(
                        'key' => 'field_footer_cta_buttons',
                        'label' => 'CTA Buttons',
                        'name' => 'footer_cta_buttons',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_button_text',
                                'label' => 'Button Text',
                                'name' => 'button_text',
                                'type' => 'text'
                            ),
                            array(
                                'key' => 'field_button_url',
                                'label' => 'Button URL',
                                'name' => 'button_url',
                                'type' => 'url'
                            ),
                            array(
                                'key' => 'field_button_style',
                                'label' => 'Button Style',
                                'name' => 'button_style',
                                'type' => 'select',
                                'choices' => array(
                                    'primary' => 'Primary',
                                    'secondary' => 'Secondary'
                                )
                            )
                        )
                    ),
                    array(
                        'key' => 'field_footer_team_images',
                        'label' => 'Team Member Images',
                        'name' => 'footer_team_images',
                        'type' => 'repeater',
                        'max' => 5,
                        'layout' => 'table',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_team_image',
                                'label' => 'Image',
                                'name' => 'image',
                                'type' => 'image',
                                'return_format' => 'array'
                            )
                        )
                    ),
                    array(
                        'key' => 'field_footer_social_links',
                        'label' => 'Social Links',
                        'name' => 'footer_social_links',
                        'type' => 'repeater',
                        'layout' => 'table',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_social_platform',
                                'label' => 'Platform',
                                'name' => 'platform',
                                'type' => 'select',
                                'choices' => array(
                                    'facebook' => 'Facebook',
                                    'instagram' => 'Instagram',
                                    'twitter' => 'Twitter',
                                    'linkedin' => 'LinkedIn',
                                    'youtube' => 'YouTube'
                                )
                            ),
                            array(
                                'key' => 'field_social_url',
                                'label' => 'URL',
                                'name' => 'url',
                                'type' => 'url'
                            )
                        )
                    ),
                    array(
                        'key' => 'field_footer_copyright',
                        'label' => 'Copyright Text',
                        'name' => 'footer_copyright',
                        'type' => 'text',
                        'default_value' => ' 2024 Empuls3. All rights reserved.',
                    )
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'theme-general-settings',
                        ),
                    ),
                ),
            )
        );
    }
}
add_action( 'acf/init', '_emp_register_footer_acf_fields' );

function _emp_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer', '_emp' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here to appear in your footer.', '_emp' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', '_emp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _emp_scripts() {
    // Styles
    wp_enqueue_style(
        '_emp-style',
        get_stylesheet_uri(),
        array(),
        _EMP_VERSION
    );

    // Scripts
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        array(),
        _EMP_VERSION,
        true
    );

    wp_enqueue_script(
        '_emp-mobile-menu',
        get_template_directory_uri() . '/assets/js/mobile-menu.js',
        array('lucide-icons'),
        _EMP_VERSION,
        true
    );

    wp_enqueue_script(
        '_emp-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('lucide-icons'),
        _EMP_VERSION,
        true
    );

    // Initialize Lucide icons
    wp_add_inline_script('lucide-icons', 'window.lucide.createIcons();', 'after');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action('wp_enqueue_scripts', '_emp_scripts');

function _emp_enqueue_block_editor_script() {
    if ( is_admin() ) {
        wp_enqueue_script(
            '_emp-editor',
            get_template_directory_uri() . '/js/block-editor.min.js',
            array(
                'wp-blocks',
                'wp-edit-post',
            ),
            _EMP_VERSION,
            true
        );
        wp_add_inline_script( '_emp-editor', "tailwindTypographyClasses = '" . esc_attr( _EMP_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
    }
}
add_action( 'enqueue_block_assets', '_emp_enqueue_block_editor_script' );

function _emp_tinymce_add_class( $settings ) {
    $settings['body_class'] = _EMP_TYPOGRAPHY_CLASSES;
    return $settings;
}
add_filter( 'tiny_mce_before_init', '_emp_tinymce_add_class' );

/**
 * Include template functions and tags
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/**
 * Include ACF field groups
 */
require get_template_directory() . '/inc/acf/header-options.php';

/**
 * Add custom body classes
 */
function _emp_body_classes( $classes ) {
    // Add page slug as class
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter( 'body_class', '_emp_body_classes' );

/**
 * Add custom image sizes
 */
function _emp_add_image_sizes() {
    add_image_size( 'hero', 1920, 1080, true );
    add_image_size( 'card', 800, 600, true );
}
add_action( 'after_setup_theme', '_emp_add_image_sizes' );

/**
 * Allow SVG uploads
 */
function _emp_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', '_emp_mime_types' );

/**
 * Remove default WordPress emoji support
 */
function _emp_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', '_emp_disable_emojis' );

// Add sample menu items if menu doesn't exist
function emp_create_sample_menu() {
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        
        // Create top-level items
        $services = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Services',
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-url' => '#',
        ));
        
        $solutions = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'Solutions',
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
            'menu-item-url' => '#',
        ));

        $about = wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => 'About',
            'menu-item-url' => '/about',
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
        ));

        // Add Services submenu items
        $service_items = array(
            array('Web Development', 'code-2', 'Custom web development solutions for your business'),
            array('Digital Marketing', 'megaphone', 'Strategic digital marketing services'),
            array('UI/UX Design', 'palette', 'User-centered design solutions'),
            array('Cloud Services', 'cloud', 'Scalable cloud infrastructure solutions'),
            array('Mobile Apps', 'smartphone', 'Native and cross-platform mobile applications'),
            array('Consulting', 'users', 'Expert technology consulting services')
        );

        foreach ($service_items as $item) {
            $item_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => $item[0],
                'menu-item-parent-id' => $services,
                'menu-item-status' => 'publish',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
            ));

            if ($item_id && !is_wp_error($item_id)) {
                update_field('menu_item_icon', $item[1], $item_id);
                update_field('menu_item_description', $item[2], $item_id);
            }
        }

        // Add Solutions submenu items
        $solution_items = array(
            array('Enterprise', 'building-2', 'Enterprise-grade business solutions'),
            array('Startups', 'rocket', 'Tailored solutions for growing startups'),
            array('Healthcare', 'heart-pulse', 'Digital healthcare solutions'),
            array('E-commerce', 'shopping-cart', 'Complete e-commerce solutions'),
            array('Education', 'graduation-cap', 'EdTech and learning solutions'),
            array('Finance', 'landmark', 'Fintech and banking solutions')
        );

        foreach ($solution_items as $item) {
            $item_id = wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title' => $item[0],
                'menu-item-parent-id' => $solutions,
                'menu-item-status' => 'publish',
                'menu-item-type' => 'custom',
                'menu-item-url' => '#',
            ));

            if ($item_id && !is_wp_error($item_id)) {
                update_field('menu_item_icon', $item[1], $item_id);
                update_field('menu_item_description', $item[2], $item_id);
            }
        }

        // Set menu location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_switch_theme', 'emp_create_sample_menu');
