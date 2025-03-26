<?php
/**
 * Testimonial 20 Block Template.
 *
 * @package _emp
 */

// Get ACF fields
$heading = get_sub_field('header') ?: 'Customer testimonials';
$description = get_sub_field('content') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

// Get testimonials from repeater field
$testimonials = [];
if (have_rows('testimonials')) {
    while (have_rows('testimonials')) {
        the_row();
        
        // Get testimonial fields
        $testimonial_text = get_sub_field('testimonial');
        $name = get_sub_field('name');
        $position = get_sub_field('position');
        $image = get_sub_field('image');
        
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
            $image_url = 'https://placehold.co/100x100/purple/white?text=User';
        }
        
        // Handle potential array values for text fields
        $testimonial_text = is_array($testimonial_text) ? (isset($testimonial_text['text']) ? $testimonial_text['text'] : '') : $testimonial_text;
        $name = is_array($name) ? (isset($name['text']) ? $name['text'] : '') : $name;
        $position = is_array($position) ? (isset($position['text']) ? $position['text'] : '') : $position;
        
        // Add testimonial to array
        $testimonials[] = [
            'quote' => $testimonial_text ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.',
            'name' => $name ?: 'Name Surname',
            'position' => $position ?: 'Position',
            'image_url' => $image_url,
            'image_alt' => $image_alt ?: 'Testimonial avatar',
            'number_of_stars' => 5 // Default to 5 stars since it's not in ACF
        ];
    }
}

// If no testimonials are found, provide default content
if (empty($testimonials)) {
    $default_testimonial = [
        'quote' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.',
        'name' => 'Name Surname',
        'position' => 'Position, Company name',
        'image_url' => 'https://placehold.co/100x100/purple/white?text=User',
        'image_alt' => 'Testimonial avatar',
        'number_of_stars' => 5
    ];
    
    // Add 3 default testimonials
    $testimonials = [
        $default_testimonial,
        $default_testimonial,
        $default_testimonial
    ];
}
?>

<section class="testimonial-20 overflow-hidden px-[5%] py-16 md:py-24 lg:py-28 bg-pink">
    <div class="container mx-auto">
        <div class="mb-12 md:mb-18 lg:mb-20">
            <h2 class="mb-5 text-4xl font-bold font-heading text-white md:mb-6 md:text-5xl lg:text-6xl">
                <?php echo esc_html($heading); ?>
            </h2>
            <p class="font-body text-white md:text-lg">
                <?php echo esc_html($description); ?>
            </p>
        </div>
        
        <!-- Testimonial Carousel -->
        <div class="testimonial-carousel relative">
            <div class="testimonial-carousel-container overflow-hidden">
                <div class="testimonial-carousel-track flex transition-transform duration-300">
                    <?php foreach ($testimonials as $index => $testimonial) : ?>
                        <div class="testimonial-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 pr-6 md:pr-8">
                            <div class="flex w-full flex-col items-start justify-between border border-gray-200 p-6 md:p-8 h-full bg-white">
                                <div class="mb-5 flex md:mb-6">
                                    <?php for ($i = 0; $i < $testimonial['number_of_stars']; $i++) : ?>
                                        <i data-lucide="star" class="w-6 h-6 text-[#FFC259] fill-[#FFC259]"></i>
                                    <?php endfor; ?>
                                </div>
                                <blockquote class="font-body text-purple/80 md:text-lg">
                                    "<?php echo esc_html($testimonial['quote']); ?>"
                                </blockquote>
                                <div class="mt-5 flex w-full flex-col items-start gap-4 md:mt-6 md:w-auto md:flex-row md:items-center">
                                    <div>
                                        <img 
                                            src="<?php echo esc_url($testimonial['image_url']); ?>" 
                                            alt="<?php echo esc_attr($testimonial['image_alt']); ?>" 
                                            class="w-12 h-12 min-h-12 min-w-12 rounded-full object-cover"
                                        />
                                    </div>
                                    <div>
                                        <p class="font-semibold font-body text-purple">
                                            <?php echo esc_html($testimonial['name']); ?>
                                        </p>
                                        <p class="font-body text-purple/80">
                                            <?php echo esc_html($testimonial['position']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Carousel Controls -->
            <div class="mt-8 flex items-center justify-between">
                <div class="carousel-dots flex items-start justify-start">
                    <?php foreach ($testimonials as $index => $testimonial) : ?>
                        <button 
                            class="carousel-dot mx-[3px] inline-block w-2 h-2 rounded-full <?php echo $index === 0 ? 'bg-purple' : 'bg-gray-200'; ?>" 
                            data-index="<?php echo esc_attr($index); ?>"
                            aria-label="Go to slide <?php echo esc_attr($index + 1); ?>"
                        ></button>
                    <?php endforeach; ?>
                </div>
                <div class="flex items-end justify-end gap-2 md:gap-4">
                    <button class="carousel-prev static right-0 top-0 w-12 h-12 flex items-center justify-center border bg-white border-gray-200 rounded-full" aria-label="Previous slide">
                        <i data-lucide="chevron-left" class="w-6 h-6 text-purple"></i>
                    </button>
                    <button class="carousel-next static right-0 top-0 w-12 h-12 flex items-center justify-center border bg-white border-gray-200 rounded-full" aria-label="Next slide">
                        <i data-lucide="chevron-right" class="w-6 h-6 text-purple"></i>
                    </button>
                </div>
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
    
    // Carousel functionality
    const carouselTrack = document.querySelector('.testimonial-carousel-track');
    const carouselItems = document.querySelectorAll('.testimonial-item');
    const carouselDots = document.querySelectorAll('.carousel-dot');
    const prevButton = document.querySelector('.carousel-prev');
    const nextButton = document.querySelector('.carousel-next');
    
    if (!carouselTrack || !carouselItems.length || !carouselDots.length || !prevButton || !nextButton) {
        return;
    }
    
    let currentIndex = 0;
    const itemCount = carouselItems.length;
    let itemWidth = carouselItems[0].offsetWidth;
    let isAnimating = false;
    
    // Function to update carousel position
    function updateCarousel() {
        if (isAnimating) return;
        
        isAnimating = true;
        carouselTrack.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
        
        // Update dots
        carouselDots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('bg-purple');
                dot.classList.remove('bg-gray-200');
            } else {
                dot.classList.remove('bg-purple');
                dot.classList.add('bg-gray-200');
            }
        });
        
        setTimeout(() => {
            isAnimating = false;
        }, 300); // Match the transition duration
    }
    
    // Handle window resize
    function handleResize() {
        // Recalculate item width
        itemWidth = carouselItems[0].offsetWidth;
        updateCarousel();
    }
    
    // Next button click
    nextButton.addEventListener('click', function() {
        if (isAnimating) return;
        
        currentIndex = (currentIndex + 1) % itemCount;
        updateCarousel();
    });
    
    // Previous button click
    prevButton.addEventListener('click', function() {
        if (isAnimating) return;
        
        currentIndex = (currentIndex - 1 + itemCount) % itemCount;
        updateCarousel();
    });
    
    // Dot click
    carouselDots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            if (isAnimating || currentIndex === index) return;
            
            currentIndex = index;
            updateCarousel();
        });
    });
    
    // Touch events for swipe
    let touchStartX = 0;
    let touchEndX = 0;
    
    carouselTrack.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    carouselTrack.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left - go next
            nextButton.click();
        } else if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right - go prev
            prevButton.click();
        }
    }
    
    // Initialize
    window.addEventListener('resize', handleResize);
    handleResize();
});
</script>