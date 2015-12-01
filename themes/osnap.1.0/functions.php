<?php

//global $wp_rewrite; $wp_rewrite->flush_rules();

//Initiate the localization of the theme domain
load_theme_textdomain( 'organicthemes', TEMPLATEPATH.'/languages' );

//Turn a category ID to a Name
function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}

// 404 Pagination Fix For Home Page
function my_post_queries( $query ) {
  // not an admin page and it is the main query
  if (!is_admin() && $query->is_main_query()){
    if(is_home() ){
      $query->set('posts_per_page', 1);
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );

// Register Scripts 
if( !function_exists('ot_enqueue_scripts') ) {
function ot_enqueue_scripts() {
	wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', true);
	wp_register_script('hover', get_template_directory_uri() . '/js/hoverIntent.js', 'jquery', '1.0', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', 'jquery', '1.6.2', true);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', 'jquery', '', true);

	//Enqueue Scripts
	wp_enqueue_script('superfish');
	wp_enqueue_script('hover');
	wp_enqueue_script('flexslider');
	wp_enqueue_script('fitvids');

	// load single scripts only on single pages
    if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 

	}

	add_action('wp_enqueue_scripts', 'ot_enqueue_scripts');
}

// Theme Options Framework
if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = 'false') {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( !empty($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}	
}

if ( !function_exists( 'optionsframework_add_page' ) && current_user_can('edit_theme_options') ) {
	function options_default() {
		add_theme_page(__("Theme Options", 'organicthemes'), __("Theme Options", 'organicthemes'), 'edit_theme_options', 'options-framework','optionsframework_page_notice');
	}
	add_action('admin_menu', 'options_default');
}

/**
 * Displays a notice on the theme options page if the Options Framework plugin is not installed
 */

if ( !function_exists( 'optionsframework_page_notice' ) ) {
	add_thickbox(); // Required for the plugin install dialog.

	function optionsframework_page_notice() { ?>
	
		<div class="wrap">
		<?php screen_icon( 'themes' ); ?>
		<h2><?php _e("Theme Options", 'organicthemes'); ?></h2>
        <p><b><?php _e("This theme requires the Options Framework plugin installed and activated to manage your theme options.", 'organicthemes'); ?> <a href="<?php echo admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=517'); ?>" class="thickbox onclick"><?php _e("Install Now", 'organicthemes'); ?></a></b></p>
		</div>
		<?php
	}
}

/************************************************
*	WooCommerce Functions		       	     	* 
************************************************/

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
    add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div id="content" class="row">
		<div class="eight columns">
				<div class="article">
    <?php
}

function mytheme_close_woocommerce_content_wrappers() {
	?>
    		</div> <!-- /article -->
    	</div> <!-- /columns -->
 
        <div class="four columns">
        	<?php get_sidebar( 'Right Sidebar' ); ?>
        </div>
        
 	</div> <!-- /row -->
    <?php
}

// Add the WC sidebar in the right place
add_action( 'woo_main_after', 'woocommerce_get_sidebar', 10 );

// WooCommerce thumbnail image sizes
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action('init', 'woo_install_theme', 1);
function woo_install_theme() {
 
update_option( 'woocommerce_thumbnail_image_width', '192' );
update_option( 'woocommerce_thumbnail_image_height', '192' );
update_option( 'woocommerce_single_image_width', '640' );
update_option( 'woocommerce_single_image_height', '640' );
update_option( 'woocommerce_catalog_image_width', '140' );
update_option( 'woocommerce_catalog_image_height', '140' );
}

// WooCommerce default product columns
function loop_columns() {
    return 4;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/************************************************/

//	Register sidebars
if ( function_exists('register_sidebars') )
	//register_sidebar(array('name'=>'Home Sidebar','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Right Sidebar','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Left Sidebar','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Footer Left','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Footer Mid Left','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Footer Middle','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Footer Mid Right','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	//register_sidebar(array('name'=>'Footer Right','before_widget'=>'<div id="%1$s" class="widget %2$s">','after_widget'=>'</div>','before_title'=>'<h4>','after_title'=>'</h4>'));
	register_sidebar(array('name' => 'Quickstart Left','before_widget' => '<div id="quickstart-left">','after_widget' => '</div>','before_title' => '','after_title' => '',));
	register_sidebar(array('name' => 'Tools Left','before_widget' => '<div id="tools-left">','after_widget' => '</div>','before_title' => '','after_title' => '',));
	register_sidebar(array('name' => 'Resources Left','before_widget' => '<div id="resources-left">','after_widget' => '</div>','before_title' => '','after_title' => '',));
	register_sidebar(array('name' => 'About Left','before_widget' => '<div id="about-left">','after_widget' => '</div>','before_title' => '','after_title' => '',));
		
//	Comments function
if ( ! function_exists( 'organicthemes_comment' ) ) :
function organicthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organicthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organicthemes' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s', 'organicthemes' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organicthemes' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organicthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for organicthemes_comment()

// Page Numbering Pagination
function number_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 5, 'gap' => 5, 'anchor' => 1,
		'before' => '<div class="number-paginate">', 'after' => '</div>',
		'title' => '',
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;
		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}	

	$output = "";

	if ($pages > 1) {	
		$output .= "$before<span class='number-title'>$title</span>";
		$ellipsis = "<span class='number-gap'>...</span>";
		if ($page > 1 && !empty($previouspage)) {
			$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='number-prev'>$previouspage</a>";
		}

		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				number_paginate_loop(1, $anchor), 
				$ellipsis, 
				number_paginate_loop($block_min, $pages, $page)
			);
		}

		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				number_paginate_loop(1, $anchor), 
				$ellipsis, 
				number_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				number_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}

		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				number_paginate_loop(1, $block_high, $page),
				$ellipsis,
				number_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}

		else {
			$output .= number_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='number-next'>$nextpage</a>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;

}

function number_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<span class='number-page number-current'>$i</span>" 
			: "<a href='" . get_pagenum_link($i) . "' class='number-page'>$i</a>";
	}

	return $output;

}

// Add Custom Meta Box To Posts
$prefix = 'custom_meta_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Featured Video',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Paste Video Embed Code', 'organicthemes'),
            'desc' => __('Enter Vimeo, YouTube or other embed code to display a featured video.', 'organicthemes'),
            'id' => $prefix . 'video',
            'type' => 'textarea',
            'std' => ''
        ),
    )
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

// Ajax Load More Button
function pbd_alp_init() {

	$wp_query = new WP_Query(array('cat'=>of_get_option('category_home_one'),'posts_per_page'=>of_get_option('postnumber_home_one'), 'paged'=>$paged));

	// Add code to index pages.
	if( !is_singular() ) {	
		// Queue JS and CSS
		wp_enqueue_script('load-posts', get_template_directory_uri() . '/js/jquery.loadPosts.js', array('jquery'), '1.0', true);
		
		// What page are we on? And what is the pages limit?
		$max = $wp_query->max_num_pages;
		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		//global $more; $more = 0;
		
		// Add some parameters for the JS.
		wp_localize_script(
			'load-posts',
			'pbd_alp',
			array(
				'startPage' => $paged,
				'maxPages' => $max,
				'nextLink' => next_posts($max, false)
			)
		);
	}
}
add_action('template_redirect', 'pbd_alp_init');

