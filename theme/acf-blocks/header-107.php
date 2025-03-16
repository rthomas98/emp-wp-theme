<?php
/**
 * Header 107 Block Template.
 *
 * @package _emp
 */

// Get field values
$title = get_sub_field('header') ?: 'Add your heading here';
$description = get_sub_field('content') ?: 'Add your description here';

// Get button fields
$button_one_label = '';
$button_one_link = '';
$button_two_label = '';
$button_two_link = '';

if (have_rows('button_one_label')) {
    while (have_rows('button_one_label')) {
        the_row();
        $button_one_label = get_sub_field('button_one_label') ?: 'Button';
        $button_one_link = get_sub_field('button_one_link') ?: '#';
        $button_two_label = get_sub_field('button_two_label') ?: 'Button';
        $button_two_link = get_sub_field('button_two_link') ?: '#';
    }
}

// Get gallery images
$gallery_images = get_sub_field('gallery');
$images = [];

// Set default images if none are provided
if (empty($gallery_images) || count($gallery_images) < 6) {
    for ($i = 0; $i < 6; $i++) {
        $images[] = [
            'url' => 'https://placehold.co/600x800',
            'alt' => 'Placeholder image ' . ($i + 1),
            'sizes' => [
                'large' => 'https://placehold.co/600x800',
            ]
        ];
    }
} else {
    $images = $gallery_images;
}

// Ensure we have exactly 6 images
$images = array_slice($images, 0, 6);
?>

<section class="header-107 relative h-[250vh] bg-white">
    <div class="px-[5%] pt-16 md:pt-24 lg:pt-28">
        <div class="container">
            <div class="w-full max-w-5xl">
                <h1 class="mb-5 text-6xl font-bold font-heading text-purple md:mb-6 md:text-7xl lg:text-7xl"><?php echo esc_html($title); ?></h1>
                <p class="md:text-md font-body text-purple/80"><?php echo esc_html($description); ?></p>
                <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                    <?php if ($button_one_link && $button_one_label) : ?>
                        <a href="<?php echo esc_url($button_one_link); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-pink bg-pink px-5 py-2.5 text-white hover:bg-pink/90 transition-colors font-body">
                            <?php echo esc_html($button_one_label); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($button_two_link && $button_two_label) : ?>
                        <a href="<?php echo esc_url($button_two_link); ?>" class="inline-flex items-center justify-center gap-2 rounded-md border border-purple/10 bg-white px-5 py-2.5 text-purple hover:bg-purple/5 transition-colors font-body">
                            <?php echo esc_html($button_two_label); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky top-0 flex h-screen w-full items-center overflow-hidden">
        <div class="z-10 grid w-full grid-flow-col grid-cols-[25%_50%_25%] justify-center md:grid-cols-[50%_30%_20%] header-107-container">
            <div class="grid grid-flow-col grid-cols-1 justify-items-end gap-4 justify-self-end px-4 header-107-left-group">
                <div class="relative top-[5%] hidden w-[40vw] sm:w-[25vw] md:block lg:w-[22vw]">
                    <img class="aspect-[2/3] w-full object-cover" src="<?php echo esc_url($images[0]['url']); ?>" alt="<?php echo esc_attr($images[0]['alt']); ?>" />
                </div>

                <div class="relative top-[-5%] flex flex-col gap-4 self-center">
                    <div class="relative w-[30vw] flex-none md:w-[15vw]">
                        <img class="aspect-square w-full object-cover" src="<?php echo esc_url($images[1]['url']); ?>" alt="<?php echo esc_attr($images[1]['alt']); ?>" />
                    </div>
                    <div class="relative w-[30vw] flex-none md:w-[15vw]">
                        <img class="aspect-[3/4] w-full object-cover" src="<?php echo esc_url($images[2]['url']); ?>" alt="<?php echo esc_attr($images[2]['alt']); ?>" />
                    </div>
                </div>

                <div class="relative top-[15%] hidden w-[40vw] sm:w-[25vw] md:block lg:w-[22vw]">
                    <img class="aspect-square w-full object-cover" src="<?php echo esc_url($images[3]['url']); ?>" alt="<?php echo esc_attr($images[3]['alt']); ?>" />
                </div>
            </div>

            <div class="relative header-107-center-container">
                <img class="size-full object-cover" src="<?php echo esc_url($images[4]['url']); ?>" alt="<?php echo esc_attr($images[4]['alt']); ?>" />
            </div>

            <div class="grid grid-flow-col grid-cols-1 gap-4 justify-self-start px-4 header-107-right-image">
                <div class="relative top-[5%] w-[40vw] md:w-[25vw] lg:w-[22vw]">
                    <img class="aspect-[3/4] w-full object-cover" src="<?php echo esc_url($images[5]['url']); ?>" alt="<?php echo esc_attr($images[5]['alt']); ?>" />
                </div>
            </div>
        </div>
    </div>
    <div class="absolute inset-0 -z-10 mt-[100vh]"></div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header107 = document.querySelector('.header-107');
    if (!header107) return;
    
    // Variables for scroll animation
    let lastScrollY = window.scrollY;
    let ticking = false;
    
    // Function to handle scroll animation
    function handleScroll() {
        const scrollY = window.scrollY;
        const scrollProgress = Math.min(scrollY / (document.body.scrollHeight - window.innerHeight), 1);
        
        // Get elements to animate
        const container = header107.querySelector('.header-107-container');
        const leftGroup = header107.querySelector('.header-107-left-group');
        const centerContainer = header107.querySelector('.header-107-center-container');
        const rightImage = header107.querySelector('.header-107-right-image');
        
        // Apply transformations based on scroll progress
        const isMobile = window.innerWidth <= 767;
        
        // Container height
        if (container) {
            const heightValue = isMobile 
                ? `${60 + (40 * scrollProgress)}vh` 
                : `${70 + (30 * scrollProgress)}vh`;
            container.style.height = heightValue;
        }
        
        // Left image group
        if (leftGroup) {
            const xValue = isMobile 
                ? `${-25 * scrollProgress}vw` 
                : `${-50 * scrollProgress}vw`;
            leftGroup.style.transform = `translateX(${xValue})`;
        }
        
        // Center image container
        if (centerContainer) {
            const xValue = isMobile 
                ? `${-25 * scrollProgress}vw` 
                : `${-50 * scrollProgress}vw`;
            const widthValue = isMobile 
                ? `${50 + (50 * scrollProgress)}vw` 
                : `${30 + (70 * scrollProgress)}vw`;
            const heightValue = isMobile 
                ? `${50 + (50 * scrollProgress)}vh` 
                : `${70 + (30 * scrollProgress)}vh`;
            
            centerContainer.style.transform = `translateX(${xValue})`;
            centerContainer.style.width = widthValue;
            centerContainer.style.height = heightValue;
        }
        
        // Right image
        if (rightImage) {
            const xValue = isMobile 
                ? `${25 * scrollProgress}vw` 
                : `${20 * scrollProgress}vw`;
            rightImage.style.transform = `translateX(${xValue})`;
        }
        
        ticking = false;
    }
    
    // Add scroll event listener
    window.addEventListener('scroll', function() {
        lastScrollY = window.scrollY;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });
    
    // Initial call to set positions
    handleScroll();
    
    // Handle resize
    window.addEventListener('resize', handleScroll);
});
</script>