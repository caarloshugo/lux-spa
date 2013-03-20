<?php

/* Get Shortcode UnAutop
------------------------------------------------------------ */
if(!function_exists("bdt_get_shortcode_unautop"))
{
	function bdt_get_shortcode_unautop($content) {
		$content = do_shortcode(shortcode_unautop($content));
		$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);
		return $content;
	}
}



/* AJAX Contact Form
------------------------------------------------------------ */

if(!function_exists('sc_ajax_contact_form'))
{
  function sc_ajax_contact_form($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'email'           => get_option('admin_email'),
      'email_signature' => "This E-Mail was sent through the contact form on your website %s.", get_option('blogname'),
      'success_msg'     => 'The message was sent successfully',
      'error_msg'       => 'Please fill in all fields correctly'
    ), $atts));
    
    if(!$email) $email = get_option('admin_email');
    $email = str_replace('@', '[at]', $email);
    
    return '
    
      <form id="contactform" class="three-column-form" method="post" action="'.TEMPLATEURL.'/contact_form_mailer.php">
      	<input type="hidden" id="receiver" name="cf_receiver" value="'.$email.'" />
      	<input type="hidden" id="email_signature" name="cf_email_signature" value="'.$email_signature.'" />
      	<input type="hidden" id="success_msg" name="cf_success_msg" value="'.$success_msg.'" />
      	<input type="hidden" id="error_msg" name="cf_error_msg" value="'.$error_msg.'" />
      	
      	<p class="one-third">
      	  <label for="subject">Message Subject*:</label>
      	  <input id="subject" name="cf_subject" class="required" type="text" />
      	</p>
      	
      	<p class="one-third">
      	  <label for="name">Your Name*:</label>
      	  <input id="name" name="cf_name" class="required" type="text" />
      	</p>
      	
      	<p class="one-third last">
      	  <label for="email">E-Mail Address*:</label>
      	  <input id="email" name="email" class="required" type="text" />
      	</p>
                
      	<p>
			<label for="email">Your Message*:</label>
    	  <textarea id="message" name="cf_message" class="required" cols="40" rows="8" placeholder="Your message here*"></textarea>
      	</p>
        <div class="message"></div>
        
      	<p>
  			<input type="submit" name="submit" value="Send Message" />
          <span class="spinner"><span>Please wait...</span></span>
      	</p>
      </form>
    
    ';
  }
}

if(function_exists('sc_ajax_contact_form'))
{
  add_shortcode('ajax_contact_form', 'sc_ajax_contact_form');
}



/* Blockquote
------------------------------------------------------------ */

if(!function_exists('sc_blockquote'))
{
  function sc_blockquote($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'source' => '',
      'align'  => ''
    ), $atts));
    
    $class = '';
    if($source) $source = "<p class='source'>&mdash; $source</p>";
    else        $class .= "no-source ";
    if($align)  $class .= "align{$align} ";
    else        $class .= "no-align ";
    
  	return "<blockquote class='{$class}'><p>".do_shortcode($content)."</p>$source</blockquote>";
  }
}

if(function_exists('sc_blockquote'))
{
  add_shortcode('blockquote', 'sc_blockquote');
}



/* Box
------------------------------------------------------------ */

if(!function_exists('sc_box'))
{
  function sc_box($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'title'          => '',
      'inner_padding'  => '',
      'with_bg'        => '',
      'centered_title' => ''
    ), $atts));
    
    $box_class = '';
    $box_header_class = '';
    
    if($inner_padding)     $box_class.= $inner_padding.'-inner-padding ';
    if($with_bg == 'true') $box_class.= 'with-bg ';
    $box_class.= ($title) ? 'with-header ' : 'no-header ';
    
    if($centered_title == 'true') $box_header_class.= 'center ';
    
    $output = "<div class='box $box_class'>";
    if($title)
      $output.= "<div class='box-header $box_header_class'><strong>$title</strong></div>";
    
    $output.= "<div class='box-content'>".wpautop(bdt_get_shortcode_unautop($content))."</div>";
    $output.= '</div>';
    
    return $output;
  }
}

if(function_exists('sc_box'))
{
  add_shortcode('box', 'sc_box');
}



/* Button
------------------------------------------------------------ */

if(!function_exists('sc_button'))
{
  function sc_button($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'size'  => '',
      'link'  => '',
      'class' => '',
      'open_new_tab' => ''
    ), $atts));
    
    $link = ($link) ? "href='$link'" : '';
    $open_new_tab = ($open_new_tab == 'true') ? 'target="_blank"' : '';
    
    $output = "<a class='button $size $class' $link $open_new_tab>";
    $output.= bdt_get_shortcode_unautop($content);
    $output.= '</a>';
    
    return $output;
  }
}

