<?php
/**
* @package   Warp Theme Framework
* @author    bdthemes
* @copyright Copyright (C) BDThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
$thispath=dirname(__FILE__).'/google-fonts.json';
$fh = fopen($thispath, 'r');
$jsonFile = fread($fh, filesize($thispath));
fclose($fh);
$jsonData=json_decode($jsonFile);
$fonts=$jsonData->items;

printf('<select %s>', $control->attributes(compact('name')));
//static font

printf('<optgroup label="Standard Fonts">
<option value="Arial">Arial</option>
<option value="Geneva">Geneva</option>
<option value="Georgia">Georgia</option>
<option value="Lucida">Lucida</option>
<option value="Optima">Optima</option>
<option value="Palatino">Palatino</option>
<option value="Trebuchet">Trebuchet</option>
</optgroup>');
printf('<optgroup label="Google Fonts">');

foreach ($fonts as $gfont) {

	// set attributes
	$attributes = array('value' => $gfont->family);

	// is checked ?
	if ($gfont->family == $value) {
		$attributes = array_merge($attributes, array('selected' => 'selected'));
	}
	printf('<option %s>%s</option>', $control->attributes($attributes),$gfont->family);
}

printf('</optgroup>');

printf('</select>');