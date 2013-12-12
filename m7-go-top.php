<?php
/**
Plugin Name: M7 Go Top
Plugin URI: http://m7-pro.ru/
Description: Creates "To Top" link on your website, so that visitors could get back to the top of page. Fully customizable.
Version: 1.1
Author: [M7] Михаил Семёнов ( Mihail Semjonov )
Author URI: http://m7-pro.ru/
License: GPLv2 or later
**/
/* Copyright (C) 2013  [M7] Михаил Семёнов ( Mihail Semjonov )  ( email : mihailsemjonov@mail.ru ) */

/**
 * Если файл вызван на прямую то прекращаем работу
**/
if ( ! function_exists( 'add_action' ) ) exit;

/**
 * Проверяем существует ли класс
**/
if( ! class_exists( 'M7_Go_Top' ) ):
/**
 * Создаём класс если он небыл раньше создан
**/
class M7_Go_Top {
    /**
     * Данный файл
    **/
    private static $file = __FILE__;
    /**
     * Слаг плагина
    **/
    public static $plugin_slug;
    /**
     * Строка textdomain, для перевода
    **/
    public static $textdomain;
    /**
     * Версия плагина
    **/
    public static $version;
    /**
     * Храняться путь к файлу
    **/
    public static $path;
    /**
     * Храняться url к файлу
    **/
    public static $url;
    /**
     * Храняться название таблицы с версией плагина
    **/
    public static $option_version;
    /**
     * Храняться название таблицы с настройками плагина
    **/
    public static $option_name;
    /**
     * Храняться настройки плагина
    **/
    public static $options;
    
