<?php
/**
 * Header 37 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$header = get_sub_field('header') ?: 'Medium length hero heading goes here';
$content = get_sub_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.';
$image = get_sub_field('image');

// Process image
$image_url = '';
$image_alt = '';

if (!empty($image)) {
    if (is_array($image) && isset($image['url'])) {
        $image_url = $image['url'];
        $image_alt = isset($image['alt']) ? $image['alt'] : '';
    } elseif (is_string($image)) {
        $image_url = $image;
    }
}

// If no image is set, use a placeholder
if (empty($image_url)) {
    $image_url = 'https://placehold.co/1200x800/purple/white?text=Hero+Image';
}

// Get button fields
$button_one_label = '';
$button_one_link = '';
$button_two_label = '';
$button_two_link = '';

// Check if button_one_label is a repeater field
if (have_rows('button_one_label')) {
    while (have_rows('button_one_label')) {
        the_row();
        
        $button_one_label = get_sub_field('button_one_label') ?: 'Button';
        $button_one_link_field = get_sub_field('button_one_link');
        $button_two_label = get_sub_field('button_two_label') ?: 'Button';
        $button_two_link_field = get_sub_field('button_two_link');
        
        // Process button links
        if (!empty($button_one_link_field)) {
            if (is_array($button_one_link_field) && isset($button_one_link_field['url'])) {
                $button_one_link = $button_one_link_field['url'];
            } elseif (is_string($button_one_link_field)) {
                $button_one_link = $button_one_link_field;
            }
        }
        
        if (!empty($button_two_link_field)) {
            if (is_array($button_two_link_field) && isset($button_two_link_field['url'])) {
                $button_two_link = $button_two_link_field['url'];
            } elseif (is_string($button_two_link_field)) {
                $button_two_link = $button_two_link_field;
            }
        }
        
        // Only process the first row
        break;
    }
} else {
    // Check if they are regular fields instead of repeater
    $button_one_label = get_sub_field('button_one_label') ?: 'Button';
    $button_one_link_field = get_sub_field('button_one_link');
    $button_two_label = get_sub_field('button_two_label') ?: 'Button';
    $button_two_link_field = get_sub_field('button_two_link');
    
    // Process button links
    if (!empty($button_one_link_field)) {
        if (is_array($button_one_link_field) && isset($button_one_link_field['url'])) {
            $button_one_link = $button_one_link_field['url'];
        } elseif (is_string($button_one_link_field)) {
            $button_one_link = $button_one_link_field;
        }
    }
    
    if (!empty($button_two_link_field)) {
        if (is_array($button_two_link_field) && isset($button_two_link_field['url'])) {
            $button_two_link = $button_two_link_field['url'];
        } elseif (is_string($button_two_link_field)) {
            $button_two_link = $button_two_link_field;
        }
    }
}

// Set default links if empty
if (empty($button_one_link)) {
    $button_one_link = '#';
}

if (empty($button_two_link)) {
    $button_two_link = '#';
}
?>

<section class="header-37 grid grid-cols-1 items-center gap-y-16 pt-16 md:pt-24 lg:grid-cols-2 lg:pt-0">
    <div class="order-2 lg:order-1">
        <img
            src="<?php echo esc_url($image_url); ?>"
            alt="<?php echo esc_attr($image_alt); ?>"
            class="w-full object-cover lg:h-screen lg:max-h-[60rem]"
        />
    </div>
    <div class="order-1 mx-[5%] sm:max-w-md md:justify-self-start lg:order-2 lg:ml-20 lg:mr-[5vw]">
        <h1 class="mb-5 text-5xl font-bold font-heading text-purple md:mb-6 md:text-6xl lg:text-7xl">
            <?php echo esc_html($header); ?>
        </h1>
        <p class="font-body text-purple/80 md:text-lg">
            <?php echo esc_html($content); ?>
        </p>
        <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
            <?php if (!empty($button_one_label)) : ?>
                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-pink hover:bg-pink/90 text-white font-semibold rounded-md transition-colors duration-200">
                    <?php echo esc_html($button_one_label); ?>
                    <i data-lucide="chevron-right" class="ml-2 w-5 h-5"></i>
                </a>
            <?php endif; ?>
            
            <?php if (!empty($button_two_label)) : ?>
                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-transparent hover:bg-purple/10 text-purple border border-purple font-semibold rounded-md transition-colors duration-200">
                    <?php echo esc_html($button_two_label); ?>
                    <i data-lucide="chevron-right" class="ml-2 w-5 h-5"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
});
</script>