<?php
get_header(); // Include the header template

// Set up the custom query
 //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
$query_args = array(
    'post_type'=>'project',
    'posts_per_page' => 6,
    'order' => 'ASC',
    'paged' => $paged
);
$query = new WP_Query($query_args);

if ($query->have_posts()) :
    ?>
<section class="archive-section">
    <div class="container">
        <header class="archive-header">
            <h1 class="archive-title"><?php the_archive_title(); ?></h1>
        </header>
        <div class="archive-content">
            <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    // Display the post content or excerpt
                    the_title('<h2>', '</h2>');
                    the_content();
                endwhile;
                ?>
        </div>
        <div class="archive-pagination">
            <?php
                $big = 999999999; // need an unlikely integer

        echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' =>  $query->max_num_pages
) );
                ?>
        </div>
    </div>
</section>
<?php
// else :
    ?>
<p class="myclass">No posts ffound.</p>
<?php
endif;

// Restore the global post data
wp_reset_postdata();

get_footer(); // Include the footer template
?>