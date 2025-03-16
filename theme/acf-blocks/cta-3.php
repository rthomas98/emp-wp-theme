<?php
/**
 * CTA 3 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$header = get_sub_field('header') ?: 'Ready to Transform Your Business?';
$content = get_sub_field('content') ?: 'Get in touch with us today to discover how our innovative solutions can effectively propel your digital transformation journey forward. We\'re here to help you navigate the complexities of change and achieve your business goals with confidence and expertise.';
$background_image = get_sub_field('background_image');

// Process background image
$background_image_url = '';
if (!empty($background_image)) {
    if (is_array($background_image) && isset($background_image['url'])) {
        $background_image_url = $background_image['url'];
    } elseif (is_string($background_image)) {
        $background_image_url = $background_image;
    }
}

// If no background image is set, use a placeholder
if (empty($background_image_url)) {
    $background_image_url = 'https://placehold.co/1920x1080/purple/white?text=Background+Image';
}

// Get buttons from repeater field
$button_one_label = '';
$button_one_link = '';
$button_two_label = '';
$button_two_link = '';

if (have_rows('buttons')) {
    while (have_rows('buttons')) {
        the_row();
        
        // Get button fields
        $button_one_label = get_sub_field('button_one_label') ?: 'Learn More';
        $button_one_link_field = get_sub_field('button_one_link');
        $button_two_label = get_sub_field('button_two_label') ?: 'Sign Up';
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
        
        // Only process the first row of buttons
        break;
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

<section class="cta-3 relative px-[5%] py-16 md:py-24 lg:py-28">
    <div class="container relative z-10">
        <div class="w-full max-w-lg">
            <h2 class="mb-5 text-4xl font-bold font-heading text-white md:mb-6 md:text-5xl lg:text-6xl">
                <?php echo esc_html($header); ?>
            </h2>
            <p class="font-body text-white md:text-lg">
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
                    <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-transparent hover:bg-white/10 text-white border border-white font-semibold rounded-md transition-colors duration-200">
                        <?php echo esc_html($button_two_label); ?>
                        <i data-lucide="chevron-right" class="ml-2 w-5 h-5"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="absolute inset-0 z-0">
        <img
            src="<?php echo esc_url($background_image_url); ?>"
            class="w-full h-full object-cover"
            alt="Background image"
        />
        <div class="absolute inset-0 bg-black/50"></div>
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