<?php
/**
 * Layout 194 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'Robust Security Solutions for Your Back-End Development Needs';
$content = get_sub_field('content') ?: 'At Empuls3, we prioritize the security of your applications and data. Our team implements best practices and advanced security measures to ensure your back-end systems are protected against potential threats.';

// Get image
$image = get_sub_field('image');
$image_url = '';
$image_alt = '';

if (!empty($image) && is_array($image)) {
    $image_url = $image['url'];
    $image_alt = $image['alt'] ?: 'Feature image';
} else {
    $image_url = 'https://placehold.co/800x800/purple/white?text=Feature+Image';
    $image_alt = 'Feature image';
}
?>

<section class="layout-194 px-[5%] py-16 md:py-24 lg:py-28 bg-gray">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-x-20">
            <div class="order-2 md:order-1">
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    class="w-full object-cover"
                    alt="<?php echo esc_attr($image_alt); ?>"
                />
            </div>
            <div class="order-1 md:order-2">
                <h3 class="mb-5 text-4xl font-bold font-heading leading-[1.2] text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h3>
                <p class="font-body text-purple/80 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
            </div>
        </div>
    </div>
</section>