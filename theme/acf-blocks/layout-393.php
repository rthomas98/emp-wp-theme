<?php
/**
 * Layout 393 Block Template.
 *
 * @package _emp
 */

// Get main section fields
$sub_header = get_sub_field('sub_header') ?: 'Outstanding performance in all endeavors.';
$header = get_sub_field('header') ?: 'Your Trusted Technology Partner for Innovative Solutions and Seamless Integration';
$content = get_sub_field('content') ?: 'Empowering businesses to thrive by leveraging our comprehensive full-stack expertise, we provide tailored solutions that drive innovation, enhance efficiency, and foster growth in today\'s competitive market landscape. Let\'s transform your vision into reality.';

// Get cards
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        $card = [
            'icon' => get_sub_field('icon'),
            'image' => get_sub_field('image'),
            'sub_header' => get_sub_field('sub_header'),
            'header' => get_sub_field('header'),
            'content' => get_sub_field('content'),
            'button_label' => get_sub_field('button_label'),
            'button_link' => get_sub_field('button_link')
        ];
        $cards[] = $card;
    }
}

// If no cards are found, provide default content
if (empty($cards) || count($cards) < 4) {
    $default_cards = [
        [
            'icon' => 'layout',
            'image' => null,
            'sub_header' => '',
            'header' => 'Comprehensive Modern Technology Solutions',
            'content' => 'Expertise across diverse technology stacks',
            'button_label' => 'Learn More',
            'button_link' => '#'
        ],
        [
            'icon' => 'code',
            'image' => null,
            'sub_header' => '',
            'header' => 'Comprehensive Modern Technology Solutions',
            'content' => 'Expertise across diverse technology stacks',
            'button_label' => 'Learn More',
            'button_link' => '#'
        ],
        [
            'icon' => null,
            'image' => [
                'url' => 'https://placehold.co/600x400',
                'alt' => 'Placeholder image 1'
            ],
            'sub_header' => 'Innovation',
            'header' => 'Empowering Your Digital Transformation',
            'content' => 'Driving growth with innovative technology solutions',
            'button_label' => 'Get Started',
            'button_link' => '#'
        ],
        [
            'icon' => null,
            'image' => [
                'url' => 'https://placehold.co/600x400',
                'alt' => 'Placeholder image 2'
            ],
            'sub_header' => 'Scalability',
            'header' => 'Experience with Industry Leaders',
            'content' => 'Trusted by global brands for excellence',
            'button_label' => 'Explore',
            'button_link' => '#'
        ]
    ];
    
    // Fill in missing cards
    while (count($cards) < 4) {
        $cards[] = $default_cards[count($cards)];
    }
}
?>

