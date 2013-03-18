<?php 

// Include WordPress Core Functions
$wp_include = '../wp-load.php';
while(!@include_once($wp_include)) { $wp_include = '../'.$wp_include; }

$shortcode_css = get_bloginfo('stylesheet_url');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  
  <head>
  </head>
  
  <body>
  
    <div id="scn-dialog">
    
      <div id="scn-options">
        <h3>Customize the Shortcode</h3>
      	<table id="scn-options-table">
      	</table>
      	<div style="float: left">
    	    <input type="button" id="scn-btn-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
      	</div>
      	<div style="float: right">
    	    <input type="button" id="scn-btn-preview" class="button" name="preview" value="Preview" accesskey="P" />
    	    <input type="button" id="scn-btn-insert" class="button-primary" name="insert" value="Insert" accesskey="I" />
      	</div>
      </div>
      
      <div id="scn-preview" style="float:left;">
        <h3>Preview</h3>
        <iframe id="scn-preview-iframe" frameborder="0" style="width:100%;height:250px" ></iframe>   
      </div>
      
      <script src="<?php echo (get_template_directory_uri()) ?>/lib/shortcode_editor/tinymce/js/column-control.js" type="text/javascript"></script>
      
      <script src="<?php echo (get_template_directory_uri()) ?>/lib/shortcode_editor/tinymce/js/dialog.js" type="text/javascript"></script>
    
    </div>
    
  </body>
  
</html>
