<?php
/**
 * Layout 247 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$sub_header = get_sub_field('sub_header') ?: 'Online shopping and digital marketplace transactions.';
$header = get_sub_field('header') ?: 'Empower Your Business with E-commerce Solutions';
$content = get_sub_field('content') ?: 'At Empuls3, we specialize in creating comprehensive e-commerce platforms designed for optimal performance. Our solutions are tailored to meet the unique needs of your business, ensuring a seamless shopping experience for your customers. With our expertise, we help you maximize sales and enhance customer engagement.';

// Default card data in case no cards are found
$default_cards = [
    [
        'icon' => 'shopping-cart',
        'header' => 'Tailored E-commerce Solutions for All',
        'content' => 'Our platforms are designed to seamlessly scale and adapt alongside your growth, ensuring you have the support you need.'
    ],
    [
        'icon' => 'credit-card',
        'header' => 'Seamless Payment Solutions',
        'content' => 'We provide reliable and secure payment gateways to significantly enhance user trust and confidence.'
    ],
    [
        'icon' => 'bar-chart',
        'header' => 'Data Insights for Smart Choices',
        'content' => 'Understand customer behavior to inform and enhance your business strategy effectively.'
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
            $icon_name = 'shopping-cart'; // Default Lucide icon
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

// Get buttons
$button_primary = get_sub_field('button_primary');
$button_secondary = get_sub_field('button_secondary');

$button_primary_text = '';
$button_primary_link = '#';
if (!empty($button_primary)) {
    if (is_array($button_primary)) {
        $button_primary_text = $button_primary['title'] ?? 'Learn More';
        $button_primary_link = $button_primary['url'] ?? '#';
    }
}

$button_secondary_text = '';
$button_secondary_link = '#';
if (!empty($button_secondary)) {
    if (is_array($button_secondary)) {
        $button_secondary_text = $button_secondary['title'] ?? 'Contact';
        $button_secondary_link = $button_secondary['url'] ?? '#';
    }
}

// Set default button text if not provided
if (empty($button_primary_text)) {
    $button_primary_text = 'Learn More';
}

if (empty($button_secondary_text)) {
    $button_secondary_text = 'Contact';
}
?>

<section class="layout-247 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="mb-12 grid grid-cols-1 items-start gap-5 md:mb-18 md:grid-cols-2 md:gap-x-12 lg:mb-20 lg:gap-x-20">
            <div>
                <p class="mb-3 font-semibold font-body text-pink md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="text-4xl font-bold font-heading leading-[1.2] text-purple md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
            </div>
            <p class="font-body text-purple/80 md:text-md">
                <?php echo esc_html($content); ?>
            </p>
        </div>
        <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-3 md:gap-x-8 lg:gap-x-12">
            <?php foreach ($cards as $card) : ?>
                <div class="flex gap-6">
                    <div class="flex-none">
                        <i data-lucide="<?php echo esc_attr($card['icon']); ?>" class="w-12 h-12 text-purple"></i>
                    </div>
                    <div>
                        <h3 class="mb-5 text-2xl font-bold font-heading text-purple md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                            <?php echo esc_html($card['header']); ?>
                        </h3>
                        <p class="font-body text-purple/80">
                            <?php echo esc_html($card['content']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($button_primary_text) || !empty($button_secondary_text)) : ?>
        <div class="mt-12 flex items-center gap-4 md:mt-18 lg:mt-20">
            <?php if (!empty($button_primary_text)) : ?>
            <a href="<?php echo esc_url($button_primary_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-white border border-purple text-purple hover:bg-purple/5 transition-colors duration-200 font-semibold">
                <?php echo esc_html($button_primary_text); ?>
            </a>
            <?php endif; ?>
            
            <?php if (!empty($button_secondary_text)) : ?>
            <a href="<?php echo esc_url($button_secondary_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-white border border-purple text-purple hover:bg-purple/5 transition-colors duration-200 font-semibold">
                <?php echo esc_html($button_secondary_text); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
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