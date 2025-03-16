<?php
/**
 * ACF Fields Configuration
 *
 * @package _emp
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Register Menu Item Fields
 */
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_menu_item_fields',
        'title' => 'Menu Item Fields',
        'fields' => array(
            array(
                'key' => 'field_menu_item_icon',
                'label' => 'Icon',
                'name' => 'menu_item_icon',
                'type' => 'text',
                'instructions' => 'Enter the Lucide icon name (e.g., "search", "globe", "layout")',
                'required' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'field_menu_item_description',
                'label' => 'Description',
                'name' => 'menu_item_description',
                'type' => 'text',
                'instructions' => 'Enter a short description for this menu item',
                'required' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
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
        'show_in_rest' => false,
    ));
}
