<?php
/**
 * Layout 16 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Innovate and transform your ideas into reality today.';
$header = get_sub_field('header') ?: 'Transform Ideas into Reality with MVP Development';
$content = get_sub_field('content') ?: 'Our MVP Development services empower businesses to rapidly prototype and validate their ideas. We combine technical expertise with industry insights to ensure your concept resonates with your target audience.';

// Default list items in case no items are found
$default_list_items = [
    'Accelerate your product journey from concept to launch.',
    'Leverage our expertise for quick market validation.',
    'Build, test, and iterate with confidence and speed.'
];

// Get list items from repeater field
$list_items = [];
if (have_rows('list')) {
    while (have_rows('list')) {
        the_row();
        $item = get_sub_field('item');
        if (!empty($item)) {
            $list_items[] = $item;
        }
    }
}

// If no list items are found, use default list items
if (empty($list_items)) {
    $list_items = $default_list_items;
}

// Default button data
$default_buttons = [
    'button_one_label' => 'Learn More',
    'button_one_link' => '#',
    'button_two_label' => 'Get Started',
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

<section class="layout-16 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 gap-y-12 md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
            <div>
                <p class="mb-3 font-semibold font-body text-pink md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h1 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h1>
                <p class="mb-5 text-base font-body text-purple/80 md:mb-6 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <ul class="grid grid-cols-1 gap-4 py-2">
                    <?php foreach ($list_items as $item) : ?>
                        <li class="flex self-start">
                            <div class="mr-4 flex-none self-start">
                                <i data-lucide="check-circle" class="w-6 h-6 text-purple"></i>
                            </div>
                            <span class="font-body text-purple/80">
                                <?php echo esc_html($item); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
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