// Custom excerpt length
function custom_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/************************************************
*	Press Trends				       	     	* 
************************************************/

// Start of Presstrends Magic
if(of_get_option('enable_presstrends') == '1') {

function presstrends() {

// PressTrends Account API Key
$api_key = 'o5byp75idn9s80nvvahx361kb4m55t5wz9yj';

// Start of Metrics
global $wpdb;
$data = get_transient( 'presstrends_data' );
if (!$data || $data == ''){
$api_base = 'http://api.presstrends.io/index.php/api/sites/update/api/';
$url = $api_base . $api_key . '/';
$data = array();
$count_posts = wp_count_posts();
$count_pages = wp_count_posts('page');
$comments_count = wp_count_comments();
$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
$plugin_count = count(get_option('active_plugins'));
$all_plugins = get_plugins();
foreach($all_plugins as $plugin_file => $plugin_data) {
$plugin_name .= $plugin_data['Name'];
$plugin_name .= '&';}
$posts_with_comments = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}posts WHERE post_type='post' AND comment_count > 0");
$comments_to_posts = number_format(($posts_with_comments / $count_posts->publish) * 100, 0, '.', '');
$pingback_result = $wpdb->get_var('SELECT COUNT(comment_ID) FROM '.$wpdb->comments.' WHERE comment_type = "pingback"');
$data['url'] = stripslashes(str_replace(array('http://', '/', ':' ), '', site_url()));
$data['posts'] = $count_posts->publish;
$data['pages'] = $count_pages->publish;
$data['comments'] = $comments_count->total_comments;
$data['approved'] = $comments_count->approved;
$data['spam'] = $comments_count->spam;
$data['pingbacks'] = $pingback_result;
$data['post_conversion'] = $comments_to_posts;
$data['theme_version'] = $theme_data['Version'];
$data['theme_name'] = $theme_data['Name'];
$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ));
$data['plugins'] = $plugin_count;
$data['plugin'] = urlencode($plugin_name);
$data['wpversion'] = get_bloginfo('version');
foreach ( $data as $k => $v ) {
$url .= $k . '/' . $v . '/';}
$response = wp_remote_get( $url );
set_transient('presstrends_data', $data, 60*60*24);}
}

// PressTrends WordPress Action
add_action('admin_init', 'presstrends');

} else {
}

/************************************************/

// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass($ulclass) {
return preg_replace('/<ul>/', '<ul class="menu">', $ulclass, 1);
}
add_filter('wp_page_menu','add_menuclass');
add_filter('wp_nav_menu','add_menuclass');

// Include the Custom Header code
if ( function_exists('add_theme_support') )
$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/logo.png',
	'random-default'         => false,
	'width'                  => 980,
	'height'                 => 160,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '333333',
	'header-text'            => true,
	'uploads'                => true,
);
add_theme_support( 'custom-header', $defaults );

