<?php
/**
 * CTA 39 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'Transform Your User Experience Today';
$content = get_sub_field('content') ?: 'Reach out to Empuls3 for professional front-end development services that will enhance both your web and mobile platforms significantly.';

// Get buttons
$default_button_one_label = 'Contact';
$default_button_two_label = 'Learn More';

// Get image
$image = get_sub_field('image');
$image_url = '';
$image_alt = '';

if (!empty($image) && is_array($image)) {
    $image_url = $image['url'];
    $image_alt = $image['alt'] ?: 'CTA image';
} else {
    $image_url = 'https://placehold.co/800x600/purple/white?text=CTA+Image';
    $image_alt = 'CTA image';
}
?>

<section class="cta-39 px-[5%] py-16 md:py-24 lg:py-28 bg-gray">
    <div class="container mx-auto">
        <div class="grid auto-cols-fr grid-cols-1 border border-purple/20 rounded-md overflow-hidden lg:grid-cols-2 bg-white">
            <div class="flex flex-col justify-center p-8 md:p-12">
                <div>
                    <h2 class="mb-5 text-4xl font-bold font-heading text-pink md:mb-6 md:text-5xl lg:text-6xl">
                        <?php echo esc_html($header); ?>
                    </h2>
                    <p class="font-body text-purple/80 md:text-md">
                        <?php echo esc_html($content); ?>
                    </p>
                </div>
                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <?php if (have_rows('buttons')) : ?>
                        <?php while (have_rows('buttons')) : the_row(); ?>
                            <?php $button_one_label = get_sub_field('button_one_label') ?: $default_button_one_label; ?>
                            <?php $button_one_link = get_sub_field('button_one_link'); ?>
                            <?php if ($button_one_link) : ?>
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-purple text-white hover:bg-purple/90 transition-colors duration-200 font-semibold">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php $button_two_label = get_sub_field('button_two_label') ?: $default_button_two_label; ?>
                            <?php $button_two_link = get_sub_field('button_two_link'); ?>
                            <?php if ($button_two_link) : ?>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-purple text-purple hover:bg-purple/10 transition-colors duration-200 font-semibold">
                                    <?php echo esc_html($button_two_label); ?>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <!-- Default buttons if none defined in ACF -->
                        <a href="#contact" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-purple text-white hover:bg-purple/90 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($default_button_one_label); ?>
                        </a>
                        <a href="#learn-more" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-purple text-purple hover:bg-purple/10 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($default_button_two_label); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    class="w-full h-full object-cover"
                    alt="<?php echo esc_attr($image_alt); ?>"
                />
            </div>
        </div>
    </div>
</section>