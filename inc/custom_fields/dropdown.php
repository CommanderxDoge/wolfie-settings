<?php
wp_enqueue_style('wolfie-settings-css');
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$name = $this->settings.'['.$name.']';
echo '<div class="wolfie-form-control">';
echo '<label>'.$label;
echo '<select style="max-width:220px;width:100%;" type="select" name="'.$name.'" value="'.$value.'">';
if(!empty($options)) {
	if(array_keys($options) !== range(0, count($options) - 1)) { //check if array is associative
		foreach($options as $label => $selectVal ) {
			if( $value == $selectVal ) {
				echo '<option value="'.$selectVal.'" selected >' . $label . '</option>';
			} else {
				echo '<option value="'.$selectVal.'" >' . $label . '</option>';
			}
		}
	} else { //not associative
		foreach($options as $label ) {
			if( $value == $label ) {
				echo '<option value="'.$label.'" selected >' . $label . '</option>';
			} else {
				echo '<option value="'.$label.'" >' . $label . '</option>';
			}
		}
	}
}
echo '</select>';
echo '</label>';
echo '</div>';
$content = ob_get_clean();