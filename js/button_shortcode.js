jQuery(document).ready(function($) {
  tinymce.create('tinymce.plugins.tnibs_plugin', {
    init : function( ed, url ) {

      // Register command for when button is clicked
      ed.addCommand( 'tnibs_insert_shortcode', function(u, v) {
        selected = tinyMCE.activeEditor.selection.getContent();

        if( selected ) {
          return;
        }else {
          content = '[button button="" color="" link=""]';
        }

        tinymce.execCommand( 'mceInsertContent', false, content );
      });

      // Register buttons - trigger above command when clicked
      ed.addButton( 'tnibs_button', {
        title : 'Insert shortcode',
        cmd : 'tnibs_insert_shortcode',
        image : url + '/path/to/image.png'
      });

    }
  });

  // Register our TinyMCE plugin
  // first parameter is the button ID1
  // second parameter must match the first parameter of the tinymce.create() function above
  tinymce.PluginManager.add( 'tnibs_button', tinymce.plugins.tnibs_plugin );
});