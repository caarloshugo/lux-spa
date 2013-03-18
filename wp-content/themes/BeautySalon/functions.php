<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

define('TEMPLATEURL', get_template_directory_uri());
define('IMAGES_URL',      TEMPLATEURL.'/images');

// load config    
require_once(dirname(__FILE__).'/config.php');
require_once(dirname(__FILE__).'/lib/shortcode_editor/shortcode_editor.php');
require_once(dirname(__FILE__).'/lib/shortcode.php');



/* Put Global Javascript Variables Code
------------------------------------------------------------ */

if(!function_exists('bdt_put_global_javascript_variables_code'))
{
  function bdt_put_global_javascript_variables_code() {
		echo "<script type='text/javascript'> /* <![CDATA[ */ ";
		echo   "var bdt = { ";
		echo     "template_url: '".TEMPLATEURL."', ";
		//echo     "fw_url: '".FW_URL."', ";
		echo " }; /* ]]> */ </script>";
  }
}

if(function_exists('bdt_put_global_javascript_variables_code'))
{
  add_action('admin_print_scripts', 'bdt_put_global_javascript_variables_code');
}

/****************************************************
/* POST TYPE: STAFF
*****************************************************/
	register_post_type('staff-profile', array(
		'label' => 'Staff Profile',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => get_template_directory_uri('template_directory') . '/images/staff-icon.png',
		'rewrite' => array('slug' => 'staff-profile'),
		'query_var' => true,
		'supports' => array('title','editor','custom-fields','excerpt','thumbnail','staff','page-attributes')) );
		add_filter("manage_edit-staff_columns", "staff_edit_columns");
		add_action("manage_posts_custom_column",  "staff_columns_display");
	
	function staff_edit_columns($staff_columns){
		$staff_columns = array("cb" => "<input type=\"checkbox\" />","title" => "Staff Title","description" => "Description","date" => "Date",);
		return $staff_columns;
	}

	function staff_columns_display($staff_columns){
		switch ($staff_columns){
			case "description":
				the_excerpt();
				break;
	}
}





/****************************************************
/* Service 
*****************************************************/
register_post_type('service', array(
		'label' => 'Service',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => get_template_directory_uri('template_directory') . '/images/service-icon.png',
		'rewrite' => array('slug' => 'service'),
		'query_var' => true,
		'supports' => array('title','editor','custom-fields','excerpt','thumbnail','service','page-attributes')) );

		add_filter("manage_edit-service_columns", "service_edit_columns");
		

function service_edit_columns($service_columns){
	$service_columns = array("cb" => "<input type=\"checkbox\" />","title" => "Project Title","description" => "Description","date" => "Date",);
	return $service_columns;
}
function service_columns_display($service_columns){
	switch ($service_columns){
		case "description":
			the_excerpt();
			break;
}
}

	/// Add custom taxonomies
add_action( 'init', 'beauty_taxnomy', 0 );

function beauty_taxnomy() 
{
	// Meal type
	$service_labels = array(
		'name' => _x( 'Service type', 'taxonomy general name' ),
		'singular_name' => _x( 'Service type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search in Service type' ),
		'all_items' => __( 'All Service type' ),
		'most_used_items' => null,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Service type' ), 
		'update_item' => __( 'Update Service type' ),
		'add_new_item' => __( 'Add new Service type' ),
		'new_item_name' => __( 'New Service type' ),
		'menu_name' => __( 'Service type' ),
	);
	register_taxonomy('service-type',array('service'),array(
		'hierarchical' => true,
		'labels' => $service_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'service-category' )
	));
}









/****************************************************
/* News 
*****************************************************/
register_post_type('news', array(
		'label' => 'News',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => get_template_directory_uri('template_directory') . '/images/news-icon.png',
		'rewrite' => array('slug' => 'news'),
		'query_var' => true,
		'supports' => array('title','editor','custom-fields','thumbnail','news','page-attributes', 'comments'),
		'taxonomies' => array('category', 'post_tag')
		));

		add_filter("manage_edit-news_columns", "news_edit_columns");
		
		add_action('init', 'news_add_default_boxes');
 
function news_add_default_boxes() {
	register_taxonomy_for_object_type('category', 'news');
	register_taxonomy_for_object_type('post_tag', 'news');
}

function news_edit_columns($news_columns){
	$news_columns = array("cb" => "<input type=\"checkbox\" />","title" => "News Title","description" => "Description","date" => "Date",);
	return $news_columns;
}
function news_columns_display($news_columns){
	switch ($news_columns){
		case "description":
			the_excerpt();
			break;
}
}

/****************************************************
/* THUMBNAIL
*****************************************************/
function catch_that_image() {
			global $post, $posts;
			$first_img = '';
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			$first_img = $matches [1] [0];
			
			if(empty($first_img)){
				//Defines a default image
				$first_img = "img/blank.jpg";
			}
			return $first_img;
		}
		function image_by_scan( $args = array() ) {
			if ( !$post_id ) global $post;
			preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>
|i', $post->post_content, $matches );
        if ( isset( $matches ) ) $image = $matches[1][0];
        if ( $matches[1][0] ) return array( 'image' => $image ); else return true;
        }
        
        /****************************************************
        /* EXCERPT POST
        *****************************************************/
        function limit_words($string, $word_limit) {
        // creates an array of words from $string (this will be our excerpt)
        // explode divides the excerpt up by using a space character
        $words = explode(' ', $string);
        // this next bit chops the $words array and sticks it back together
        // starting at the first word '0' and ending at the $word_limit
        // the $word_limit which is passed in the function will be the number
        // of words we want to use
        // implode glues the chopped up array back together using a space character
        return implode(' ', array_slice($words, 0, $word_limit));
        }