// Add custom background
if ( function_exists('add_theme_support') )
$defaults = array(
	'default-color'          => 'F9F9F9',
	'default-image'          => get_template_directory_uri() . '/images/background.png',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

// Add navigation support
if( !function_exists( 'ot_register_menu' ) ) {
    function ot_register_menu() {
	    register_nav_menu('header-menu', __('Header Menu'));
    }
    add_action('init', 'ot_register_menu');
}

// Display home page link in custom menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

// Add default posts and comments RSS feed links to head
if ( function_exists('add_theme_support') )
add_theme_support( 'automatic-feed-links' );

// Add thumbnail support
if ( function_exists('add_theme_support') )
add_theme_support('post-thumbnails');
add_image_size( 'slide', 640, 360, true ); // Slideshow Featured Image
add_image_size( 'post', 640, 420, true ); // Post Featured Image
add_image_size( 'page', 980, 520, true ); // Featured Page Banner



/////////////  ADDED by SLAVEN 4/8/13  /////////////////
/////////////  to limit number of checkboxes  //////////
/////////////  see http://gravitywiz.com/limiting-how-many-checkboxes-can-be-checked/ ///

/**
* Limit How Many Checkboxes Can Be Checked
* http://gravitywiz.com/2012/06/11/limiting-how-many-checkboxes-can-be-checked/
*/
 

class GFLimitCheckboxes {

    private $form_id;
    private $field_limits;
    private $output_script;

    function __construct($form_id, $field_limits) {

        $this->form_id = $form_id;
        $this->field_limits = $this->set_field_limits($field_limits);

        add_filter("gform_pre_render_$form_id", array(&$this, 'pre_render'));
        add_filter("gform_validation_$form_id", array(&$this, 'validate'));

    }

    function pre_render($form) {

        $script = '';
        $output_script = false;

        foreach($form['fields'] as $field) {

            $field_id = $field['id'];
            $field_limits = $this->get_field_limits($field['id']);

            if( !$field_limits                                          // if field limits not provided for this field
                || RGFormsModel::get_input_type($field) != 'checkbox'   // or if this field is not a checkbox
                || !isset($field_limits['max'])        // or if 'max' is not set for this field
                )
                continue;

            $output_script = true;
            $max = $field_limits['max'];
            $selectors = array();

            foreach($field_limits['field'] as $checkbox_field) {
                $selectors[] = "#field_{$form['id']}_{$checkbox_field} .gfield_checkbox input:checkbox";
            }

            $script .= "jQuery(\"" . implode(', ', $selectors) . "\").checkboxLimit({$max});";

        }

        GFFormDisplay::add_init_script($form['id'], 'limit_checkboxes', GFFormDisplay::ON_PAGE_RENDER, $script);

        if($output_script):
            ?>

            <script type="text/javascript">
            jQuery(document).ready(function($) {
                $.fn.checkboxLimit = function(n) {

                    var checkboxes = this;

                    this.toggleDisable = function() {

                        // if we have reached or exceeded the limit, disable all other checkboxes
                        if(this.filter(':checked').length >= n) {
                            var unchecked = this.not(':checked');
                            unchecked.prop('disabled', true);
                        }
                        // if we are below the limit, make sure all checkboxes are available
                        else {
                            this.prop('disabled', false);
                        }

                    }

                    // when form is rendered, toggle disable
                    checkboxes.bind('gform_post_render', checkboxes.toggleDisable());

                    // when checkbox is clicked, toggle disable
                    checkboxes.click(function(event) {

                        checkboxes.toggleDisable();

                        // if we are equal to or below the limit, the field should be checked
                        return checkboxes.filter(':checked').length <= n;
                    });

                }
            });
            </script>

            <?php
        endif;

        return $form;
    }

    function validate($validation_result) {

        $form = $validation_result['form'];
        $checkbox_counts = array();

        // loop through and get counts on all checkbox fields (just to keep things simple)
        foreach($form['fields'] as $field) {

            if( RGFormsModel::get_input_type($field) != 'checkbox' )
                continue;

            $field_id = $field['id'];
            $count = 0;

            foreach($_POST as $key => $value) {
                if(strpos($key, "input_{$field['id']}_") !== false)
                    $count++;
            }

            $checkbox_counts[$field_id] = $count;

        }

        // loop through again and actually validate
        foreach($form['fields'] as &$field) {

            if(!$this->should_field_be_validated($form, $field))
                continue;

            $field_id = $field['id'];
            $field_limits = $this->get_field_limits($field_id);

            $min = isset($field_limits['min']) ? $field_limits['min'] : false;
            $max = isset($field_limits['max']) ? $field_limits['max'] : false;

            $count = 0;
            foreach($field_limits['field'] as $checkbox_field) {
                $count += rgar($checkbox_counts, $checkbox_field);
            }

            if($count < $min) {
                $field['failed_validation'] = true;
                $field['validation_message'] = sprintf( _n('You must select at least %s item.', 'You must select at least %s items.', $min), $min );
                $validation_result['is_valid'] = false;
            }
            else if($count > $max) {
                $field['failed_validation'] = true;
                $field['validation_message'] = sprintf( _n('You may only select %s item.', 'You may only select %s items.', $max), $max );
                $validation_result['is_valid'] = false;
            }

        }

        $validation_result['form'] = $form;

        return $validation_result;
    }

    function should_field_be_validated($form, $field) {

        if( $field['pageNumber'] != GFFormDisplay::get_source_page( $form['id'] ) )
    		return false;

        // if no limits provided for this field
        if( !$this->get_field_limits($field['id']) )
            return false;

        // or if this field is not a checkbox
        if( RGFormsModel::get_input_type($field) != 'checkbox' )
            return false;

        // or if this field is hidden
        if( RGFormsModel::is_field_hidden($form, $field, array()) )
            return false;

        return true;
    }

    function get_field_limits($field_id) {

        foreach($this->field_limits as $key => $options) {
            if(in_array($field_id, $options['field']))
                return $options;
        }

        return false;
    }

    function set_field_limits($field_limits) {

        foreach($field_limits as $key => &$options) {

            if(isset($options['field'])) {
                $ids = is_array($options['field']) ? $options['field'] : array($options['field']);
            } else {
                $ids = array($key);
            }

            $options['field'] = $ids;

        }

        return $field_limits;
    }

}

new GFLimitCheckboxes(7, array(
    2 => array(
        'max' => 5
        )
    ));


	








///////////// CUSTOM EDITS BY SLAVEN //////////////////////////

//// custom profile fields
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<div class="userformbottom">
		<div>
			<label for="getemails" class="twolinelabel"><?php _e('Send emails from HPRC regarding opportunities and resources?', 'profile'); ?></label>
			<select name="getemails" id="getemails">
				<? $getemails = get_the_author_meta('getemails',$user->ID ) ?>
				<option value="no" <? if($getemails == 'no') echo " selected"; ?> >No</option>
				<option value="yes" <? if($getemails == 'yes') echo " selected"; ?> >Yes</option>
			</select>	
		</div>
		<div>
			<label for="zip"><?php _e('Zip Code', 'profile'); ?></label>
			<input type="text" name="zip" id="zip" value="<?php echo esc_attr( get_the_author_meta( 'zip', $user->ID ) ); ?>" class="regular-text" />
		</div>
		<div>
			<label for="title"><?php _e('Role / Title', 'profile'); ?></label>
			<select name="title" id="title" class="320wide">
				<? $title = get_the_author_meta('title',$user->ID ) ?>
				<option value="aspsdc" <? if($title == 'aspsdc') echo " selected"; ?> >Afterschool program site director/coordinator</option>
				<option value="aspgcs" <? if($title == 'aspgcs') echo " selected"; ?> >Afterschool program group/classroom staff</option>
				<option value="msphde" <? if($title == 'msphde') echo " selected"; ?> >Municipal or state public health department employee</option>
				<option value="mssdde" <? if($title == 'mssdde') echo " selected"; ?> >Municipal or state school district or department employee</option>
				<option value="cmapsa" <? if($title == 'cmapsa') echo " selected"; ?> >Coordinator of multiple afterschool programs for sponsoring agency </option>
				<option value="other" <? if($title == 'other') echo " selected"; ?> >Other (fill in text below)</option>
			</select>	
		</div>
		<div class="othertitle">
			<label for="othertitle"><?php _e('if other', 'profile'); ?></label>
			<input type="text" name="othertitle" id="othertitle" value="<?php echo esc_attr( get_the_author_meta( 'othertitle', $user->ID ) ); ?>" class="regular-text" />
		</div>
	</div>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_user_meta( $user_id, 'zip', $_POST['zip'] );
	update_user_meta( $user_id, 'title', $_POST['title'] );
	update_user_meta( $user_id, 'othertitle', $_POST['othertitle'] );
	update_user_meta( $user_id, 'getemails', $_POST['getemails'] );
}



//// gravity forms submission filter for Background Info form
add_filter("gform_pre_submission_filter_6", "pre_submission_filter_6");
function pre_submission_filter_6($form) {
	$timestamp = date('F j, Y',current_time('timestamp',0));
	$_POST['input_10'] = $timestamp;	
	return $form;
}




//// gravity forms submission filter for Daily Practice Self Assessment
add_filter("gform_pre_submission_filter_4", "pre_submission_filter_4");
function pre_submission_filter_4($form) {

	//// calculate if goals were met, i.e. all physical activity 
	// S1: Include 30 minutes of moderate physical activity for every child every day 
   $goal_1_met = 'no';
	if ($_POST['input_44'] >= 30) {
		$goal_1_met = 'yes';
	}
	// S2: Offer 20 minutes of vigorous physical activity 3 times per week.
	$goal_2_met = 'no';
	if ($_POST['input_48'] >= 20) {
		$goal_2_met = 'yes';
	}
	// S3: Limit computer and digital device time to homework or instructional only.
	$goal_3_met = 'no';
	if (($_POST['input_12'] == 'No')&&($_POST['input_14'] == 'No')) {
		$goal_3_met = 'yes';
	}
	// S4: Eliminate use of commercial broadcast TV/movies.
	$goal_4_met = 'no';
	if ($_POST['input_15'] == 'No') {
		$goal_4_met = 'yes';
	}
	// S5: Offer a fruit or vegetable option every day at snack.
	$goal_5_met = 'no';
	if ($_POST['input_18'] == 'Yes') {
		$goal_5_met = 'yes';
	}
	// S6: When serving grains, serve whole grains.
	$goal_6_met = 'no';
	if ($_POST['input_19'] == 'No') {
		$goal_6_met = 'n-a';
	} 
	if (($_POST['input_19'] == 'Yes')&&($_POST['input_20'] == 'Yes')) {
		$goal_6_met = 'yes';
	}
	// S7: Do not serve sugar-sweetened drinks.
	$goal_7_met = 'no';
	if ($_POST['input_21'] == 'No') {
		$goal_7_met = 'yes';
	}
	// S8: Offer water as a beverage at snack every day.
	$goal_8_met = 'no';
	if ($_POST['input_24'] == 'Yes') {
		$goal_8_met = 'yes';
	}
	// S9: Do not allow sugar-sweetened drinks to be brought in during program time
	$goal_9_met = 'no';
	if ($_POST['input_26'] == 'none') {
		$goal_9_met = 'yes';
	}

	// Set all goals met into db
	$_POST['input_32'] = $goal_1_met;	
	$_POST['input_33'] = $goal_2_met;
	$_POST['input_34'] = $goal_3_met;
	$_POST['input_35'] = $goal_4_met;
	$_POST['input_36'] = $goal_5_met;
	$_POST['input_37'] = $goal_6_met;
	$_POST['input_38'] = $goal_7_met;
	$_POST['input_39'] = $goal_8_met;
	$_POST['input_40'] = $goal_9_met;

	$timestamp = date('F j, Y',current_time('timestamp',0));
	$_POST['input_30'] = $timestamp;	
	return $form;
}



