<?php ob_start();
wp_enqueue_script('wolfie-fonticonpicker-js');
wp_enqueue_script('wolfie-iconpicker-js');
wp_enqueue_style('wolfie-fonticonpicker-css');
wp_enqueue_style('wolfie-icons');   
// $label is defined as well
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$name = (isset($name)) ? 'name="'.$this->settings.'['.$name.']"' : '' ;
// $icon_list = get_the_icon_list();
$icon_list = get_the_icon_list();
$icon_list = json_encode($icon_list);
?>
<div class="wolfie-form-control">
    <label><?php echo $label ?></label>
    <input class="icon-picker" type="text" <?php echo $name ?> value="<?php echo $value ?>">
</div>
<?php
$content = ob_get_clean();
if($print === true) {
    echo $content;
}
