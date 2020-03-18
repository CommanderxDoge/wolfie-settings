<?php
wp_enqueue_style('wolfie-settings-css');
$name = (isset($name)) ? 'name="'.$this->settings.'['.$name.']"' : '' ;
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
echo '<div class="wolfie-form-control">';
echo '<label>'.$label;
echo '<input class="text" '.$name.' value="'.$value.'" type="text">';
echo '</label>';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
	echo $content;
}