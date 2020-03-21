<?php
wp_enqueue_style('wolfie-settings-css');
wp_enqueue_script('wolfie-switcher-js');
ob_start();
$name = (isset($name)) ? $name : '';
$nameInline = (isset($name)) ? 'name="'.$this->settings.'['.$name.']"' : '' ;
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$value = (isset($groupVal)) ? $groupVal : $value ;
$switch_off = $value;
echo '<div class="wolfie-form-control">';
echo '<label>'.$label;
echo '</label>';
if(isset($switch_off) && $switch_off === 'off') {
	echo '<label class="switch">';
	echo '<input class="checkbox" '.$nameInline.' type="checkbox">';
	echo '<span class="slider round"></span>';
	echo '</label>';
} else  {
	echo '<label class="switch active">';
	echo '<input class="checkbox" '.$nameInline.' type="checkbox" checked>';
	echo '<span class="slider round"></span>';
	echo '</label>';
}
echo '</div>';
$content = ob_get_clean();
if($print === true) {
    echo $content;
}