//=============================================
// Get a field's label by form id and field id
//=============================================
function get_field_label($form_id, $field_id) {
	//get form object
		$form = RGFormsModel::get_form_meta($form_id);
    // get field object
		$field = RGFormsModel::get_field($form, $field_id);
	// return field label
		return $field["label"];
}
//=============================================
// Get a field's label by form object and field id
//=============================================
function get_field_label_by_form($form, $field_id) {
    // get field object
		$field = RGFormsModel::get_field($form, $field_id);
	// return field label
		return $field["label"];
}



//=============================================
// Create a datetime object, return it formatted 
//=============================================
function fdate($datetimestring = '1970-01-01 00:00:00', $format = 'U') { 
	$dt = new DateTime($datetimestring); 
	return $dt->format($format); 
} 



//=============================================
// Gravity forms submission filter for Policy Self Assessment
//=============================================
add_filter("gform_pre_submission_filter_1", "calculate_compliance");
function calculate_compliance($form) {

	// get form object so we can get field labels
	$form = RGFormsModel::get_form_meta(1);
	
	//calculate if q1 goals were met/////////////////
    $q1met = 'no';
	$q1docs ='';
	
	//q1 parent newsletters or flyers...
	if (($_POST['input_10'] >= 30) && ($_POST['input_11'] >= $_POST['input_1'])) {
		$q1met = 'yes';
		//$q1docs = $q1docs.'<li>'.$form['fields'][4]['label'].'</li>';
		$q1docs = $q1docs.'<li>'.get_field_label_by_form($form, 3).'</li>';
		
	}
	//q1 handbook...
	if (($_POST['input_13'] >= 30) && ($_POST['input_12'] >= $_POST['input_1'])) {
		$q1met = 'yes';
		//$q1docs = $q1docs.'<li>'.$form['fields'][7]['label'].'</li>';
		$q1docs = $q1docs.'<li>'.get_field_label_by_form($form, 4).'</li>';
	}
	//q1 schedules...
	if (($_POST['input_14'] >= 30) && ($_POST['input_15'] >= $_POST['input_1'])) {
		$q1met = 'yes';
		//$q1docs = $q1docs.'<li>'.$form['fields'][10]['label'].'</li>';
		$q1docs = $q1docs.'<li>'.get_field_label_by_form($form, 5).'</li>';
	}
	//q1 training materials...
	if (($_POST['input_16'] >= 30) && ($_POST['input_18'] >= $_POST['input_1'])) {
		$q1met = 'yes';
		//$q1docs = $q1docs.'<li>'.$form['fields'][13]['label'].'</li>';
		$q1docs = $q1docs.'<li>'.get_field_label_by_form($form, 6).'</li>';
	}
	//q1 other...
	if (($_POST['input_19'] >= 30) && ($_POST['input_17'] >= $_POST['input_1'])) {
		$q1met = 'yes';
		$q1docs = $q1docs.'<li>Other: '.$_POST['input_8'].'</li>';
	}

	$_POST['input_22'] = $q1met;
	$_POST['input_23'] = $q1docs;
	
	
	//calculate if q2 goals were met////////////////////
    $q2met = 'no';
	$q2docs ='';
	
	//q2 parent newsletters or flyers...
	if ($_POST['input_29'] == 'Yes') {
		$q2met = 'yes';
		//$q2docs = $q2docs.'<li>'.$form['fields'][24]['label'].'</li>';
		$q2docs = $q2docs.'<li>'.get_field_label_by_form($form, 29).'</li>';
	}
	//q2 handbook...
	if ($_POST['input_30'] == 'Yes') {
		$q2met = 'yes';
		//$q2docs = $q2docs.'<li>'.$form['fields'][25]['label'].'</li>';
		$q2docs = $q2docs.'<li>'.get_field_label_by_form($form, 30).'</li>';
	}
	//q2 schedules...
	if ($_POST['input_31'] == 'Yes') {
		$q2met = 'yes';
		//$q2docs = $q2docs.'<li>'.$form['fields'][26]['label'].'</li>';
		$q2docs = $q2docs.'<li>'.get_field_label_by_form($form, 31).'</li>';
	}
	//q2 training materials...
	if ($_POST['input_32'] == 'Yes') {
		$q2met = 'yes';
		//$q2docs = $q2docs.'<li>'.$form['fields'][27]['label'].'</li>';
		$q2docs = $q2docs.'<li>'.get_field_label_by_form($form, 32).'</li>';
	}
	//q2 other...
	if ($_POST['input_33'] == 'Yes') {
		$q2met = 'yes';
		$q2docs = $q2docs.'<li>Other: '.$_POST['input_34'].'</li>';
	}

	$_POST['input_38'] = $q2met;
	$_POST['input_39'] = $q2docs;
	
	
	//calculate if q3 goals were met////////////////////
    $q3met = 'no';
	$q3docs ='';
	
	//q3 parent newsletters or flyers...
	if ($_POST['input_40'] == 'Yes') {
		$q3met = 'yes';
		//$q3docs = $q3docs.'<li>'.$form['fields'][34]['label'].'</li>';
		$q3docs = $q3docs.'<li>'.get_field_label_by_form($form, 40).'</li>';
	}
	//q3 handbook...
	if ($_POST['input_41'] == 'Yes') {
		$q3met = 'yes';
		//$q3docs = $q3docs.'<li>'.$form['fields'][35]['label'].'</li>';
		$q3docs = $q3docs.'<li>'.get_field_label_by_form($form, 41).'</li>';
	}
	//q3 schedules...
	if ($_POST['input_42'] == 'Yes') {
		$q3met = 'yes';
		//$q3docs = $q3docs.'<li>'.$form['fields'][36]['label'].'</li>';
		$q3docs = $q3docs.'<li>'.get_field_label_by_form($form, 42).'</li>';
	}
	//q3 training materials...
	if ($_POST['input_43'] == 'Yes') {
		$q3met = 'yes';
		//$q3docs = $q3docs.'<li>'.$form['fields'][37]['label'].'</li>';
		$q3docs = $q3docs.'<li>'.get_field_label_by_form($form, 43).'</li>';
	}
	//q3 other...
	if ($_POST['input_44'] == 'Yes') {
		$q3met = 'yes';
		$q3docs = $q3docs.'<li>Other: '.$_POST['input_45'].'</li>';
	}	

	$_POST['input_46'] = $q3met;
	$_POST['input_47'] = $q3docs;
	

	//calculate if q4 goals were met/////////////////
    $q4met = 'no';
	$q4docs ='';
	
	//q4 parent newsletters or flyers...
	if (($_POST['input_51'] >= 30) && ($_POST['input_55'] >= $_POST['input_1'])) {
		$q4met = 'yes';
		//$q4docs = $q4docs.'<li>'.$form['fields'][44]['label'].'</li>';
		$q4docs = $q4docs.'<li>'.get_field_label_by_form($form, 50).'</li>';
	}
	//q4 handbook...
	if (($_POST['input_54'] >= 30) && ($_POST['input_52'] >= $_POST['input_1'])) {
		$q4met = 'yes';
		//$q4docs = $q4docs.'<li>'.$form['fields'][47]['label'].'</li>';
		$q4docs = $q4docs.'<li>'.get_field_label_by_form($form, 53).'</li>';
	}
	//q4 schedules...
	if (($_POST['input_57'] >= 30) && ($_POST['input_58'] >= $_POST['input_1'])) {
		$q4met = 'yes';
		//$q4docs = $q4docs.'<li>'.$form['fields'][50]['label'].'</li>';
		$q4docs = $q4docs.'<li>'.get_field_label_by_form($form, 56).'</li>';
	}
	//q4 training materials...
	if (($_POST['input_60'] >= 30) && ($_POST['input_61'] >= $_POST['input_1'])) {
		$q4met = 'yes';
		//$q4docs = $q4docs.'<li>'.$form['fields'][53]['label'].'</li>';
		$q4docs = $q4docs.'<li>'.get_field_label_by_form($form, 59).'</li>';
	}
	//q4 other...
	if (($_POST['input_64'] >= 30) && ($_POST['input_65'] >= $_POST['input_1'])) {
		$q4met = 'yes';
		$q4docs = $q4docs.'<li>Other: '.$_POST['input_63'].'</li>';
	}

	$_POST['input_154'] = $q4met;
	$_POST['input_155'] = $q4docs;
	
	
	//calculate if q6 goals were met////////////////////
    $q5met = 'no';
	$q5docs ='';
	
	//q5 parent newsletters or flyers...
	if ($_POST['input_69'] == 'Yes') {
		$q5met = 'yes';
		//$q5docs = $q5docs.'<li>'.$form['fields'][65]['label'].'</li>';
		$q5docs = $q5docs.'<li>'.get_field_label_by_form($form, 69).'</li>';
	}
	//q5 handbook...
	if ($_POST['input_70'] == 'Yes') {
		$q5met = 'yes';
		//$q5docs = $q5docs.'<li>'.$form['fields'][66]['label'].'</li>';
		$q5docs = $q5docs.'<li>'.get_field_label_by_form($form, 70).'</li>';
	}
	//q5 training materials...
	if ($_POST['input_71'] == 'Yes') {
		$q5met = 'yes';
		//$q5docs = $q5docs.'<li>'.$form['fields'][67]['label'].'</li>';
		$q5docs = $q5docs.'<li>'.get_field_label_by_form($form, 71).'</li>';
	}
	//q5 other...
	if ($_POST['input_72'] == 'Yes') {
		$q5met = 'yes';
		$q5docs = $q5docs.'<li>Other: '.$_POST['input_73'].'</li>';
	}

	$_POST['input_156'] = $q5met;
	$_POST['input_157'] = $q5docs;
	
	
	
	//calculate if q6 goals were met////////////////////
    $q6met = 'no';
	$q6docs ='';
	
	//q6 parent newsletters or flyers...
	if ($_POST['input_77'] == 'Yes') {
		$q6met = 'yes';
		//$q6docs = $q6docs.'<li>'.$form['fields'][75]['label'].'</li>';
		$q6docs = $q6docs.'<li>'.get_field_label_by_form($form, 77).'</li>';
	}
	//q6 handbook...
	if ($_POST['input_78'] == 'Yes') {
		$q6met = 'yes';
		//$q6docs = $q6docs.'<li>'.$form['fields'][76]['label'].'</li>';
		$q6docs = $q6docs.'<li>'.get_field_label_by_form($form, 78).'</li>';
	}
	//q6 training materials...
	if ($_POST['input_79'] == 'Yes') {
		$q6met = 'yes';
		//$q6docs = $q6docs.'<li>'.$form['fields'][77]['label'].'</li>';
		$q6docs = $q6docs.'<li>'.get_field_label_by_form($form, 79).'</li>';
	}
	//q6 other...
	if ($_POST['input_80'] == 'Yes') {
		$q6met = 'yes';
		$q6docs = $q6docs.'<li>Other: '.$_POST['input_81'].'</li>';
	}

	$_POST['input_158'] = $q6met;
	$_POST['input_159'] = $q6docs;
	
	
	
	//calculate if q7 goals were met////////////////////
    $q7met = 'no';
	$q7docs ='';
	
	//q7 menu...
	if ($_POST['input_84'] == 'Yes') {
		$q7met = 'yes';
		//$q7docs = $q7docs.'<li>'.$form['fields'][84]['label'].'</li>';
		$q7docs = $q7docs.'<li>'.get_field_label_by_form($form, 84).'</li>';
	}
	//q7 handbook...
	if ($_POST['input_85'] == 'Yes') {
		$q7met = 'yes';
		//$q7docs = $q7docs.'<li>'.$form['fields'][85]['label'].'</li>';
		$q7docs = $q7docs.'<li>'.get_field_label_by_form($form, 85).'</li>';
	}
	//q7 family newsletters or flyers...
	if ($_POST['input_86'] == 'Yes') {
		$q7met = 'yes';
		//$q7docs = $q7docs.'<li>'.$form['fields'][86]['label'].'</li>';
		$q7docs = $q7docs.'<li>'.get_field_label_by_form($form, 86).'</li>';
	}
	//q7 official memos or letters to parents...
	if ($_POST['input_87'] == 'Yes') {
		$q7met = 'yes';
		//$q7docs = $q7docs.'<li>'.$form['fields'][87]['label'].'</li>';
		$q7docs = $q7docs.'<li>'.get_field_label_by_form($form, 87).'</li>';
	}
	//q7 posters on site...
	if ($_POST['input_88'] == 'Yes') {
		$q7met = 'yes';
		//$q7docs = $q7docs.'<li>'.$form['fields'][88]['label'].'</li>';
		$q7docs = $q7docs.'<li>'.get_field_label_by_form($form, 88).'</li>';
	}
	//q7 training materials...
	if ($_POST['input_89'] == 'Yes') {
		$q7met = 'yes';
		//$q7docs = $q7docs.'<li>'.$form['fields'][89]['label'].'</li>';
		$q7docs = $q7docs.'<li>'.get_field_label_by_form($form, 89).'</li>';
	}
	//q7 other...
	if ($_POST['input_90'] == 'Yes') {
		$q7met = 'yes';
		$q7docs = $q7docs.'<li>Other: '.$_POST['input_91'].'</li>';
	}
	
	$_POST['input_160'] = $q7met;
	$_POST['input_161'] = $q7docs;
	
	
	
	//calculate if q9 goals were met////////////////////
    $q9met = 'no';
	$q9docs ='';
	
	//q9 menu...
	if (($_POST['input_97'] == 'Yes') && ($_POST['input_103'] >= $_POST['input_1'])) {
		$q9met = 'yes';
		//$q9docs = $q9docs.'<li>'.$form['fields'][99]['label'].'</li>';
		$q9docs = $q9docs.'<li>'.get_field_label_by_form($form, 97).'</li>';
	}
	//q9 handbook...
	if (($_POST['input_98'] == 'Yes') && ($_POST['input_104'] >= $_POST['input_1'])) {
		$q9met = 'yes';
		//$q9docs = $q9docs.'<li>'.$form['fields'][101]['label'].'</li>';
		$q9docs = $q9docs.'<li>'.get_field_label_by_form($form, 98).'</li>';
	}
	//q9 family newsletters or flyers...
	if (($_POST['input_99'] == 'Yes') && ($_POST['input_105'] >= $_POST['input_1'])) {
		$q9met = 'yes';
		//$q9docs = $q9docs.'<li>'.$form['fields'][103]['label'].'</li>';
		$q9docs = $q9docs.'<li>'.get_field_label_by_form($form, 99).'</li>';
	}
	//q9 training materials...
	if (($_POST['input_100'] == 'Yes') && ($_POST['input_106'] >= $_POST['input_1'])) {
		$q9met = 'yes';
		//$q9docs = $q9docs.'<li>'.$form['fields'][105]['label'].'</li>';
		$q9docs = $q9docs.'<li>'.get_field_label_by_form($form, 100).'</li>';
	}
	//q9 other...
	if (($_POST['input_101'] == 'Yes') && ($_POST['input_107'] >= $_POST['input_1'])) {
		$q9met = 'yes';
		$q9docs = $q9docs.'<li>Other: '.$_POST['input_91'].'</li>';
	}

	$_POST['input_162'] = $q9met;
	$_POST['input_163'] = $q9docs;
	
	
	//calculate if q10 goals were met////////////////////
    $q10met = 'no';
	$q10docs ='';
	
	//q10 menu...
	if ($_POST['input_111'] == 'Yes') {
		$q10met = 'yes';
		//$q10docs = $q10docs.'<li>'.$form['fields'][114]['label'].'</li>';
		$q10docs = $q10docs.'<li>'.get_field_label_by_form($form, 111).'</li>';
	}
	//q10 handbook...
	if ($_POST['input_112'] == 'Yes') {
		$q10met = 'yes';
		//$q10docs = $q10docs.'<li>'.$form['fields'][115]['label'].'</li>';
		$q10docs = $q10docs.'<li>'.get_field_label_by_form($form, 112).'</li>';
	}
	//q10 family newsletters or flyers...
	if ($_POST['input_113'] == 'Yes') {
		$q10met = 'yes';
		//$q10docs = $q10docs.'<li>'.$form['fields'][116]['label'].'</li>';
		$q10docs = $q10docs.'<li>'.get_field_label_by_form($form, 113).'</li>';
	}
	//q10 training materials...
	if ($_POST['input_114'] == 'Yes') {
		$q10met = 'yes';
		//$q10docs = $q10docs.'<li>'.$form['fields'][117]['label'].'</li>';
		$q10docs = $q10docs.'<li>'.get_field_label_by_form($form, 114).'</li>';
	}
	//q10 other...
	if ($_POST['input_115'] == 'Yes') {
		$q10met = 'yes';
		$q10docs = $q10docs.'<li>Other: '.$_POST['input_116'].'</li>';
	}
	
	$_POST['input_164'] = $q10met;
	$_POST['input_165'] = $q10docs;
	
	
	
	//calculate if q11 goals were met////////////////////
    $q11met = 'no';
	$q11docs ='';
	
	//q11 menu...
	if ($_POST['input_119'] == 'Yes') {
		$q11met = 'yes';
		//$q11docs = $q11docs.'<li>'.$form['fields'][124]['label'].'</li>';
		$q11docs = $q11docs.'<li>'.get_field_label_by_form($form, 119).'</li>';
	}
	//q11 handbook...
	if ($_POST['input_120'] == 'Yes') {
		$q11met = 'yes';
		//$q11docs = $q11docs.'<li>'.$form['fields'][125]['label'].'</li>';
		$q11docs = $q11docs.'<li>'.get_field_label_by_form($form, 120).'</li>';
	}
	//q11 family newsletters or flyers...
	if ($_POST['input_121'] == 'Yes') {
		$q11met = 'yes';
		//$q11docs = $q11docs.'<li>'.$form['fields'][126]['label'].'</li>';
		$q11docs = $q11docs.'<li>'.get_field_label_by_form($form, 121).'</li>';
	}
	//q11 training materials...
	if ($_POST['input_122'] == 'Yes') {
		$q11met = 'yes';
		//$q11docs = $q11docs.'<li>'.$form['fields'][127]['label'].'</li>';
		$q11docs = $q11docs.'<li>'.get_field_label_by_form($form, 122).'</li>';
	}
	//q11 other...
	if ($_POST['input_123'] == 'Yes') {
		$q11met = 'yes';
		$q11docs = $q11docs.'<li>Other: '.$_POST['input_124'].'</li>';
	}
	
	$_POST['input_166'] = $q11met;
	$_POST['input_167'] = $q11docs;
	
	
	
	//calculate if q12 goals were met////////////////////
    $q12met = 'no';
	$q12docs ='';
	
	//q12 menu...
	if ($_POST['input_127'] == 'Yes') {
		$q12met = 'yes';
		//$q12docs = $q12docs.'<li>'.$form['fields'][134]['label'].'</li>';
		$q12docs = $q12docs.'<li>'.get_field_label_by_form($form, 127).'</li>';
	}
	//q12 handbook...
	if ($_POST['input_128'] == 'Yes') {
		$q12met = 'yes';
		//$q12docs = $q12docs.'<li>'.$form['fields'][135]['label'].'</li>';
		$q12docs = $q12docs.'<li>'.get_field_label_by_form($form, 128).'</li>';
	}
	//q12 family newsletters or flyers...
	if ($_POST['input_129'] == 'Yes') {
		$q12met = 'yes';
		//$q12docs = $q12docs.'<li>'.$form['fields'][136]['label'].'</li>';
		$q12docs = $q12docs.'<li>'.get_field_label_by_form($form, 129).'</li>';
	}
	//q12 training materials...
	if ($_POST['input_130'] == 'Yes') {
		$q12met = 'yes';
		//$q12docs = $q12docs.'<li>'.$form['fields'][137]['label'].'</li>';
		$q12docs = $q12docs.'<li>'.get_field_label_by_form($form, 130).'</li>';
	}
	//q12 other...
	if ($_POST['input_131'] == 'Yes') {
		$q12met = 'yes';
		$q12docs = $q12docs.'<li>Other: '.$_POST['input_132'].'</li>';
	}
	
	$_POST['input_168'] = $q12met;
	$_POST['input_169'] = $q12docs;
	
	
	
	//calculate if q13 goals were met////////////////////
    $q13met = 'no';
	$q13docs ='';
	
	//q13 menu...
	if (($_POST['input_135'] == 'Yes') && ($_POST['input_141'] >= $_POST['input_1'])) {
		$q13met = 'yes';
		//$q13docs = $q13docs.'<li>'.$form['fields'][99]['label'].'</li>';
		$q13docs = $q13docs.'<li>'.get_field_label_by_form($form, 135).'</li>';
	}
	//q13 handbook...
	if (($_POST['input_136'] == 'Yes') && ($_POST['input_142'] >= $_POST['input_1'])) {
		$q13met = 'yes';
		//$q13docs = $q13docs.'<li>'.$form['fields'][101]['label'].'</li>';
		$q13docs = $q13docs.'<li>'.get_field_label_by_form($form, 136).'</li>';
	}
	//q13 family newsletters or flyers...
	if (($_POST['input_137'] == 'Yes') && ($_POST['input_143'] >= $_POST['input_1'])) {
		$q13met = 'yes';
		//$q13docs = $q13docs.'<li>'.$form['fields'][103]['label'].'</li>';
		$q13docs = $q13docs.'<li>'.get_field_label_by_form($form, 137).'</li>';
	}
	//q13 training materials...
	if (($_POST['input_138'] == 'Yes') && ($_POST['input_144'] >= $_POST['input_1'])) {
		$q13met = 'yes';
		//$q13docs = $q13docs.'<li>'.$form['fields'][105]['label'].'</li>';
		$q13docs = $q13docs.'<li>'.get_field_label_by_form($form, 138).'</li>';
	}
	//q13 other...
	if (($_POST['input_139'] == 'Yes') && ($_POST['input_145'] >= $_POST['input_1'])) {
		$q13met = 'yes';
		$q13docs = $q13docs.'<li>Other: '.$_POST['input_140'].'</li>';
	}
	
	$_POST['input_170'] = $q13met;
	$_POST['input_171'] = $q13docs;
	
	
	
	//calculate if q14 goals were met////////////////////
    $q14met = 'no';
	$q14docs ='';
	
	//q14 menu...
	if ($_POST['input_148'] == 'Yes') {
		$q14met = 'yes';
		//$q14docs = $q14docs.'<li>'.$form['fields'][159]['label'].'</li>';
		$q14docs = $q14docs.'<li>'.get_field_label_by_form($form, 148).'</li>';
	}
	//q14 handbook...
	if ($_POST['input_149'] == 'Yes') {
		$q14met = 'yes';
		//$q14docs = $q14docs.'<li>'.$form['fields'][160]['label'].'</li>';
		$q14docs = $q14docs.'<li>'.get_field_label_by_form($form, 149).'</li>';
	}
	//q14 family newsletters or flyers...
	if ($_POST['input_150'] == 'Yes') {
		$q14met = 'yes';
		//$q14docs = $q14docs.'<li>'.$form['fields'][161]['label'].'</li>';
		$q14docs = $q14docs.'<li>'.get_field_label_by_form($form, 150).'</li>';
	}
	//q14 training materials...
	if ($_POST['input_151'] == 'Yes') {
		$q14met = 'yes';
		//$q14docs = $q14docs.'<li>'.$form['fields'][162]['label'].'</li>';
		$q14docs = $q14docs.'<li>'.get_field_label_by_form($form, 151).'</li>';
	}
	//q14 other...
	if ($_POST['input_152'] == 'Yes') {
		$q14met = 'yes';
		$q14docs = $q14docs.'<li>Other: '.$_POST['input_153'].'</li>';
	}
	
	$_POST['input_172'] = $q14met;
	$_POST['input_173'] = $q14docs;
	
	
			
	//calculate if q3a goals were met, i.e. all physical activity /////////////
    $q3amet = 'no';
	$q3adocs = '';
	
	if (($q1met == 'yes')||($q2met == 'yes')||($q3met == 'yes')) {
		$q3amet = 'partial';
		$q3adocs = $q1docs.$q2docs.$q3docs;
	}
	if (($q1met == 'yes')&&($q2met == 'yes')&&($q3met == 'yes')) {
		$q3amet = 'yes';
		$q3adocs = $q1docs.$q2docs.$q3docs;
	}	
	
	// remove duplicates
	$q3adocs = '</li>'.$q3adocs.'<li>'; // add these so array can be created
	$q3a_arr = explode('</li><li>', $q3adocs);
	$q3a_arr_unique = array_unique($q3a_arr);
	$q3adocs = implode('</li><li>', $q3a_arr_unique);
	$q3adocs = substr($q3adocs, 5);  // remove extra li /li added above
	$q3adocs = $q3adocs.'</li>';
	
	$_POST['input_177'] = $q3amet;
	$_POST['input_178'] = $q3adocs;

	
	// timestamp
	$timestamp = date("F j, Y");            		  // March 10, 2001
	$_POST['input_176'] = $timestamp;

	return $form;

}


