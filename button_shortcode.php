<?php
/**
 * @package Button_Shortcode
 */
/*
Plugin Name: Button Shortcode
Plugin URI:
Description: Adds a [button] shortcode.
Version: 0.1
Author: The Net Impact
Author URI: http://www.thenetimpact.com
License: GPLv2 or later
*/

function tnibs_button_shortcode( $atts ) {
  $defaults = array(
    'text' => 'Click Here',
    'color' => 'yellow',
    'link' => '#',
    'class' => ''
  );
  $attr = shortcode_atts( $defaults, $atts );

  // $output = '<div class="button-' . strtolower( $attr['color'] ) . ' ' . esc_attr( $attr['class'] ) . '"><a href="' . esc_attr( $attr['link'] ) . '">' . $attr['button'] . '</a></div>';
  $output = '<div class="button-' . strtolower( esc_attr( $attr['color'] ) ) . ' ' . esc_attr( $attr['class'] ) . '"><a href="' . esc_attr( $attr['link'] ) . '" title="' . esc_attr( $attr['text'] ) . '" ><span>' . esc_attr( $attr['text'] ) . '</span></a></div>';

  return $output;
}
add_shortcode( 'button', 'tnibs_button_shortcode' );


/*
 * http://wordpress.stackexchange.com/questions/72394/how-to-add-a-shortcode-button-to-the-tinymce-editor
 */

 // init process for registering our button
function tnibs_shortcode_button_init() {

  //Abort early if the user will never see TinyMCE
  if ( ! current_user_can( 'edit_posts' )
    && ! current_user_can( 'edit_pages' )
    && get_user_option( 'rich_editing' ) == 'true' ) {
    return;
  }

  //Add a callback to regiser our tinymce plugin
  add_filter( 'mce_external_plugins', 'tnibs_register_tinymce_plugin' );

  // Add a callback to add our button to the TinyMCE toolbar
  add_filter( 'mce_buttons', 'tnibs_add_tinymce_button' );
}
add_action('init', 'tnibs_shortcode_button_init');


//This callback registers our plug-in
function tnibs_register_tinymce_plugin( $plugin_array ) {
  $plugin_array['tnibs_button'] = plugin_dir_url( __FILE__ ) . 'js/button_shortcode.js';
  return $plugin_array;
}


//This callback adds our button to the toolbar
function tnibs_add_tinymce_button( $buttons ) {
  //Add the button ID to the $button array
  $buttons[] = "tnibs_button";
  return $buttons;
}

?>