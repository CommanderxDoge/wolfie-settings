<?php
wp_enqueue_style('wolfie-settings-css');
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
echo '<div class="wolfie-form-control">';
echo '<label>'.$label;
// echo '<input class="editor" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text">';
wp_editor( $value, $name, array(
	'wpautop'       => true,
	'media_buttons' => false,
	'textarea_name' => $this->settings.'['.$name.']',
	'textarea_rows' => 5,
	'teeny'         => true
) );
echo '</label>';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
    echo $content;
}