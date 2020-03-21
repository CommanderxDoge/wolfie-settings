<?php
wp_enqueue_script('wolfie-group-js');
wp_enqueue_style('wolfie-icons');
$originFields = $fields;
$maxFields = count($originFields);
$i = 0;
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$jsonDecoded = json_decode($value);
// var_dump( $json );
$name = $this->settings.'['.$name.']';
ob_start();
echo '<div class="wolfie-form-control">';
echo '<div class="wolfie-group">';
echo '<label>'.$label.'</label>';
echo '<textarea class="group-input" style="width:100%;height:120px;" class="" name="'.$name.'" hidden>'.$value.'</textarea>';
echo '<button class="save-group">Save group</button>';
//get description from fields
if(is_array($fields) && empty($jsonDecoded->fields) ){
	echo '<div class="wolfie-group-holder">';
	echo '<div class="wolfie-actions"><i class="wolfie-add sl-plus"></i><i class="wolfie-remove sl-close"></i></div>';
	foreach($fields as $index => $field) {
		if($field['type']){
			echo '<div class="wolfie-col col-6">';
			if($field['type'] === 'text'){
				echo '<div class="text-field">';
				$this->textPicker(null,$field['desc'],true);
				echo '</div>';
			} elseif($field['type'] === 'icon') {
				echo '<div class="icon-field">';
				$this->iconPicker(null, $field['desc'], null, true);
				echo '</div>';
			} elseif($field['type'] === 'editor') {
				echo '<div class="editor-field">';
				$this->editor(null, $field['desc'], true);
				echo '</div>';
			} elseif($field['type'] === 'gallery') {
				echo '<div class="gallery-field">';
				$this->galleryPicker(null, $field['desc'], true);
				echo '</div>';
			} elseif($field['type'] === 'image') {
				echo '<div class="image-field">';
				$this->imagePicker(null, $field['desc'], true);
				echo '</div>';
			} elseif($field['type'] === 'file') {
				echo '<div class="file-field">';
				$this->imagePicker(null, $field['desc'], true);
				echo '</div>';
			} elseif($field['type'] === 'dropdown') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="dropdown-field">';
				$this->dropdown(null, $field['desc'], $field['options'], true);
				echo '</div>';
				echo '</div>';
			} elseif($field['type'] === 'color') {
				echo '<div class="color-field">';
				$this->colorPicker(null, $field['desc'], true);
				echo '</div>';
			} elseif($field === 'check') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="check-field">';
				$this->checkbox(null, $field['desc'], null, true);
				echo '</div>';
				echo '</div>';
			}	
			echo '</div>';
		}
	}
	echo '</div>';
} elseif(!empty($jsonDecoded)) {
	foreach($jsonDecoded->fields as $index => $field) {
		$fields =  get_object_vars($field) ;
		echo '<div class="wolfie-group-holder">';
		echo '<div class="wolfie-actions"><i class="wolfie-add sl-plus"></i><i class="wolfie-remove sl-close"></i></div>';
		foreach ($fields as $key => $groupVal) {
			if($i == $maxFields) {
				$i = 0;
			} 
			if($key === 'text'){
				echo '<div class="wolfie-col col-6">';
				echo '<div class="text-field">';
				$this->textPicker(null,$originFields[$i]['desc'],true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'icon') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="icon-field">';
				$this->iconPicker(null, $originFields[$i]['desc'], null, true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'editor') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="editor-field">';
				$this->editor(null, $originFields[$i]['desc'], true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'gallery') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="gallery-field">';
				$this->galleryPicker(null, $originFields[$i]['desc'], true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'image') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="image-field">';
				$this->imagePicker(null, $originFields[$i]['desc'], true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'file') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="file-field">';
				$this->filePicker(null, $originFields[$i]['desc'], true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'color') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="color-field">';
				$this->colorPicker(null, $originFields[$i]['desc'], true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'check') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="check-field">';
				$this->checkbox(null, $originFields[$i]['desc'], null ,true, $groupVal);
				echo '</div>';
				echo '</div>';
			} elseif($key === 'dropdown') {
				echo '<div class="wolfie-col col-6">';
				echo '<div class="dropdown-field">';
				$this->dropdown(null, $originFields[$i]['desc'], $originFields[$i]['options'], true, $groupVal);
				echo '</div>';
				echo '</div>';
			}		
			$i++;
		}
		echo '</div>';
	}
}
echo '</div>';
echo '</div>';

$content = ob_get_clean();
if($print === true) {
	echo $content;
}
