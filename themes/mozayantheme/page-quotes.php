<?php
/**
 * The template for displaying quotes page
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
// Call the get_kanye_quotes() function
$quotes = kanye_quotes();

// Check if the quotes are available
if ($quotes) {
    echo '<ul>';
    foreach ($quotes as $quote) {
        echo '<li>' . $quote . '</li>';
    }
    echo '</ul>';
} else {
    // Display an error message if the quotes couldn't be retrieved
    echo 'Sorry, unable to fetch Kanye West quotes.';
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
