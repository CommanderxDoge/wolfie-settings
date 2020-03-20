jQuery(document).ready(function($){ 
	function commaCorrection(val) {
		var newVal = val.replace(/,\s*$/, "");
		newVal = newVal.replace(/^,/, '');
		newVal = newVal.replace(/,,/, ',');
		return newVal;
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
	$('.wolfie-group').each(function(){
		var repeater = $(this);
		var input = repeater.find('textarea');
		var group = repeater.find('.wolfie-group-holder');
		var add = repeater.find('.wolfie-add');
		var remove = repeater.find('.wolfie-remove');
		var groupClass = '.wolfie-group-holder';
		function cloneGroup(){
			var t = $(this);
			var group = t.closest('.wolfie-group-holder');
			var newItem = group.clone(false).insertAfter(group);
			var selectIcons = newItem.find('.icons-selector').remove();
			var newIconPicker = newItem.find('.icon-picker').removeAttr('style'); 
			newIconPicker.fontIconPicker(args);
			initGallery();
			initEditor(t);
			initImage();
		}
		function removeGroup(){
			var t = $(this);
			group = t.closest(groupClass);
			group.remove();
		}
		function saveGroup(e){
			e.preventDefault();
			var data = {};
			var rows = $(this).siblings('.wolfie-group-holder')
			rows.each(function(i){
				t = $(this);
				console.log('row: '+ i)
				var cols = t.children('.wolfie-col');
				cols.each(function(i){
					t = $(this);
					var editorID = t.find('textarea').attr('id');
					var textVal = t.find('.text').val();
					var iconVal = t.find('.icon-picker').val()
					var galleryVal = t.find('.gallery-wolfie').val();
					console.log(typeof(textVal))
					if( textVal === 'undefined') {
						console.log(textVal)
					} else {
						console.log('col '+i+' textVal: '+ textVal)
						// data['text'] = textval;
					}
					if(typeof(iconVal) !== 'undefined') {
						console.log('col '+i+' iconVal: '+iconVal)
						// groupData.fields.icon = 'iconVal'
					}
					if(typeof(galleryVal) !== 'undefined') {
						console.log('col '+i+' galleryVal: '+galleryVal)
						// groupData.fields.gallery = 'galleryVal'
					}
					if(typeof(editorID) !== 'undefined' ) {
						var editorVal = tinymce.get(editorID).getContent();
						console.log('col '+i+' editorContent: '+editorVal)
						// groupData.fields.editor = 'editorVal'
					}
				})
				// data = fields[i]
			})
			var json = JSON.stringify(data);
			console.log(json);
		}
		repeater.off().on('click', '.wolfie-add', cloneGroup )
		repeater.on('click', '.wolfie-remove', removeGroup)
		repeater.on('click', '.save-group', saveGroup)
	})
});