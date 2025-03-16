<?php
/**
 * Layout 373 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Creating effective solutions.';
$header = get_sub_field('header') ?: 'Crafting Engaging Interfaces';
$content = get_sub_field('content') ?: 'We are committed to enhancing user experience by providing innovative design solutions that not only meet our clients\' needs but also create engaging and intuitive interactions for users across all platforms.';

// Default card data
$default_cards = [
    [
        'icon' => [
            'url' => 'https://placehold.co/100x100/purple/white?text=Icon',
            'alt' => 'Icon'
        ],
        'header' => 'Intuitive User Experience',
        'content' => 'We create interfaces that are not only beautiful but also easy to navigate and use.',
        'button_label' => 'Learn More',
        'button_link' => '#',
        'link_label' => 'Contact',
        'link_url' => '#',
        'size' => 'large'
    ],
    [
        'icon' => [
            'url' => 'https://placehold.co/100x100/purple/white?text=Icon',
            'alt' => 'Icon'
        ],
        'header' => 'Why Choose Our Front-End Development?',
        'content' => 'Tailored solutions for web and mobile applications.',
        'link_label' => 'Explore',
        'link_url' => '#',
        'size' => 'small'
    ],
    [
        'icon' => [
            'url' => 'https://placehold.co/100x100/purple/white?text=Icon',
            'alt' => 'Icon'
        ],
        'header' => 'Why Choose Our Front-End Development?',
        'content' => 'Tailored solutions for web and mobile applications.',
        'link_label' => 'Explore',
        'link_url' => '#',
        'size' => 'small'
    ]
];

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    $index = 0;
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $icon = get_sub_field('icon');
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        $button_label = get_sub_field('button_label');
        $button_link = get_sub_field('button_link');
        $link_label = get_sub_field('link_label');
        $link_url = get_sub_field('link_url');
        
        // Process icon
        $icon_url = '';
        $icon_alt = '';
        
        if (!empty($icon) && is_array($icon)) {
            $icon_url = $icon['url'];
            $icon_alt = $icon['alt'] ?: 'Icon';
        } else {
            $icon_url = $default_cards[$index]['icon']['url'] ?? 'https://placehold.co/100x100/purple/white?text=Icon';
            $icon_alt = $default_cards[$index]['icon']['alt'] ?? 'Icon';
        }
        
        // Add card to array
        $cards[] = [
            'icon' => [
                'url' => $icon_url,
                'alt' => $icon_alt
            ],
            'header' => $card_header ?: $default_cards[$index]['header'] ?? 'Card Header',
            'content' => $card_content ?: $default_cards[$index]['content'] ?? 'Card content goes here.',
            'button_label' => $button_label ?: $default_cards[$index]['button_label'] ?? '',
            'button_link' => $button_link ?: $default_cards[$index]['button_link'] ?? '#',
            'link_label' => $link_label ?: $default_cards[$index]['link_label'] ?? '',
            'link_url' => $link_url ?: $default_cards[$index]['link_url'] ?? '#',
            'size' => $index === 0 ? 'large' : 'small'
        ];
        
        $index++;
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}
?>

<section class="layout-373 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="mb-12 md:mb-16 lg:mb-20">
            <div class="mx-auto max-w-3xl text-center">
                <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="font-body text-purple/80 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:gap-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:gap-8 lg:grid-cols-4">
                <?php foreach ($cards as $index => $card) : ?>
                    <?php if ($index === 0) : ?>
                        <!-- Large card (spans 2 columns) -->
                        <div class="grid grid-cols-1 border border-purple/20 sm:col-span-2 sm:row-span-1 bg-yellow">
                            <div class="flex flex-1 flex-col justify-center p-6 md:p-8 lg:p-12">
                                <div>
                                    <div class="mb-5 md:mb-6">
                                        <img
                                            src="<?php echo esc_url($card['icon']['url']); ?>"
                                            class="w-12 h-12"
                                            alt="<?php echo esc_attr($card['icon']['alt']); ?>"
                                        />
                                    </div>
                                    <h3 class="mb-5 text-3xl font-bold font-heading text-purple leading-[1.2] md:mb-6 md:text-4xl lg:text-5xl">
                                        <?php echo esc_html($card['header']); ?>
                                    </h3>
                                    <p class="font-body text-purple/80">
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Small card -->
                        <div class="flex flex-col border border-purple/20 bg-yellow">
                            <div class="flex h-full flex-col justify-between p-6 md:p-8 lg:p-6">
                                <div>
                                    <div class="mb-3 md:mb-4">
                                        <img
                                            src="<?php echo esc_url($card['icon']['url']); ?>"
                                            alt="<?php echo esc_attr($card['icon']['alt']); ?>"
                                            class="w-12 h-12"
                                        />
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold font-heading text-purple md:text-2xl">
                                        <?php echo esc_html($card['header']); ?>
                                    </h3>
                                    <p class="font-body text-purple/80">
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    <?php endif; ?>
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