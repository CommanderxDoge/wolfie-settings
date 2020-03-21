jQuery(document).ready(function($){ 
	function commaCorrection(val) {
		var newVal = val.replace(/,\s*$/, "");
		newVal = newVal.replace(/^,/, '');
		newVal = newVal.replace(/,,/, ',');
		return newVal;
	}
	$('.image').each(function(){
		var control = $(this).closest('.wolfie-form-control')
		control.find('.add').off().click(function(e){
			e.preventDefault();
			custom_uploader = wp.media({
				title: 'Insert image',
				library : {
					type : 'image'
				},
				button: {
				text: 'Use this image' // button label text
			},
			multiple: false // for multiple image selection set to true
		}).open().on('select', function() { // it also has "open" and "close" events 
		var attachment = custom_uploader.state().get('selection').first().toJSON();
		control.find('.image-holder').html('<div class="item" data-id="'+attachment.id+'"><a href="#" class="wolfie-close"></a><img class="true_pre_image" src="' + attachment.url + '" style="max-width:100px;display:block;"></div>');
		control.find('.image').val(attachment.id);

	});
	});
		control.find('.remove').off().click(function(e){
			e.preventDefault();
			control.find('.image-holder').html('');
			control.find('.image').val('');
		})
	});
	var val;
	$('body').off().on('click', '.wolfie-close', function(e){
		e.preventDefault();
		var t = $(this);
		var id = t.parent().data('id');
		var input = t.closest('.wolfie-form-control').find('input');
		val = input.val();
		var newVal = val.replace(id, '')
		newVal = commaCorrection(newVal);
		input.val(newVal);
		var id = t.parent().remove();
	})

});