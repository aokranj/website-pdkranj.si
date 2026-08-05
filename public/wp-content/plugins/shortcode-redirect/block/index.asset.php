<?php
return array(
	'dependencies' => array(
		'wp-blocks',
		'wp-block-editor',
		'wp-components',
		'wp-element',
		'wp-i18n',
	),
	'version' => defined('SCR_VERSION') ? SCR_VERSION : filemtime(__FILE__),
);
