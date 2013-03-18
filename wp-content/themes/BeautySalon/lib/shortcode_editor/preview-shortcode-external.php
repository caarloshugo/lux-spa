<?php
  // Include WordPress Core Functions
  $wp_include = '../wp-load.php';
  while(!@include_once($wp_include)) { $wp_include = '../'.$wp_include; }
  
  // Include Stylesheet
  $shortcode_css = get_bloginfo('stylesheet_url');
?>

<html>

  <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" ></script>
    <link rel="stylesheet" href="<?php echo $shortcode_css; ?>">
    <?php //echo bdt_get_option_css_code(); ?>
  </head>
  <body>
  
    <?php
      $shortcode = isset($_REQUEST['shortcode']) ? $_REQUEST['shortcode'] : '';
      
      // WordPress automatically adds slashes to quotes
      // http://stackoverflow.com/questions/3812128/although-magic-quotes-are-turned-off-still-escaped-strings
      $shortcode = stripslashes($shortcode);
      
      echo do_shortcode($shortcode);
    ?>
    
    <script type="text/javascript">
      jQuery('#scn-preview h3:first', window.parent.document).removeClass('scn-loading');
    </script>
    
  </body>
  
</html>
