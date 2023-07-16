<?php
get_header(); // Include the header template
?>
<div class="container">
    <?php
$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$args = array(
    'post_type' => 'project',
    'posts_per_page' => 6,
    'order' => 'ASC',
    'paged' => $paged
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) :
        $query->the_post();
        the_title('<h2>', '</h2>');
        the_content();

    endwhile;

    // Pagination
    $total_pages = $query->max_num_pages;

    echo paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => '/page/%#%',
        'current' => $paged,
        'total' => $total_pages,
        'prev_text' => '&laquo; ' . __('Previous'),
        'next_text' => __('Next') . ' &raquo;'
    ));

    wp_reset_postdata(); // Restore original post data
else :
    ?>
    <p>No posts found.</p>
    <?php
endif;
?>
</div><?php
get_footer(); // Include the footer template
?>
