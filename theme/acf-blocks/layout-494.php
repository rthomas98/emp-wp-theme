<?php
/**
 * Layout 494 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$image = get_sub_field('image');
$tagline = get_sub_field('sub_header') ?: 'Tagline';
$heading = get_sub_field('header') ?: 'Medium length section heading goes here';
$description = get_sub_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.';

// Process main image
$main_image_url = '';
$main_image_alt = '';

if (!empty($image)) {
    if (is_array($image) && isset($image['url'])) {
        $main_image_url = $image['url'];
        $main_image_alt = isset($image['alt']) ? $image['alt'] : '';
    } elseif (is_string($image)) {
        $main_image_url = $image;
    }
}

if (empty($main_image_url)) {
    $main_image_url = 'https://placehold.co/800x600';
}

// Get tabs from repeater field
$tabs = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        
        // Get tab fields
        $tab_heading = get_sub_field('header');
        $tab_description = get_sub_field('content');
        
        // Handle potential array values for text fields
        $tab_heading = is_array($tab_heading) ? (isset($tab_heading['text']) ? $tab_heading['text'] : '') : $tab_heading;
        $tab_description = is_array($tab_description) ? (isset($tab_description['text']) ? $tab_description['text'] : '') : $tab_description;
        
        // Add tab to array
        $tabs[] = [
            'heading' => $tab_heading ?: 'Short heading goes here',
            'description' => $tab_description ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ];
    }
}

// If no tabs are found, provide default content
if (empty($tabs)) {
    $tabs = [
        [
            'heading' => 'Short heading goes here',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
        ],
        [
            'heading' => 'Short heading goes here',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
        ],
        [
            'heading' => 'Short heading goes here',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'
        ]
    ];
}

// Get buttons
$buttons = [];
if (have_rows('buttons')) {
    while (have_rows('buttons')) {
        the_row();
        
        $button_one_label = get_sub_field('button_one_label');
        $button_one_link_field = get_sub_field('button_one_link');
        $button_two_label = get_sub_field('button_two_label');
        $button_two_link_field = get_sub_field('button_two_link');
        
        // Process button links
        $button_one_link = '#';
        if (is_array($button_one_link_field) && isset($button_one_link_field['url'])) {
            $button_one_link = $button_one_link_field['url'];
        } elseif (is_string($button_one_link_field)) {
            $button_one_link = $button_one_link_field;
        }
        
        $button_two_link = '#';
        if (is_array($button_two_link_field) && isset($button_two_link_field['url'])) {
            $button_two_link = $button_two_link_field['url'];
        } elseif (is_string($button_two_link_field)) {
            $button_two_link = $button_two_link_field;
        }
        
        $buttons = [
            'button_one_label' => $button_one_label ?: 'Button',
            'button_one_link' => $button_one_link,
            'button_two_label' => $button_two_label ?: 'Button',
            'button_two_link' => $button_two_link
        ];
        
        // Only process the first row of the buttons repeater
        break;
    }
}

// If no buttons are found, provide default content
if (empty($buttons)) {
    $buttons = [
        'button_one_label' => 'Button',
        'button_one_link' => '#',
        'button_two_label' => 'Button',
        'button_two_link' => '#'
    ];
}
?>

<section class="layout-494 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="relative flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 md:pr-6 lg:pr-10">
                <div class="mb-8 md:hidden">
                    <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                        <?php echo esc_html($tagline); ?>
                    </p>
                    <h1 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                        <?php echo esc_html($heading); ?>
                    </h1>
                    <p class="font-body text-purple/80 md:text-md">
                        <?php echo esc_html($description); ?>
                    </p>
                </div>
                
                <!-- Main Image Area -->
                <div class="relative">
                    <img 
                        src="<?php echo esc_url($main_image_url); ?>" 
                        alt="<?php echo esc_attr($main_image_alt); ?>" 
                        class="w-full h-auto object-cover mb-6 md:mb-0"
                    />
                </div>
            </div>
            
            <div class="w-full md:w-1/2 md:pl-6 lg:pl-10">
                <div class="mb-8 hidden md:block">
                    <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                        <?php echo esc_html($tagline); ?>
                    </p>
                    <h1 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                        <?php echo esc_html($heading); ?>
                    </h1>
                    <p class="font-body text-purple/80 md:text-md">
                        <?php echo esc_html($description); ?>
                    </p>
                </div>
                
                <!-- Tabs Navigation -->
                <div class="static flex flex-col flex-wrap justify-stretch md:block">
                    <div class="relative grid auto-cols-fr grid-cols-1 grid-rows-[auto_auto] items-start md:mb-0 md:items-stretch">
                        <?php foreach ($tabs as $index => $tab) : ?>
                            <div class="tab-trigger cursor-pointer border-b border-gray-200 py-4 <?php echo $index === 0 ? 'active opacity-100' : 'opacity-25'; ?>" data-tab="<?php echo esc_attr($index); ?>">
                                <h2 class="text-xl font-bold font-heading text-purple md:text-2xl">
                                    <?php echo esc_html($tab['heading']); ?>
                                </h2>
                                <div class="tab-description overflow-hidden" style="<?php echo $index === 0 ? '' : 'height: 0; opacity: 0;'; ?>">
                                    <p class="mt-2 font-body text-purple/80">
                                        <?php echo esc_html($tab['description']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <a href="<?php echo esc_url($buttons['button_one_link']); ?>" class="inline-flex items-center justify-center rounded-md bg-pink px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-dark-purple transition-colors duration-200 font-body">
                        <?php echo esc_html($buttons['button_one_label']); ?>
                    </a>
                    
                    <a href="<?php echo esc_url($buttons['button_two_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                        <?php echo esc_html($buttons['button_two_label']); ?>
                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Tab functionality
    const tabTriggers = document.querySelectorAll('.tab-trigger');
    
    tabTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            // Update active tab trigger
            tabTriggers.forEach(t => {
                t.classList.remove('active', 'opacity-100');
                t.classList.add('opacity-25');
                
                // Hide description
                const description = t.querySelector('.tab-description');
                description.style.height = '0';
                description.style.opacity = '0';
            });
            
            this.classList.add('active', 'opacity-100');
            this.classList.remove('opacity-25');
            
            // Show description
            const activeDescription = this.querySelector('.tab-description');
            activeDescription.style.height = 'auto';
            activeDescription.style.opacity = '1';
        });
    });
});
</script>

<style>
.tab-description {
    transition: height 0.3s ease-in-out, opacity 0.3s ease-in-out;
}
</style>