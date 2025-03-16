<?php
/**
 * Template part for displaying the footer content
 *
 * @package _emp
 */

$footer_heading = get_field('footer_heading', 'option') ?: 'Explore Our Comprehensive Technology Solutions';
$footer_description = get_field('footer_description', 'option') ?: 'Empuls3 delivers innovative solutions tailored to your business needs, ensuring growth and digital excellence.';
$cta_buttons = get_field('footer_cta_buttons', 'option');
$social_links = get_field('footer_social_links', 'option');
$copyright = get_field('footer_copyright', 'option');
?>

<footer id="colophon" class="px-[5%] py-12 md:py-18 lg:py-20 bg-white">
    <div class="container mx-auto">
        <div class="border-b border-purple/10">
            <div class="mb-12 grid grid-cols-1 gap-x-[8vw] gap-y-12 md:mb-18 md:gap-y-16 lg:mb-20 lg:grid-cols-[1fr_0.5fr] lg:gap-y-20">
                <div class="rb-6 max-w-md">
                    <h2 class="mb-5 text-4xl font-bold font-heading md:mb-6 md:text-5xl lg:text-6xl text-dark-purple">
                        <?php echo esc_html($footer_heading); ?>
                    </h2>
                    <p class="text-purple/80 font-body">
                        <?php echo esc_html($footer_description); ?>
                    </p>
                    <?php if ($cta_buttons) : ?>
                        <div class="mt-6 flex flex-wrap gap-4 md:mt-8">
                            <?php foreach ($cta_buttons as $button) : 
                                $is_primary = $button['button_style'] === 'primary';
                                $button_classes = $is_primary 
                                    ? 'text-white bg-pink hover:bg-pink/90' 
                                    : 'text-purple bg-white border border-purple/20 hover:bg-purple/5';
                                $icon = $is_primary ? 'chevron-right' : 'mail';
                            ?>
                                <a href="<?php echo esc_url($button['button_url']); ?>" 
                                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-sm font-medium font-body rounded-md shadow-sm transition-colors duration-200 <?php echo esc_attr($button_classes); ?>">
                                    <?php echo esc_html($button['button_text']); ?>
                                    <i data-lucide="<?php echo esc_attr($icon); ?>" class="size-4"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="grid grid-cols-1 items-start gap-x-6 gap-y-5 sm:grid-cols-2 sm:gap-x-8 md:gap-y-4">
                    <div>
                        <h3 class="mb-4 text-lg font-bold font-heading text-dark-purple">Legal</h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-legal',
                            'container' => false,
                            'menu_class' => 'footer-menu',
                            'fallback_cb' => false,
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>'
                        ));
                        ?>
                    </div>
                    <div>
                        <h3 class="mb-4 text-lg font-bold font-heading text-dark-purple">Company</h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer-company',
                            'container' => false,
                            'menu_class' => 'footer-menu',
                            'fallback_cb' => false,
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>'
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="rb-6 col-span-1 flex flex-col items-start justify-between pb-6 sm:flex-row sm:items-center md:pb-8 lg:col-span-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/emp-logo.svg" 
                         alt="<?php echo esc_attr(get_bloginfo('name')); ?>" 
                         class="mb-6 inline-block h-10 w-auto sm:mb-0" />
                </a>
                <div class="ml-3 flex">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <div class="relative -ml-3 size-12 min-h-12 min-w-12 rounded-full border-2 border-white bg-purple/5 flex items-center justify-center">
                            <i data-lucide="users-round" class="size-6 text-purple/60"></i>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="flex flex-col-reverse items-start justify-between pb-4 pt-6 text-sm md:flex-row md:items-center md:pb-0 md:pt-8">
            <p class="text-purple/80 font-body">&copy;<?php echo esc_html($copyright); ?></p>
            <?php if ($social_links) : ?>
                <div class="grid grid-flow-col grid-cols-[max-content] items-start justify-start gap-x-3">
                    <?php foreach ($social_links as $social) : ?>
                        <a href="<?php echo esc_url($social['url']); ?>" 
                           class="text-purple hover:text-dark-purple transition-colors duration-200"
                           aria-label="<?php echo esc_attr($social['platform']); ?>"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i data-lucide="<?php echo esc_attr($social['platform']); ?>" class="size-6"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<style>
/* Footer Menu Styles */
.footer-menu {
    @apply space-y-1;
}

.footer-menu li {
    @apply py-2 text-sm font-semibold font-body;
}

.footer-menu a {
    @apply text-purple hover:text-dark-purple transition-colors duration-200;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.lucide) {
        window.lucide.createIcons();
    }
});
</script>
