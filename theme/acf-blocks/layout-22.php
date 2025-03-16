<?php
/**
 * Layout 22 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'React Native Development: Build Mobile Apps Efficiently';
$content = get_sub_field('content') ?: 'Empuls3 specializes in React Native Development, enabling the creation of cross-platform mobile applications that deliver native performance. Our team leverages this powerful framework to ensure your app reaches a wider audience without sacrificing quality.';

// Get icon
$icon = get_sub_field('icon');
$icon_url = '';
$icon_alt = '';

if (!empty($icon) && is_array($icon)) {
    $icon_url = $icon['url'];
    $icon_alt = $icon['alt'] ?: 'Feature icon';
} else {
    // Default to using a Lucide icon if no image is provided
    $icon_url = '';
    $icon_alt = '';
}

// Default button data
$default_buttons = [
    'button_one_label' => 'Learn More',
    'button_one_link' => '#',
    'button_two_label' => 'Need Help?',
    'button_two_link' => '#'
];

// Get button data from repeater field
$buttons = $default_buttons;
if (have_rows('buttons')) {
    while (have_rows('buttons')) {
        the_row();
        $button_one_label = get_sub_field('button_one_label');
        $button_one_link = get_sub_field('button_one_link');
        $button_two_label = get_sub_field('button_two_label');
        $button_two_link = get_sub_field('button_two_link');
        
        if (!empty($button_one_label)) {
            $buttons['button_one_label'] = $button_one_label;
        }
        
        if (!empty($button_one_link)) {
            $buttons['button_one_link'] = $button_one_link;
        }
        
        if (!empty($button_two_label)) {
            $buttons['button_two_label'] = $button_two_label;
        }
        
        if (!empty($button_two_link)) {
            $buttons['button_two_link'] = $button_two_link;
        }
    }
}

// Get image
$image = get_sub_field('image');
$image_url = '';
$image_alt = '';

if (!empty($image) && is_array($image)) {
    $image_url = $image['url'];
    $image_alt = $image['alt'] ?: 'Feature image';
} else {
    $image_url = 'https://placehold.co/800x600/purple/white?text=Feature+Image';
    $image_alt = 'Feature image';
}
?>

<section class="layout-22 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 gap-y-12 md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
            <div>
                <?php if (!empty($icon_url)) : ?>
                    <div class="mb-5 md:mb-6">
                        <img
                            src="<?php echo esc_url($icon_url); ?>"
                            class="w-20 h-20"
                            alt="<?php echo esc_attr($icon_alt); ?>"
                        />
                    </div>
                <?php else : ?>
                    <div class="mb-5 md:mb-6">
                        <i data-lucide="code" class="w-20 h-20 text-purple"></i>
                    </div>
                <?php endif; ?>
                
                <h2 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="font-body text-purple/80 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <?php if (!empty($buttons['button_one_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_one_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-white border border-purple text-purple hover:bg-purple/5 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($buttons['button_one_label']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($buttons['button_two_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_two_link']); ?>" class="inline-flex items-center text-pink hover:text-pink/80 font-semibold transition-colors duration-200">
                            <?php echo esc_html($buttons['button_two_label']); ?>
                            <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    class="w-full object-cover"
                    alt="<?php echo esc_attr($image_alt); ?>"
                />
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
});
</script>