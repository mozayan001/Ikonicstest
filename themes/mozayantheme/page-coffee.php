<?php
/**
 * The template for displaying coffee page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mozayan_Moeed
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container-fluid">
			<div class="container">
			<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );
            $coffee_link = hs_give_me_coffee();
            // Check if the coffee link is available
if ($coffee_link) {
    // Display the coffee link
    echo '<a href="' . $coffee_link . '">Get a cup of coffee!</a>';
} else {
    // Display an error message if the coffee link couldn't be retrieved
    echo 'Sorry, unable to fetch a coffee link.';
}






			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

			</div>
		</div>



	</main><!-- #main -->

<?php

get_footer();
