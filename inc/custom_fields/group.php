<?php
wp_enqueue_script('wolfie-group-js');
wp_enqueue_style('wolfie-icons');
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$value = json_decode($value);
$name = $this->settings.'['.$name.']';
ob_start();
echo '<div class="wolfie-form-control">';
echo '<div class="wolfie-group">';
echo '<label>'.$label.'</label>';
echo '<textarea style="width:100%;height:120px;" class="container" name="'.$name.'" value="'.$value.'"></textarea>';
echo '<div class="wolfie-group-holder">';
echo '<div class="wolfie-actions"><i class="wolfie-add sl-plus"></i><i class="wolfie-remove sl-close"></i></div>';
if(is_array($fields)){
	foreach($fields as $index => $field) {
		if($field['type']){
		echo '<div class="wolfie-col col-6">';
			if($field['type'] === 'text'){
				$this->textPicker(null,'Add Url to icon',true);
			} elseif($field['type'] === 'icon') {
				$this->iconPicker(null, $field['desc'], null, true);
			} elseif($field['type'] === 'editor') {
				$this->editor(null, $field['desc'], true);
			} elseif($field['type'] === 'gallery') {
				$this->galleryPicker(null, $field['desc'], true);
			}
		echo '</div>';
		}
	}
}
echo '</div>';
echo '</div>';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
	echo $content;
}
