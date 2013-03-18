<?php
  function IsMyMeta($metas){
    $default=array("_edit_last","_edit_lock");
    foreach ($metas as $meta=>$value ){
      if(!in_array($meta, $default)){
        return true;
      }
    }
    return false;
  } 
?>

<div id="system" class="staffPage">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <article class="item" data-permalink="<?php the_permalink(); ?>">
    <header>
      <h1 class="title">
        <?php the_title(); ?>
      </h1>
    </header>
    <div class="content clearfix">
      <div class="two-sixth">
        <div class="content-img gkResponsive">
          <a data-lightbox href="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' ); echo $src[0]; ?>"> <?php the_post_thumbnail(); ?> </a> 
        </div>
          
          <?php if(IsMyMeta(get_post_meta(get_the_ID()))){?>
          <div class="serviceinfotitle">
              <h3><?php echo $this['config']->get('staffMetaName'); ?></h3>
            </div>
            <div class="serviceinfo">       
              <?php the_meta();  ?>
              <ul>
                <?php  wp_list_categories('show_count=1&taxonomy=catporto&title_li=&orderby=count&order=DESC'); ?>
              </ul>
            </div>
          <?php }?>
      </div>
      <div class="four-sixth last">
        <div class="content-text">
          <?php the_content(''); ?>
        </div>
      </div>
    </div>
    
  </article>
  <?php endwhile; ?>
  <?php endif; ?>
</div>
