<?php
if(!function_exists('is_fields')){
	function is_fields($args) {
		if( !empty($args['custom_fields'])) {
			$customFields = $args['custom_fields'];
			return $customFields;
		} else {
			return false;
		}
	}
}
if(!function_exists('is_tabs')){
	function is_tabs($args){
		if(!isset($args['tabs']) || $args['tabs'] !== false) {
			return true;
		} else {
			return false;
		}
	}
}
if(!function_exists('unifyString')) {
	function unifyString($content){
		return $content = str_replace(' ', '_', (strtolower($content)));
	}
}