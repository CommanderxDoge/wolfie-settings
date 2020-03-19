jQuery(document).ready(function($){ 
	var iconList = wolf.icons;
	var args = {
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
}
$('.wolfie-group').each(function(){
	var repeater = $(this);
	var input = repeater.find('textarea');
	var group = repeater.find('.wolfie-group-holder');
	var add = repeater.find('.wolfie-add');
	var remove = repeater.find('.wolfie-remove');
	var groupClass = '.wolfie-group-holder';
	function cloneField(){
		var t = $(this);
		var group = t.closest('.wolfie-group-holder');
		var newItem = group.clone(false).insertAfter(group);
		var selectIcons = newItem.find('.icons-selector').remove();
		var newIconPicker = newItem.find('.icon-picker').removeAttr('style'); 
		newIconPicker.fontIconPicker(args);
	}

	repeater.off().on('click', '.wolfie-add', cloneField )
	repeater.on('click', '.wolfie-remove', function(){
		var t = $(this);
		group = t.closest(groupClass);
		group.remove();
	})

})
});