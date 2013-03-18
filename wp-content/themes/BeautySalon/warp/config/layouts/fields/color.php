<?php
/**
* @package   Warp Theme Framework
* @author    bdthemes
* @copyright Copyright (C) BDThemes Ltd
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

printf('<input class="color" %s />', $control->attributes(array_merge($node->attr(), array('type' => 'text', 'name' => $name, 'value' => $value)), array('label', 'description', 'default')));
