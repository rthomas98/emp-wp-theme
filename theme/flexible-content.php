<?php
/**
 * Template Name: Flexible Content Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _emp
 */

get_header();
?>

<section id="primary">
    <main id="main">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content/content', 'flexible-content');
        endwhile;
        ?>
    </main>
</section>

<?php
get_footer(); 