<?php

/*
Plugin Name: Advanced Custom Fields: Tag It
Plugin URI: https://wordpress.org/plugins/advanced-custom-fields-tag-it/
Description: A tag-it field for ACF
Version: 2.0.0
Author: Brian Reed
Author URI: iambrian.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

//load_plugin_textdomain( 'acf-tag-it', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 

class acf_include_field_types
{
	function __construct()
	{	
		add_action( 'acf/include_field_types', array( $this, 'include_field_types' ) );
	}
	
	function include_field_types()
	{
		require ( plugin_dir_path( __FILE__ ) . 'field.php' );
	}
}

new acf_include_field_types();