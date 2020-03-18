<?php ob_start();
wp_enqueue_script('wolfie-fonticonpicker-js');
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
<!-- <select class="picker" class="" name="<?php echo $name ?>">
    <option value="<?php echo $value ?>">No icon</option>
    <option>fa fa-address-book</option>
    <option>fa fa-plus-circle</option>
</select> -->


<!-- <i class="iconify" data-icon="fa:home"></i> -->
<!-- <span class="iconify" data-icon="mdi:account-cowboy-hat" data-inline="true"></span> -->
<input class="icon-picker" type="text" <?php echo $name ?> value="<?php echo $value ?>">
<script type="text/javascript">
    jQuery(document).ready(function($){ 
    <?php echo "var iconList = ". $icon_list . ";\n";?>
    var $picker = $('.icon-picker').fontIconPicker({
    theme              : 'fip-darkgrey',              // The CSS theme to use with this fontIconPicker. You can set different themes on multiple elements on the same page
    source             : iconList,                   // Icons source (array|false|object)
    searchSource       : false,                   // map source with text to search
    emptyIcon          : true,                    // Empty icon should be shown?
    emptyIconValue     : '',                      // The value of the empty icon, change if you select has something else, say "none"
    autoClose          : true,                    // Whether or not to close the FIP automatically when clicked outside
    iconsPerPage       : 20,                      // Number of icons per page
    hasSearch          : true,                    // Is search enabled?
    // jQuery objects
    useAttribute       : false,                   // Whether to use attribute selector for printing icons
    attributeName      : 'data-icon',             // HTML Attribute name
    convertToHex       : false,                    // Whether or not to convert to hexadecimal for attribute value. If true then    
    searchPlaceholder  : 'Search Icons'           // Placeholder for the search input
});
    });
</script>
</div>
<?php
$content = ob_get_clean();
if($print === true) {
    echo $content;
}
