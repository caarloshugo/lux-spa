
<article id="item-<?php the_ID(); ?>" class="item" data-permalink="<?php the_permalink(); ?>">

	<?php if (has_post_thumbnail()) : ?>
		<?php
		$width = get_option('thumbnail_size_w'); //get the width of the thumbnail setting
		$height = get_option('thumbnail_size_h'); //get the height of the thumbnail setting
		?>
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(array($width, $height), array('class' => 'size-auto')); ?></a>
	<?php endif; ?>

	<header>

		<h1 class="title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		
		<p class="meta">
			<?php 
				$date = '<time datetime="'.get_the_date('Y-m-d').'" pubdate>'.get_the_date().'</time>';
				printf(__('<span class="writtenby"><i class="icon-edit"></i> Written by: %s </span> <span class="dateofpublished"><i class="icon-calendar"></i> Date of published: %s.</span>  <span class="postedin"><i class="icon-folder-open"></i> Posted in %s</span>', 'warp'), '<a class="tooltip" href="'.get_author_posts_url(get_the_author_meta('ID')).'" title="'.get_the_author().'">'.get_the_author().'</a>', $date, get_the_category_list(', '));
			?>
		</p>
		
	</header>

	<div class="content clearfix">
		<?php the_content(''); ?>
	</div>

	<p class="links">
		<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Continue Reading', 'warp'); ?></a>
		<?php if(comments_open()) comments_popup_link(__('No Comments', 'warp'), __('1 Comment', 'warp'), __('% Comments', 'warp'), "", ""); ?>
	</p>

	<?php edit_post_link(__('Edit this post.', 'warp'), '<p class="edit">','</p>'); ?>

</article>