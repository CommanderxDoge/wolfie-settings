<?php
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$name = $this->settings.'['.$name.']';
ob_start();
echo '<div class="wolfie-form-control">';
echo '<label>'.$label.'</label>';
echo '<textarea style="width:100%;height:120px;" class="container" name="'.$name.'" value="'.$value.'"></textarea>';
echo '<div class="wolfie-group">';
if(is_array($fields)){
	foreach($fields as $index => $field) {
		if($field['type'] === 'text'){
			$this->textPicker(null,'lol',true);
			$this->iconPicker(null,'lol', null, true);
		}
	}
}
echo '</div>';
echo '</div>';
$content = ob_get_clean();
if($print === true) {
	echo $content;
}