// Allow basic tags like <div> and <li> etc in gforms //
add_filter("gform_allowable_tags", "allow_basic_tags");
function allow_basic_tags($allowable_tags){
    return '<p><a><strong><em><div><ul><li>';
}


// Disable the Wordpress Admin Bar for everyone. //
show_admin_bar(false);


// Enable categories onpages
function myplugin_settings() {  
	register_taxonomy_for_object_type('category', 'page');  
}
add_action( 'admin_init', 'myplugin_settings' );


//=============================================
// Get a field's id by label
//=============================================
function get_field_id_by_label($key, $form) {
	if (is_array($form['fields'])){
		foreach ($form['fields'] as $field) {
			$lead_key = $field['label'];
			if ($lead_key == $key) {
				return $field['id'];
			}
		}
	}
	return false;
}

//=============================================
// Set the default column layout to one column
//=============================================
global $current_user;
get_currentuserinfo();
$user_id = $current_user->ID;
$prev_value = NULL;
update_user_meta($user_id, screen_layout_dashboard, 1);


//=============================================
// Go to home page after logout
//=============================================

add_filter('logout_url', 'dmk_logout_redirect_url', 10, 2);
/**
 * Adds a redirect url to the homepage to $logouturl
 *
 * @author Daan Kortenbach
 * @param string $logouturl Existing logouturl
 * @return string $logouturl Amended with redirect url
 */
