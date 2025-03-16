<?php
/**
 * Layout 374 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Create and implement new ideas and solutions.';
$header = get_sub_field('header') ?: 'Comprehensive Development Solutions';
$content = get_sub_field('content') ?: 'We specialize in transforming innovative ideas into powerful and robust software applications that operate seamlessly, ensuring an exceptional user experience while meeting your unique business needs and objectives effectively.';

// Default card data in case no cards are found
$default_cards = [
    [
        'icon' => 'code',
        'image' => [
            'url' => 'https://placehold.co/800x400/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'sub_header' => 'Solutions',
        'header' => 'Tailored Software Development Services',
        'content' => 'From initial concept to final deployment, we guarantee that your software effectively meets all your unique business needs and requirements.',
        'button_label' => 'Learn More',
        'button_link' => '#',
        'link_label' => 'Contact',
        'link_url' => '#',
        'size' => 'large' // large for the first card, small for others
    ],
    [
        'icon' => 'settings',
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'sub_header' => 'Expertise',
        'header' => 'Our Development Process',
        'content' => 'Agile methodologies for rapid and efficient project delivery.',
        'button_label' => '',
        'button_link' => '',
        'link_label' => 'Get Started',
        'link_url' => '#',
        'size' => 'small'
    ],
    [
        'icon' => 'code-2',
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'sub_header' => 'Expertise',
        'header' => 'Our Development Process',
        'content' => 'Agile methodologies for rapid and efficient project delivery.',
        'button_label' => '',
        'button_link' => '',
        'link_label' => 'Get Started',
        'link_url' => '#',
        'size' => 'small'
    ],
    [
        'icon' => 'git-branch',
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'sub_header' => 'Expertise',
        'header' => 'Our Development Process',
        'content' => 'Agile methodologies for rapid and efficient project delivery.',
        'button_label' => '',
        'button_link' => '',
        'link_label' => 'Get Started',
        'link_url' => '#',
        'size' => 'small'
    ],
    [
        'icon' => 'database',
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'sub_header' => 'Expertise',
        'header' => 'Our Development Process',
        'content' => 'Agile methodologies for rapid and efficient project delivery.',
        'button_label' => '',
        'button_link' => '',
        'link_label' => 'Get Started',
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
        $image = get_sub_field('image');
        $card_sub_header = get_sub_field('sub_header');
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        $button_label = get_sub_field('button_label');
        $button_link = get_sub_field('button_link');
        $link_label = get_sub_field('link_label');
        $link_url = get_sub_field('link_url');
        
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
            $icon_name = $default_cards[$index]['icon'] ?? 'code'; // Default Lucide icon
        }
        
        // Process image
        $image_url = '';
        $image_alt = '';
        
        if (!empty($image)) {
            if (is_array($image) && isset($image['url'])) {
                $image_url = $image['url'];
                $image_alt = $image['alt'] ?: 'Feature image';
            }
        }
        
        if (empty($image_url)) {
            $image_url = $default_cards[$index]['image']['url'] ?? 'https://placehold.co/600x300/purple/white?text=Feature+Image';
            $image_alt = $default_cards[$index]['image']['alt'] ?? 'Feature image';
        }
        
        // Determine card size (first card is large, others are small)
        $size = ($index === 0) ? 'large' : 'small';
        
        // Add card to array
        $cards[] = [
            'icon' => $icon_name,
            'image' => [
                'url' => $image_url,
                'alt' => $image_alt
            ],
            'sub_header' => $card_sub_header ?: $default_cards[$index]['sub_header'] ?? 'Feature',
            'header' => $card_header ?: $default_cards[$index]['header'] ?? 'Card Header',
            'content' => $card_content ?: $default_cards[$index]['content'] ?? 'Card content goes here.',
            'button_label' => $button_label ?: $default_cards[$index]['button_label'] ?? '',
            'button_link' => $button_link ?: $default_cards[$index]['button_link'] ?? '#',
            'link_label' => $link_label ?: $default_cards[$index]['link_label'] ?? '',
            'link_url' => $link_url ?: $default_cards[$index]['link_url'] ?? '#',
            'size' => $size
        ];
        
        $index++;
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}
?>

<section class="layout-374 px-[5%] py-16 md:py-24 lg:py-28 bg-gray">
    <div class="container">
        <div class="mb-12 md:mb-18 lg:mb-20">
            <div class="mx-auto max-w-3xl text-center">
                <p class="mb-3 font-semibold font-body text-pink md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="mb-5 text-4xl font-bold font-heading leading-[1.2] text-purple md:text-5xl lg:text-6xl">
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
                    <?php if ($card['size'] === 'large') : ?>
                        <div class="flex flex-col border border-purple/20 bg-white sm:col-span-2 sm:row-span-2">
                            <div class="flex flex-1 flex-col justify-center p-6 md:p-8 lg:p-12">
                                <div>
                                    <p class="mb-2 text-sm font-semibold font-body text-pink">
                                        <?php echo esc_html($card['sub_header']); ?>
                                    </p>
                                    <h3 class="mb-5 text-3xl font-bold font-heading leading-[1.2] text-purple md:mb-6 md:text-4xl lg:text-5xl">
                                        <?php echo esc_html($card['header']); ?>
                                    </h3>
                                    <p class="font-body text-purple/80">
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                </div>
                                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                                    <?php if (!empty($card['button_label'])) : ?>
                                        <a href="<?php echo esc_url($card['button_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-white border border-purple text-purple hover:bg-purple/5 transition-colors duration-200 font-semibold">
                                            <?php echo esc_html($card['button_label']); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($card['link_label'])) : ?>
                                        <a href="<?php echo esc_url($card['link_url']); ?>" class="inline-flex items-center text-pink hover:text-pink/80 font-semibold transition-colors duration-200">
                                            <?php echo esc_html($card['link_label']); ?>
                                            <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <img
                                    src="<?php echo esc_url($card['image']['url']); ?>"
                                    alt="<?php echo esc_attr($card['image']['alt']); ?>"
                                    class="w-full object-cover"
                                />
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="flex flex-col border border-purple/20 bg-white">
                            <div class="flex flex-col justify-center p-6">
                                <div>
                                    <p class="mb-2 text-sm font-semibold font-body text-pink">
                                        <?php echo esc_html($card['sub_header']); ?>
                                    </p>
                                    <h3 class="mb-2 text-xl font-bold font-heading text-purple md:text-2xl">
                                        <?php echo esc_html($card['header']); ?>
                                    </h3>
                                    <p class="font-body text-purple/80">
                                        <?php echo esc_html($card['content']); ?>
                                    </p>
                                </div>
                                <?php if (!empty($card['link_label'])) : ?>
                                    <div class="mt-5 flex items-center gap-4 md:mt-6">
                                        <a href="<?php echo esc_url($card['link_url']); ?>" class="inline-flex items-center text-pink hover:text-pink/80 font-semibold transition-colors duration-200">
                                            <?php echo esc_html($card['link_label']); ?>
                                            <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center justify-center">
                                <img
                                    src="<?php echo esc_url($card['image']['url']); ?>"
                                    alt="<?php echo esc_attr($card['image']['alt']); ?>"
                                    class="w-full object-cover"
                                />
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