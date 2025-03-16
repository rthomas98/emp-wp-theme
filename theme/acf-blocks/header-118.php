<?php
/**
 * Header 118 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'Elevate Your Experience with Front-End Development';
$content = get_sub_field('content') ?: 'At Empuls3, we specialize in crafting exceptional user interfaces and experiences for both web and mobile platforms. Our front-end development services focus on delivering visually stunning and highly functional applications that engage users and drive results.';

// Default button data
$default_buttons = [
    'button_one_label' => 'Learn More',
    'button_one_link' => '#',
    'button_two_label' => 'Get Started',
    'button_two_link' => '#'
];

// Get button data from repeater field
$buttons = $default_buttons;
if (have_rows('button_one_label')) {
    while (have_rows('button_one_label')) {
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
$image_two = get_sub_field('image_two');
$image_three = get_sub_field('image_three');

// Process images
$image_url = !empty($image) && is_array($image) ? $image['url'] : 'https://placehold.co/600x600/purple/white?text=Image+1';
$image_alt = !empty($image) && is_array($image) ? $image['alt'] : 'Feature image 1';

$image_two_url = !empty($image_two) && is_array($image_two) ? $image_two['url'] : 'https://placehold.co/600x900/purple/white?text=Image+2';
$image_two_alt = !empty($image_two) && is_array($image_two) ? $image_two['alt'] : 'Feature image 2';

$image_three_url = !empty($image_three) && is_array($image_three) ? $image_three['url'] : 'https://placehold.co/600x900/purple/white?text=Image+3';
$image_three_alt = !empty($image_three) && is_array($image_three) ? $image_three['alt'] : 'Feature image 3';
?>

<section class="header-118 px-[5%] py-16 md:py-24 lg:py-28 bg-pink text-white">
    <div class="container mx-auto">
        <div class="mb-12 grid grid-cols-1 items-start gap-5 md:mb-16 md:grid-cols-2 md:gap-12 lg:mb-20 lg:gap-20">
            <div>
                <h1 class="text-5xl font-bold font-heading md:text-6xl lg:text-7xl">
                    <?php echo esc_html($header); ?>
                </h1>
            </div>
            <div class="mx-[7.5%] flex flex-col justify-end md:mt-48">
                <p class="font-body md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                    <?php if (!empty($buttons['button_one_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_one_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-white text-pink hover:bg-white/90 transition-colors duration-200 font-semibold">
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
        <div class="grid grid-cols-1 sm:grid-cols-[1fr_1.5fr_1fr] items-start gap-6 sm:gap-8">
            <div class="mt-0 sm:mt-[70%] w-full">
                <img
                    class="aspect-square w-full object-cover"
                    src="<?php echo esc_url($image_url); ?>"
                    alt="<?php echo esc_attr($image_alt); ?>"
                />
            </div>
            <div class="w-full">
                <img
                    class="aspect-[2/3] w-full object-cover"
                    src="<?php echo esc_url($image_two_url); ?>"
                    alt="<?php echo esc_attr($image_two_alt); ?>"
                />
            </div>
            <div class="w-full">
                <img
                    class="aspect-[2/3] w-full object-cover"
                    src="<?php echo esc_url($image_three_url); ?>"
                    alt="<?php echo esc_attr($image_three_alt); ?>"
                />
            </div>
        </div>
    </div>
</section>