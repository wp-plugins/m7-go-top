<?php
/*
Plugin Name: M7 Go Top
Plugin URI: http://m7-pro.ru
Description: Plugin for "Top" button
Version: 0.1
Author: Mihails Semjonovs
Author URI: http://m7-pro.ru
License: GPLv2 or later
*/

/* Заполнение стандартных значений */
global $m7_ver;
$m7_ver = '0.1';
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

/* Подключаем админку */
require_once( M7_GO_TOP_PATH . '/admin/m7_admin.php');

/* Подключаем фронт */
require_once( M7_GO_TOP_PATH . '/front/m7_front.php');