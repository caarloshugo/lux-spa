<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

class Warp_LatestNews extends WP_Widget {

	function Warp_LatestNews() {
		$widget_ops = array('description' => 'Display default Wordpress Latest News');
		parent::WP_Widget(false, 'Warp - Latest News', $widget_ops);      
	}

	function widget($args, $instance) {  
		
		global $wp_query;
		
		extract($args);

		$title = $instance['title'];
		$postNumber = $instance['postNumber'];
		$warp  = Warp::getInstance();
		
		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		{?>
		
		<div class="home-news">
        	<div class="nspArts bottom" style="width: 100%">
        	<div class="nspArtPage">
         <?php 
          if(have_posts()) :
          $my_query = new WP_Query('post_type=news&orderby=date&showposts=' .$postNumber. '&paged= $paged');
          while ($my_query->have_posts()) : $my_query->the_post();
                  ?>
        <div class="nspArt nspCol<?php echo $postNumber; ?>" style="padding:0 10px 0px 10px;">
          <div class="nspArtWrapper">
            <h4 class="nspHeader tcenter fnone"><a href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
            <p class="nspText tcenter fleft"><?php echo substr(get_the_excerpt(), 0,70); $title; ?>...</p>
          </div>
        </div>
      
          
          <?php endwhile; wp_reset_query(); endif; ?>
         
        </div>
        </div>
        </div>
		
		<?php }
		
		$output = $warp['template']->get('featurednewss.output', "");
		
		echo $output;

		echo $after_widget;

	}

	function update($new_instance, $old_instance) {                
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['postNumber'] = $new_instance['postNumber'];
		return $instance;
	}

	function form($instance) {        
		$title = esc_attr($instance['title']);
		$postNumber = esc_attr($instance['postNumber']);
 
		?>
        <p>
			<label for="<?php echo $this->get_field_id('postNumber'); ?>">Number of News:</label>
			<input type="text" name="<?php echo $this->get_field_name('postNumber'); ?>"  value="<?php echo $postNumber; ?>" class="widefat" id="<?php echo $this->get_field_id('postNumber'); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','warp'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
<?php
	}

} 

register_widget('Warp_LatestNews');