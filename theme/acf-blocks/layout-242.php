<?php
/**
 * Layout 242 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$header = get_sub_field('header') ?: 'Explore Our Comprehensive Development Solutions Tailored for Your Business Needs';
$content = get_sub_field('content') ?: '';

// Default card data in case no cards are found
$default_cards = [
    [
        'icon' => 'https://placehold.co/100x100/purple/white?text=Icon',
        'header' => 'Unlock Your Business Potential with Our Services',
        'content' => 'At Empuls3, we proudly provide a comprehensive array of development capabilities designed specifically to propel your success to new heights.',
        'button_label' => 'Learn More',
        'button_link' => '#'
    ],
    [
        'icon' => 'https://placehold.co/100x100/purple/white?text=Icon',
        'header' => 'Server-Side Solutions for Applications',
        'content' => 'Our comprehensive back-end development services guarantee efficient data management and optimal application performance for your needs.',
        'button_label' => 'Discover',
        'button_link' => '#'
    ],
    [
        'icon' => 'https://placehold.co/100x100/purple/white?text=Icon',
        'header' => 'Front-End Development: Engaging User Experiences with Technology',
        'content' => 'Our expertise lies in creating intuitive interfaces that not only captivate users but also effectively retain their engagement over time.',
        'button_label' => 'Explore',
        'button_link' => '#'
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
        $button_label = get_sub_field('button_label');
        $button_link = get_sub_field('button_link');
        
        // Process icon
        $icon_url = '';
        if (!empty($icon)) {
            if (is_array($icon) && isset($icon['url'])) {
                $icon_url = $icon['url'];
            } elseif (is_string($icon)) {
                $icon_url = $icon;
            }
        }
        
        if (empty($icon_url)) {
            $icon_url = 'https://placehold.co/100x100/purple/white?text=Icon';
        }
        
        // Process button link
        $button_link_url = '';
        if (!empty($button_link)) {
            if (is_array($button_link) && isset($button_link['url'])) {
                $button_link_url = $button_link['url'];
            } elseif (is_string($button_link)) {
                $button_link_url = $button_link;
            }
        }
        
        if (empty($button_link_url)) {
            $button_link_url = '#';
        }
        
        // Add card to array
        $cards[] = [
            'icon' => $icon_url,
            'header' => $card_header ?: 'Card Header',
            'content' => $card_content ?: 'Card content goes here.',
            'button_label' => $button_label ?: 'Learn More',
            'button_link' => $button_link_url
        ];
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}
?>

<section class="layout-242 px-[5%] py-16 md:py-24 lg:py-28 gradient-background">
    <div class="container">
        <div class="flex flex-col items-start">
            <div class="mb-12 w-full max-w-4xl md:mb-18 lg:mb-20">
                <h2 class="text-4xl font-bold font-heading leading-[1.2] text-white md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <?php if (!empty($content)) : ?>
                    <div class="mt-4 font-body text-white/80">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                <?php foreach ($cards as $card) : ?>
                    <div>
                        <div class="mb-5 md:mb-6">
                            <img
                                src="<?php echo esc_url($card['icon']); ?>"
                                alt="<?php echo esc_attr($card['header']); ?> icon"
                                class="w-12 h-12"
                            />
                        </div>
                        <h3 class="mb-5 text-xl font-bold font-heading text-white md:mb-6 md:text-2xl">
                            <?php echo esc_html($card['header']); ?>
                        </h3>
                        <p class="mb-5 font-body text-white/80 md:mb-6">
                            <?php echo esc_html($card['content']); ?>
                        </p>
                        <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                            <a href="<?php echo esc_url($card['button_link']); ?>" class="inline-flex items-center text-white hover:text-white/80 font-semibold transition-colors duration-200">
                                <?php echo esc_html($card['button_label']); ?>
                                <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
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