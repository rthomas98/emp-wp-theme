<?php
/**
 * Layout 131 Block Template.
 *
 * @package _emp
 */

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $image = get_sub_field('image');
        $sub_header = get_sub_field('sub_header');
        $header = get_sub_field('header');
        $content = get_sub_field('content');
        
        // Process image
        $image_url = '';
        $image_alt = '';
        
        if (!empty($image)) {
            if (is_array($image) && isset($image['url'])) {
                $image_url = $image['url'];
                $image_alt = isset($image['alt']) ? $image['alt'] : '';
            } elseif (is_string($image)) {
                $image_url = $image;
            }
        }
        
        if (empty($image_url)) {
            $image_url = 'https://placehold.co/800x450';
        }
        
        // Handle potential array values for text fields
        $sub_header = is_array($sub_header) ? (isset($sub_header['text']) ? $sub_header['text'] : '') : $sub_header;
        $header = is_array($header) ? (isset($header['text']) ? $header['text'] : '') : $header;
        $content = is_array($content) ? (isset($content['text']) ? $content['text'] : '') : $content;
        
        // Get buttons
        $buttons = [];
        if (have_rows('buttons')) {
            while (have_rows('buttons')) {
                the_row();
                
                $button_one_label = get_sub_field('button_one_label');
                $button_one_link_field = get_sub_field('button_one_link');
                $button_two_label = get_sub_field('button_two_label');
                $button_two_link_field = get_sub_field('button_two_link');
                
                // Process button links
                $button_one_link = '#';
                if (is_array($button_one_link_field) && isset($button_one_link_field['url'])) {
                    $button_one_link = $button_one_link_field['url'];
                } elseif (is_string($button_one_link_field)) {
                    $button_one_link = $button_one_link_field;
                }
                
                $button_two_link = '#';
                if (is_array($button_two_link_field) && isset($button_two_link_field['url'])) {
                    $button_two_link = $button_two_link_field['url'];
                } elseif (is_string($button_two_link_field)) {
                    $button_two_link = $button_two_link_field;
                }
                
                $buttons = [
                    'button_one_label' => $button_one_label ?: 'Learn More',
                    'button_one_link' => $button_one_link,
                    'button_two_label' => $button_two_label ?: 'Contact',
                    'button_two_link' => $button_two_link
                ];
                
                // Only process the first row of the buttons repeater
                break;
            }
        }
        
        // Add card to array
        $cards[] = [
            'image_url' => $image_url,
            'image_alt' => $image_alt,
            'sub_header' => $sub_header,
            'header' => $header,
            'content' => $content,
            'buttons' => $buttons
        ];
    }
}

// If no cards are found, provide default content
if (empty($cards) || count($cards) < 2) {
    $default_cards = [
        [
            'image_url' => 'https://placehold.co/800x450',
            'image_alt' => 'Placeholder image 1',
            'sub_header' => 'Flexibility',
            'header' => 'Empowering Your Business with Remote Solutions',
            'content' => 'Our remote-first structure allows us to deliver exceptional results with unmatched efficiency. This flexibility not only enhances scalability but also ensures that we meet your unique business needs.',
            'buttons' => [
                'button_one_label' => 'Learn More',
                'button_one_link' => '#',
                'button_two_label' => 'Contact',
                'button_two_link' => '#'
            ]
        ],
        [
            'image_url' => 'https://placehold.co/800x450',
            'image_alt' => 'Placeholder image 2',
            'sub_header' => 'Agility',
            'header' => 'Seamless Integration for Your Projects',
            'content' => 'Our approach ensures that your projects are executed smoothly, regardless of location. With a team of experts at your disposal, we adapt quickly to changing requirements and deliver top-notch solutions.',
            'buttons' => [
                'button_one_label' => 'Get Started',
                'button_one_link' => '#',
                'button_two_label' => 'Explore',
                'button_two_link' => '#'
            ]
        ]
    ];
    
    // Fill in missing cards
    while (count($cards) < 2) {
        $cards[] = $default_cards[count($cards)];
    }
}
?>

<section class="layout-131 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 items-start gap-y-12 md:grid-cols-2 md:gap-x-8 md:gap-y-16 lg:gap-16">
            <?php foreach ($cards as $card) : ?>
                <div>
                    <div class="mb-6 md:mb-8">
                        <img 
                            src="<?php echo esc_url($card['image_url']); ?>" 
                            alt="<?php echo esc_attr($card['image_alt']); ?>" 
                            class="w-full h-auto aspect-[16/9] object-cover"
                        />
                    </div>
                    <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                        <?php echo esc_html($card['sub_header']); ?>
                    </p>
                    <h3 class="mb-5 text-3xl font-bold font-heading leading-[1.2] text-purple md:mb-6 md:text-3xl lg:text-3xl">
                        <?php echo esc_html($card['header']); ?>
                    </h3>
                    <p class="mt-5 font-body text-purple/80 md:mt-6">
                        <?php echo esc_html($card['content']); ?>
                    </p>
                    
                    <?php if (!empty($card['buttons'])) : ?>
                        <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                            <a href="<?php echo esc_url($card['buttons']['button_one_link']); ?>" class="inline-flex items-center justify-center rounded-md bg-pink px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-dark-purple transition-colors duration-200 font-body">
                                <?php echo esc_html($card['buttons']['button_one_label']); ?>
                            </a>
                            
                            <a href="<?php echo esc_url($card['buttons']['button_two_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                                <?php echo esc_html($card['buttons']['button_two_label']); ?>
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
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