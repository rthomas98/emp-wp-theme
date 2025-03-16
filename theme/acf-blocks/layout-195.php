<?php
/**
 * Layout 195 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Cutting-edge and forward-thinking ideas and solutions.';
$header = get_sub_field('header') ?: 'Elevate Your Experience with Progressive Web Apps';
$content = get_sub_field('content') ?: 'Progressive Web Apps (PWAs) combine the best of web and mobile apps, delivering high performance and a seamless user experience. With offline capabilities and fast loading times, they ensure your users stay engaged and connected.';

// Default card data in case no cards are found
$default_cards = [
    [
        'header' => 'User Engagement',
        'content' => 'Boost user retention with responsive designs and native-like performance on any device.'
    ],
    [
        'header' => 'Scalable Solutions',
        'content' => 'Easily adapt to growing user demands and evolving business needs with our PWA services.'
    ]
];

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        
        // Add card to array if it has content
        if (!empty($card_header) || !empty($card_content)) {
            $cards[] = [
                'header' => $card_header ?: '',
                'content' => $card_content ?: ''
            ];
        }
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
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

<section class="layout-195 px-[5%] py-16 md:py-24 lg:py-28 bg-gray">
    <div class="container">
        <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2 lg:gap-x-20">
            <div class="order-2 md:order-1">
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    class="w-full object-cover"
                    alt="<?php echo esc_attr($image_alt); ?>"
                />
            </div>
            <div class="order-1 md:order-2">
                <p class="mb-3 font-semibold font-body text-pink md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="mb-6 font-body text-purple/80 md:mb-8 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                    <?php foreach ($cards as $card) : ?>
                        <div>
                            <h6 class="mb-3 text-md font-bold font-heading leading-[1.4] text-purple md:mb-4 md:text-xl">
                                <?php echo esc_html($card['header']); ?>
                            </h6>
                            <p class="font-body text-purple/80">
                                <?php echo esc_html($card['content']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
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