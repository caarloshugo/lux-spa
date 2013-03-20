
<div id="system" class="news-page">

	<?php if (have_posts()) : ?>
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
         query_posts("post_type=news&showposts=12&paged= $paged"); ?>
    <?php while(have_posts()) : the_post(); ?>
		
		<article class="item">
		
			<header>
		
				<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php echo get_the_title($ID); ?>"><?php echo get_the_title($ID); ?></a></h1>
				<p class="meta">
			<?php 
				$date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
				printf(__('<span class="writtenby"><i class="icon-edit"></i> Written by: %s </span> <span class="dateofpublished"><i class="icon-calendar"></i> Date of published: %s.</span>', 'warp'), '<a class="tooltip" href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
			?>
		</p>
			</header>
			
			<div class="content clearfix">
            <a href="<?php the_permalink() ?>" class="alignleft border"><img class="nspImage" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo catch_that_image() ?>&amp;w=156&amp;h=156" alt="<?php the_title(); ?>" /></a>
            <p><?php echo substr(get_the_excerpt(), 0,380); ?>...</p> </div>
            
            <p class="links alignright" style="margin-top: -20px;">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Continue Reading', 'warp'); ?></a>
                <?php comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?>
            </p>

			<?php edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>
	
		</article>
		
		<?php endwhile; ?>
	<?php endif; ?>
	
	<?php comments_template(); ?>

</div>
