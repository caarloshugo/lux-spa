<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get template configuration
include($this['path']->path('layouts:template.config.php'));

$template_path = get_template_directory_uri();

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">

<head>
<?php echo $this['template']->render('head'); ?>
</head>

<body id="page" class="page <?php echo $this['config']->get('body_classes'); ?>" data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

	<?php if ($this['modules']->count('absolute')) : ?>
	<div id="absolute">
		<?php echo $this['modules']->render('absolute'); ?>
	</div>
	<?php endif; ?>
<div class="header-wrapper">	
<div class="header-shadow">
	<div class="wrapper clearfix">

		<header id="header">

			<?php if ($this['modules']->count('toolbar-l + toolbar-r') || $this['config']->get('date')) : ?>
			<div id="toolbar" class="clearfix">

				<?php if ($this['modules']->count('toolbar-l') || $this['config']->get('date')) : ?>
				<div class="float-left">
				
					<?php if ($this['config']->get('date')) : ?>
					<time datetime="<?php echo $this['config']->get('datetime'); ?>"><?php echo $this['config']->get('actual_date'); ?></time>
					<?php endif; ?>
				
					<?php echo $this['modules']->render('toolbar-l'); ?>
					
				</div>
				<?php endif; ?>
					
				<?php if ($this['modules']->count('toolbar-r')) : ?>
				<div class="float-right"><?php echo $this['modules']->render('toolbar-r'); ?></div>
				<?php endif; ?>
				
			</div>
			<?php endif; ?>

			<?php if ($this['modules']->count('logo + headerbar + menu')) : ?>	
			<div id="headerbar" class="clearfix">
			
				<?php if ($this['modules']->count('logo')) : ?>	
				<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>
				<?php endif; ?>
                
                <?php if ($this['modules']->count('menu')) : ?>
                <div id="menubar" class="clearfix">
                    
                    <?php if ($this['modules']->count('menu')) : ?>
                    <nav id="menu"><?php echo $this['modules']->render('menu'); ?></nav>
                    <?php endif; ?>
                    
                </div>
                <?php endif; ?>
                
				
				<?php if($this['modules']->count('headerbar')) : ?>
				<?php echo $this['modules']->render('headerbar'); ?>
				<?php endif; ?>
				
			</div>
			<?php endif; ?>

			
            
          	<?php if ($this['modules']->count('slider')) : ?>
            <div class="slider-shadow">
            <section id="slider" class="grid-block"><?php echo $this['modules']->render('slider', array('layout'=>$this['config']->get('slider'))); ?></section>
            <img src="<?php echo $template_path; ?>/images/shadows/shadow5.png" style="width: 105%; height: auto; margin-left: -2.5%;" alt="Slider Shadow" />
            </div>
           
            <?php endif; ?>  
            
          
		
			<?php if ($this['modules']->count('banner')) : ?>
			<div id="banner"><?php echo $this['modules']->render('banner'); ?></div>
			<?php endif; ?>
		
		</header>
        
 </div>
 </div>
 </div>
 
 <div class="body-wrapper">
 <div class="wrapper clearfix">
 		
        <?php if ($this['modules']->count('slider')) : ?>
        
        <div class="slider-position">
            </div>
            
        <?php endif; ?> 

		<?php if ($this['modules']->count('top-a')) : ?>
		<section id="top-a" class="grid-block"><?php echo $this['modules']->render('top-a', array('layout'=>$this['config']->get('top-a'))); ?></section>
		<?php endif; ?>
		
		<?php if ($this['modules']->count('top-b')) : ?>
		<section id="top-b" class="grid-block"><?php echo $this['modules']->render('top-b', array('layout'=>$this['config']->get('top-b'))); ?></section>
		<?php endif; ?>
        
        <?php if ($this['modules']->count('services')) : ?>
		<section id="services" class="grid-block"><?php echo $this['modules']->render('services', array('layout'=>$this['config']->get('services'))); ?></section>
		<?php endif; ?>
        
		
		<?php if ($this['modules']->count('innertop + innerbottom + sidebar-a + sidebar-b + search') || $this['config']->get('system_output')) : ?>
		<div id="main" class="grid-block">

			<div id="maininner" class="grid-box">

				<?php if ($this['modules']->count('innertop')) : ?>
				<section id="innertop" class="grid-block"><?php echo $this['modules']->render('innertop', array('layout'=>$this['config']->get('innertop'))); ?></section>

				<?php endif; ?>

				<?php if ($this['modules']->count('breadcrumbs')) : ?>
				<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
				<?php endif; ?>
                
                <?php if ($this['modules']->count('search')) : ?>
				<div id="search"><?php echo $this['modules']->render('search'); ?></div>
				<?php endif; ?>

				<?php if ($this['config']->get('system_output')) : ?>
				<section id="content" class="grid-block"><?php echo $this['template']->render('content'); ?></section>
				<?php endif; ?>

				<?php if ($this['modules']->count('innerbottom')) : ?>
				<section id="innerbottom" class="grid-block"><?php echo $this['modules']->render('innerbottom', array('layout'=>$this['config']->get('innerbottom'))); ?></section>
				<?php endif; ?>

			</div>
			<!-- maininner end -->
			
			<?php if ($this['modules']->count('sidebar-a')) : ?>
			<aside id="sidebar-a" class="grid-box"><?php echo $this['modules']->render('sidebar-a', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>
			
			<?php if ($this['modules']->count('sidebar-b')) : ?>
			<aside id="sidebar-b" class="grid-box"><?php echo $this['modules']->render('sidebar-b', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		<!-- main end -->

		<?php if ($this['modules']->count('bottom-a')) : ?>
		<section id="bottom-a" class="grid-block"><?php echo $this['modules']->render('bottom-a', array('layout'=>$this['config']->get('bottom-a'))); ?></section>
		<?php endif; ?>
		
		<?php if ($this['modules']->count('appointment')) : ?>
		<section id="appointment" class="grid-block"><?php echo $this['modules']->render('appointment', array('layout'=>$this['config']->get('appointment'))); ?></section>
		<?php endif; ?>
</div>
</div>

<div class="footer-wrapper">
<div class="footer-shadow">
 <div class="wrapper clearfix">
	<section id="bottom-b" class="grid-block">
		<div class="grid-box width25 grid-h">
			<div class="module mod-box  deepest">
				<div class="module-title-wrapper">
					<h3 class="module-title"><span class="color">CONTACT</span> US</h3>
				</div>
				
				<p><i class="icon-home"></i> 46/1 west malibagh, Dhaka, Bangladesh</p>
				<p><i class="icon-th"></i> +880-1718-542596</p>
				<p><i class="icon-envelope"></i> <a href="mailto:info@yourdomain.com">info@yourdomain.com</a></p>
				<p><i class="icon-globe"></i>  <a href="http://www.bdtheme.com">www.yoursite.com</a></p>
			</div>
		</div>
		
		<div class="grid-box width25 grid-h">
			<div class="module mod-box  deepest">
				<div class="module-title-wrapper">
					<h3 class="module-title"><span class="color">WE&#8217;RE</span> OPEN</h3>
				</div>
				<p>
					<i class="icon-calendar"></i> Tuesday and Thursday<br /> 
					<i class="icon-time"></i> 9:00am - 7:00pm
				</p>
				
				<p>
					<i class="icon-calendar"></i> Wednesday and Friday<br /> 
					<i class="icon-time"></i> 10:30am - 8:00pm
				</p>
				
				<p>
					<i class="icon-calendar"></i> Saturday<br /> 
					<i class="icon-time"></i> 10:30am - 2:00pm
				</p>		
			</div>
		</div>
		
		<div class="grid-box width25 grid-h">
			<div class="module mod-box  deepest">
				<div class="module-title-wrapper">
					<h3 class="module-title"><span class="color">ABOUT</span> US</h3>
				</div>
				<p><i class="icon-leaf"></i> Sed sed eros nulla. In fermentum turpis quis sem mollis tempor. Nulla mollis, lorem vel commodo dignissim, sapien purus consectetur sapien, sit amet pellentesque enim lectus</p>		
			</div>
		</div>
		
		<div class="grid-box width25 grid-h">
			<div class="module mod-box  deepest">
				<div class="module-title-wrapper">
					<h3 class="module-title"><span class="color">FOOTER</span> MENU</h3>
				</div>
				<ul class="menu menu-sidebar">
					<li class="level1 item907">
						<a href="http://demo.bdtheme.com/wordpress/beautysalon/news/" class="level1"><span>Latest News</span></a>
					</li>
					
					<li class="level1 item909">
						<a href="http://demo.bdtheme.com/wordpress/beautysalon/photo-gallery/" class="level1"><span>Photo Gallery</span></a>
					</li>
					
					<li class="level1 item923">
						<a href="http://demo.bdtheme.com/wordpress/beautysalon/client-testimonials/" class="level1"><span>Client Testimonials</span></a>
					</li>
					
					<li class="level1 item957">
						<a href="http://demo.bdtheme.com/wordpress/beautysalon/category/shortcodes/" class="level1"><span>Shortcodes</span></a></li><li class="level1 item958"><a href="http://demo.bdtheme.com/wordpress/beautysalon/typography-2/" class="level1"><span>Template Typography</span></a>
					</li>
				</ul>		
			</div>
		</div>
	</section>	
		
		<?php if ($this['modules']->count('footer + debug') || $this['config']->get('warp_branding') || $this['config']->get('totop_scroller')) : ?>
		<footer id="footer">

			<?php if ($this['config']->get('totop_scroller')) : ?>
			<a id="totop-scroller" href="#page"></a>
			<?php endif; ?>

			<?php
				echo $this['modules']->render('footer');
				$this->output('warp_branding');
				echo $this['modules']->render('debug');
			?>

		</footer>
		<?php endif; ?>

	</div>
	
    </div>
    </div>
    
	<?php echo $this->render('footer'); ?>
    
    <script type="text/javascript" src="<?php echo $template_path;?>/lib/shadows.php?template_dir=<?php echo urlencode($template_path) ?>"></script>
	
</body>
</html>

