<?php
/**
 * CTA 1 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'Get Your Back-End Solutions Today';
$content = get_sub_field('content') ?: 'Reach out to us today to schedule a consultation regarding your back-end development requirements. Let us help you enhance and elevate your business to new heights with our expert services.';

// Default button data
$default_buttons = [
    'button_one_label' => 'Get A Quote',
    'button_one_link' => '#',
    'button_two_label' => 'Need Another Solution?',
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
    $image_url = 'https://placehold.co/800x500/purple/white?text=Feature+Image';
    $image_alt = 'Feature image';
}
?>

<section class="cta-1 px-[5%] py-16 md:py-24 lg:py-28 bg-gray">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-x-20 gap-y-12 md:gap-y-16 lg:grid-cols-2 lg:items-center">
            <div>
                <h2 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="font-body text-purple/80 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                    <?php if (!empty($buttons['button_one_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_one_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-purple text-white hover:bg-purple/90 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($buttons['button_one_label']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($buttons['button_two_label'])) : ?>
                        <a href="<?php echo esc_url($buttons['button_two_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-purple text-purple hover:bg-purple/10 transition-colors duration-200 font-semibold">
                            <?php echo esc_html($buttons['button_two_label']); ?>
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