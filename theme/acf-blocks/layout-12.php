<?php
/**
 * Layout 12 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$header = get_sub_field('header') ?: 'Empuls3\'s Back-End Development: Powering Your Business with Robust Solutions';
$content = get_sub_field('content') ?: 'Our back-end development services are designed to create robust and scalable systems that support your business needs. We leverage modern technologies to ensure high performance and reliability.';

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
    $image_url = 'https://placehold.co/600x400/purple/white?text=Feature+Image';
}

// Default card data in case no cards are found
$default_cards = [
    [
        'icon' => 'scale',
        'header' => 'Scalable Solutions',
        'content' => 'Build systems that grow with your business and adapt to changing demands.'
    ],
    [
        'icon' => 'users',
        'header' => 'Expert Team',
        'content' => 'Our experienced developers ensure quality and efficiency in every back-end project.'
    ]
];

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $icon = get_sub_field('icon');
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        
        // Process icon
        $icon_name = '';
        if (!empty($icon)) {
            if (is_string($icon)) {
                $icon_name = $icon;
            } elseif (is_array($icon) && isset($icon['name'])) {
                $icon_name = $icon['name'];
            } elseif (is_array($icon) && isset($icon['value'])) {
                $icon_name = $icon['value'];
            }
        }
        
        if (empty($icon_name)) {
            $icon_name = 'zap'; // Default Lucide icon
        }
        
        // Add card to array
        $cards[] = [
            'icon' => $icon_name,
            'header' => $card_header ?: 'Card Header',
            'content' => $card_content ?: 'Card content goes here.'
        ];
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}
?>

<section class="layout-12 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
            <div>
                <h2 class="mb-5 text-4xl font-bold font-heading leading-[1.2] text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="mb-6 font-body text-purple/80 md:mb-8 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                    <?php foreach ($cards as $card) : ?>
                        <div>
                            <div class="mb-3 md:mb-4">
                                <?php if (!empty($card['icon'])) : ?>
                                    <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="w-12 h-12 text-purple"></i>
                                <?php else : ?>
                                    <i data-lucide="zap" class="w-12 h-12 text-purple"></i>
                                <?php endif; ?>
                            </div>
                            <h6 class="mb-3 text-md font-bold font-heading leading-[1.4] text-purple md:mb-4 md:text-xl">
                                <?php echo esc_html($card['header']); ?>
                            </h6>
                            <p class="font-body text-purple/80">
                                <?php echo esc_html($card['content']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
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