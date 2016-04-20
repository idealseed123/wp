tinymce.PluginManager.add('short_button', function(ed, url) {
	ed.addCommand("ve_pbPopup", function ( a, params )
	{
		var popup = 'shortcode-generator';

		if(typeof params != 'undefined' && params.identifier) {
			popup = params.identifier;
		}

		// load thickbox
		tb_show("Shortcodes", ajaxurl + "?action=shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});

	// Add a button that opens a window
	ed.addButton('short_button', {
		text: '',
		icon: true,
		image: Ve_pagebuilderShortcodes.plugin_folder + '/tinymce/images/icon.png',
		cmd: 've_pbPopup'
	});
});