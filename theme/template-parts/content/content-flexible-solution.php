<?php

if ( get_field( 'blocks' ) ) :

    while ( has_sub_field( 'blocks', get_the_ID() ) ) :

        if ( get_row_layout() == 'header_107' ):
            include( get_stylesheet_directory() . '/acf-blocks/header-107.php' );
        endif;

        if ( get_row_layout() == 'header_37' ):
            include( get_stylesheet_directory() . '/acf-blocks/header-37.php' );
        endif;

        if ( get_row_layout() == 'header_116' ):
            include( get_stylesheet_directory() . '/acf-blocks/header-116.php' );
        endif;

        if ( get_row_layout() == 'header_118' ):
            include( get_stylesheet_directory() . '/acf-blocks/header-118.php' );
        endif;

        if ( get_row_layout() == 'layout_373' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-373.php' );
        endif;

        if ( get_row_layout() == 'layout_403' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-403.php' );
        endif;

        if ( get_row_layout() == 'layout_4' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-4.php' );
        endif;

        if ( get_row_layout() == 'layout_245' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-245.php' );
        endif;

        if ( get_row_layout() == 'cta_39' ):
            include( get_stylesheet_directory() . '/acf-blocks/cta-39.php' );
        endif;

        if ( get_row_layout() == 'layout_194' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-194.php' );
        endif;

        if ( get_row_layout() == 'layout_239' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-239.php' );
        endif;

        if ( get_row_layout() == 'layout_242' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-242.php' );
        endif;

        if ( get_row_layout() == 'layout_247' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-247.php' );
        endif;

        if ( get_row_layout() == 'layout_366' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-366.php' );
        endif;

        if ( get_row_layout() == 'layout_16' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-16.php' );
        endif;

        if ( get_row_layout() == 'layout_195' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-195.php' );
        endif;
    
        if ( get_row_layout() == 'layout_22' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-22.php' );
        endif;

        if ( get_row_layout() == 'layout_374' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-374.php' );
        endif;

        if ( get_row_layout() == 'layout_116' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-116.php' );
        endif;

        if ( get_row_layout() == 'layout_12' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-12.php' );
        endif;

        if ( get_row_layout() == 'layout_142' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-142.php' );
        endif;

        if ( get_row_layout() == 'layout_247' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-247.php' );
        endif;

        if ( get_row_layout() == 'layout_25' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-25.php' );
        endif;

        if ( get_row_layout() == 'layout_384' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-384.php' );
        endif;

        if ( get_row_layout() == 'layout_393' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-393.php' );
        endif;  

        if ( get_row_layout() == 'layout_457' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-457.php' );
        endif;
        
        if ( get_row_layout() == 'layout_49' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-49.php' );
        endif;

        if ( get_row_layout() == 'layout_131' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-131.php' );
        endif;

        if ( get_row_layout() == 'layout_494' ):
            include( get_stylesheet_directory() . '/acf-blocks/layout-494.php' );
        endif;

        if ( get_row_layout() == 'testimonial_20' ):
            include( get_stylesheet_directory() . '/acf-blocks/testimonial-20.php' );
        endif;

        if ( get_row_layout() == 'cta_3' ):
            include( get_stylesheet_directory() . '/acf-blocks/cta-3.php' );
        endif;

        if ( get_row_layout() == 'cta_1' ):
            include( get_stylesheet_directory() . '/acf-blocks/cta-1.php' );
        endif;

        if ( get_row_layout() == 'cta_31' ):
            include( get_stylesheet_directory() . '/acf-blocks/cta-31.php' );
        endif;

        if ( get_row_layout() == 'blog_41' ):
            include( get_stylesheet_directory() . '/acf-blocks/blog-41.php' );
        endif;

    endwhile;
endif;
?>