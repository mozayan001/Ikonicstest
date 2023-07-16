<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mozayan_Moeed
 */

?>

	<footer class="footer p-4 bg-body-tertiary">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4>About Us</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec purus feugiat, molestie ipsum et, congue odio.</p>
            </div>
            <div class="col-lg-3">
                <h4>Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h4>Contact Us</h4>
                <p>123 Main Street, City, Country</p>
                <p>Email: info@example.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
        </div>
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'mozayan-moeed' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'mozayan-moeed' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'mozayan-moeed' ), 'mozayan-moeed', '<a href="#">Mozayan Moeed</a>' );
				?>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
