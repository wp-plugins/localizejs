<?php
/**
 * @package Localizejs
 * @version 0.1.1
 */
/*
Plugin Name: Localize.js Integration
Plugin URI: http://wordpress.org/plugins/localizejs/
Description: Easily integrate Localize.js into your WordPress site.
Author: Johnny Wu
Version: 0.1.1
Author URI: https://github.com/jonathanpeterwu
*/

/*  Copyright 2015  Jonathan Wu  (email : jonathan.x.wu@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );


/**
 * Exit if absolute path
*/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Plugin setup
 *
 * Version 0.0.1
*/

//Init Function
add_action('init', 'init_function');

function init_function() {
	add_action( 'wp_enqueue_scripts', 'add_localizejs_script', 1);
	add_action('admin_menu', 'my_plugin_menu');
	add_action( 'admin_init', 'my_plugin_settings' );
};

// SET LOCALIZEJS SCRIPT
function add_localizejs_script() {
    wp_deregister_script( 'localize' );
    wp_deregister_script( 'localizeFallback' );

		$project_key = get_option( 'project_key' );

		wp_register_script('localize', ( '//cdn.localizejs.com/localize.js' ), false, null, false);
		wp_register_script('localizeFallback', plugins_url('/localizejs.js',__FILE__) , false, null, false);

    wp_enqueue_script( 'localize' );
    wp_enqueue_script( 'localizeFallback' );

		wp_localize_script( 'localizeFallback', 'PROJECT_KEY', $project_key);

}

function my_plugin_menu() {
	add_menu_page('Localize.js Settings Page', 'Localize.js Plugin Settings', 'administrator', 'localizejs', 'my_plugin_settings_page', 'dashicons-admin-generic');
}

// SET PROJECT KEY
function my_plugin_settings() {
	register_setting( 'my-plugin-settings-group', 'project_key' );
}

// SETTINGS PAGE SETUP
function my_plugin_settings_page() {
		?>
	<div class="wrap">
		<h2>Localize.js Project Details</h2>

		<p> Login to your <a target="_blank" href="https://localizejs.com/">Localize.js</a> Dashboard to get your project key</p>
		<form method="post" action="options.php">
		    <?php settings_fields( 'my-plugin-settings-group' ); ?>
		    <?php do_settings_sections( 'my-plugin-settings-group' ); ?>
		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row">Project Key</th>
		        <td><input type="text" name="project_key" value="<?php echo esc_attr( get_option('project_key') ); ?>" /></td>
		        </tr>
		    </table>
		    <?php submit_button(); ?>
		</form>

		<a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/localizejs?rate=5#postform">
			<?php _e( 'Love Localize.js? Help spread the word by rating us 5★ on WordPress.org', 'localizejs' ); ?>
		</a>
	</div>
			<?php

}

