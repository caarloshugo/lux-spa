<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

global $wp_query;

$queried_object = $wp_query->get_queried_object();

// output content from header/footer mode
if ($this->has('content')) {
	return $this->output('content');
}

$content = '';

if (is_home()) {
	$content = 'index';
}
elseif (is_page()) {  
    if (is_page_template('page-service.php')) {  
        $content = 'page-service'; 
	} elseif (is_page_template('page-frontpage.php')) {  
        $content = 'page-frontpage'; 
	}
	 elseif (is_page_template('page-news.php')) {  
        $content = 'page-news'; 
	}
	elseif (is_page_template('page-appointment.php')) {  
        $content = 'page-appointment'; 
	}
	 elseif (is_page_template('page-staff.php')) {  
        $content = 'page-staff'; 
	}
	elseif (is_page_template('page-blog.php')) {  
        $content = 'page-blog'; 
	}
	 elseif (is_page_template('page-contact.php')) {  
        $content = 'page-contact'; 
	}
	 else {  
        $content = 'page';  
	}
} 
elseif (is_attachment()) {
	$content = 'attachment';
} 
elseif ((is_single()) && (get_post_type() == 'service')) {
		$content = 'single-service';
	}
elseif ((is_single()) && (get_post_type() == 'staff-profile')) {
		$content = 'single-staff';
	}  
elseif ((is_single()) && (get_post_type() == 'news')) {
		$content = 'single-news';
	}  
 elseif (is_single()) {
	
	$content = 'single';

	if ($this["path"]->path("layouts:{$queried_object->post_type}.php")) {
		$content = $queried_object->post_type;
	}

} elseif (is_search()) {
	$content = 'search';
} elseif (is_archive() && is_author()) {
	$content = 'author';
} elseif (is_archive()) {

	$content = 'archive';

	if ($this["path"]->path("layouts:{$queried_object->taxonomy}.php")) {
		$content = $queried_object->taxonomy;
	}

} elseif (is_404()) {
	$content = '404';
}

echo $this->render(apply_filters('warp_content', $content));