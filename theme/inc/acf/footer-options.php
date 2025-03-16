<?php
/**
 * Register ACF fields for footer options
 *
 * @package _emp
 */

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key' => 'group_footer_options',
        'title' => 'Footer Options',
        'fields' => array(
            array(
                'key' => 'field_footer_heading',
                'label' => 'Footer Heading',
                'name' => 'footer_heading',
                'type' => 'text',
                'instructions' => 'Enter the main heading for the footer section',
                'required' => 0,
                'default_value' => 'Explore Our Comprehensive Technology Solutions',
            ),
            array(
                'key' => 'field_footer_description',
                'label' => 'Footer Description',
                'name' => 'footer_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description text for the footer section',
                'required' => 0,
                'default_value' => 'Empuls3 delivers innovative solutions tailored to your business needs, ensuring growth and digital excellence.',
            ),
            array(
                'key' => 'field_social_links',
                'label' => 'Social Media Links',
                'name' => 'social_links',
                'type' => 'group',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_facebook_url',
                        'label' => 'Facebook URL',
                        'name' => 'facebook_url',
                        'type' => 'url',
                        'instructions' => 'Enter your Facebook profile URL',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_instagram_url',
                        'label' => 'Instagram URL',
                        'name' => 'instagram_url',
                        'type' => 'url',
                        'instructions' => 'Enter your Instagram profile URL',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_twitter_url',
                        'label' => 'Twitter URL',
                        'name' => 'twitter_url',
                        'type' => 'url',
                        'instructions' => 'Enter your Twitter profile URL',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_linkedin_url',
                        'label' => 'LinkedIn URL',
                        'name' => 'linkedin_url',
                        'type' => 'url',
                        'instructions' => 'Enter your LinkedIn profile URL',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_youtube_url',
                        'label' => 'YouTube URL',
                        'name' => 'youtube_url',
                        'type' => 'url',
                        'instructions' => 'Enter your YouTube channel URL',
                        'required' => 0,
                    ),
                ),
            ),
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
