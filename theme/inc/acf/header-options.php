<?php
/**
 * ACF Fields for Header Options
 *
 * @package _emp
 */

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_header_options',
        'title' => 'Header Options',
        'fields' => array(
            array(
                'key' => 'field_header_logo',
                'label' => 'Header Logo',
                'name' => 'header_logo',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_header_logo_url',
                        'label' => 'Logo URL',
                        'name' => 'url',
                        'type' => 'url',
                        'default_value' => home_url('/'),
                    ),
                    array(
                        'key' => 'field_header_logo_image',
                        'label' => 'Logo Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'preview_size' => 'medium',
                        'instructions' => 'Upload your logo image. PNG or JPG format recommended.',
                    ),
                    array(
                        'key' => 'field_header_logo_alt',
                        'label' => 'Logo Alt Text',
                        'name' => 'alt',
                        'type' => 'text',
                        'default_value' => get_bloginfo('name'),
                    ),
                ),
            ),
            array(
                'key' => 'field_header_buttons',
                'label' => 'Header Buttons',
                'name' => 'header_buttons',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Button',
                'min' => 1,
                'max' => 2,
                'sub_fields' => array(
                    array(
                        'key' => 'field_header_button_text',
                        'label' => 'Button Text',
                        'name' => 'text',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_header_button_url',
                        'label' => 'Button URL',
                        'name' => 'url',
                        'type' => 'url',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_header_button_style',
                        'label' => 'Button Style',
                        'name' => 'style',
                        'type' => 'select',
                        'choices' => array(
                            'primary' => 'Primary (Pink)',
                            'secondary' => 'Secondary (Purple)',
                        ),
                        'default_value' => 'secondary',
                    ),
                ),
            ),
            array(
                'key' => 'field_mega_menu_settings',
                'label' => 'Mega Menu Settings',
                'name' => 'mega_menu_settings',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_mega_menu_featured_heading',
                        'label' => 'Featured Section Heading',
                        'name' => 'featured_heading',
                        'type' => 'text',
                        'default_value' => 'Featured from Blog',
                    ),
                    array(
                        'key' => 'field_mega_menu_featured_post',
                        'label' => 'Featured Post',
                        'name' => 'featured_post',
                        'type' => 'post_object',
                        'post_type' => array('post'),
                        'return_format' => 'object',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_mega_menu_cta_text',
                        'label' => 'CTA Button Text',
                        'name' => 'cta_text',
                        'type' => 'text',
                        'default_value' => 'See all articles',
                    ),
                    array(
                        'key' => 'field_mega_menu_cta_url',
                        'label' => 'CTA Button URL',
                        'name' => 'cta_url',
                        'type' => 'url',
                        'default_value' => '/blog',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
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