if(function_exists('sc_button'))
{
  add_shortcode('button', 'sc_button');
}



/* Column
------------------------------------------------------------ */

if(!function_exists('sc_column'))
{
  function sc_column($atts, $content = null, $sc_name = '') {
    $last = '';
  	if(isset($atts[0]) && trim($atts[0]) == 'last')
  	  $last = 'last';
  	
    $class  = str_replace('_', '-', $sc_name);
    $output = '<div class="'.$class.' '.$last.'">'.wpautop(bdt_get_shortcode_unautop($content)).'</div>';
    
    if(!empty($last))
      $output.= do_shortcode('[divider]');
    
    return $output;
  }
}

if(function_exists('sc_column'))
{
  $column_shortcodes = array('one_half',   'one_third', 'two_third', 'three_fourth',
                             'one_fourth', 'one_fifth', 'two_fifth', 'three_fifth',
                             'four_fifth', 'one_sixth', 'two_sixth', 'three_sixth',
                             'four_sixth', 'five_sixth');
  
  foreach($column_shortcodes as $column_shortcode) {
    add_shortcode($column_shortcode, 'sc_column');
  }
}




/* Dividers / Spacers / Rulers
------------------------------------------------------------ */

if(!function_exists('sc_divider'))
{
  function sc_divider($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array('size' => ''), $atts));
    return bdt_get_shortcode_unautop("<span class='{$sc_name} {$size}'></span>");
  }
}

if(function_exists('sc_divider'))
{
  add_shortcode('divider', 'sc_divider');
  add_shortcode('hr',      'sc_divider');
  add_shortcode('spacer',  'sc_divider');
}



/* Dropcap
------------------------------------------------------------ */

if(!function_exists('sc_dropcap'))
{
  function sc_dropcap($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'style'   => '',
      'colored' => ''
    ), $atts));
    
    if($style) $style = "-$style";
    $colored = ($colored == 'true') ? 'colored' : '';
    
  	return "<span class='dropcap{$style} {$colored}'>".do_shortcode($content).'</span>';
  }
}

if(function_exists('sc_dropcap'))
{
  add_shortcode('dropcap', 'sc_dropcap');
}



/* Heading
------------------------------------------------------------ */

if(!function_exists('sc_heading'))
{
  function sc_heading($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'type'              => 'h2',
      'underlined'        => '',
      'no_top_padding'    => '',
      'no_bottom_padding' => ''
    ), $atts));
    
    if(!$type) $type = 'h2';
    
    $class = ($underlined        == 'true') ? 'underlined ' : '';
    $class.= ($no_top_padding    == 'true') ? 'top '        : '';
    $class.= ($no_bottom_padding == 'true') ? 'bottom '     : '';
    
  	return "<$type class='$class'>".do_shortcode($content)."</$type>";
  }
}

if(function_exists('sc_heading'))
{
  add_shortcode('heading', 'sc_heading');
}



/* Hightlight
------------------------------------------------------------ */

if(!function_exists('sc_highlight'))
{
  function sc_highlight($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array('style' => ''), $atts));
    return "<span class='highlight $style'>".do_shortcode($content)."</span>";
  }
}

if(function_exists('sc_highlight'))
{
  add_shortcode('highlight', 'sc_highlight');
}



/* Icon Text
------------------------------------------------------------ */

if(!function_exists('sc_icon_text'))
{
  function sc_icon_text($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'icon' => '',
      'custom_icon' => '',
      'icon_position' => 'left',
      'box' => ''
    ), $atts));
    
    $icon_url = ($custom_icon) ? $custom_icon : IMAGES_URL."/text_icons/{$icon}";
    $icon_position = 'icon-'.$icon_position;
    $box = ($box == 'true') ? true : false;
    
    $output = "<div class='icon-text {$icon_position}'>";
    if($icon_position == 'icon-top') {
      $output.= "<div class='icon' style='background-image: url({$icon_url});'></div>";
    }
    else {
      $output.= "<span class='icon'><img src='{$icon_url}' alt='' /></span>";
    }
    $output.= '<div class="content">'.do_shortcode($content).'</div>';
    $output.= '</div>';
    
    if($box) {
      $output = do_shortcode('[box inner_padding="smaller"]'.$output.'[/box]');
    }
    
    return $output;
  }
}

if(function_exists('sc_icon_text'))
{
  add_shortcode('icon_text', 'sc_icon_text');
}




/* Notification
------------------------------------------------------------ */

if(!function_exists('sc_info_box'))
{
  function sc_info_box($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'style' => 'note',
      'icon'  => ''
    ), $atts));
    
    $class = '';
    
    if    ($icon == 'none') $class = 'no-icon';
    elseif($icon)           $icon  = "style='background-image: url($icon);'";
    
    return "<p class='info-box {$style} {$class}' {$icon}>".do_shortcode($content)."</p>";
  }
}

