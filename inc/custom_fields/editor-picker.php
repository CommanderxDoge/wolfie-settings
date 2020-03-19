<?php
wp_enqueue_style('wolfie-settings-css');
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$textarea_name = (isset($name)) ? $this->settings.'['.$name.']' : '' ;
$name = (isset($name)) ? $name : 'repeater';
echo '<div class="wolfie-form-control">';
echo '<label>'.$label;
wp_editor( $value, $name, array(
	'wpautop'       => true,
	'media_buttons' => false,
	'textarea_name' => $textarea_name,
	'textarea_rows' => 5,
	'teeny'         => true
) );
echo '</label>';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
    echo $content;
}