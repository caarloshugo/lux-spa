<?php 

$serviceOrder = $this['config']->get('serviceOrder'); 

if ($serviceOrder == '1') {
  $orderby = 'date';
  $sorting = '';
}
elseif ($serviceOrder == '2') {
  $orderby = 'modified';
  $sorting = '';
}
elseif ($serviceOrder == '3') {
  $orderby = 'title';
  $sorting = 'ASC';
}
elseif ($serviceOrder == '4') {
  $orderby = 'title';
  $sorting = 'DESC';
}

else {
  $orderby = 'rand';
  $sorting = '';
}
?>
<div id="system" class="service">
    
    <article class="item" data-permalink="<?php the_permalink(); ?>">
    
      <header>
    
        <h1 class="title"><?php the_title(); ?></h1>

      </header>


<div class="home-service">
          <div class="nspArts bottom" style="width: 100%">
          <div class="nspArtPage">
    <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
         query_posts("post_type=service&showposts=50&orderby=" .$orderby. "&order=" .$order. "&paged= $paged"); ?>
     
    <?php $k=1;while(have_posts()) : the_post(); ?>
   
    <div class="nspArt nspCol5" style="padding:0 10px 0px 10px;">
          <div class="nspArtWrapper">
            <h4 class="nspHeader tcenter fnone"><a href="<?php the_permalink() ?>" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a></h4>
            <!-- Begin Thumb Container -->
            <div class="center tcenter fleft gkResponsive">
            <a href="<?php the_permalink() ?>" class="nspImageWrapper tcenter fleft gkResponsive" style="margin:6px 7px 15px 7px;"><img class="nspImage" src="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' ); echo $src[0]; ?>" alt="<?php the_title(); ?>" /></a></div>
            <!-- End Thumb Container -->
            <p class="nspText tcenter fleft"><?php echo substr(get_the_excerpt(), 0,70); ?>...</p>
          </div>
        </div>
    
    <?php
    if($k%5==0)
      echo '<div class="clearfix"></div>';
    $k++;
  ?>
    
    <?php endwhile; ?>
    

  </div>
        </div>
        </div>

</article>

    

</div>
