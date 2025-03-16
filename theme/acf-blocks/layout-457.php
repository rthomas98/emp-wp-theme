<?php
/**
 * Layout 457 Block Template.
 *
 * @package _emp
 */

// Get main section fields
$sub_header = get_sub_field('sub_header');
$header = get_sub_field('header');
$content = get_sub_field('content');

// Handle array values and provide fallbacks
$sub_header = is_array($sub_header) ? (isset($sub_header['text']) ? $sub_header['text'] : 'Outstanding performance in all endeavors.') : ($sub_header ?: 'Outstanding performance in all endeavors.');
$header = is_array($header) ? (isset($header['text']) ? $header['text'] : 'Medium length section heading goes here') : ($header ?: 'Medium length section heading goes here');
$content = is_array($content) ? (isset($content['text']) ? $content['text'] : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.') : ($content ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.');

// Get features/cards
$features = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        $image = get_sub_field('image');
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        
        // Handle potential array values
        $card_header = is_array($card_header) ? (isset($card_header['text']) ? $card_header['text'] : '') : $card_header;
        $card_content = is_array($card_content) ? (isset($card_content['text']) ? $card_content['text'] : '') : $card_content;
        
        $feature = [
            'image' => $image,
            'header' => $card_header,
            'content' => $card_content
        ];
        $features[] = $feature;
    }
}

// If no features are found, provide default content
if (empty($features) || count($features) < 3) {
    $default_features = [
        [
            'image' => [
                'url' => 'https://placehold.co/800x533',
                'alt' => 'Placeholder image 1'
            ],
            'header' => 'Medium length section heading goes here',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.'
        ],
        [
            'image' => [
                'url' => 'https://placehold.co/800x533',
                'alt' => 'Placeholder image 2'
            ],
            'header' => 'Medium length section heading goes here',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.'
        ],
        [
            'image' => [
                'url' => 'https://placehold.co/800x533',
                'alt' => 'Placeholder image 3'
            ],
            'header' => 'Medium length section heading goes here',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla.'
        ]
    ];
    
    // Fill in missing features
    while (count($features) < 3) {
        $features[] = $default_features[count($features)];
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
    $button_one_label = 'Get Started';
}

if (empty($button_two_label)) {
    $button_two_label = 'Learn More';
}

if (empty($button_one_link)) {
    $button_one_link = '#';
}

if (empty($button_two_link)) {
    $button_two_link = '#';
}
?>

<section class="layout-457 overflow-hidden px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container">
        <div class="mb-12 max-w-3xl md:mb-18 lg:mb-20">
            <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                <?php echo esc_html($sub_header); ?>
            </p>
            <h2 class="mb-5 text-3xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                <?php echo esc_html($header); ?>
            </h2>
            <p class="md:text-md font-body text-purple/80">
                <?php echo esc_html($content); ?>
            </p>
        </div>
        
        <div class="grid auto-cols-fr grid-cols-1 items-start gap-12 md:grid-cols-3 md:gap-8 lg:gap-12">
            <?php foreach ($features as $index => $feature) : ?>
                <div class="w-full <?php echo ($index === 1) ? 'md:mt-[25%]' : (($index === 2) ? 'md:mt-[50%]' : ''); ?>">
                    <div class="mb-6 w-full md:mb-8">
                        <?php if (!empty($feature['image'])) : ?>
                            <?php if (is_array($feature['image']) && !empty($feature['image']['url'])) : ?>
                                <img src="<?php echo esc_url($feature['image']['url']); ?>" 
                                     alt="<?php echo esc_attr($feature['image']['alt'] ?? 'Feature image'); ?>" 
                                     class="aspect-[3/2] w-full object-cover" />
                            <?php else : ?>
                                <img src="<?php echo is_string($feature['image']) ? esc_url($feature['image']) : 'https://placehold.co/800x533'; ?>" 
                                     alt="Feature image" 
                                     class="aspect-[3/2] w-full object-cover" />
                            <?php endif; ?>
                        <?php else : ?>
                            <img src="https://placehold.co/800x533" 
                                 alt="Placeholder image" 
                                 class="aspect-[3/2] w-full object-cover" />
                        <?php endif; ?>
                    </div>
                    <h3 class="mb-3 text-2xl font-bold font-heading text-purple md:mb-4 md:text-2xl md:leading-[1.3] lg:text-3xl">
                        <?php echo esc_html($feature['header'] ?? 'Medium length section heading goes here'); ?>
                    </h3>
                    <p class="font-body text-purple/80">
                        <?php echo esc_html($feature['content'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.'); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
            <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center rounded-md bg-pink px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-dark-purple transition-colors duration-200 font-body">
                <?php echo esc_html($button_one_label); ?>
            </a>
            
            <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                <?php echo esc_html($button_two_label); ?>
                <i data-lucide="chevron-right" class="h-4 w-4"></i>
            </a>
        </div>
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