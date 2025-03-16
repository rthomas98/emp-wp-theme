<?php
/**
 * Layout 384 Block Template.
 *
 * @package _emp
 */

// Get cards from ACF
$cards = [];
if (have_rows('cards')) {
    while (have_rows('cards')) {
        the_row();
        $card = [
            'sub_header' => get_sub_field('sub_header') ?: 'Innovate and transform ideas into reality.',
            'header' => get_sub_field('header') ?: 'Enhancing Business Operations Through Advanced Technology',
            'content' => get_sub_field('content') ?: 'At Empuls3, we specialize in delivering tailored technology solutions that drive growth and efficiency. Our team combines technical expertise with industry insights to meet your unique business challenges.',
            'image' => get_sub_field('image'),
            'button_one_label' => '',
            'button_one_link' => '',
            'button_two_label' => '',
            'button_two_link' => ''
        ];

        // Get button fields
        if (have_rows('buttons')) {
            while (have_rows('buttons')) {
                the_row();
                $card['button_one_label'] = get_sub_field('botton_one_label') ?: 'More About Our Agency';
                $card['button_one_link'] = get_sub_field('button_one_link') ?: '#';
                $card['button_two_label'] = get_sub_field('button_two_label') ?: 'Have More Questions';
                $card['button_two_link'] = get_sub_field('button_two_link') ?: '#';
            }
        }

        $cards[] = $card;
    }
}

// If no cards are found, provide default content
if (empty($cards)) {
    for ($i = 0; $i < 4; $i++) {
        $cards[] = [
            'sub_header' => 'Innovate and transform ideas into reality.',
            'header' => 'Enhancing Business Operations Through Advanced Technology',
            'content' => 'At Empuls3, we specialize in delivering tailored technology solutions that drive growth and efficiency. Our team combines technical expertise with industry insights to meet your unique business challenges.',
            'image' => [
                'url' => 'https://placehold.co/800x600',
                'alt' => 'Placeholder image ' . ($i + 1)
            ],
            'button_one_label' => 'More About Our Agency',
            'button_one_link' => '#',
            'button_two_label' => 'Have More Questions',
            'button_two_link' => '#'
        ];
    }
}
?>

<section class="layout-384 px-[5%]">
    <div class="container">
        <div class="relative grid gap-x-12 py-16 sm:gap-y-12 md:grid-cols-2 md:py-0 lg:gap-x-20">
            <!-- Left column with sticky images -->
            <div class="sticky top-0 hidden h-screen md:flex md:flex-col md:items-center md:justify-center layout-384-images">
                <?php foreach ($cards as $index => $card) : ?>
                    <?php 
                    $image_url = isset($card['image']['url']) ? $card['image']['url'] : 'https://placehold.co/800x600';
                    $image_alt = isset($card['image']['alt']) ? $card['image']['alt'] : 'Placeholder image ' . ($index + 1);
                    ?>
                    <img 
                        src="<?php echo esc_url($image_url); ?>" 
                        class="absolute w-full layout-384-image" 
                        data-index="<?php echo esc_attr($index); ?>"
                        alt="<?php echo esc_attr($image_alt); ?>" 
                    />
                <?php endforeach; ?>
            </div>

            <!-- Right column with scrollable content -->
            <div class="grid grid-cols-1 gap-12 md:block layout-384-content">
                <?php foreach ($cards as $index => $card) : ?>
                    <div class="layout-384-section" data-index="<?php echo esc_attr($index); ?>">
                        <div class="flex flex-col items-start justify-center md:h-screen">
                            <p class="mb-3 font-semibold font-body text-purple md:mb-4">
                                <?php echo esc_html($card['sub_header']); ?>
                            </p>
                            <h2 class="mb-5 text-3xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                                <?php echo esc_html($card['header']); ?>
                            </h2>
                            <p class="md:text-md font-body text-purple/80">
                                <?php echo esc_html($card['content']); ?>
                            </p>
                            <div class="mt-6 flex flex-wrap items-center gap-4 md:mt-8">
                                <?php if ($card['button_one_link'] && $card['button_one_label']) : ?>
                                    <a href="<?php echo esc_url($card['button_one_link']); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-purple/10 bg-pink px-5 py-2.5 text-white hover:bg-purple transition-colors font-body">
                                        <?php echo esc_html($card['button_one_label']); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($card['button_two_link'] && $card['button_two_label']) : ?>
                                    <a href="<?php echo esc_url($card['button_two_link']); ?>" class="inline-flex items-center gap-1 text-purple hover:text-pink transition-colors font-body">
                                        <?php echo esc_html($card['button_two_label']); ?>
                                        <i data-lucide="chevron-right" class="h-4 w-4"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Mobile image -->
                            <div class="mt-10 block w-full md:hidden">
                                <img 
                                    src="<?php echo esc_url($image_url); ?>" 
                                    class="w-full" 
                                    alt="<?php echo esc_attr($image_alt); ?>" 
                                />
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="fixed inset-0 -z-10 bg-[#e5e5e5] transition-opacity duration-300 layout-384-overlay"></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const layout384 = document.querySelector('.layout-384');
    if (!layout384) return;
    
    // Get elements
    const sections = layout384.querySelectorAll('.layout-384-section');
    const images = layout384.querySelectorAll('.layout-384-image');
    const overlay = layout384.querySelector('.layout-384-overlay');
    
    let activeSection = 0;
    let sectionHeight = window.innerHeight;
    
    // Initialize images visibility
    updateImagesVisibility();
    
    // Function to handle scroll
    function handleScroll() {
        const currentScrollPosition = window.scrollY + sectionHeight / 2;
        const layoutOffset = layout384.offsetTop;
        const relativeScroll = currentScrollPosition - layoutOffset;
        
        if (relativeScroll < 0) {
            activeSection = 0;
        } else {
            activeSection = Math.floor(relativeScroll / sectionHeight);
            if (activeSection >= sections.length) {
                activeSection = sections.length - 1;
            }
        }
        
        updateImagesVisibility();
        updateOverlayVisibility();
    }
    
    // Function to update images visibility
    function updateImagesVisibility() {
        images.forEach((image, index) => {
            if (index === activeSection) {
                image.style.opacity = '1';
                image.style.zIndex = '1';
            } else {
                image.style.opacity = '0';
                image.style.zIndex = '0';
            }
        });
    }
    
    // Function to update overlay visibility
    function updateOverlayVisibility() {
        if (activeSection === 0 || activeSection === 2) {
            overlay.style.opacity = '1';
        } else {
            overlay.style.opacity = '0';
        }
    }
    
    // Add scroll event listener
    window.addEventListener('scroll', function() {
        requestAnimationFrame(handleScroll);
    });
    
    // Handle resize
    window.addEventListener('resize', function() {
        sectionHeight = window.innerHeight;
        handleScroll();
    });
    
    // Initial call
    handleScroll();
    
    // Initialize Lucide icons
    if (window.lucide) {
        window.lucide.createIcons();
    }
});
</script>