function dmk_logout_redirect_url( $logouturl ) {	
	return $logouturl . '&amp;redirect_to=' . urlencode( get_option( 'siteurl' ) );
}
 
add_action( 'init', 'dmk_loggedout_redirect' );
function dmk_loggedout_redirect() {
	if( $_GET['loggedout'] == 'true' ) {
		wp_redirect( get_option( 'siteurl' ) );
		exit;
	}
}


//=============================================
// add css to admin pages
//=============================================
function admin_css() {
	global $user_level;
	if (is_super_admin()) {
	   echo '<style type="text/css">
				.wrap div.error, .media-upload-form div.error {display: none;}
				.login h1 a {width: 100%;}
			</style>';
   }
}
add_action('admin_head', 'admin_css');


//=============================================
// get site url from shortcode
// http://www.wpsnacks.com
//=============================================
function url_shortcode() {
	return get_bloginfo('url');
}
add_shortcode('url','url_shortcode');


//=============================================
// find files in filesystem (used for pdf archives)
//=============================================
function findfile( $location, $fileregex ) {
	if (!$location or !is_dir($location) or !$fileregex) {
	   return false;
	}
 	
	$matchedfiles = array();
 
	$all = opendir($location);
	while ($file = readdir($all)) {
	   if (is_dir($location.'/'.$file) and $file <> ".." and $file <> ".") {
		  $subdir_matches = findfile($location.'/'.$file,$fileregex);
		  $matchedfiles = array_merge($matchedfiles,$subdir_matches);
		  unset($file);
	   }
	   elseif (!is_dir($location.'/'.$file)) {
		  if (preg_match($fileregex,$file)) {
			 //array_push($matchedfiles,$location.'/'.$file);
			 array_push($matchedfiles,$file);
		  }
	   }
	}
	closedir($all);
	unset($all);
	return $matchedfiles;
}
function findFileRowsForUser( $endDir, $username ) {
	// $endDir = pdf-assessment-reports | pdf-action-plans | etc
	// username = WP username, ie 'slaven'
	if ($username == '') {$username = 'null';} // don't want to return everything if username is blank
	$basePath = '/var/www/osnap.org/public_html/';
	$webDir = 'wp-content/themes/osnap.1.0/';
	$path = $basePath.$webDir.$endDir;
	
	// return any file ending in pdf if user name passed is all-users
	if ($username == 'all-users') {$username = '';} 
	   
	$fileEnd = '/^'.$username.'.*\.(pdf)$/';

	$fileList = findfile( $path, $fileEnd ); 

	if ( $endDir == 'pdf-assessment-reports' ) {
		$spanClass = 'delete-AR-pdf';
	} else {
		$spanClass = 'delete-AP-pdf';
	}
		
	foreach ($fileList as &$file) {
		echo '<tr><td>';
		echo '<a href="/'.$webDir.$endDir.'/'.$file.'">'.$file.'</a>';
		echo '<span class="'.$spanClass.' btn" id="'.$file.'"><i class="icon-trash"></i></span>';
		echo '</td></tr>';
		
	}
}
function deleteFile ( $endDir, $fileName ) {
	$basePath = '/var/www/osnap.org/public_html/';
	$webDir = 'wp-content/themes/osnap.1.0/';
	$path = $basePath.$webDir.$endDir;
	unlink ( $path.$fileName );
}







