<?php
wp_enqueue_script('wolfie-colorpicker-alpha-js');
wp_enqueue_script('wolfie-colorpicker-init');
wp_enqueue_style('wolfie-settings-css');
$name = (isset($name)) ? $name : '';
$nameInline = (isset($name)) ? 'name="'.$this->settings.'['.$name.']"' : '' ;
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$value = (isset($groupVal)) ? $groupVal : $value ;
ob_start();
echo '<div class="wolfie-form-control">';
echo '<label>'.$label.'</label>';
echo '<input class="colorpicker" data-alpha="true" '.$nameInline.' value="'.$value.'" type="text">';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
    echo $content;
}
