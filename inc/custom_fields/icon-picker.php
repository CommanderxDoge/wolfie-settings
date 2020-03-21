<?php 
wp_enqueue_script('wolfie-fonticonpicker-js');
wp_enqueue_script('wolfie-iconpicker-js');
wp_enqueue_style('wolfie-fonticonpicker-css');
wp_enqueue_style('wolfie-icons');
$name = (isset($name)) ? $name : '';
$nameInline = (isset($name)) ? 'name="'.$this->settings.'['.$name.']"' : '' ;
$value = (isset($this->settingsArray[$name]))? $this->settingsArray[$name] : '' ;
$value = (isset($groupVal)) ? $groupVal : $value ;
ob_start();
$icon_list = get_the_icon_list();
$icon_list = json_encode($icon_list);
?>
<div class="wolfie-form-control">
    <label><?php echo $label ?></label>
    <input class="icon-picker" type="text" <?php echo $nameInline ?> value="<?php echo $value ?>">
</div>
<?php
$content = ob_get_clean();
if($print === true) {
    echo $content;
}
