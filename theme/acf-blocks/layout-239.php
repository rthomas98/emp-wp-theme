<?php
/**
 * Layout 239 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Performance review summary.';
$header = get_sub_field('header') ?: 'Robust Back-End Development Solutions for Your Business';
$content = get_sub_field('content') ?: 'Our back-end development services are designed to enhance performance, security, and scalability. We leverage cutting-edge technologies to build solutions that meet the unique needs of your business.';

// Default card data
$default_cards = [
    [
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'header' => 'Explore Our Essential Services That We Provide',
        'content' => 'We provide comprehensive back-end solutions, encompassing everything from API development to seamless cloud integration for your projects.'
    ],
    [
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'header' => 'Tailored Solutions for Your Unique Needs',
        'content' => 'Our dedicated team specializes in comprehensive database design and effective server management solutions.'
    ],
    [
        'image' => [
            'url' => 'https://placehold.co/600x300/purple/white?text=Feature+Image',
            'alt' => 'Feature image'
        ],
        'header' => 'Scalable Microservices Architecture',
        'content' => 'We utilize a microservices architecture to significantly improve our system\'s flexibility and scalability, allowing for better performance and adaptability.'
    ]
];

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    $index = 0;
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $image = get_sub_field('image');
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        
        // Process image
        $image_url = '';
        $image_alt = '';
        
        if (!empty($image) && is_array($image)) {
            $image_url = $image['url'];
            $image_alt = $image['alt'] ?: 'Feature image';
        } else {
            $image_url = $default_cards[$index]['image']['url'] ?? 'https://placehold.co/600x300/purple/white?text=Feature+Image';
            $image_alt = $default_cards[$index]['image']['alt'] ?? 'Feature image';
        }
        
        // Add card to array
        $cards[] = [
            'image' => [
                'url' => $image_url,
                'alt' => $image_alt
            ],
            'header' => $card_header ?: $default_cards[$index]['header'] ?? 'Card Header',
            'content' => $card_content ?: $default_cards[$index]['content'] ?? 'Card content goes here.'
        ];
        
        $index++;
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
?>

<section class="layout-239 px-[5%] py-16 md:py-24 lg:py-28 gradient-background text-white">
    <div class="container mx-auto">
        <div class="flex flex-col items-center">
            <div class="mb-12 text-center md:mb-16 lg:mb-20">
                <div class="w-full max-w-3xl mx-auto">
                    <p class="mb-3 font-semibold font-body md:mb-4 text-white/90">
                        <?php echo esc_html($sub_header); ?>
                    </p>
                    <h2 class="mb-5 text-4xl font-bold font-heading md:mb-6 md:text-5xl lg:text-6xl">
                        <?php echo esc_html($header); ?>
                    </h2>
                    <p class="font-body md:text-md">
                        <?php echo esc_html($content); ?>
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 items-start justify-center gap-y-12 md:grid-cols-3 md:gap-x-8 md:gap-y-16 lg:gap-x-12">
                <?php foreach ($cards as $card) : ?>
                    <div class="flex w-full flex-col items-center text-center">
                        <div class="mb-6 md:mb-8">
                            <img
                                src="<?php echo esc_url($card['image']['url']); ?>"
                                alt="<?php echo esc_attr($card['image']['alt']); ?>"
                                class="w-full"
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
            <div class="mt-10 flex flex-wrap items-center gap-4 md:mt-12">
                <?php if (!empty($buttons['button_one_label'])) : ?>
                    <a href="<?php echo esc_url($buttons['button_one_link']); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-white text-white hover:bg-white/10 transition-colors duration-200 font-semibold">
                        <?php echo esc_html($buttons['button_one_label']); ?>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($buttons['button_two_label'])) : ?>
                    <a href="<?php echo esc_url($buttons['button_two_link']); ?>" class="inline-flex items-center text-white hover:text-white/80 font-semibold transition-colors duration-200">
                        <?php echo esc_html($buttons['button_two_label']); ?>
                        <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                    </a>
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