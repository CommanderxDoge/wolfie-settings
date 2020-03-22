jQuery(document).ready(function($){ 
	var groupClass =  $('.wolfie-group-holder');
	function commaCorrection(val) {
		var newVal = val.replace(/,\s*$/, "");
		newVal = newVal.replace(/^,/, '');
		newVal = newVal.replace(/,,/, ',');
		return newVal;
	}
	function initColor(t) {
		var group = t.closest('.wolfie-group-holder')
		var addedGroup = group.next();
		var color = addedGroup.find('.color-field');
		var colorHolder = color.children('.wolfie-form-control');
		var colorPicker = color.find('.colorpicker').detach().appendTo(colorHolder);
		colorPicker.removeAttr('name');
		colorPicker.removeAttr('value');
		colorHolder.children('div').remove();
		colorPicker.wpColorPicker();
	}
	function initEditor(t){
		var group = t.closest('.wolfie-group-holder')
		var addedGroup = group.next();
		var editor = addedGroup.find('.editor-field');
		var editorHolder = editor.children('.wolfie-form-control');
		var textarea = editor.find('textarea').detach().appendTo(editorHolder);
		textarea.removeAttr('style').removeAttr('id');
		editorHolder.children('div').remove();

		tinymce.init({selector:'.editor-field textarea'})
	}
	function initEditors(){
		var group = $('.wolfie-group');
		var editor = group.find('.editor-field');
		editor.each(function(){
			var editorHolder = $(this).children('.wolfie-form-control');
			var textarea = $(this).find('textarea').detach().appendTo(editorHolder);
			textarea.removeAttr('style');
			textarea.removeAttr('id');
			textarea.removeAttr('name');
			editorHolder.children('div').remove();
		})
		if($('.wolfie-group').find('.editor-field')) {
			tinymce.init({selector:'.editor-field textarea'})
		}
	}
	if($('.wolfie-group').find('.editor-field')) {
		initEditors();
	}
	function initImage(){
		$('.wolfie-group .image').each(function(){
			var control = $(this).closest('.wolfie-form-control')
			control.find('.add').off().click(function(e){
				e.preventDefault();
				var custom_uploader = wp.media({
					title: 'Insert image',
					library : {
						type : 'image'
					},
					button: {
						text: 'Use this image' 
					},
					multiple: false 
				}).open().on('select', function() { 
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					control.find('.image-holder').html('<div class="item" data-id="'+attachment.id+'"><a href="#" class="wolfie-close"></a><img class="true_pre_image" src="' + attachment.url + '" style="max-width:100px;display:block;"></div>');
					control.find('.image').val(attachment.id);
				});
			});
			control.find('.remove').click(function(e){
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

	}
	function initGallery(){
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
		$('.wolfie-group .gallery-wolfie').each(function(){
			var control = $(this).closest('.wolfie-form-control')
			var holder = control.find('.images-holder')
			var add = control.find('.add')
			var remove = control.find('.remove')
			var input = control.find('input');
			add.off().click(function(e){
				e.preventDefault();
				var custom_uploader = wp.media({
					title: 'Insert images',
					library : {
						type : 'image'
					},
					button: {
						text: 'Use this images'
					},
					multiple: true 
				}).open().off().on('select', function() {
					var currentIds = input.val().split(',').map(Number);
					var attachment = custom_uploader.state().get('selection').first().toJSON();
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
				});
			});
			remove.off().click(function(e){
				e.preventDefault();
				holder.html('');
				input.val('');
			})
			holder.sortable({
				placeholder: 'wolfie-drop-placeholder'
			}).on( "sortstop", function( event, ui ) {
				var ids = getIds(holder);
				input.val(ids);
			});
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
	}
	var iconList = wolf.icons;
	var args = {
		theme              : 'fip-darkgrey',              
		source             : iconList,                   
		searchSource       : false,                   
		emptyIcon          : true,                    
		emptyIconValue     : '',                      
		autoClose          : true,                    
		iconsPerPage       : 20,                      
		hasSearch          : true,                    

		useAttribute       : false,                   
		attributeName      : 'data-icon',             
		convertToHex       : false,                    
		searchPlaceholder  : 'Search Icons'           
	}
	function changeNumber(t){
		var wrap = t.closest('.wolfie-group');
		setTimeout(function(){
			wrap.children('.wolfie-group-holder').each(function(i){
				var newNumber = i + 1;
				$(this).find('.number').text(newNumber);
			})
		},50)
	}
	$('.wolfie-group').each(function(){
		var repeater = $(this);
		var input = repeater.find('.group-input');
		var group = repeater.find('.wolfie-group-holder');
		var add = repeater.find('.wolfie-add');
		var remove = repeater.find('.wolfie-remove');
		var groupClass = '.wolfie-group-holder';
		function cloneGroup(){
			var t = $(this);
			var wrap = t.closest('.wolfie-group');
			// console.log(wrap)
			var group = t.closest('.wolfie-group-holder');
			var newItem = group.clone(false).insertAfter(group);
			var selectIcons = newItem.find('.icons-selector').remove();
			var newIconPicker = newItem.find('.icon-picker').removeAttr('style'); 
			newIconPicker.fontIconPicker(args);
			changeNumber(t);
			initGallery();
			initEditor(t);
			initImage();
			initColor(t);
		}
		function removeGroup(){
			var t = $(this);
			group = t.closest(groupClass);
			changeNumber(t);
			group.remove();
		}
		function saveGroup(e){
			e.preventDefault();
			var data = [];
			var rows = $(this).siblings('.wolfie-group-holder')
			rows.each(function(index){
				t = $(this);
				var row = [];
				var cols = t.children('.fields-holder').children('.wolfie-col');
				cols.each(function(i){
					t = $(this);
					var col = {};
					var gallery = t.find('.gallery-wolfie').attr('class');
					var icon = t.find('.icon-picker').attr('class');
					var val = t.find('.icon-picker,.text,.colorpicker,gallery-wolfie,.dropdown,.datepicker').val();
					var name = t.find('.image-field,.file-field,.radio-field,.multiple-field,.radioimage-field,.date-field,.text-field,.icon-field,.color-field,.gallery-field,.dropdown-field,.datepicker-field,.editor-field').attr('class').split('-')[0];
					if(typeof(val) === 'undefined') {
						var editorID = t.find('textarea').attr('id');
						if (editorID) {
							val = tinymce.get(editorID).getContent();	
						} else {
							val = ''
						}
					}
					col.name = name;
					col.val = val;
					row.push(col);
				}) // END OF COL loop
				data.push(row);
			}) // END OF ROW loop
			var json = JSON.stringify(data);
			input.html(json);
		}
		function collapseGroup(e){
			e.preventDefault();
			t = $(this);
			t.closest(groupClass).toggleClass('collapsed').find('.fields-holder').slideToggle();
		}
		repeater.off().on('click', '.wolfie-add', cloneGroup )
		repeater.on('click', '.wolfie-remove', removeGroup)
		repeater.on('click', '.save-group', saveGroup)
		repeater.on('click', 'header i', collapseGroup)
		$('form').submit(function(){
			$('.save-group').each(function(){
				$(this).trigger('click');	
			})
		})
	})
});