//=============================================
// find all entries in all forms for logged-in user
//=============================================

function findAllMyEntries () {
	
	// get current user info
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	
	// initialize strings
	$result = "";
	$my_lead_ids = array();
	
	// find entries for this user in all forms that we want to wipe out
	$form_ids = array(1,4,7,8,10,16,18,19,20,21,22,49);
	foreach ($form_ids as $form_id) {
		
		// reset running count of number of entries found
		$number_of_entries_f[$form_id] = 0;
		
		// get all leads for that form id
		$leads = RGFormsModel::get_leads( $form_id ); 
				
		// get form meta and then user-login field id for each form
		$form_meta = RGFormsModel::get_form_meta( $form_id );
		$form_title = $form_meta["title"];
		//$user_field_id = get_field_id_by_label('user-login', $form_meta);
		
		// get leads that match on user-login
		foreach ($leads as $lead) {
			//if ($lead[$user_field_id] == $user_login){
			if ($lead['created_by'] == $user_id){
				$number_of_entries_f[$form_id]++;
				
				// do more stuff here
				// array_push($my_leads, $lead);
			}
			
		}		
		
		$result .= $form_title.": ".$number_of_entries_f[$form_id]."<br/>";			
	}
	
	return $result;
}


//=============================================
// delete all entries in all forms for logged-in user
//=============================================

