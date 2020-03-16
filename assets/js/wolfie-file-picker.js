jQuery(document).ready(function($){ 
	function commaCorrection(val) {
		var newVal = val.replace(/,\s*$/, "");
		newVal = newVal.replace(/^,/, '');
		newVal = newVal.replace(/,,/, ',');
		return newVal;
	}
	$('.file').each(function(){
		var control = $(this).closest('.wolfie-form-control')
		control.find('.add').click(function(e){
			e.preventDefault();
			custom_uploader = wp.media({
				title: 'Insert file',
				library : {
				// uncomment the next line if you want to attach file to the current post
				// uploadedTo : wp.media.view.settings.post.id, 
				// type : 'link'
			},
			button: {
				text: 'Use this file' // button label text
			},
			multiple: false // for multiple file selection set to true
		}).on('select', function() { // it also has "open" and "close" events 

		var attachment = custom_uploader.state().get('selection').first().toJSON();
		if(attachment.url.includes('.pdf')) {
			var url = location.origin + '/wp-includes/images/media/document.png';
		} else {
			var url = attachment.url;
		}
		control.find('.file-holder').html('<div class="item"data-id="'+attachment.id+'"><a href="#" class="wolfie-close"></a><img class="icon file" src="' + url + '" style="max-width:100px;display:block;"><span class="title">'+attachment.title+'</span></div>');
		control.find('.file').val(attachment.id);
		console.log(attachment);
		debugger;
	}).open();
	});
		control.find('.remove').click(function(e){
			e.preventDefault();
			control.find('.file-holder').html('');
			control.find('.file').val('');
		})
	});
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