<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

wp_footer();

//custom javascript
echo '<script type="text/javascript">' ;
echo $this['config']->get('custom_js');
echo '</script>';

// output tracking code
echo $this['config']->get('tracking_code');

