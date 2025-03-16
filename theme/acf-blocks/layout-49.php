<?php
/**
 * Layout 49 Block Template.
 *
 * @package _emp
 */

// Get main section fields
$sub_header = get_sub_field('sub_header');
$header = get_sub_field('header');
$content = get_sub_field('content');
$background_image = get_sub_field('background_image');

// Handle array values and provide fallbacks
$sub_header = is_array($sub_header) ? (isset($sub_header['text']) ? $sub_header['text'] : 'Tagline') : ($sub_header ?: 'Tagline');
$header = is_array($header) ? (isset($header['text']) ? $header['text'] : 'Medium length section heading goes here') : ($header ?: 'Medium length section heading goes here');
$content = is_array($content) ? (isset($content['text']) ? $content['text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.') : ($content ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.');

// Process background image
$background_image_url = '';
$background_image_alt = 'Background Image';

if (!empty($background_image)) {
    if (is_array($background_image) && isset($background_image['url'])) {
        $background_image_url = $background_image['url'];
        $background_image_alt = isset($background_image['alt']) ? $background_image['alt'] : 'Background Image';
    } elseif (is_string($background_image)) {
        $background_image_url = $background_image;
    }
}

if (empty($background_image_url)) {
    $background_image_url = 'https://placehold.co/1920x1080';
}

// Get cards/subheadings
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        
        // Handle potential array values
        $card_header = is_array($card_header) ? (isset($card_header['text']) ? $card_header['text'] : '') : $card_header;
        $card_content = is_array($card_content) ? (isset($card_content['text']) ? $card_content['text'] : '') : $card_content;
        
        $card = [
            'header' => $card_header,
            'content' => $card_content
        ];
        $cards[] = $card;
    }
}

// If no cards are found, provide default content
if (empty($cards) || count($cards) < 2) {
    $default_cards = [
        [
            'header' => 'Subheading one',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.'
        ],
        [
            'header' => 'Subheading two',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.'
        ]
    ];
    
    // Fill in missing cards
    while (count($cards) < 2) {
        $cards[] = $default_cards[count($cards)];
    }
}

// Get buttons from repeater field
$button_one_label = '';
$button_one_link = '#';
$button_two_label = '';
$button_two_link = '#';

if (have_rows('buttons')) {
    while (have_rows('buttons')) {
        the_row();
        
        // Get button fields from the repeater
        $button_one_label = get_sub_field('button_one_label');
        $button_one_link_field = get_sub_field('button_one_link');
        $button_two_label = get_sub_field('button_two_label');
        $button_two_link_field = get_sub_field('button_two_link');
        
        // Process button links
        if (is_array($button_one_link_field) && isset($button_one_link_field['url'])) {
            $button_one_link = $button_one_link_field['url'];
        } elseif (is_string($button_one_link_field)) {
            $button_one_link = $button_one_link_field;
        }
        
        if (is_array($button_two_link_field) && isset($button_two_link_field['url'])) {
            $button_two_link = $button_two_link_field['url'];
        } elseif (is_string($button_two_link_field)) {
            $button_two_link = $button_two_link_field;
        }
        
        // Only process the first row of the repeater
        break;
    }
}

// Set default button values if empty
if (empty($button_one_label)) {
    $button_one_label = 'Button';
}

if (empty($button_two_label)) {
    $button_two_label = 'Button';
}

if (empty($button_one_link)) {
    $button_one_link = '#';
}

if (empty($button_two_link)) {
    $button_two_link = '#';
}
?>

<section class="layout-49 relative px-[5%] py-16 md:py-24 lg:py-28">
    <div class="container relative z-10">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 md:gap-x-12 md:gap-y-8 lg:gap-x-20">
            <div>
                <p class="mb-3 font-semibold font-body text-white md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="text-3xl font-bold font-heading text-white md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
            </div>
            <div>
                <p class="mb-6 text-white font-body md:mb-8 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2 sm:gap-y-8">
                    <?php foreach ($cards as $card) : ?>
                        <div>
                            <h6 class="mb-3 text-md font-bold font-heading leading-[1.4] text-white md:mb-4 md:text-xl">
                                <?php echo esc_html($card['header']); ?>
                            </h6>
                            <p class="text-white font-body">
                                <?php echo esc_html($card['content']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-base font-medium text-purple shadow-sm hover:bg-gray-100 transition-colors duration-200 font-body">
                        <?php echo esc_html($button_one_label); ?>
                    </a>
                    
                    <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center gap-1 text-white hover:text-pink transition-colors font-body">
                        <?php echo esc_html($button_two_label); ?>
                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute inset-0 z-0">
        <img src="<?php echo esc_url($background_image_url); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr($background_image_alt); ?>" />
        <div class="absolute inset-0 bg-black/50"></div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons if available
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    } else {
        // Fallback for when lucide is not loaded yet
        setTimeout(function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }, 500);
    }
});
</script>