function deleteAllMyEntries () {
	
	// get current user info
	global $current_user;
	get_currentuserinfo();
	$user_id = $current_user->ID;
	
	// initialize
	$result = "";
	$my_lead_ids = array();
	$successes = 0;
	$failures = 0;
	$failure_msg = "";
	
	// find entries for this user in all forms that we want to wipe out
	$form_ids = array(1,4,7,8,10,16,18,19,20,21,22,49);
	
	foreach ($form_ids as $form_id) {
		
		// reset running count of number of entries found
		$number_of_entries_f[$form_id] = 0;
		
		// get all leads for that form id
		$leads = RGFormsModel::get_leads( $form_id ); 
				
		// get form meta and then user-login field id for each form
		$form_meta = RGFormsModel::get_form_meta( $form_id );
		$form_title = $form_meta["title"];
		
		// get leads that match on user-login
		foreach ($leads as $lead) {
			if ($lead['created_by'] == $user_id){
			
				array_push($my_lead_ids, $lead['id']);
				$number_of_entries_f[$form_id]++;
				
			}		
		}		
		
		$result .= $form_title.": ".$number_of_entries_f[$form_id]."<br/>";			
	}
	
	// delete the entries
	foreach ($my_lead_ids as $lead_id) {
		$del_result = GFAPI::delete_entry($lead_id);
		//echo "dr: ".$del_result;
		if ( $del_result == true ) {
			$successes++;
		} else {
			$failures++;
			$failure_msg .= "<br>".$del_result;
		}
	}

	
	$final_result = "<br><br><b>Reset of all forms is complete.</b><br/><br/>Details - Attempted to delete the following number of entries:<br/>".$result;
	$final_result .= "<br/>Successes: ".$successes."<br/>Failures: ".$failures."<br>".$failure_msg;
	return $final_result;
}




///////////// END CUSTOM EDITS BY //////////////////////////


/*** BEGIN CUSTOM EDITS BY DAVE ROTHFARB, HEALTH COMMUNICATION CORE, DEC 2015 ***/

function test_leads() {
  global $my_practice_leads;
  //print_r($my_practice_leads);
  echo '<ul>';
  foreach($my_practice_leads as $lead) {
    echo '<li>' . $lead[2] . '</li>';
  }
  echo '</ul>';
}

function get_all_assessment_questions() {
  $questions_toignore = array(0, 1, 2, 3, 13, 14, 19, 20);
  $filtered_questions = array();
  $end =  31;
  $meta = GFAPI::get_form(4);
  for($i = 0; $i < $end; $i++) {
    if( !in_array($i, $questions_toignore) ) {
      $filtered_questions[] = $meta['fields'][$i]->label;
    }
  }
  return $filtered_questions;
}

function build_assessment_q_and_a() {
  $all_questions = get_all_assessment_questions();
}

function build_assessment_csv_data() {
  global $my_practice_leads;
  $assessment_q_and_a = build_assessment_q_and_a();
}

add_action('template_redirect', 'execute_csv_export');

function execute_csv_export () {
  if( $_SERVER['REQUEST_URI'] == '/tools/self-assessment-report/download-csv-report' ) {
    //$csv_data = build_assessment_csv_data();

    /* Insert csv download code here */
  }
  else if( $_SERVER['REQUEST_URI'] == '' ) {
    /* Insert csv download code here */
  }
  else {}
}

?>
