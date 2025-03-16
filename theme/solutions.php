<?php
/**
 * Template Name: Solutions Page Template
 * Template Post Type: solution
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _emp
 */

get_header();
?>

	<section id="primary">
		<main id="main">

			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part('template-parts/content/content', 'flexible-solution');
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
