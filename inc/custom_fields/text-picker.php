<?php
wp_enqueue_style('wolfie-settings-css');
$name = (isset($name)) ? $name : '';
$nameInline = (isset($name)) ? 'name="'.$this->settings.'['.$name.']"' : '' ;
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$value = (isset($groupVal)) ? $groupVal : $value ;
ob_start();
echo '<div class="wolfie-form-control">';
echo '<label>'.$label.'</label>';
echo '<input class="text" '.$nameInline.' value="'.$value.'" type="text">';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
	echo $content;
}