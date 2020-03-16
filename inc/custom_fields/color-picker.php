<?php
wp_enqueue_script('wolfie-colorpicker-alpha-js');
wp_enqueue_style('wolfie-settings-css');
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
echo '<div class="wolfie-form-control">';
echo '<label>'.$label.'</label>';
echo '<input class="colorpicker" data-alpha="true" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text">';
echo '</div>';
$content = ob_get_clean();
