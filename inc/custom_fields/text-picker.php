<?php
wp_enqueue_style('wolfie-settings-css');
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
echo '<div class="wolfie-form-control">';
echo '<label>'.$label;
echo '<input class="text" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text">';
echo '</label>';
echo '</div>';
$content = ob_get_clean();