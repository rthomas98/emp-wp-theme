<?php
/**
 * Layout 4 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Enhance efficiency and performance in all areas.';
$header = get_sub_field('header') ?: 'Enhancing Performance for Web and Mobile';
$content = get_sub_field('content') ?: 'Our front-end development focuses on speed and efficiency. We ensure that your web and mobile applications deliver a seamless user experience.';

// Default card data
$default_cards = [
    [
        'header' => 'Speed Matters',
        'content' => 'Reduce load times and improve responsiveness for a better user experience.'
    ],
    [
        'header' => 'Efficiency Boost',
        'content' => 'By streamlining code and optimizing assets, we achieve significantly faster performance overall.'
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
        
        // Add card to array
        $cards[] = [
            'header' => $card_header ?: '',
            'content' => $card_content ?: ''
        ];
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}

// Get buttons
$default_button_one_label = 'Learn More';
$default_button_two_label = 'Get Started';

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

<section class="layout-4 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-y-12 md:grid-flow-row md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
            <div>
                <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="mb-6 font-body text-purple/80 md:mb-8 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                
                <?php if (!empty($cards)) : ?>
                <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                    <?php foreach ($cards as $card) : ?>
                    <div>
                        <h6 class="mb-3 text-md font-bold font-heading text-purple leading-[1.4] md:mb-4 md:text-xl">
                            <?php echo esc_html($card['header']); ?>
                        </h6>
                        <p class="font-body text-purple/80">
                            <?php echo esc_html($card['content']); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <?php if (have_rows('buttons')) : ?>
                        <?php while (have_rows('buttons')) : the_row(); ?>
                            <?php $button_one_label = get_sub_field('button_one_label') ?: $default_button_one_label; ?>
                            <?php $button_one_link = get_sub_field('button_one_link'); ?>
                            <?php if ($button_one_link) : ?>
                                <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-transparent border border-purple text-purple hover:bg-purple/10 transition-colors duration-200 font-semibold">
                                    <?php echo esc_html($button_one_label); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php $button_two_label = get_sub_field('button_two_label') ?: $default_button_two_label; ?>
                            <?php $button_two_link = get_sub_field('button_two_link'); ?>
                            <?php if ($button_two_link) : ?>
                                <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center text-purple hover:text-pink transition-colors duration-200 font-semibold">
                                    <?php echo esc_html($button_two_label); ?>
                                    <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                                </a>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div>
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    class="w-full object-cover rounded-md"
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