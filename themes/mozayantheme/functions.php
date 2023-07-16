<?php


function mozayan_moeed_setup() {
    add_theme_support( 'post-thumbnails' );

    	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);


    	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 1000,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'mozayan_moeed_setup' );

    




function enqueFiles() {
    if (!is_admin()) {
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    }

    wp_enqueue_style('main-style', get_template_directory_uri().'/style.css', array(), '1.1');
    wp_enqueue_script('popper-js', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js', array('jquery'), '1.14.7', true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js', array('jquery', 'popper-js'), '4.5.2', true);
}
add_action('wp_enqueue_scripts', 'enqueFiles');

// function enqueue_custom_scripts() {
//   wp_enqueue_script('custom-script', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0', true);
// }
// add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');





// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');






// redirect the user away from the site if their IP address starts with "77.29"

function redirect_user_by_ip() {
  // Get the user's IP address
  $user_ip = $_SERVER['REMOTE_ADDR'];
//$user_ip = '77.29.123.456'; // Replace with an IP starting with "77.29"


// var_dump($user_ip);

  // Check if the IP address starts with "77.29"
  if (strpos($user_ip, '77.29') === 0) {
      // Redirect the user to a different website or URL
      wp_redirect('https://google.com');
      exit;
  }
}
add_action('wp', 'redirect_user_by_ip');


// registering Post Type Projects

function custom_post_type() {
  $labels = array(
      'name'               => 'Projects',
      'singular_name'      => 'Project',
      'add_new'            => 'Add New',
      'add_new_item'       => 'Add New Project',
      'edit_item'          => 'Edit Project',
      'new_item'           => 'New Project',
      'view_item'          => 'View Project',
      'search_items'       => 'Search Projectss',
      'not_found'          => 'No Projects found',
      'not_found_in_trash' => 'No Projects found in Trash',
      'parent_item_colon'  => 'Parent Projects:',
      'menu_name'          => 'Projects'
  );

  $args = array(
      'labels'              => $labels,
      'public'              => true,
      'publicly_queryable'  => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'query_var'           => true,
      'rewrite'             => array( 'slug' => 'Projects' ),
      'capability_type'     => 'post',
      'has_archive'         => true,
      'hierarchical'        => false,
      'menu_position'       => 5,
      'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'Project', $args );
}
add_action( 'init', 'custom_post_type' );


// registering Project Type taxonomy for Projects

function custom_taxonomy_project_type() {
  $labels = array(
      'name'                       => 'Project Types',
      'singular_name'              => 'Project Type',
      'search_items'               => 'Search Project Types',
      'popular_items'              => 'Popular Project Types',
      'all_items'                  => 'All Project Types',
      'parent_item'                => null,
      'parent_item_colon'          => null,
      'edit_item'                  => 'Edit Project Type',
      'update_item'                => 'Update Project Type',
      'add_new_item'               => 'Add New Project Type',
      'new_item_name'              => 'New Project Type',
      'separate_items_with_commas' => 'Separate project types with commas',
      'add_or_remove_items'        => 'Add or remove project types',
      'choose_from_most_used'      => 'Choose from the most used project types',
      'not_found'                  => 'No project types found',
      'menu_name'                  => 'Project Types',
  );

  $args = array(
      'hierarchical'      => false,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'project-type'  ),
  );

  register_taxonomy( 'project-type', 'project', $args );
}
add_action( 'init', 'custom_taxonomy_project_type' );


function custom_project_posts_per_page($query) {
 
  if (is_post_type_archive('project') && $query->is_main_query()) {
      $query->set('posts_per_page', 6);
  }
}
add_action('pre_get_posts', 'custom_project_posts_per_page');




function enqueue_custom_scripts() {
  wp_enqueue_script('custom-script', get_template_directory_uri() . '/custom.js', array('jquery'), '1.0', true);

  // Localize the AJAX URL
  wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');




/**
 * Register the AJAX endpoint.
 */
function register_ajax_endpoint() {
  add_action('wp_ajax_my_ajax_endpoint', 'my_ajax_callback');
  add_action('wp_ajax_nopriv_my_ajax_endpoint', 'my_ajax_callback');
}
add_action('init', 'register_ajax_endpoint');


/**
 * AJAX callback function.
 */
function my_ajax_callback() {
  // Check if the user is logged in.
  $user_logged_in = is_user_logged_in();

  // Query arguments.
  $query_args = array(
    'post_type'      => 'project',
    'posts_per_page' => $user_logged_in ? 6 : 3,
    // 'posts_per_page' => '3',
     // Determine the number of posts based on the user's login status.
    'tax_query'      => array(
      array(
        'taxonomy' => 'project-type',
        'field'    => 'slug',
        'terms'    => 'architecture',
      ),
    ),
  );

// Log the query arguments
error_log('Query Arguments: ' . print_r($query_args, true));

  // Query the projects.
  $projects_query = new WP_Query($query_args);

 // Log the SQL query generated by the WP_Query
 error_log('SQL Query: ' . $projects_query->request);


  // Prepare the data array.
  $data = array();

  if ($projects_query->have_posts()) {
    while ($projects_query->have_posts()) {
      $projects_query->the_post();

      // Get project ID, title, and link.
      $project_id    = get_the_ID();
      $project_title = get_the_title();
      $project_link  = get_permalink();

      // Prepare object.
      $object = array(
        'id'    => $project_id,
        'title' => $project_title,
        'link'  => $project_link,
      );

      // Add object to data array.
      $data[] = $object;
    }

    wp_reset_postdata();
  }

  // Prepare the response.
  $response = array(
    'success' => true,
    'data'    => $data,
  );


  

  // Send JSON response.
  wp_send_json($response);



     // Terminate further execution.
      die();
}





// random API coffee

function hs_give_me_coffee() {
  // Make a request to the Random Coffee API
  $response = wp_remote_get('https://coffee.alexflipnote.dev/random.json');

  // Check if the request was successful
  if (is_wp_error($response)) {
      return false;
  }

  // Get the response body
  $body = wp_remote_retrieve_body($response);

  // Decode the JSON response
  $data = json_decode($body);

  // Check if the JSON decoding was successful
  if (!$data) {
      return false;
  }

  // Extract the direct link to the coffee
  $coffee_link = $data->file;

  // Return the direct link to the coffee
  return $coffee_link;
}



// Use this API https://api.kanye.rest/ and show 5 quotes on a page.


function kanye_quotes() {
  $quotes = array();

  for ($i = 0; $i < 5; $i++) {
      // Make a request to the Kanye West Quotes API
      $response = wp_remote_get('https://api.kanye.rest/');

      // Check if the request was successful
      if (is_wp_error($response)) {
          return false;
      }

      // Get the response body
      $body = wp_remote_retrieve_body($response);

      // Decode the JSON response
      $data = json_decode($body, true);

      // Check if the JSON decoding was successful
      if (!$data || !isset($data['quote'])) {
          return false;
      }

      // Extract the quote
      $quote = $data['quote'];

      // Add the quote to the array
      $quotes[] = $quote;
  }

  // Return the quotes
  return $quotes;
}