if(function_exists('sc_info_box'))
{
  add_shortcode('info_box', 'sc_info_box');
}



/* List
------------------------------------------------------------ */

if(!function_exists('sc_list'))
{
  function sc_list($atts, $content = null, $sc_name = '') {
  	return str_replace('<ul>', '<ul class="'.$sc_name.'">', bdt_get_shortcode_unautop($content));
  }
}

if(function_exists('sc_list'))
{ 
  add_shortcode('circle-large',  'sc_list');
  add_shortcode('triangle-large',  'sc_list');
  add_shortcode('checkmark', 'sc_list');
  add_shortcode('circle-checkmark', 'sc_list');
  add_shortcode('square-checkmark', 'sc_list');
  add_shortcode('circle-small',  'sc_list');
  add_shortcode('circle',  'sc_list');
 
  add_shortcode('triangle-small',  'sc_list');
  add_shortcode('triangle',  'sc_list');
  
  add_shortcode('bullet',  'sc_list');
}



/* Inline Style
------------------------------------------------------------ */

if(!function_exists('sc_inline_style'))
{
  function sc_inline_style($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'text_size'  => '',
      'text_align' => '',
      'class'      => '',
      'style'      => ''
    ), $atts));
    
    $class = "class='text {$class} {$text_size} {$text_align}'";
    $style = ($style) ? "style='{$style}'" : '';
    
    return "<{$sc_name} {$class} {$style}>".bdt_get_shortcode_unautop($content)."</{$sc_name}>";
  }
}

if(function_exists('sc_inline_style'))
{
  add_shortcode('div',  'sc_inline_style');
  add_shortcode('span', 'sc_inline_style');
}



/* Table
------------------------------------------------------------ */

if(!function_exists('sc_table'))
{
  function sc_table($atts, $tblcontent = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'style' => 'default'
    ), $atts));
    
    return "<div class='table $style'>".bdt_get_shortcode_unautop($tblcontent)."</div>";
  }
}

if(function_exists('sc_table'))
{
  add_shortcode('table', 'sc_table');
}


/* Tab Group
------------------------------------------------------------ */

if(!function_exists('sc_tabgroup'))
{
  function sc_tabgroup($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'type'  => 'horizontal',
      'style' => 'default'
    ), $atts));
    
    $output = "<div class='tabgroup $type $style'>";
    $output.= bdt_get_shortcode_unautop($content);
    $output.= '</div>';
    
    return $output;
  }
}

if(function_exists('sc_tabgroup'))
{
  add_shortcode('tabgroup', 'sc_tabgroup');
}



/* Tab
------------------------------------------------------------ */

if(!function_exists('sc_tab'))
{
  function sc_tab($atts, $content = null, $sc_name ="")
  {   
    extract(shortcode_atts(array(
      'title'  => 'Title goes here',
      'active' => ''
    ), $atts));
    
    //$active = ($active == 'true') ? 'active' : '';
    
    $output = "<div class='tab'><strong>$title</strong></div>";
    $output.= "<div class='tab-content'>";
    $output.= wpautop(bdt_get_shortcode_unautop($content));
    $output.= '</div>';
  
    return $output;
  }
}

if(function_exists('sc_tab'))
{
  add_shortcode('tab', 'sc_tab');
}


/* Toggler Group
------------------------------------------------------------ */

if(!function_exists('sc_togglergroup'))
{
  function sc_togglergroup($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'accordion' => '',
      'style'     => 'default'
    ), $atts));
    
    $accordion = ($accordion == 'true') ? 'close-all' : '';
    
		$output = "<div class='togglergroup $accordion $style'>";
	 	$output.= bdt_get_shortcode_unautop($content);
		$output.= '</div>';
  
  	return $output;
  }
}

if(function_exists('sc_togglergroup'))
{
  add_shortcode('togglergroup', 'sc_togglergroup');
}



/* Toggler ------------------------------------------------------------ */

if(!function_exists('sc_toggler'))
{
  function sc_toggler($atts, $content = null, $sc_name = '') {
    extract(shortcode_atts(array(
      'title'  => 'Title goes here',
      'active' => ''
    ), $atts));
    
    $active = ($active == 'true') ? 'active' : '';
    
    $output = "<div class='toggler-wrapper'>";
  	$output.= "<div class='toggler $active'><strong>$title</strong></div>";
  	$output.= "<div class='toggler-content $active'>".wpautop(bdt_get_shortcode_unautop($content)).'</div>';
  	$output.= '</div>';
  
  	return $output;
  }
}

if(function_exists('sc_toggler'))
{
  add_shortcode('toggler', 'sc_toggler');
}


