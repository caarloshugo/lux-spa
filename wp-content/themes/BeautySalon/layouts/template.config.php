<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// include helper functions	
include_once(dirname(__FILE__).'/../lib/helper_functions.php');

// generate css for layout
$css[] = sprintf('.wrapper { max-width: %dpx; }', $this['config']->get('template_width'));


$css[] .= sprintf('body { color: '.$this['config']->get('body_color').'; }');
$css[] .= sprintf('.header-wrapper, .footer-wrapper, a.readon, a.button, .apbutton, button.button, input.button, input[type="submit"], .menu-dropdown > li.level1, .catItemBlog .catItemDateCreated, .itemBlogView .ItemDateCreated, .highlight, .dropcap-circle.colored, .dropcap-square.colored, .tagcloud a { background-color: '.$this['config']->get('baseColor').'; }');

$css[] .= sprintf('a, a.readon, a.link { color: '.$this['config']->get('baseColor').'; }');
$css[] .= sprintf('a:hover, a.readon:hover, a.link:hover { color: '.$this['config']->get('hoverColor').'; }');

$color = new Color($this['config']->get('baseColor'));

$css[] .= sprintf('button:hover,
a.button:hover,
a.readon:hover,
.apbutton:hover,
button.button:hover,
input.button:hover,
input[type="submit"]:hover { background-color: '.$color->lighten('15%').'; }');

if ($this['config']->get('zoomEffect') == '1') {
$css[] .= sprintf('.itemView span.itemImage img:hover, .catItemBlog span.catItemImage img:hover, ul.sig-container li.sig-block a:hover img.sig-image, a.animate img:hover, .servicePage .content-img img:hover, .staffPage .content-img img:hover {
	-moz-transform: scale(1.2) rotate(-8deg) translate(0px, 0px) skew(0deg, 0deg);
	-webkit-transform: scale(1.2) rotate(-8deg) translate(0px, 0px) skew(0deg, 0deg);
	-o-transform: scale(1.2) rotate(-8deg) translate(0px, 0px) skew(0deg, 0deg);
	-ms-transform: scale(1.2) rotate(-8deg) translate(0px, 0px) skew(0deg, 0deg);
	transform: scale(1.2) rotate(-8deg) translate(0px, 0px) skew(0deg, 0deg);
}');
}

$css[] .= sprintf('.menu-dropdown a.level1,
.menu-dropdown span.level1 { color: '.$color->lighten('35%').'; }');

$imgroundRGB = $this['config']->get('baseColor');

$css[] .= sprintf('.home-service .nspImageWrapper:hover,
.home-staff .nspImageWrapper:hover { box-shadow: 0 0 0 5px '. _RGBA($imgroundRGB, 0.8).'; }');


/* Set Hover */
$css[] .= sprintf('.menu-dropdown li.level1:hover .level1,
.menu-dropdown li.remain .level1  { color: '.$color->lighten('20%').'; }');

$menuRGB = $color->darken('35%');
$css[] .= sprintf('.menu-dropdown .dropdown-bg > div  { background: '. _RGBA($menuRGB, 0.8).'; }');


$css[] .= sprintf('span.userItemImage, span.tagItemImage, span.itemImage, span.catItemImage, .inputbox:hover, .inputbox:focus, input[type="text"]:hover, input[type="text"]:focus, input[type="password"]:hover, input[type="password"]:focus, input[type="email"]:hover, input[type="email"]:focus, textarea:hover, textarea:focus, body ul.circle-checkmark li:before, body ul.square-checkmark li:before, body ul.checkmark li:after, body ul.triangle-small li:after, body ul.triangle li:after, body ul.triangle-large li:after, body ul.circle-small li:after, body ul.circle li:after, body ul.circle-large li:after, .title1 .module-surround .module-border, .box6 .rt-block, ul.checkmark li:after, ul.circle-checkmark li:after, ul.square-checkmark li:after, ul.circle-small li:after, ul.circle li:after, ul.circle-large li:after, .tagcloud a:before  { border-color: '.$this['config']->get('baseColor').'; }');

$css[] .= sprintf('body  { background-color: '.$this['config']->get('baseColor').'; }');



// font family setup
$css[] .= sprintf('body , body p { font-family: '.$this['config']->get('bodyFont').'; }');
$css[] .= sprintf('h1,h2,h3,h4,h5,h6, .show-title, .wk-twitter-single .content { font-family: '.$this['config']->get('headerFont').'; }');
$css[] .= sprintf('.menu-dropdown a.level1, .menu-dropdown span.level1 { font-family: '.$this['config']->get('menuFont').'; }');


// generate css for 3-column-layout
$sidebar_a       = '';
$sidebar_b       = '';
$maininner_width = 100;
$sidebar_a_width = intval($this['config']->get('sidebar-a_width'));
$sidebar_b_width = intval($this['config']->get('sidebar-b_width'));
$sidebar_classes = "";
$rtl             = $this['config']->get('direction') == 'rtl';
$body_config	 = array();

// set widths
if ($this['modules']->count('sidebar-a')) {
	$sidebar_a = $this['config']->get('sidebar-a'); 
	$maininner_width -= $sidebar_a_width;
	$css[] = sprintf('#sidebar-a { width: %d%%; }', $sidebar_a_width);
}

if ($this['modules']->count('sidebar-b')) {
	$sidebar_b = $this['config']->get('sidebar-b'); 
	$maininner_width -= $sidebar_b_width;
	$css[] = sprintf('#sidebar-b { width: %d%%; }', $sidebar_b_width);
}

$css[] = sprintf('#maininner { width: %d%%; }', $maininner_width);

// all sidebars right
if (($sidebar_a == 'right' || !$sidebar_a) && ($sidebar_b == 'right' || !$sidebar_b)) {
	$sidebar_classes .= ($sidebar_a) ? 'sidebar-a-right ' : '';
	$sidebar_classes .= ($sidebar_b) ? 'sidebar-b-right ' : '';

// all sidebars left
} elseif (($sidebar_a == 'left' || !$sidebar_a) && ($sidebar_b == 'left' || !$sidebar_b)) {
	$sidebar_classes .= ($sidebar_a) ? 'sidebar-a-left ' : '';
	$sidebar_classes .= ($sidebar_b) ? 'sidebar-b-left ' : '';
	$css[] = sprintf('#maininner { float: %s; }', $rtl ? 'left' : 'right');

// sidebar-a left and sidebar-b right
} elseif ($sidebar_a == 'left') {
	$sidebar_classes .= 'sidebar-a-left sidebar-b-right ';
	$css[] = '#maininner, #sidebar-a { position: relative; }';
	$css[] = sprintf('#maininner { %s: %d%%; }', $rtl ? 'right' : 'left', $sidebar_a_width);
	$css[] = sprintf('#sidebar-a { %s: -%d%%; }', $rtl ? 'right' : 'left', $maininner_width);

// sidebar-b left and sidebar-a right
} elseif ($sidebar_b == 'left') {
	$sidebar_classes .= 'sidebar-a-right sidebar-b-left ';
	$css[] = '#maininner, #sidebar-a, #sidebar-b { position: relative; }';
	$css[] = sprintf('#maininner, #sidebar-a { %s: %d%%; }', $rtl ? 'right' : 'left', $sidebar_b_width);
	$css[] = sprintf('#sidebar-b { %s: -%d%%; }', $rtl ? 'right' : 'left', $maininner_width + $sidebar_a_width);
}

// number of sidebars
if ($sidebar_a && $sidebar_b) {
	$sidebar_classes .= 'sidebars-2 ';
} elseif ($sidebar_a || $sidebar_b) {
	$sidebar_classes .= 'sidebars-1 ';
}

// generate css for dropdown menu
foreach (array(1 => '.dropdown', 2 => '.columns2', 3 => '.columns3', 4 => '.columns4') as $i => $class) {
	$css[] = sprintf('#menu %s { width: %dpx; }', $class, $i * intval($this['config']->get('menu_width')));
}

// load css
$this['asset']->addFile('css', 'css:base.css');
$this['asset']->addFile('css', 'css:layout.css');
$this['asset']->addFile('css', 'css:menus.css');
$this['asset']->addString('css', implode("\n", $css));
$this['asset']->addFile('css', 'css:modules.css');
$this['asset']->addFile('css', 'css:tools.css');
$this['asset']->addFile('css', 'css:system.css');
$this['asset']->addFile('css', 'css:extensions.css');
$this['asset']->addFile('css', 'css:custom.css');
$this['asset']->addFile('css', 'css:shortcodes.css');
//if (($color = $this['config']->get('color1')) && $this['path']->path("css:/color1/$color.css")) { $this['asset']->addFile('css', "css:/color1/$color.css"); }
//if (($color = $this['config']->get('color2')) && $this['path']->path("css:/color2/$color.css")) { $this['asset']->addFile('css', "css:/color2/$color.css"); }

$this['asset']->addFile('css', 'css:style.css');
if ($this['config']->get('direction') == 'rtl') $this['asset']->addFile('css', 'css:rtl.css');
$this['asset']->addFile('css', 'css:responsive.css');
$this['asset']->addFile('css', 'css:print.css');
if (($typography = $this['config']->get('typography'))) { $this['asset']->addFile('css', "css:/typography.css"); }

//load google or device fonts
AddGoogleFont('bodyFont', $this);
AddGoogleFont('headerFont', $this);
AddGoogleFont('menuFont', $this);
GetGoogleFont($this);


// set body css classes
$body_classes  = $sidebar_classes.' ';
$body_classes .= $this['system']->isBlog() ? 'isblog ' : 'noblog ';
$body_classes .= $this['config']->get('page_class');

$this['config']->set('body_classes', $body_classes);

// add social buttons
$body_config['twitter'] = (int) $this['config']->get('twitter', 0);
$body_config['plusone'] = (int) $this['config']->get('plusone', 0);
$body_config['facebook'] = (int) $this['config']->get('facebook', 0);

$this['config']->set('body_config', json_encode($body_config));

// add javascripts
$this['asset']->addFile('js', 'js:warp.js');
$this['asset']->addFile('js', 'js:responsive.js');
$this['asset']->addFile('js', 'js:accordionmenu.js');
$this['asset']->addFile('js', 'js:dropdownmenu.js');

$this['asset']->addFile('js', 'js:validate.pack.js');
$this['asset']->addFile('js', 'js:form.js');
$this['asset']->addFile('js', 'js:tipsy.js');
$this['asset']->addFile('js', 'js:template.js');


// internet explorer
if ($this['useragent']->browser() == 'msie') {

	// add conditional comments
	$head[] = sprintf('<!--[if lte IE 8]><script src="%s"></script><![endif]-->', $this['path']->url('js:html5.js'));
	$head[] = sprintf('<!--[if IE 8]><link rel="stylesheet" href="%s" /><![endif]-->', $this['path']->url('css:ie8.css'));

}

// add $head
if (isset($head)) {
	$this['template']->set('head', implode("\n", $head));
}