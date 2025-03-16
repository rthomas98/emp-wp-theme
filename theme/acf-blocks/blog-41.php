<?php
/**
 * Blog 41 Block Template.
 *
 * @package _emp
 */

// Get ACF fields for the main section
$header = get_sub_field('header') ?: 'Latest Insights & News';
$content = get_sub_field('content') ?: 'Stay updated with our latest articles, news, and insights about web development, design trends, and technology advancements.';

// Get recent posts
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
);

$recent_posts = new WP_Query($args);
?>

<section class="blog-41 px-[5%] py-16 md:py-24 lg:py-28 bg-white">
    <div class="container mx-auto">
        <div class="mb-12 text-center md:mb-16 lg:mb-20">
            <div class="mx-auto max-w-3xl">
                <h2 class="mb-5 text-4xl font-bold font-heading text-purple md:mb-6 md:text-5xl lg:text-6xl">
                    <?php echo esc_html($header); ?>
                </h2>
                <p class="font-body text-purple/80 md:text-md">
                    <?php echo esc_html($content); ?>
                </p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php 
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                    // Get featured image
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    if (!$thumbnail_url) {
                        $thumbnail_url = 'https://placehold.co/800x600/purple/white?text=Blog+Image';
                    }
                    
                    // Get post date
                    $post_date = get_the_date('F j, Y');
                    
                    // Get excerpt
                    $excerpt = get_the_excerpt();
                    if (empty($excerpt)) {
                        $excerpt = wp_trim_words(get_the_content(), 20, '...');
                    }
            ?>
                <div class="flex flex-col overflow-hidden rounded-lg shadow-md transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img 
                            src="<?php echo esc_url($thumbnail_url); ?>" 
                            alt="<?php echo esc_attr(get_the_title()); ?>" 
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <p class="mb-3 text-sm font-semibold text-pink">
                            <?php echo esc_html($post_date); ?>
                        </p>
                        <h3 class="mb-4 text-xl font-bold font-heading text-purple">
                            <?php echo esc_html(get_the_title()); ?>
                        </h3>
                        <p class="mb-5 flex-1 font-body text-purple/80">
                            <?php echo esc_html($excerpt); ?>
                        </p>
                        <a 
                            href="<?php echo esc_url(get_permalink()); ?>" 
                            class="inline-flex items-center font-semibold text-purple hover:text-pink transition-colors duration-200"
                        >
                            Read More
                            <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            else :
                // Display placeholder cards if no posts are found
                for ($i = 0; $i < 3; $i++) :
            ?>
                <div class="flex flex-col overflow-hidden rounded-lg shadow-md">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img 
                            src="https://placehold.co/800x600/purple/white?text=Blog+Image" 
                            alt="Placeholder image" 
                            class="h-full w-full object-cover"
                        />
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <p class="mb-3 text-sm font-semibold text-pink">
                            <?php echo esc_html(date('F j, Y')); ?>
                        </p>
                        <h3 class="mb-4 text-xl font-bold font-heading text-purple">
                            Sample Blog Post Title
                        </h3>
                        <p class="mb-5 flex-1 font-body text-purple/80">
                            This is a placeholder for a blog post. Create some posts to see them appear here.
                        </p>
                        <a 
                            href="#" 
                            class="inline-flex items-center font-semibold text-purple hover:text-pink transition-colors duration-200"
                        >
                            Read More
                            <i data-lucide="arrow-right" class="ml-1 w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            <?php 
                endfor;
            endif; 
            ?>
        </div>
        
        <div class="mt-12 text-center md:mt-16">
            <a 
                href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" 
                class="inline-flex items-center justify-center px-6 py-3 rounded-md bg-purple text-white hover:bg-purple/90 transition-colors duration-200 font-semibold"
            >
                View All Articles
            </a>
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