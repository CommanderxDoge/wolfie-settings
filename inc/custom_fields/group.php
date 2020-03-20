<?php
$json = '{
	"fields":
		{"icon": "fab-accessible-icon", "text": "witek jest głupi", "editor": "<h1>to jest</h1>", "gallery": "56,55,54", },
		{"icon": "fab-accessible-icon", "text": "witek jest głupi", "editor": "<h1>to jest</h1>", "gallery": "56,55,54" }
	}';
wp_enqueue_script('wolfie-group-js');
wp_enqueue_style('wolfie-icons');
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$jsonDecoded = json_decode($json);
var_dump( $json );
$name = $this->settings.'['.$name.']';
ob_start();
echo '<div class="wolfie-form-control">';
echo '<div class="wolfie-group">';
echo '<label>'.$label.'</label>';
echo '<textarea id="group-input" style="width:100%;height:120px;" class="" name="'.$name.'">'.$json.'</textarea>';
echo '<button class="save-group">Save group</button>';
echo '<div class="wolfie-group-holder">';
echo '<div class="wolfie-actions"><i class="wolfie-add sl-plus"></i><i class="wolfie-remove sl-close"></i></div>';
// if(is_array($fields) && empty($value) ){
if(is_array($fields) ){
	foreach($fields as $index => $field) {
		if($field['type']){
			echo '<div class="wolfie-col col-6">';
			if($field['type'] === 'text'){
				$this->textPicker(null,'Add Url to icon',true);
			} elseif($field['type'] === 'icon') {
				$this->iconPicker(null, $field['desc'], null, true);
			} elseif($field['type'] === 'editor') {
				echo '<div class="editor-field">';
				$this->editor(null, $field['desc'], true);
				echo '</div>';
			} elseif($field['type'] === 'gallery') {
				$this->galleryPicker(null, $field['desc'], true);
			} elseif($field['type'] === 'image') {
				$this->imagePicker(null, $field['desc'], true);
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
