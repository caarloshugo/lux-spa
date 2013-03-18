<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

class Warp_FeaturedStaff extends WP_Widget {

	function Warp_FeaturedStaff() {
		$widget_ops = array('description' => 'Display default Wordpress Featured Staff');
		parent::WP_Widget(false, 'Warp - Featured Staff', $widget_ops);      
	}

	function widget($args, $instance) {  
		
		global $wp_query;
		
		extract($args);

		$title = $instance['title'];
		$postNumber = $instance['postNumber'];
		$sortingType = $instance['sortingType'];
		$warp  = Warp::getInstance();
		
		echo $before_widget;

		if ($title) {
			echo $before_title . $title . $after_title;
		}
		
		{?>

        <div class="home-staff">
        	<div class="nspArts bottom" style="width: 100%">
        	<div class="nspArtPage">
         <?php 
          if(have_posts()) :
          $my_query = new WP_Query('post_type=staff-profile&orderby='.$sortingType.'&showposts=' .$postNumber. '&paged= $paged');
          while ($my_query->have_posts()) : $my_query->the_post();
                  ?>
        
        <div class="nspArt nspCol<?php echo $postNumber; ?>" style="padding:0 10px 0px 10px;">
          <div class="nspArtWrapper">
            <h4 class="nspHeader tcenter fnone"><a href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
            <!-- Begin Thumb Container -->
            <div class="center tcenter fleft gkResponsive">
            <a href="<?php the_permalink() ?>" class="nspImageWrapper tcenter fleft gkResponsive" style="margin:6px 7px 15px 7px;"><img class="nspImage" src="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' ); echo $src[0]; ?>" alt="<?php the_title(); ?>" /></a></div>
            <!-- End Thumb Container -->
            <p class="nspText tcenter fleft"><?php echo substr(get_the_excerpt(), 0,70); ?>...</p>
          </div>
        </div>
        
        
		 
          
           
          
          <?php endwhile; wp_reset_query(); endif; ?>
        </div>
        </div>
        </div>
        
        <?php }
		
		$output = $warp['template']->get('featuredstaff.output', "");
		
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
		$sortingType = esc_attr($instance['sortingType']);	
 
		?>
        <p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','warp'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
 		<p>
			<label for="<?php echo $this->get_field_id('postNumber'); ?>">Number of Service:</label>
			<input type="text" name="<?php echo $this->get_field_name('postNumber'); ?>"  value="<?php echo $postNumber; ?>" class="widefat" id="<?php echo $this->get_field_id('postNumber'); ?>" />
		</p>
		
        
         <p>
			<label for="<?php echo $this->get_field_id('sortingType'); ?>">Sorting type:</label>            
            <select class="widefat"   name="<?php echo $this->get_field_name('sortingType'); ?>" id="<?php echo $this->get_field_id('sortingType'); ?>" title="Sorting type">

				<option value="date" <?php echo $sortingType!="date" ? "" :  'selected="selected"'; ?> >Sort by Date</option>
                <option value="title" <?php echo $sortingType!="title" ? "" :  'selected="selected"'; ?> >Sort by Title</option>
                <option value="rand" <?php echo $sortingType!="rand" ? "" :  'selected="selected"'; ?> >Random</option>

		</select>
        

        
        
		</p>
        
<?php
	}

} 

register_widget('Warp_FeaturedStaff');