    /**
     * Конструктор
    **/
    public function __construct() {
        $this->init();
        /**
         * Экшены
        **/
        add_action( 'plugins_loaded',               array( &$this, 'action_plugins_loaded' ) );
        if ( is_admin() ) { // Экшены которые работают только в админке
            add_action( 'admin_init',               array( &$this, 'action_admin_init'              ) );
            add_action( 'admin_menu',               array( &$this, 'action_admin_menu'              ) );
            add_action( 'admin_enqueue_scripts',    array( &$this, 'action_admin_enqueue_scripts'   ) );
        } else {
            if( (int) self::$options['disabled'] == 0 ) {
                add_action( 'wp_enqueue_scripts',   array( &$this, 'action_wp_enqueue_scripts'      ) );
                add_action( 'wp_footer',            array( &$this, 'action_wp_footer'               ) );
            }
                
        }
    }
    /**
     * Подключаем перевод плагина
    **/
    public function action_plugins_loaded() {
        // Используем свою функцию т.к. то что предоставляет ВП не работает, если делать require этого плагина
        $this->load_plugin_textdomain( self::$textdomain, self::$path . '/languages' );
    }
    /**
     * Добавляем ajax функции
    **/
    public function action_admin_init() {
        if( ! current_user_can( 'manage_options' ) )
            return false;
        add_action( 'wp_ajax_' . self::$plugin_slug,    array( &$this, 'ajax_do_options_save'   ) );
    }
    /**
     * Ajax функция которая сохраняет настройки
    **/
    public function ajax_do_options_save() {
        if ( empty( $_POST ) || ! isset( $_POST[self::$plugin_slug] ) || ! check_admin_referer( self::$plugin_slug . '_action', self::$plugin_slug . '_nounce' ) )
        wp_die( __( 'Validation has not been passed', self::$textdomain ) );
                    
        $doing_ajax = ( ! isset( $_POST['doing_ajax'] ) || (int) $_POST['doing_ajax'] == 0 ) ? false : true;
                    
        $new_options = array();
        
        foreach( $_POST[self::$plugin_slug] as $key => $val ){
            $new_options[$key] = $val;
        }
        
        update_option( self::$option_name, $new_options );
        self::$options = $new_options;
        
        $referer = false;
        if( isset( $_POST['_wp_http_referer'] ) && ! empty( $_POST['_wp_http_referer'] ) )
            $referer = str_replace( '&updated=updated', '', $_POST['_wp_http_referer'] );
            
        if( ! $doing_ajax && $referer )
            wp_redirect( $referer . '&updated=updated' );
                        
        die('updated');
    }
    /**
     * Создаём страницу в админке
    **/
    public function action_admin_menu() {
        add_options_page(
        _x('M7 Go Top', 'submenu page title' , self::$textdomain ),
        _x('M7 Go Top', 'submenu menu title' , self::$textdomain ),
        'manage_options',
        self::$textdomain,
        array( &$this, 'options_page')
        );
    }
    /**
     * Вывод страницы настроек в админке
    **/
    public function options_page() {
        if( ! current_user_can( 'manage_options' ) )
        wp_die( __( 'У вас недостаточно полномочий для доступа к этой странице.', self::$textdomain ) );
        include_once ( self::$path . '/admin.php' );
    }
    /**
     * Подключаем стили и скрипты в админке
    **/
    public function action_admin_enqueue_scripts() {
        // Подключаем стили и скрипты только к нашей странице
        if( ! isset( $_GET['page'] ) || $_GET['page'] != self::$textdomain )
            return;
        wp_enqueue_style( 'wp-color-picker' ); // Colorpicker
        wp_enqueue_style(
            self::$textdomain . '-admin-style',
            self::$url . '/css/admin-style.css',
            array(),
            self::$version
        );
        wp_enqueue_script(
            'jquery-cookie',
            self::$url . '/js/jquery-cookie.js',
            array( 'jquery' ),
            '1.4.0'
        );
        if( function_exists( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        } else {
            wp_enqueue_style('thickbox');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
        }
        wp_enqueue_script(
            self::$textdomain . '-admin-script',
            self::$url . '/js/admin-script.js',
            array( 'jquery', 'wp-color-picker', 'jquery-cookie' ),
            self::$version
        );
    }
    
    /**
     * Для использования нашего плагина нужно что бы jquery был подключен
    **/
    public function action_wp_enqueue_scripts() {
        wp_enqueue_script( 'jquery' );
    }
    /**
     * Функия, которая выводит кнопку по настройкам
    **/
    public function action_wp_footer() {
        include_once self::$path . '/frontend.php';
    }
    
    
    /**
     * Функия, которая при каждом запуске записывает переменные перед их использованием
    **/
    public function init() {
        $this->init_path( self::$file );
        self::$plugin_slug      =   preg_replace( '/\W/', '_',  basename( self::$file, '.php' ) );
        self::$textdomain       =   str_replace( '_', '-', self::$plugin_slug );
        self::$option_version   =   self::$plugin_slug . '_version';
        self::$option_name      =   self::$plugin_slug . '_options';
        $this->check_plugin_update();
        self::$options          =   get_option( self::$option_name );
    }
    /**
     * Проверяем в необходимости обновить настройки плагина
    **/
    public function check_plugin_update() {
        if ( ! is_admin() ) return false;
        if( ! function_exists( 'get_plugin_data' ) )
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            
        $plugin_data    =   get_plugin_data( self::$file , false, false );            
            
        self::$version  =   $plugin_data['Version'];
        $old_version    =   get_option( self::$option_version );
        
        if( ! $old_version || $old_version != self::$version || ! get_option( self::$option_name ) )
            $this->plugin_update( $old_version, self::$version );
    }
    /**
     * Получаем путь и url к данному файлу
    **/
    public function init_path( $path = __FILE__ ) {
        $path       =   dirname( $path );
        $path       =   str_replace('\\' ,'/', $path); // sanitize for Win32 installs
        $path       =   preg_replace('|/+|', '/', $path);
        $forlder    =   basename( WP_CONTENT_DIR );
        $path       =   substr( $path, strpos( $path, $forlder ) );
        self::$path =   preg_replace('|/+|', '/', ABSPATH . $path);
        self::$url  =   site_url( $path );
        return $path;
    }
    /**
     * Функция поддключающая перевод к плагину
    **/
    public function load_plugin_textdomain( $domain, $plugin_abs_path = false ) {
        $locale     =   apply_filters( 'plugin_locale', get_locale(), $domain );
        
        $path       =   trim( self::$path, '/' );
        if ( false !== $plugin_abs_path )
            $path   =   trim( $plugin_abs_path, '/' );
        
        $mofile     =   $path . '/'. $domain . '-' . $locale . '.mo';
        return load_textdomain( $domain, $mofile );
    }
    /**
     * Функция обновления плагина с пред. версий
    **/
    public function plugin_update( $old_version, $new_version ) {
        $new_options = $this->plugin_defaults();
        if( isset( $old_version ) && ! empty( $old_version ) ) {
            if( (float) $old_version < (float) '1.0' && get_option( 'm7_go_top_fields' ) ) {
                $old_options = get_option( 'm7_go_top_fields' );
                if( $old_options ):
                    $new_options['disabled']                    =   0;
                    $new_options['settings']['type']            =   $old_options['type'];
                    $new_options['settings']['text']            =   $old_options['text'];
                    $new_options['settings']['aling_h']         =   $old_options['position'];
                    $new_options['style']['width']              =   $old_options['width'];
                    $new_options['style']['height']             =   $old_options['height'];
                    $new_options['offset']['top']               =   $old_options['ztop'];
                    $new_options['offset']['bottom']            =   $old_options['zbottom'];
                    $new_options['offset']['left']              =   $old_options['zleft'];
                    $new_options['offset']['right']             =   $old_options['zright'];
                    $new_options['color']['wrapp']              =   $old_options['bg_color'];
                    $new_options['color']['wrapp_hover']        =   $old_options['bg_hover_color'];
                    $new_options['color']['text']               =   $old_options['color'];
                    $new_options['color']['text_hover']         =   $old_options['hover_color'];
                    if( 'vk' == $old_options['type'] ) {
                        if( 'left' == $old_options['position'] ){
                            $new_options['padding']['right']    =   $old_options['zleft'];
                        } else {
                            $new_options['padding']['left']     =   $old_options['zright'];
                        }
                    }
                endif;
                delete_option( 'm7_go_top_fields' );
                $new_version = '1.0';
            } elseif( (float) $old_version < (float) '1.1' ) {
                $new_options = get_option( self::$option_name );
                $new_version = '1.1';
            }
        }
        update_option( self::$option_name, $new_options );
        update_option( self::$option_version, $new_version );
    }
    
    public function plugin_defaults() {
        $defaults = array(
            'disabled'              =>  1,
            'settings'      =>  array(
                'type'              =>  'button', // button / vk / image / button-image / vk-image
                
                'text'              =>  __( 'Top', self::$textdomain ),
                //'text_hover'        =>  __( 'Up', self::$textdomain ),
                
                'src'               =>  '',
                'src_hover'         =>  '',
                
                'align_h'           =>  'left', // left / right
                'align_w'           =>  'bottom', // bottom / top
            ),
            'script'        =>  array(
                'start'             =>  300,
                'start_unit'        =>  'px',
                
                'speed'             =>  1000
            ),
            'style'         =>  array(
                'opacity'           =>  5,
                'opacity_hover'     =>  10,
                
                'font_size'         =>  14,
                'font_size_unit'    =>  'px',
                
                'width'             =>  50,
                'height'            =>  50,
                
                'custom'            =>  '',
            ),
            'color'         =>  array(
                'wrapp'             =>  '#000000',
                'wrapp_hover'       =>  '#000000',
                
                'text'              =>  '#ffffff',
                'text_hover'        =>  '#ffffff',
            ),
            'padding'       =>  array(
                'right'             =>  10,
                'left'              =>  10
            ),
            'offset'      =>  array(
                'top'               =>  50,
                'right'             =>  50,
                'bottom'            =>  50,
                'left'              =>  50
            ),
            'border'        =>  array(
                'use'               =>  0,
                'width'             =>  1,
                'style'             =>  'solid',
                'color'             =>  '#7099bf'
            ),
            'border_radius' =>  array(
                'use'               =>  1,
                'top_left'          =>  10,
                'top_right'         =>  10,
                'bottom_right'      =>  10,
                'bottom_left'       =>  10
            ),
            'text_shadow'   =>  array(
                'use'               =>  1,
                'x'                 =>  0,
                'y'                 =>  1,
                'blur'              =>  1,
                'color'             =>  '#ffffff'
            ),
            'box_shadow'    =>  array(
                'use'               =>  1,
                'inset'             =>  0,
                'x'                 =>  0,
                'y'                 =>  0,
                'blur'              =>  10,
                'spread'            =>  0,
                'color'             =>  '#000000'
            ),
            'classes'       =>  array(
                'wrapp'              =>  '',
                'link'              =>  '',
                'span'              =>  '',
                'image'             =>  ''
            )
        );
        
        return $defaults;
    }
    
    public static function plugin_uninstall() {
        if( get_option( self::$option_version ) )
            delete_option( self::$option_version );
        if( get_option( self::$option_name ) )
            delete_option( self::$option_name );
    }
} // class M7_Go_Top

endif; // ( class_exists( 'M7_Go_Top' ) )

/**
 * Проверяем существует ли класс и инициализируем его запуск
**/
if( class_exists( 'M7_Go_Top' ) ):
    
    global $M7_Go_Top;
    if( ! isset( $M7_Go_Top ) || empty( $M7_Go_Top ) )
	   $M7_Go_Top = new M7_Go_Top();
    
    /**
     * Добавляем базовые хуки при активации, деактивации и удалении плагина
    **/
    //register_activation_hook( __FILE__,     array( $M7_Go_Top,  'plugin_activation' ) );
    //register_deactivation_hook( __FILE__,   array( $M7_Go_Top,  'plugin_deactivation' ) );
    register_uninstall_hook( __FILE__,      array( 'M7_Go_Top',  'plugin_uninstall' ) );
    
endif; // ( class_exists( 'M7_Go_Top' ) )