<section class="layout-393 px-[5%] py-16 md:py-24 lg:py-28 gradient-background">
    <div class="container">
        <div class="mx-auto mb-12 w-full max-w-3xl text-center md:mb-18 lg:mb-20">
            <p class="mb-3 font-semibold font-body md:mb-4 text-white">
                <?php echo esc_html($sub_header); ?>
            </p>
            <h2 class="mb-5 text-3xl font-bold font-heading md:mb-6 md:text-5xl lg:text-6xl text-white">
                <?php echo esc_html($header); ?>
            </h2>
            <p class="md:text-md font-body text-white">
                <?php echo esc_html($content); ?>
            </p>
        </div>
        
        <div class="grid auto-cols-fr gap-6 md:grid-cols-2 md:gap-8 lg:grid-cols-3">
            <!-- Card 1 -->
            <div class="flex flex-col border border-purple/10 bg-white">
                <div class="flex flex-1 flex-col justify-center p-6 md:p-8">
                    <div>
                        <div class="mb-5 md:mb-6">
                            <i data-lucide="layout" class="size-12 text-purple"></i>
                        </div>
                        <h3 class="mb-3 text-2xl font-bold font-heading text-purple md:mb-4 md:text-2xl md:leading-[1.3] lg:text-3xl">
                            <?php echo esc_html($cards[0]['header'] ?? 'Comprehensive Modern Technology Solutions'); ?>
                        </h3>
                        <p class="font-body text-purple/80">
                            <?php echo esc_html($cards[0]['content'] ?? 'Expertise across diverse technology stacks'); ?>
                        </p>
                    </div>
                    <div class="mt-5 md:mt-6">
                        <?php if (!empty($cards[0]['button_link']) && !empty($cards[0]['button_label'])) : ?>
                            <a href="<?php echo esc_url($cards[0]['button_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                                <?php echo esc_html($cards[0]['button_label']); ?>
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="flex flex-col border border-purple/10 bg-white">
                <div class="flex flex-1 flex-col justify-center p-6 md:p-8">
                    <div>
                        <div class="mb-5 md:mb-6">
                            <i data-lucide="code" class="size-12 text-purple"></i>
                        </div>
                        <h3 class="mb-3 text-2xl font-bold font-heading text-purple md:mb-4 md:text-2xl md:leading-[1.3] lg:text-3xl xl:text-4xl">
                            <?php echo esc_html($cards[1]['header'] ?? 'Comprehensive Modern Technology Solutions'); ?>
                        </h3>
                        <p class="font-body text-purple/80">
                            <?php echo esc_html($cards[1]['content'] ?? 'Expertise across diverse technology stacks'); ?>
                        </p>
                    </div>
                    <div class="mt-5 md:mt-6">
                        <?php if (!empty($cards[1]['button_link']) && !empty($cards[1]['button_label'])) : ?>
                            <a href="<?php echo esc_url($cards[1]['button_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                                <?php echo esc_html($cards[1]['button_label']); ?>
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 (Large with image) -->
            <div class="flex auto-cols-fr flex-col border border-purple/10 sm:col-span-2 sm:grid-cols-2 lg:col-span-1 lg:col-start-3 lg:row-span-2 bg-white">
                <div class="flex size-full flex-col items-center justify-center self-start lg:h-auto">
                    <?php if (!empty($cards[2]['image'])) : ?>
                        <?php if (is_array($cards[2]['image']) && !empty($cards[2]['image']['url'])) : ?>
                            <img src="<?php echo esc_url($cards[2]['image']['url']); ?>" alt="<?php echo esc_attr($cards[2]['image']['alt'] ?? 'Image'); ?>" class="w-full h-full object-cover" />
                        <?php else : ?>
                            <img src="<?php echo esc_url($cards[2]['image']); ?>" alt="Image" class="w-full h-full object-cover" />
                        <?php endif; ?>
                    <?php else : ?>
                        <img src="https://placehold.co/600x400" alt="Placeholder image" class="w-full h-full object-cover" />
                    <?php endif; ?>
                </div>
                <div class="block flex-1 p-6 sm:flex sm:flex-col sm:justify-center md:p-8">
                    <div>
                        <p class="mb-2 font-semibold font-body text-purple">
                            <?php echo esc_html($cards[2]['sub_header'] ?? 'Innovation'); ?>
                        </p>
                        <h3 class="mb-3 text-2xl font-bold font-heading text-purple md:mb-4 md:text-2xl md:leading-[1.3] lg:text-3xl">
                            <?php echo esc_html($cards[2]['header'] ?? 'Empowering Your Digital Transformation'); ?>
                        </h3>
                        <p class="font-body text-purple/80">
                            <?php echo esc_html($cards[2]['content'] ?? 'Driving growth with innovative technology solutions'); ?>
                        </p>
                    </div>
                    <div class="mt-5 md:mt-6">
                        <?php if (!empty($cards[2]['button_link']) && !empty($cards[2]['button_label'])) : ?>
                            <a href="<?php echo esc_url($cards[2]['button_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                                <?php echo esc_html($cards[2]['button_label']); ?>
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 (Large with image) -->
            <div class="flex auto-cols-fr flex-col border border-purple/10 last-of-type:row-span-1 last-of-type:grid sm:col-span-2 sm:grid-cols-2 sm:last-of-type:row-start-2 md:last-of-type:col-span-2 lg:col-span-1 lg:col-start-3 lg:row-span-2 lg:last-of-type:col-span-2 bg-white">
                <div class="flex size-full flex-col items-center justify-center self-start lg:h-auto">
                    <?php if (!empty($cards[3]['image'])) : ?>
                        <?php if (is_array($cards[3]['image']) && !empty($cards[3]['image']['url'])) : ?>
                            <img src="<?php echo esc_url($cards[3]['image']['url']); ?>" alt="<?php echo esc_attr($cards[3]['image']['alt'] ?? 'Image'); ?>" class="w-full h-full object-cover" />
                        <?php else : ?>
                            <img src="<?php echo esc_url($cards[3]['image']); ?>" alt="Image" class="w-full h-full object-cover" />
                        <?php endif; ?>
                    <?php else : ?>
                        <img src="https://placehold.co/600x400" alt="Placeholder image" class="w-full h-full object-cover" />
                    <?php endif; ?>
                </div>
                <div class="block flex-1 p-6 sm:flex sm:flex-col sm:justify-center md:p-8">
                    <div>
                        <p class="mb-2 font-semibold font-body text-purple">
                            <?php echo esc_html($cards[3]['sub_header'] ?? 'Scalability'); ?>
                        </p>
                        <h3  class="mb-3 text-2xl font-bold font-heading text-purple md:mb-4 md:text-2xl md:leading-[1.3] lg:text-3xl xl:text-4xl">
                            <?php echo esc_html($cards[3]['header'] ?? 'Experience with Industry Leaders'); ?>
                        </h3>
                        <p class="font-body text-purple/80">
                            <?php echo esc_html($cards[3]['content'] ?? 'Trusted by global brands for excellence'); ?>
                        </p>
                    </div>
                    <div class="mt-5 md:mt-6">
                        <?php if (!empty($cards[3]['button_link']) && !empty($cards[3]['button_label'])) : ?>
                            <a href="<?php echo esc_url($cards[3]['button_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                                <?php echo esc_html($cards[3]['button_label']); ?>
                                <i data-lucide="chevron-right" class="h-4 w-4"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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