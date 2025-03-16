<?php
/**
 * Layout 403 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$sub_header = get_sub_field('sub_header') ?: 'Adaptable and flexible to changing conditions or needs.';
$header = get_sub_field('header') ?: 'Seamless User Experience Across Devices';
$content = get_sub_field('content') ?: 'Our front-end development ensures that your applications look great and function flawlessly on any device. We prioritize user experience to keep your audience engaged.';

// Default card data
$default_cards = [
    [
        'header' => 'Adaptive Interfaces',
        'content' => 'Create interfaces that adapt to any screen size for optimal usability and engagement.',
        'image' => [
            'url' => 'https://placehold.co/1200x300/purple/white?text=Adaptive+Interfaces',
            'alt' => 'Adaptive Interfaces'
        ]
    ],
    [
        'header' => 'Responsive Design',
        'content' => 'Build applications that respond intelligently to different devices and screen sizes.',
        'image' => [
            'url' => 'https://placehold.co/1200x300/purple/white?text=Responsive+Design',
            'alt' => 'Responsive Design'
        ]
    ],
    [
        'header' => 'Cross-Platform Compatibility',
        'content' => 'Ensure your applications work seamlessly across all browsers and operating systems.',
        'image' => [
            'url' => 'https://placehold.co/1200x300/purple/white?text=Cross-Platform+Compatibility',
            'alt' => 'Cross-Platform Compatibility'
        ]
    ]
];

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    $index = 0;
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $card_header = get_sub_field('header');
        $card_content = get_sub_field('content');
        $image = get_sub_field('image');
        
        // Process image
        $image_url = '';
        $image_alt = '';
        
        if (!empty($image) && is_array($image)) {
            $image_url = $image['url'];
            $image_alt = $image['alt'] ?: 'Tab image';
        } else {
            $image_url = $default_cards[$index]['image']['url'] ?? 'https://placehold.co/1200x300/purple/white?text=Tab+Image';
            $image_alt = $default_cards[$index]['image']['alt'] ?? 'Tab image';
        }
        
        // Add card to array
        $cards[] = [
            'header' => $card_header ?: $default_cards[$index]['header'] ?? 'Tab Title',
            'content' => $card_content ?: $default_cards[$index]['content'] ?? 'Tab content goes here.',
            'image' => [
                'url' => $image_url,
                'alt' => $image_alt
            ]
        ];
        
        $index++;
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}

// Generate unique ID for tabs
$tab_id = 'tabs-' . uniqid();
?>

<section class="layout-403 px-[5%] py-16 md:py-24 lg:py-28 bg-gray">
    <div class="container mx-auto">
        <div class="mx-auto mb-12 w-full max-w-3xl text-center md:mb-16 lg:mb-20">
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
        
        <!-- Tabs Component -->
        <div class="tabs-component" id="<?php echo esc_attr($tab_id); ?>">
            <!-- Tab Navigation -->
            <div class="mb-12 flex flex-col md:mb-16 md:flex-row border-b border-purple/20">
                <?php foreach ($cards as $index => $card) : ?>
                    <button 
                        class="tab-trigger flex w-full flex-col gap-1 whitespace-normal border-0 border-purple/20 px-6 py-4 text-center transition-all duration-200 hover:text-purple <?php echo $index === 0 ? 'active border-purple text-purple' : 'text-purple/70'; ?>" 
                        data-tab="tab-<?php echo esc_attr($index); ?>"
                    >
                        <h3 class="text-md font-bold font-heading leading-[1.4] md:text-xl">
                            <?php echo esc_html($card['header']); ?>
                        </h3>
                        <p class="font-body">
                            <?php echo esc_html($card['content']); ?>
                        </p>
                    </button>
                <?php endforeach; ?>
            </div>
            
            <!-- Tab Content -->
            <?php foreach ($cards as $index => $card) : ?>
                <div class="tab-content <?php echo $index === 0 ? 'active' : 'hidden'; ?>" id="tab-<?php echo esc_attr($index); ?>">
                    <div class="max-h-[400px] overflow-hidden rounded-md">
                        <img
                            src="<?php echo esc_url($card['image']['url']); ?>"
                            class="w-full object-cover"
                            alt="<?php echo esc_attr($card['image']['alt']); ?>"
                            style="height: 400px;"
                        />
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tabs functionality
    const tabsContainer = document.getElementById('<?php echo esc_js($tab_id); ?>');
    if (tabsContainer) {
        const tabTriggers = tabsContainer.querySelectorAll('.tab-trigger');
        const tabContents = tabsContainer.querySelectorAll('.tab-content');
        
        tabTriggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                // Remove active class from all triggers
                tabTriggers.forEach(t => {
                    t.classList.remove('active', 'border-purple', 'text-purple');
                    t.classList.add('text-purple/70', 'border-purple/20');
                });
                
                // Add active class to clicked trigger
                this.classList.add('active', 'border-purple', 'text-purple');
                this.classList.remove('text-purple/70', 'border-purple/20');
                
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });
                
                // Show corresponding tab content
                const tabId = this.getAttribute('data-tab');
                const tabContent = tabsContainer.querySelector(`#${tabId}`);
                if (tabContent) {
                    tabContent.classList.remove('hidden');
                    tabContent.classList.add('active');
                    
                    // Add fade-in animation
                    tabContent.style.opacity = '0';
                    tabContent.style.transition = 'opacity 0.3s ease-in-out';
                    setTimeout(() => {
                        tabContent.style.opacity = '1';
                    }, 50);
                }
            });
        });
    }
});
</script>