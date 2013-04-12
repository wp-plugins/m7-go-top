<?php

// Задаём пути для админки
define( 'M7_GO_TOP_ADMIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'M7_GO_TOP_ADMIN_URL', plugin_dir_url( __FILE__ ) );

// Подключаем админские скрипты
add_action('admin_enqueue_scripts', 'm7_admin_enqueue_scripts');

function m7_admin_enqueue_scripts() {
    global $m7_ver;
    if ( is_admin() ) {
        wp_enqueue_style( 'm7_go_top_style', M7_GO_TOP_ADMIN_URL . 'css/m7_go_top_admin_style.css', false, $m7_ver );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script( 'jquery-maskedinput', M7_GO_TOP_ADMIN_URL . 'js/jquery.maskedinput.min.js', array('jquery'), '1.3.1' );
        wp_enqueue_script( 'm7_go_top_script', M7_GO_TOP_ADMIN_URL . 'js/m7_go_top_admin_script.js', array('jquery'), $m7_ver );
    }     
}
//Создаём страницу настроек
add_action('admin_menu', 'm7_menu');

function m7_menu() {
	add_options_page('Go Top', 'Go Top', 'manage_options', 'm7-go-top.php', 'm7_view');
}

function m7_view(){
    ?>
    <div class="wrap">
    <div id="icon-plugins" class="icon32"></div>
    <h2>M7 Go Top</h2>
    <div id="m7_go_top">
        
        <div style="float: right; width:35%;margin-right:10%;text-align: center;">
            <h2>Donate</h2>
            <p>As a young, college student, it takes a great deal of my time and resources to continue to develop and support these great, FREE WordPress Plugin.<br /><b>Please help me out by Donating today.</b>
<br /><br /><i>After clicking the button below you will be re-directed to PayPal where you can specify how much to donate and complete the secure transaction.</i></p>
            <p><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="J85VH2E779DXA">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">
</form></p>

        <div id="credits">
            <p><a target="_blank" href="#">Plugin Web Site</a><span style="font-size: 9px;">(in development)</span> and <a target="_blank" href="http://m7-pro.ru">Author Web Site</a></p>
        </div>
        </div>
        
        <form class="m7_go_top" action="options.php" method="post" style="width: 50%;overflow:auto;">
        <?php settings_fields('m7_plugin_options'); ?>
        <?php do_settings_sections('m7-go-top.php'); ?>
        <?php submit_button(); ?>
        </form>
        
        <div class="clear"></div>
    </div>
    <?php
}
add_action('admin_init', 'm7_plugin_admin_init');
function m7_plugin_admin_init(){
    register_setting( 'm7_plugin_options', 'm7_fields', 'm7_plugin_options_validate' );
    add_settings_section('m7_plugin_main', '', 'm7_plugin_section_text', 'm7-go-top.php');
    
    /** Основные */
    add_settings_field('m7_plugin_go_top_type', '<label for="m7_plugin_go_top_type">Button type:</label>', 'm7_plugin_go_top_type', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_text', '<label for="m7_plugin_go_top_text">Button text:</label>', 'm7_plugin_go_top_text', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_position', '<label for="m7_plugin_go_top_position">Align:</label>', 'm7_plugin_go_top_position', 'm7-go-top.php', 'm7_plugin_main');
    
    /** Размер */
    add_settings_field('m7_plugin_go_top_width', '<label for="m7_plugin_go_top_width">Width:</label>', 'm7_plugin_go_top_width', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_height', '<label for="m7_plugin_go_top_height">Height:</label>', 'm7_plugin_go_top_height', 'm7-go-top.php', 'm7_plugin_main');
    
    /** Отступы */
    add_settings_field('m7_plugin_go_top_ztop', '<label for="m7_plugin_go_top_ztop">Top inset</label>', 'm7_plugin_go_top_ztop', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_zright', '<label for="m7_plugin_go_top_zright">Right inset</label>', 'm7_plugin_go_top_zright', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_zbottom', '<label for="m7_plugin_go_top_zbottom">Bottom inset</label>', 'm7_plugin_go_top_zbottom', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_zleft', '<label for="m7_plugin_go_top_zleft">Left inset</label>', 'm7_plugin_go_top_zleft', 'm7-go-top.php', 'm7_plugin_main');
    
    /** Цвета */
    add_settings_field('m7_plugin_go_top_color', '<label for="m7_plugin_go_top_color">Text color</label>', 'm7_plugin_go_top_color', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_hover_color', '<label for="m7_plugin_go_top_hover_color">Text hover color</label>', 'm7_plugin_go_top_hover_color', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_bg_color', '<label for="m7_plugin_go_top_bg_color">Background color</label>', 'm7_plugin_go_top_bg_color', 'm7-go-top.php', 'm7_plugin_main');
    add_settings_field('m7_plugin_go_top_bg_hover_color', '<label for="m7_plugin_go_top_bg_hover_color">Background hover color</label>', 'm7_plugin_go_top_bg_hover_color', 'm7-go-top.php', 'm7_plugin_main');
}
function m7_plugin_section_text() {
    echo '';
}
/** Основные */
function m7_plugin_go_top_type() {
    $options = get_option('m7_fields');
    $items = array('button' => 'Button', 'vk' => 'style like VK.com');
	echo "<select id='m7_plugin_go_top_type' name='m7_fields[type]'>";
	foreach($items as $key => $item) {
		$selected = ($options['type'] == $key) ? 'selected="selected"' : '';
		echo "<option value='$key' $selected>$item</option>";
	}
	echo "</select>";
}
function m7_plugin_go_top_text() {
    $options = get_option('m7_fields');
    echo "<input id='m7_plugin_go_top_text' name='m7_fields[text]' type='text' value='{$options['text']}' placeholder='Top' />";
}
function m7_plugin_go_top_position() {
    $options = get_option('m7_fields');
    $items = array('right' => 'Right', 'left' => 'Left');
	echo "<select id='m7_plugin_go_top_position' name='m7_fields[position]'>";
	foreach($items as $key => $item) {
		$selected = ($options['position'] == $key) ? 'selected="selected"' : '';
		echo "<option value='$key' $selected>$item</option>";
	}
	echo "</select>";
}
/** Размер */
function m7_plugin_go_top_width() {
    $options = get_option('m7_fields');
    echo "<p><input id='m7_plugin_go_top_width' name='m7_fields[width]' type='number' value='{$options['width']}' /> px</p>";
}
function m7_plugin_go_top_height() {
    $options = get_option('m7_fields');
    echo "<p><input id='m7_plugin_go_top_height' name='m7_fields[height]' type='number' value='{$options['height']}' /> px</p>";
}
/** Отступы */
function m7_plugin_go_top_ztop() {
    $options = get_option('m7_fields');
    echo "<p><input id='m7_plugin_go_top_ztop' name='m7_fields[ztop]' type='number' value='{$options['ztop']}' /> px</p>";
}
function m7_plugin_go_top_zright() {
    $options = get_option('m7_fields');
    echo "<p><input id='m7_plugin_go_top_zright' name='m7_fields[zright]' type='number' value='{$options['zright']}' /> px</p>";
}
function m7_plugin_go_top_zbottom() {
    $options = get_option('m7_fields');
    echo "<p><input id='m7_plugin_go_top_zbottom' name='m7_fields[zbottom]' type='number' value='{$options['zbottom']}' /> px</p>";
}
function m7_plugin_go_top_zleft() {
    $options = get_option('m7_fields');
    echo "<p><input id='m7_plugin_go_top_zleft' name='m7_fields[zleft]' type='number' value='{$options['zleft']}' /> px</p>";
}
/** Цвета */
function m7_plugin_go_top_color() {
    $options = get_option('m7_fields');
    echo "<input id='m7_plugin_go_top_color' class='m7-color-field' name='m7_fields[color]' type='text' value='{$options['color']}' data-default-color='#45688e' />";
}
function m7_plugin_go_top_hover_color() {
    $options = get_option('m7_fields');
    echo "<input id='m7_plugin_go_top_hover_color' class='m7-color-field' name='m7_fields[hover_color]' type='text' value='{$options['hover_color']}' data-default-color='#45688e' />";
}
function m7_plugin_go_top_bg_color() {
    $options = get_option('m7_fields');
    echo "<input id='m7_plugin_go_top_bg_color' class='m7-color-field' name='m7_fields[bg_color]' type='text' value='{$options['bg_color']}' data-default-color='transparent' />";
}
function m7_plugin_go_top_bg_hover_color() {
    $options = get_option('m7_fields');
    echo "<input id='m7_plugin_go_top_bg_hover_color' class='m7-color-field' name='m7_fields[bg_hover_color]' type='text' value='{$options['bg_hover_color']}' data-default-color='#E1E7ED' />";
}
function m7_plugin_options_validate($input) {
    $newinput['type'] = wp_filter_nohtml_kses(trim($input['type']));
    $newinput['text'] = wp_filter_nohtml_kses(trim($input['text']));
    if($newinput['text'] == '' || !$newinput['text'] ){
        $newinput['text'] = '&uarr; Top';
    }
    $newinput['position'] = wp_filter_nohtml_kses(trim($input['position']));
    
    
    $newinput['width'] = wp_filter_nohtml_kses(trim($input['width']));
    if($newinput['width'] == '' || !$newinput['width'] ){
        $newinput['width'] = 'auto';
    }
    $newinput['height'] = wp_filter_nohtml_kses(trim($input['height']));
    if($newinput['height'] == '' || !$newinput['height'] ){
        $newinput['height'] = 'auto';
    }
    
    $newinput['ztop'] = wp_filter_nohtml_kses(trim($input['ztop']));
    if($newinput['ztop'] == '' || !$newinput['ztop'] ){
        $newinput['ztop'] = '0';
    }
    $newinput['zright'] = wp_filter_nohtml_kses(trim($input['zright']));
    if($newinput['zright'] == '' || !$newinput['zright'] ){
        $newinput['zright'] = '0';
    }
    $newinput['zbottom'] = wp_filter_nohtml_kses(trim($input['zbottom']));
    if($newinput['zbottom'] == '' || !$newinput['zbottom'] ){
        $newinput['zbottom'] = '0';
    }
    $newinput['zleft'] = wp_filter_nohtml_kses(trim($input['zleft']));
    if($newinput['zleft'] == '' || !$newinput['zleft'] ){
        $newinput['zleft'] = '0';
    }
    
    $newinput['color'] = wp_filter_nohtml_kses(trim($input['color']));
    if($newinput['color'] == '' || !$newinput['color'] ){
        $newinput['color'] = '#45688e';
    }
    $newinput['hover_color'] = wp_filter_nohtml_kses(trim($input['hover_color']));
    if($newinput['hover_color'] == '' || !$newinput['hover_color'] ){
        $newinput['hover_color'] = '#45688e';
    }
    $newinput['bg_color'] = wp_filter_nohtml_kses(trim($input['bg_color']));
    if($newinput['bg_color'] == '' || !$newinput['color'] ){
        $newinput['bg_color'] = '#E1E7ED';
    }
    $newinput['bg_hover_color'] = wp_filter_nohtml_kses(trim($input['bg_hover_color']));
    if($newinput['bg_hover_color'] == '' || !$newinput['bg_hover_color'] ){
        $newinput['bg_hover_color'] = '#E1E7ED';
    }
    return $newinput;
}