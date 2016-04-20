// start the popup specefic scripts
// safe to use $
var old_tb_remove = window.tb_remove;
var using_text_editor = false;
var text_editor_toggle;
var html_editor_toggle;
var editor_area;
var cursor_position = 0;

jQuery(document).ready(function($) {
	var tb_remove = function() {
		// check if text editor shortcode button was used; if so return to it
		if ( using_text_editor ) {
			using_text_editor = false;
			window.switchEditors.switchto( jQuery('#content-html')[0] );
		}

		old_tb_remove();
	};

	window.theme_tb_height = (92 / 100) * jQuery(window).height();
	window.theme_ve_pb_shortcodes_height = (71 / 100) * jQuery(window).height();
	if(window.theme_ve_pb_shortcodes_height > 550) {
		window.theme_ve_pb_shortcodes_height = (74 / 100) * jQuery(window).height();
	}

	jQuery(window).resize(function() {
		window.theme_tb_height = (92 / 100) * jQuery(window).height();
		window.theme_ve_pb_shortcodes_height = (71 / 100) * jQuery(window).height();

		if(window.theme_ve_pb_shortcodes_height > 550) {
			window.theme_ve_pb_shortcodes_height = (74 / 100) * jQuery(window).height();
		}
	});

	themeve_pb_shortcodes = {
		loadVals: function()
		{
			var shortcode = $('#_ve_pb_shortcode').text(),
				uShortcode = shortcode;

			// fill in the gaps eg {{param}}
			$('.ve_pb-input').each(function() {
				var input = $(this),
					id = input.attr('id'),
					id = id.replace('ve_pb_', ''),		// gets rid of the ve_pb_ prefix
					re = new RegExp("{{"+id+"}}","g");
					var value = input.val();
					if(value == null) {
					  value = '';
					}
				uShortcode = uShortcode.replace(re, value);
			});

			// adds the filled-in shortcode as hidden input
			$('#_ve_pb_ushortcode').remove();
			$('#ve_pb-sc-form-table').prepend('<div id="_ve_pb_ushortcode" class="hidden">' + uShortcode + '</div>');
		},
		cLoadVals: function()
		{
			var shortcode = $('#_ve_pb_cshortcode').text(),
				pShortcode = '';

				if(shortcode.indexOf("<li>") < 0) {
					shortcodes = '<br />';
				} else {
					shortcodes = '';
				}

			// fill in the gaps eg {{param}}
			$('.ve_pb-shortcodes-popup .child-clone-row').each(function() {
				var row = $(this),
					rShortcode = shortcode;

				if($(this).find('#ve_pb_slider_type').length >= 1) {
					if($(this).find('#ve_pb_slider_type').val() == 'image') {
						rShortcode = '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]';
					} else if($(this).find('#ve_pb_slider_type').val() == 'video') {
						rShortcode = '[slide type="{{slider_type}}"]{{video_content}}[/slide]';
					}
				}
				$('.ve_pb-cinput', this).each(function() {
					var input = $(this),
						id = input.attr('id'),
						id = id.replace('ve_pb_', '')		// gets rid of the ve_pb_ prefix
						re = new RegExp("{{"+id+"}}","g");
						var value = input.val();
						if(value == null) {
						  value = '';
						}
					rShortcode = rShortcode.replace(re, input.val());
				});

				if(shortcode.indexOf("<li>") < 0) {
					shortcodes = shortcodes + rShortcode + '<br />';
				} else {
					shortcodes = shortcodes + rShortcode;
				}
			});

			// adds the filled-in shortcode as hidden input
			$('#_ve_pb_cshortcodes').remove();
			$('.ve_pb-shortcodes-popup .child-clone-rows').prepend('<div id="_ve_pb_cshortcodes" class="hidden">' + shortcodes + '</div>');

			// add to parent shortcode
			this.loadVals();
			pShortcode = $('#_ve_pb_ushortcode').html().replace('{{child_shortcode}}', shortcodes);

			// add updated parent shortcode
			$('#_ve_pb_ushortcode').remove();
			$('#ve_pb-sc-form-table').prepend('<div id="_ve_pb_ushortcode" class="hidden">' + pShortcode + '</div>');
		},
		children: function()
		{
			// assign the cloning plugin
			$('.ve_pb-shortcodes-popup .child-clone-rows').appendo({
				subSelect: '> div.child-clone-row:last-child',
				allowDelete: false,
				focusFirst: false,
				onAdd: function(row) {
					// Get Upload ID
					var prev_upload_id = jQuery(row).prev().find('.ve_pb-upload-button').data('upid');
					var new_upload_id = prev_upload_id + 1;
					jQuery(row).find('.ve_pb-upload-button').attr('data-upid', new_upload_id);

					// activate chosen
					jQuery('.ve_pb-form-multiple-select').chosen({
						width: '100%',
						placeholder_text_multiple: 'Select Options or Leave Blank for All'
					});

					// activate color picker
					jQuery('.wp-color-picker-field').wpColorPicker({
						change: function(event, ui) {
							themeve_pb_shortcodes.loadVals();
							themeve_pb_shortcodes.cLoadVals();
						}
					});

					// changing slide type
					var type = $(row).find('#ve_pb_slider_type').val();

					if(type == 'video') {
						$(row).find('#ve_pb_image_content, #ve_pb_image_url, #ve_pb_image_target, #ve_pb_image_lightbox').closest('li').hide();
						$(row).find('#ve_pb_video_content').closest('li').show();

						$(row).find('#_ve_pb_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
					}

					if(type == 'image') {
						$(row).find('#ve_pb_image_content, #ve_pb_image_url, #ve_pb_image_target, #ve_pb_image_lightbox').closest('li').show();
						$(row).find('#ve_pb_video_content').closest('li').hide();

						$(row).find('#_ve_pb_cshortcode').text('[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');
					}

					themeve_pb_shortcodes.loadVals();
					themeve_pb_shortcodes.cLoadVals();
				}
			});

			// remove button
			$('.ve_pb-shortcodes-popup .child-clone-row-remove').live('click', function() {
				var	btn = $(this),
					row = btn.parent();

				if( $('.ve_pb-shortcodes-popup .child-clone-row').size() > 1 )
				{
					row.remove();
				}
				else
				{
					alert('You need a minimum of one row');
				}

				return false;
			});

			// assign jUI sortable
			$( ".ve_pb-shortcodes-popup .child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row',
				cancel: 'div.iconpicker, input, select, textarea, a'
			});
		},
		resizeTB: function()
		{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				ve_pbPopup = $('#ve_pb-popup');

			tbWindow.css({
				height: window.theme_tb_height,
				width: ve_pbPopup.outerWidth(),
				marginLeft: -(ve_pbPopup.outerWidth()/2)
			});

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: window.theme_tb_height,
				overflow: 'auto', // IMPORTANT
				width: ve_pbPopup.outerWidth()
			});

			tbWindow.show();

			$('#ve_pb-popup').addClass('no_preview');
			$('#ve_pb-sc-form-wrap #ve_pb-sc-form').height(window.theme_ve_pb_shortcodes_height);
		},
		load: function()
		{

			var	ve_pb = this,
				popup = $('#ve_pb-popup'),
				form = $('#ve_pb-sc-form', popup),
				shortcode = $('#_ve_pb_shortcode', form).text(),
				popupType = $('#_ve_pb_popup', form).text(),
				uShortcode = '';

			// if its the shortcode selection popup
			if($('#_ve_pb_popup').text() == 'shortcode-generator') {
				$('.ve_pb-sc-form-button').hide();
			}

			// resize TB
			themeve_pb_shortcodes.resizeTB();
			$(window).resize(function() { themeve_pb_shortcodes.resizeTB() });

			// initialise
			themeve_pb_shortcodes.loadVals();
			themeve_pb_shortcodes.children();
			themeve_pb_shortcodes.cLoadVals();

			// update on children value change
			$('.ve_pb-cinput', form).live('change', function() {
				themeve_pb_shortcodes.cLoadVals();
			});

			// update on value change
			$('.ve_pb-input', form).live('change', function() {
				themeve_pb_shortcodes.loadVals();
			});

			// change shortcode when a user selects a shortcode from choose a dropdown field
			$('#ve_pb_select_shortcode').change(function() {
				var name = $(this).val();
				var label = $(this).text();

				if(name != 'select') {
					tinyMCE.activeEditor.execCommand("ve_pbPopup", false, {
						title: label,
						identifier: name
					});

					$('#TB_window').hide();
				}
			});

			// activate chosen
			$('.ve_pb-form-multiple-select').chosen({
				width: '100%',
				placeholder_text_multiple: 'Select Options'
			});

			// update upload button ID
			jQuery('.ve_pb-upload-button:not(:first)').each(function() {
				var prev_upload_id = jQuery(this).data('upid');
				var new_upload_id = prev_upload_id + 1;
				jQuery(this).attr('data-upid', new_upload_id);
			});
		}
	}

	// run
	$('#ve_pb-popup').livequery(function() {
		themeve_pb_shortcodes.load();

		$('#ve_pb-popup').closest('#TB_window').addClass('ve_pb-shortcodes-popup');

		$('#ve_pb_video_content').closest('li').hide();

			// activate color picker
			$('.wp-color-picker-field').wpColorPicker({
				change: function(event, ui) {
					setTimeout(function() {
						themeve_pb_shortcodes.loadVals();
						themeve_pb_shortcodes.cLoadVals();
					},
					1);
				}
			});
	});

	// when insert is clicked
	$('.ve_pb-insert').live('click', function() {

		if( using_text_editor ) {
			if( $('#ve_pb_select_shortcode').val() != 'table' ) {
				using_text_editor = false;

				// switch back to text editor mode
				window.switchEditors.switchto( text_editor_toggle[0] );

				var html = $('#_ve_pb_ushortcode').html().replace( /<br>/g, '' );

				// inserting the new shortcode at the correct position in the text editor content field
				editor_area.val( [ editor_area.val().slice(0, cursor_position), html, editor_area.val().slice(cursor_position)].join( '' ) );

				tb_remove();
			}

		} else if(window.tinyMCE)
		{
			window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, $('#_ve_pb_ushortcode').html());
			tb_remove();
		}
	});

	//tinymce.init(tinyMCEPreInit.mceInit['ve_pb_content']);
	//tinymce.execCommand('mceAddControl', true, 've_pb_content');
	//quicktags({id: 've_pb_content'});

	// activate upload button
	$('.ve_pb-upload-button').live('click', function(e) {
		e.preventDefault();

		upid = $(this).attr('data-upid');

		if($(this).hasClass('remove-image')) {
			$('.ve_pb-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', '').hide();
			$('.ve_pb-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', '');
			$('.ve_pb-upload-button[data-upid="' + upid + '"]').text('Upload').removeClass('remove-image');

			return;
		}

		var file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Image',
			button: {
				text: 'Select Image',
			},
			frame: 'post',
			multiple: false  // Set to true to allow multiple files to be selected
		});

		file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();

		file_frame.on( 'select', function() {
			var selection = file_frame.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				$('.ve_pb-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
				$('.ve_pb-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				themeve_pb_shortcodes.loadVals();
				themeve_pb_shortcodes.cLoadVals();
			});

			$('.ve_pb-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});

		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get('selection');
			var size = jQuery('.attachment-display-settings .size').val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if(!size) {
					attachment.url = attachment.url;
				} else {
					attachment.url = attachment.sizes[size].url;
				}

				$('.ve_pb-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
				$('.ve_pb-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				themeve_pb_shortcodes.loadVals();
				themeve_pb_shortcodes.cLoadVals();
			});

			$('.ve_pb-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});
	});

	// activate iconpicker
	$('.iconpicker i').live('click', function(e) {
		e.preventDefault();

		var iconWithPrefix = $(this).attr('class');
		var fontName = $(this).attr('data-name');

		if($(this).hasClass('active')) {
			$(this).parent().find('.active').removeClass('active');

			$(this).parent().parent().find('input').attr('value', '');
		} else {
			$(this).parent().find('.active').removeClass('active');
			$(this).addClass('active');

			$(this).parent().parent().find('input').attr('value', fontName);
		}

		themeve_pb_shortcodes.loadVals();
		themeve_pb_shortcodes.cLoadVals();
	});

	// table shortcode
	$('#ve_pb-sc-form-table .ve_pb-insert').live('click', function(e) {
		e.stopPropagation();

		var shortcodeType = $('#ve_pb_select_shortcode').val();

		if(shortcodeType == 'table') {
			var type = $('#ve_pb-sc-form-table #ve_pb_type').val();
			var columns = $('#ve_pb-sc-form-table #ve_pb_columns').val();

			var text = '<div class="ve_pb-table table-' + type + '"><table width="100%"><thead><tr>';

			for(var i=0;i<columns;i++) {
				text += '<th>Column ' + (i + 1) + '</th>';
			}

			text += '</tr></thead><tbody>';

			for(var i=0;i<columns;i++) {
				text += '<tr>';
				if(columns >= 1) {
					text += '<td>Item #' + (i + 1) + '</td>';
				}
				if(columns >= 2) {
					text += '<td>Description</td>';
				}
				if(columns >= 3) {
					text += '<td>Discount:</td>';
				}
				if(columns >= 4) {
					text += '<td>$' + (i + 1) + '.00</td>';
				}
				if(columns >= 5) {
					text += '<td>$ 0.' + (i + 1) + '0</td>';
				}
				if(columns >= 6) {
					text += '<td>$ 0.' + (i + 1) + '0</td>';
				}
				text += '</tr>';
			}

			text += '<tr>';

			if(columns >= 1) {
				text += '<td><strong>All Items</strong></td>';
			}
			if(columns >= 2) {
				text += '<td><strong>Description</strong></td>';
			}
			if(columns >= 3) {
				text += '<td><strong>Your Total:</strong></td>';
			}
			if(columns >= 4) {
				text += '<td><strong>$10.00</strong></td>';
			}
			if(columns >= 5) {
				text += '<td><strong>Tax: $10.00</strong></td>';
			}
			if(columns >= 6) {
				text += '<td><strong>Gross: $10.00</strong></td>';
			}
			text += '</tr>';
			text += '</tbody></table></div>';

			if( using_text_editor ) {
				using_text_editor = false;

				// switch back to text editor mode
				window.switchEditors.switchto( text_editor_toggle[0] );

				// inserting the new shortcode at the correct position in the text editor content field
				editor_area.val( [ editor_area.val().slice(0, cursor_position), text, editor_area.val().slice(cursor_position)].join( '' ) );

				tb_remove();
			} else if(window.tinyMCE)
			{
				window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, text);
				tb_remove();
			}
		}
	});

	// slider shortcode
	$('#ve_pb_slider_type').live('change', function(e) {
		e.preventDefault();

		var type = $(this).val();
		if(type == 'video') {
			$(this).parents('ul').find('#ve_pb_image_content, #ve_pb_image_url, #ve_pb_image_target, #ve_pb_image_lightbox').closest('li').hide();
			$(this).parents('ul').find('#ve_pb_video_content').closest('li').show();

			$('#_ve_pb_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
		}

		if(type == 'image') {
			$(this).parents('ul').find('#ve_pb_image_content, #ve_pb_image_url, #ve_pb_image_target, #ve_pb_image_lightbox').closest('li').show();
			$(this).parents('ul').find('#ve_pb_video_content').closest('li').hide();

			$('#_ve_pb_cshortcode').text('[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');
		}
	});

	$('.ve_pb-add-video-shortcode').live('click', function(e) {
		e.preventDefault();

		var shortcode = $(this).attr('href');
		var content = $(this).parents('ul').find('#ve_pb_video_content');

		content.val(content.val() + shortcode);
		themeve_pb_shortcodes.cLoadVals();
	});

	$('#ve_pb-popup textarea').live('focus', function() {
		var text = $(this).val();

		if(text == 'Your Content Goes Here') {
			$(this).val('');
		}
	});

	$('.ve_pb-gallery-button').live('click', function(e) {
		var gallery_file_frame;

		e.preventDefault();

		alert('To add images to this post or page for attachments layout, navigate to "Upload Files" tab in media manager and upload new images.');

		gallery_file_frame = wp.media.frames.gallery_file_frame = wp.media({
			title: 'Attach Images to Post/Page',
			button: {
				text: 'Go Back to Shortcode',
			},
			frame: 'post',
			multiple: true  // Set to true to allow multiple files to be selected
		});

		gallery_file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();

		$('.media-menu-item:contains("Upload Files")').trigger('click');

		gallery_file_frame.on( 'select', function() {
			$('.media-modal-close').trigger('click');

			themeve_pb_shortcodes.loadVals();
			themeve_pb_shortcodes.cLoadVals();
		});
	});

	// text editor shortcode button was used
	jQuery(window).resize(function() {
		$('.quicktags-toolbar input[id*=ve_pb_shortcodes_text_mode]').addClass( 've_pb-shortcode-generator-button' );
	});
	$( '.switch-html, .ve_pb-expand-child' ).live('click', function(e) {
		$('.quicktags-toolbar input[id*=ve_pb_shortcodes_text_mode]').addClass( 've_pb-shortcode-generator-button' );
	});

	$('.quicktags-toolbar input[id*="ve_pb_shortcodes_text_mode"]').each(function() {
		$(this).addClass( 've_pb-shortcode-generator-button' );
	})

	$('.quicktags-toolbar input[id*=ve_pb_shortcodes_text_mode]').live('click', function(e) {

		var popup = 'shortcode-generator';

		// set the flag for text editor, change to visual editor
		using_text_editor = true;
		text_editor_toggle = $( this ).parents( '.wp-editor-wrap' ).find( '.wp-switch-editor.switch-html');
		html_editor_toggle = $( this ).parents( '.wp-editor-wrap' ).find( '.wp-switch-editor.switch-tmce');
		editor_area = $( this ).parents( '.wp-editor-container' ).find( '.wp-editor-area' );

		cursor_position = editor_area.getCursorPosition();

		window.switchEditors.switchto( html_editor_toggle[0] );

		// load thickbox
		//tb_show("Ve_pagebuilderShortcodes", ajaxurl + "?action=shortcodes_popup&popup=" + popup);
		tb_show("Ve_Page Builder Shortcodes", ajaxurl + "?action=shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});
});


// Helper function to check the cursor position of text editor content field before the shortcode generator is opened
(function($, undefined) {
    $.fn.getCursorPosition = function() {
        var el = $(this).get(0);
        var pos = 0;
        if ('selectionStart' in el) {
            pos = el.selectionStart;
        } else if ('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    }
})(jQuery);