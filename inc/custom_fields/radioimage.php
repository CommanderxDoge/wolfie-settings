<?php 
wp_enqueue_style('wolfie-settings-css');
wp_enqueue_script('wolfie-radioimage-js');
ob_start();
echo '<div class="wolfie-form-control">';
echo '<label>' .$label. '</label>';
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$name = $this->settings.'['.$name.']';
$count = 0;
echo '<div class="radioimage-holder">';
if(!empty($options)) {
	foreach($options as $option ) {
		if( $count == $value ) {
			echo '<div class="radioimage option-'.$count.' active">';
			echo '<img src="'. $option['image'] . '">';
			echo '<div class="title-wrapper">';
			echo '<input type="radio" name="'.$name.'" value="'.$count.'" checked > '. $option['label'] . '<br>';
			echo '</div>';
			echo '</div>';
		} else {
			echo '<div class="radioimage option-'.$count.'">';
			echo '<img src="'. $option['image'] . '">';
			echo '<div class="title-wrapper">';
			echo '<input type="radio" name="'.$name.'" value="'.$count.'">'.$option['label'].'<br>';
			echo '</div>';
			echo '</div>';
		}
		$count++;
	} 
} else {
	echo 'ERROR: Add some options to your radioimage!';
} 
echo '</div>';
echo '</div>';
$content = ob_get_clean();