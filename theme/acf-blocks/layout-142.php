<?php
/**
 * Layout 142 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$header = get_sub_field('header') ?: 'Full-Stack Development: Unifying Front-End and Back-End for Optimal Performance';
$content = get_sub_field('content') ?: 'Our Full-Stack Development services ensure a seamless integration of front-end and back-end technologies, providing a cohesive user experience. With our expertise, we deliver robust applications that are scalable, efficient, and tailored to meet your business needs.';

// Get image
$image = get_sub_field('image');
$image_url = '';
$image_alt = '';

if (!empty($image)) {
    if (is_array($image) && isset($image['url'])) {
        $image_url = $image['url'];
        $image_alt = $image['alt'] ?: 'Feature image';
    } elseif (is_string($image)) {
        $image_url = $image;
        $image_alt = 'Feature image';
    }
}

if (empty($image_url)) {
    $image_url = 'https://placehold.co/1200x600/purple/white?text=Feature+Image';
}
?>

<section class="layout-142 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="mb-12 md:mb-18 lg:mb-20">
            <div class="mx-auto flex max-w-3xl flex-col items-center text-center">
                <h2 class="mb-5 text-4xl font-bold font-heading leading-[1.2] text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="font-body text-purple/80 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
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
</section>