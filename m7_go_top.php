<?php
/*
Plugin Name: M7 Go Top
Plugin URI: http://m7-pro.ru
Description: Creates "top" link on your web so that visitors could simply get back to the top of your site.
Version: 0.3
Author: Михаил Семёнов
Author URI: http://m7-pro.ru
License: GPLv2 or later
*/

/* Заполнение стандартных значений */
if ( function_exists( 'add_action' ) ) {
    
	if ( ! defined( 'WP_CONTENT_URL' ) )
		define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
	if ( ! defined( 'WP_CONTENT_DIR' ) )
		define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
	if ( ! defined( 'WP_PLUGIN_URL' ) )
		define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
	if ( ! defined( 'WP_PLUGIN_DIR' ) )
		define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
    
    define( 'M7_GO_TOP_BASENAME', plugin_basename( __FILE__ ) );
	define( 'M7_GO_TOP_BASEFOLDER', plugin_basename( dirname( __FILE__ ) ) );
    define( 'M7_GO_TOP_PATH', plugin_dir_path( __FILE__ ) ); // для require
    define( 'M7_GO_TOP_URL', plugin_dir_url( __FILE__ ) ); // для скриптов
}

/** Loading languages */
add_action('plugins_loaded', 'm7_go_top_init');
function m7_go_top_init() {
    load_plugin_textdomain( 'm7-go-top', false, dirname( M7_GO_TOP_BASENAME ) . '/languages/' ); 
}
function m7_go_top_check_version(){
    if( is_admin() ){
        if ( ! function_exists( 'get_plugin_data' ) )
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        $m7_go_top_plugin_data = get_plugin_data( __FILE__, false, false);
        $m7_go_top_plugin_data = strval($m7_go_top_plugin_data['Version']);
        if( ! get_option( 'm7_go_top_version' ) ){
            add_option( 'm7_go_top_version', $m7_go_top_plugin_data );
        } else {
            if($m7_go_top_plugin_data != get_option( 'm7_go_top_version' )) 
                update_option( 'm7_go_top_version', $m7_go_top_plugin_data );
        }
    }
}
/** Hooks */
register_activation_hook(__FILE__, function() {
    m7_go_top_check_version();
});
/*register_deactivation_hook(__FILE__, function(){
    delete_option('m7_go_top_version');
    delete_option('m7_fields');
    delete_option('m7_go_top_fields');
});*/
register_uninstall_hook(__FILE__, 'm7_go_top_plugin_uninstall');
function m7_go_top_plugin_uninstall(){
    delete_option('m7_go_top_version');
    delete_option('m7_go_top_fields');
}

/** Loading admin */
require_once( M7_GO_TOP_PATH . '/admin/m7_admin.php');

/** Loading front */
require_once( M7_GO_TOP_PATH . '/front/m7_front.php');