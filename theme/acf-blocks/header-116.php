<?php
/**
 * Header 116 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'Elevate Your Business with Back-End Development';
$content = get_sub_field('content') ?: 'At Empuls3, our Back-End Development services are designed to enhance performance, ensure robust security, and provide scalable solutions tailored to your business needs. Trust our expertise to build a solid foundation for your applications, driving efficiency and growth.';

// Default button data
$default_buttons = [
    'button_one_label' => 'Learn More',
    'button_one_link' => '#',
    'button_two_label' => 'Sign Up',
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

// Get images
$image = get_sub_field('image');
$image_url = '';
$image_alt = '';

if (!empty($image) && is_array($image)) {
    $image_url = $image['url'];
    $image_alt = $image['alt'] ?: 'Header image';
} else {
    $image_url = 'https://placehold.co/1200x800/purple/white?text=Header+Image';
    $image_alt = 'Header image';
}

$image_two = get_sub_field('image_two');
$image_two_url = '';
$image_two_alt = '';

if (!empty($image_two) && is_array($image_two)) {
    $image_two_url = $image_two['url'];
    $image_two_alt = $image_two['alt'] ?: 'Header image two';
} else {
    $image_two_url = 'https://placehold.co/800x1200/purple/white?text=Header+Image';
    $image_two_alt = 'Header image two';
}
?>

<section class="header-116 px-[5%] py-16 md:py-24 lg:py-28 bg-purple">
    <div class="container mx-auto">
        <div class="mb-12 grid grid-cols-1 items-start gap-5 md:mb-18 md:grid-cols-2 md:gap-12 lg:mb-20 lg:gap-20">
            <div>
                <h1 class="text-5xl font-bold font-heading text-white md:text-6xl lg:text-7xl">
                    <?php echo esc_html($header); ?>
                </h1>
            </div>
            <div class="mx-[7.5%] flex flex-col justify-end md:mt-48">
                <p class="font-body text-white/90 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                    <?php if (!empty($buttons['button_one_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_one_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-pink text-white hover:bg-pink/90 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($buttons['button_one_label']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($buttons['button_two_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_two_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-white text-white hover:bg-white/10 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($buttons['button_two_label']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-[1fr_0.33fr] items-start gap-6 sm:gap-8 md:gap-16">
            <div class="mt-[10%] w-full">
                <img
                    class="aspect-[3/2] w-full h-auto object-cover"
                    src="<?php echo esc_url($image_url); ?>"
                    alt="<?php echo esc_attr($image_alt); ?>"
                />
            </div>
            <div class="w-full">
                <img
                    class="aspect-[2/3] w-full h-auto object-cover"
                    src="<?php echo esc_url($image_two_url); ?>"
                    alt="<?php echo esc_attr($image_two_alt); ?>"
                />
            </div>
        </div>
    </div>
</section>