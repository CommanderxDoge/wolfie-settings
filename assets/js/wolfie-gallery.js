jQuery(document).ready(function($){ 
	function getIds(holder){
		var i = 0,
		ids = [],
		children = holder.children('.item');
		children.each(function(){
			t = $(this);
			ids[i] = $(this).data('id');
			i++;
		})
		return ids;
	}
	$('.gallery-wolfie').each(function(){
		var control = $(this).closest('.wolfie-form-control')
		var holder = control.find('.images-holder')
		var add = control.find('.add')
		var remove = control.find('.remove')
		var input = control.find('input')
		add.click(function(e){
			e.preventDefault();
			custom_uploader = wp.media({
				title: 'Insert images',
				library : {
					type : 'image'
				},
				button: {
				text: 'Use this images' // button label text
			},
			multiple: true // for multiple images selection set to true
		}).on('select', function() { // it also has "open" and "close" events 
		var currentIds = input.val().split(',').map(Number);
		var attachment = custom_uploader.state().get('selection').first().toJSON();
		/* if you sen multiple to true, here is some code for getting the images IDs */
		var attachments = custom_uploader.state().get('selection'),
		galleryImages,
		attachment_ids = new Array(),
		attachment_urls = new Array(),
		i = 0;
		attachments.each(function(attachment) {
			var thumbUrl = attachment.attributes.sizes.thumbnail;
			var url = attachment.attributes['url'];
			if(thumbUrl) {
				url = thumbUrl['url'];
			}
			attachment_ids[i] = attachment['id'];
			attachment_urls[i] = url;
			i++;
			control.find('.images-holder').append('<div class="item" data-id="'+attachment['id']+'"><a href="#" class="wolfie-close"></a><img style="width:100px;height:100px;object-fit:cover" src="'+url+'"></div>');
		});
		var idsArr = currentIds.concat(attachment_ids);
		input.val(idsArr);
	}).open();
	});
		remove.click(function(e){
			e.preventDefault();
			holder.html('');
			input.val('');
		})
		holder.sortable({
			axis: "x",
		}).on( "sortstop", function( event, ui ) {
			var ids = getIds(holder);
			input.val(ids);
		});
	});
});