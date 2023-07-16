<?php
get_header(); // Include the header template

// Set up the custom query


if (have_posts()) :
    ?>
    <section class="archive-section">
        <div class="container">
            <header class="archive-header">
                <h1 class="archive-title"><?php the_archive_title(); ?></h1>
            </header>
            <div class="archive-content">
                <?php
                while (have_posts()) :
                    the_post();
                    // Display the post content or excerpt
                    the_title('<h2>', '</h2>');
                    the_content();
                endwhile;
                ?>
            </div>
            <div class="archive-pagination">
                <?php
the_posts_pagination();
                ?>
            </div>
        </div>
    </section>
    <?php
else :
    ?>
    <p>No posts found.</p>
    <?php
endif;

// Restore the global post data
wp_reset_postdata();

get_footer(); // Include the footer template
?>
