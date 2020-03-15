jQuery(document).ready(function($){ 

	$('.file').each(function(){
		var control = $(this).closest('.wolfie-form-control')
		control.find('.add').click(function(e){
			e.preventDefault();
			console.log(wp)
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
		control.find('.file-holder').html('<div class="item"data-id="'+attachment.id+'"><a href="#" class="wolfie-close"></a><img class="" src="' + attachment.url + '" style="max-width:100px;display:block;"><span class="title"><'+attachment.title+'/span></div>');
		control.find('.file').val(attachment.id);
		})
		.open();
	});
		control.find('.remove').click(function(e){
			e.preventDefault();
			control.find('.file-holder').html('');
			control.find('.file').val('');
		})

	});
});