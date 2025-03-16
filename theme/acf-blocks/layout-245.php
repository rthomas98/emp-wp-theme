<?php
/**
 * Layout 245 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Creative and forward-thinking solutions for all needs.';
$header = get_sub_field('header') ?: 'Elevate Your User Experience with Front-End Development';
$content = get_sub_field('content') ?: 'Our front-end development services focus on creating seamless user interfaces that enhance engagement across web and mobile platforms. We prioritize cross-browser compatibility and adhere to accessibility standards, ensuring that every user can interact with your application effortlessly. By integrating with back-end services, we deliver a cohesive experience that drives results.';

// Default card data
$default_cards = [
    [
        'icon' => [
            'url' => 'https://placehold.co/100x100/white/purple?text=Icon',
            'alt' => 'Icon'
        ],
        'header' => 'Key Features of Our Front-End Development',
        'content' => 'Enjoy seamless and flawless performance across all major web browsers for an exceptional online experience every time.'
    ],
    [
        'icon' => [
            'url' => 'https://placehold.co/100x100/white/purple?text=Icon',
            'alt' => 'Icon'
        ],
        'header' => 'Commitment to Accessibility Compliance',
        'content' => 'We are committed to making sure that all of your applications are accessible and usable for everyone, without exception.'
    ],
    [
        'icon' => [
            'url' => 'https://placehold.co/100x100/white/purple?text=Icon',
            'alt' => 'Icon'
        ],
        'header' => 'Seamless Integration with Back-End Services',
        'content' => 'Our front-end solutions seamlessly integrate and function flawlessly with all of your existing systems for an enhanced user experience.'
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
        
        // Process icon
        $icon_url = '';
        $icon_alt = '';
        
        if (!empty($icon) && is_array($icon)) {
            $icon_url = $icon['url'];
            $icon_alt = $icon['alt'] ?: 'Icon';
        } else {
            $icon_url = $default_cards[$index]['icon']['url'] ?? 'https://placehold.co/100x100/white/purple?text=Icon';
            $icon_alt = $default_cards[$index]['icon']['alt'] ?? 'Icon';
        }
        
        // Add card to array
        $cards[] = [
            'icon' => [
                'url' => $icon_url,
                'alt' => $icon_alt
            ],
            'header' => $card_header ?: $default_cards[$index]['header'] ?? 'Card Header',
            'content' => $card_content ?: $default_cards[$index]['content'] ?? 'Card content goes here.'
        ];
        
        $index++;
        
        // Only process the first 3 cards
        if ($index >= 3) {
            break;
        }
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}

?>

<section class="layout-245 px-[5%] py-16 md:py-24 lg:py-28 gradient-background-purple text-white">
    <div class="container mx-auto">
        <div class="flex flex-col items-start">
            <div class="mb-12 grid grid-cols-1 items-start justify-between gap-5 md:mb-16 md:grid-cols-2 md:gap-x-12 md:gap-y-8 lg:mb-20 lg:gap-x-20">
                <div>
                    <p class="mb-3 font-semibold font-body md:mb-4">
                        <?php echo esc_html($sub_header); ?>
                    </p>
                    <h2 class="text-4xl font-bold font-heading md:text-5xl lg:text-6xl">
                        <?php echo esc_html($header); ?>
                    </h2>
                </div>
                <div>
                    <p class="font-body md:text-md">
                        <?php echo esc_html($content); ?>
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                <?php foreach ($cards as $card) : ?>
                <div>
                    <div class="mb-5 md:mb-6">
                        <img
                            src="<?php echo esc_url($card['icon']['url']); ?>"
                            alt="<?php echo esc_attr($card['icon']['alt']); ?>"
                            class="w-12 h-12"
                        />
                    </div>
                    <h3 class="mb-5 text-2xl font-bold font-heading md:mb-6 md:text-3xl md:leading-[1.3] lg:text-4xl">
                        <?php echo esc_html($card['header']); ?>
                    </h3>
                    <p class="font-body">
                        <?php echo esc_html($card['content']); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-10 flex items-center gap-4 md:mt-14 lg:mt-16">
                <?php if (have_rows('buttons')) : ?>
                    <?php while (have_rows('buttons')) : the_row(); ?>
                        <?php $button_one_label = get_sub_field('button_one_label') ?: 'Learn More'; ?>
                        <?php $button_one_link = get_sub_field('button_one_link'); ?>
                        <?php if ($button_one_link) : ?>
                            <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-white text-white hover:bg-white/10 transition-colors duration-200 font-semibold">
                                <?php echo esc_html($button_one_label); ?>
                            </a>
                        <?php endif; ?>
                        
                        <?php $button_two_label = get_sub_field('button_two_label') ?: 'Get Started'; ?>
                        <?php $button_two_link = get_sub_field('button_two_link'); ?>
                        <?php if ($button_two_link) : ?>
                            <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-white hover:text-pink transition-colors duration-200 font-semibold">
                                <?php echo esc_html($button_two_label); ?>
                                <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
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