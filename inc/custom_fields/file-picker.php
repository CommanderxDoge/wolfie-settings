<?php 
wp_enqueue_media();
wp_enqueue_script('wolfie-file-picker');
wp_enqueue_style('wolfie-settings-css');
ob_start();
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
echo '<div class="wolfie-form-control">';
echo '<label>'.$label.'</label>';
echo '<input class="file" name="'.$this->settings.'['.$name.']" value="'.$value.'" type="text" hidden>';
echo '<div class="actions"><button class="add">Add File</button><button class="remove">Remove File</button></div><div class="file-holder holder">';
if(!empty($value)) {
	$url = wp_get_attachment_url($value);
	$attachment_title = get_the_title($value);
	if( !strpos($url, '.png') || !strpos($url, '.jpg') || !strpos($url, '.jpeg') || !strpos($url, '.svg') ) {
		$img = '<img src="'.site_url('/').'/wp-includes/images/media/document.png" class="icon file" alt="">';
	} else {
		$img = '<img src="'.$url.'">';
	}
	echo '<div class="item" data-id="'.$value.'">'.$img.'<span class="title">'.$attachment_title.'</span>';
	echo '<a href="#" class="wolfie-close"></a>';
	echo '</div>';
}
echo '</div>';
echo '</div>';
$content = ob_get_clean();