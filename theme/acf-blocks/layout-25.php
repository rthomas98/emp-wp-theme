<?php
/**
 * Layout 25 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$sub_header = get_sub_field('sub_header') ?: 'Tagline';
$header = get_sub_field('header') ?: 'Medium length section heading goes here';
$content = get_sub_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.';

// Get image
$image = get_sub_field('image');
$image_url = '';
$image_alt = '';

if (!empty($image)) {
    if (is_array($image) && isset($image['url'])) {
        $image_url = $image['url'];
        $image_alt = $image['alt'] ?: 'Feature image';
    } elseif (is_string($image)) {
        $image_url = $image;
        $image_alt = 'Feature image';
    }
}

if (empty($image_url)) {
    $image_url = 'https://placehold.co/600x800/purple/white?text=Feature+Image';
}

// Default card data in case no cards are found
$default_cards = [
    [
        'state' => '50',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ],
    [
        'state' => '50',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    ]
];

// Get cards from repeater field
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        
        // Get card fields
        $state = get_sub_field('state');
        $card_content = get_sub_field('content');
        
        // Add card to array
        $cards[] = [
            'state' => $state ?: '50',
            'content' => $card_content ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ];
    }
}

// If no cards are found, use default cards
if (empty($cards)) {
    $cards = $default_cards;
}

// Get buttons
$button_primary = get_sub_field('button_primary');
$button_secondary = get_sub_field('button_secondary');

$button_primary_text = '';
$button_primary_link = '#';
if (!empty($button_primary)) {
    if (is_array($button_primary)) {
        $button_primary_text = $button_primary['title'] ?? 'Learn More';
        $button_primary_link = $button_primary['url'] ?? '#';
    }
}

$button_secondary_text = '';
$button_secondary_link = '#';
if (!empty($button_secondary)) {
    if (is_array($button_secondary)) {
        $button_secondary_text = $button_secondary['title'] ?? 'Discover';
        $button_secondary_link = $button_secondary['url'] ?? '#';
    }
}
?>

<section class="layout-25 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 gap-y-12 md:grid-cols-2 md:items-center md:gap-x-12 lg:gap-x-20">
            <div>
                <p class="mb-3 font-semibold font-body text-pink md:mb-4">
                    <?php echo esc_html($sub_header); ?>
                </p>
                <h2 class="mb-5 text-4xl font-bold font-heading leading-[1.2] text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="mb-6 font-body text-purple/80 md:mb-8 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
                <div class="grid grid-cols-1 gap-6 py-2 sm:grid-cols-2">
                    <?php $index = 0; foreach ($cards as $card) : ?>
                        <div>
                            <h3 class="mb-2 text-4xl font-bold font-heading text-pink md:text-5xl lg:text-6xl">
                                <span class="stat-counter" data-target="<?php echo esc_attr($card['state']); ?>">0</span>%
                            </h3>
                            <p class="font-body text-purple/80">
                                <?php echo esc_html($card['content']); ?>
                            </p>
                        </div>
                    <?php $index++; endforeach; ?>
                </div>
                
                <?php if (!empty($button_primary_text) || !empty($button_secondary_text)) : ?>
                <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                    <?php if (!empty($button_primary_text)) : ?>
                    <a href="<?php echo esc_url($button_primary_link); ?>" class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-purple text-white hover:bg-dark-purple transition-colors duration-200 font-semibold">
                        <?php echo esc_html($button_primary_text); ?>
                    </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($button_secondary_text)) : ?>
                    <a href="<?php echo esc_url($button_secondary_link); ?>" class="inline-flex items-center text-pink hover:text-pink/80 font-semibold transition-colors duration-200">
                        <?php echo esc_html($button_secondary_text); ?>
                        <i data-lucide="chevron-right" class="ml-1 w-5 h-5"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div>
                <img
                    src="<?php echo esc_url($image_url); ?>"
                    class="w-full object-cover"
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
    
    // Counter animation for statistics
    const counterAnimation = () => {
        const counters = document.querySelectorAll('.stat-counter');
        const speed = 150; // Higher value for slower animation
        const duration = 1500; // Total animation duration in milliseconds
        
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            
            // Reset counter to 0 before starting animation
            counter.innerText = '0';
            
            // Start animation when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Add a small delay to make the animation more noticeable
                        setTimeout(() => {
                            // Use a more controlled animation with timestamps
                            const startTime = performance.now();
                            
                            const updateCounter = (currentTime) => {
                                const elapsedTime = currentTime - startTime;
                                const progress = Math.min(elapsedTime / duration, 1);
                                
                                // Easing function for smoother animation
                                const easedProgress = progress < 0.5 
                                    ? 2 * progress * progress 
                                    : 1 - Math.pow(-2 * progress + 2, 2) / 2;
                                
                                const currentValue = Math.floor(easedProgress * target);
                                counter.innerText = currentValue;
                                
                                if (progress < 1) {
                                    requestAnimationFrame(updateCounter);
                                } else {
                                    counter.innerText = target;
                                }
                            };
                            
                            requestAnimationFrame(updateCounter);
                        }, 300);
                        
                        observer.unobserve(entry.target);
                    }
                });
            }, { 
                threshold: 0.2,
                rootMargin: '-50px 0px'
            });
            
            observer.observe(counter);
        });
    };
    
    // Run counter animation
    counterAnimation();
    
    // Re-run animation when page is scrolled (in case it was missed)
    document.addEventListener('scroll', function() {
        counterAnimation();
    }, { passive: true, once: true });
});
</script>