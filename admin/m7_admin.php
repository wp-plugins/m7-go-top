<?php
// Задаём пути для админки
define( 'M7_GO_TOP_ADMIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'M7_GO_TOP_ADMIN_URL', plugin_dir_url( __FILE__ ) );

/** Loading scripts only on m7-go-top options page */
add_action('admin_enqueue_scripts', 'm7_admin_enqueue_scripts');
function m7_admin_enqueue_scripts() {
    if ( is_admin() && isset($_GET['page']) && $_GET['page'] == 'm7-go-top.php') {
        wp_enqueue_style( 'm7_go_top_style', M7_GO_TOP_ADMIN_URL . 'css/m7_go_top_admin_style.css', false, get_option('m7_go_top_version') );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        wp_register_script( 'm7_go_top_script', M7_GO_TOP_ADMIN_URL . 'js/m7_go_top_admin_script.js', array('jquery'), get_option('m7_go_top_version') );
        wp_enqueue_script( 'm7_go_top_script' );
    }     
}

/** Creating options page m7-go-top */
add_action('admin_menu', 'm7_go_top_menu');
function m7_go_top_menu() {
	add_options_page('M7 Go Top', 'M7 Go Top', 'manage_options', 'm7-go-top.php', 'm7_go_top_view');
}
function m7_go_top_view(){
    ?>
    <div class="wrap">
    <div id="icon-plugins" class="icon32"></div>
    <h2>M7 Go Top</h2>
    <div id="m7_go_top">
        <div style="float: right; width:35%;margin-right:10%;text-align: center;">
            <h2><?php _e( 'Donate', 'm7-go-top' ); ?></h2>
            <p><?php _e( 'As a young, college student, it takes a great deal of my time and resources to continue to develop and support these great, FREE WordPress Plugin.', 'm7-go-top' ); ?><br /><b><?php _e( 'Please help me out by Donating today.', 'm7-go-top' ); ?></b>
<br /><br /><i><?php _e( 'After clicking the button below you will be re-directed to PayPal where you can specify how much to donate and complete the secure transaction.', 'm7-go-top' ); ?></i></p>
            <p>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="J85VH2E779DXA">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <!--<img alt="" border="0" src="https://www.paypalobjects.com/ru_RU/i/scr/pixel.gif" width="1" height="1">-->
                </form>
            </p>

        <div id="credits">
            <p><a target="_blank" href="#"><?php _e('Plugin Web Site','m7-go-top'); ?></a> <?php _e('and','m7-go-top'); ?> <a target="_blank" href="http://m7-pro.ru"><?php _e('Author Web Site','m7-go-top'); ?></a></p>
        </div>
        </div>
        
        <form class="m7_go_top" action="options.php" method="post" style="width: 50%;overflow:auto;">
        <?php settings_fields('m7_go_top_options'); ?>
        <?php do_settings_sections('m7-go-top.php'); ?>
        <?php submit_button(); ?>
        </form>
        
        <div class="clear"></div>
    </div>
    <?php
}
add_action('admin_init', 'm7_plugin_admin_init');
function m7_plugin_admin_init(){
    $m7 = 'm7_go_top';
    register_setting( $m7.'_options', $m7.'_fields', $m7.'_options_validate' );
    add_settings_section( $m7.'_settings', '', $m7.'_section_text', 'm7-go-top.php');
    
    /** Основные */
    add_settings_field( $m7.'_type', '<label for="'.$m7.'_type">'.__( 'Button type', 'm7-go-top' ).':</label>', $m7.'_type', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_text', '<label for="'.$m7.'_text">'.__( 'Button text', 'm7-go-top' ).':</label>', $m7.'_text', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_position', '<label for="'.$m7.'_position">'.__( 'Align', 'm7-go-top' ).':</label>', $m7.'_position', 'm7-go-top.php', $m7.'_settings');
    
    /** Размер */
    add_settings_field( $m7.'_width', '<label for="'.$m7.'_width">'.__( 'Width', 'm7-go-top' ).':</label>', $m7.'_width', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_height', '<label for="'.$m7.'_height">'.__( 'Height', 'm7-go-top' ).':</label>', $m7.'_height', 'm7-go-top.php', $m7.'_settings');
    
    /** Отступы */
    add_settings_field( $m7.'_zleft', '<label for="'.$m7.'_zleft">'.__( 'Left inset', 'm7-go-top' ).':</label>', $m7.'_zleft', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_zright', '<label for="'.$m7.'_zright">'.__( 'Right inset', 'm7-go-top' ).':</label>', $m7.'_zright', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_ztop', '<label for="'.$m7.'_ztop">'.__( 'Top inset', 'm7-go-top' ).':</label>', $m7.'_ztop', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_zbottom', '<label for="'.$m7.'_zbottom">'.__( 'Bottom inset', 'm7-go-top' ).':</label>', $m7.'_zbottom', 'm7-go-top.php', $m7.'_settings');
    
    
    /** Цвета */
    add_settings_field( $m7.'_color', '<label for="'.$m7.'_color">'.__( 'Text color', 'm7-go-top' ).':</label>', $m7.'_color', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_hover_color', '<label for="'.$m7.'_hover_color">'.__( 'Text hover color', 'm7-go-top' ).':</label>', $m7.'_hover_color', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_bg_color', '<label for="'.$m7.'_bg_color">'.__( 'Background color', 'm7-go-top' ).':</label>', $m7.'_bg_color', 'm7-go-top.php', $m7.'_settings');
    add_settings_field( $m7.'_bg_hover_color', '<label for="'.$m7.'_bg_hover_color">'.__( 'Background hover color', 'm7-go-top' ).':</label>', $m7.'_bg_hover_color', 'm7-go-top.php', $m7.'_settings');
}
function m7_go_top_section_text() {
    echo '';
}
/** Основные */
function m7_go_top_type() {
    $options = get_option('m7_go_top_fields');
    $items = array('button' => __( 'Button', 'm7-go-top' ), 'vk' => __( 'VK.com style', 'm7-go-top' ));
	echo "<select id='m7_go_top_type' name='m7_go_top_fields[type]'>";
	foreach($items as $key => $item) {
		$selected = ($options['type'] == $key) ? 'selected="selected"' : '';
		echo "<option value='$key' $selected>$item</option>";
	}
	echo "</select>";
}
function m7_go_top_text() {
    $options = get_option('m7_go_top_fields');
    echo "<input id='m7_go_top_text' name='m7_go_top_fields[text]' type='text' value='{$options['text']}' placeholder='Top' />";
}
function m7_go_top_position() {
    $options = get_option('m7_go_top_fields');
    $items = array('right' => __( 'Right', 'm7-go-top' ), 'left' => __( 'Left', 'm7-go-top' ));
	echo "<select id='m7_go_top_position' name='m7_go_top_fields[position]'>";
	foreach($items as $key => $item) {
		$selected = ($options['position'] == $key) ? 'selected="selected"' : '';
		echo "<option value='$key' $selected>$item</option>";
	}
	echo "</select>";
}
/** Размер */
function m7_go_top_width() {
    $options = get_option('m7_go_top_fields');
    echo "<p><input id='m7_go_top_width' name='m7_go_top_fields[width]' type='number' value='{$options['width']}' /> px</p>";
}
function m7_go_top_height() {
    $options = get_option('m7_go_top_fields');
    echo "<p><input id='m7_go_top_height' name='m7_go_top_fields[height]' type='number' value='{$options['height']}' /> px</p>";
}
/** Отступы */
function m7_go_top_ztop() {
    $options = get_option('m7_go_top_fields');
    echo "<p><input id='m7_go_top_ztop' name='m7_go_top_fields[ztop]' type='number' value='{$options['ztop']}' /> px</p>";
}
function m7_go_top_zright() {
    $options = get_option('m7_go_top_fields');
    echo "<p><input id='m7_go_top_zright' name='m7_go_top_fields[zright]' type='number' value='{$options['zright']}' /> px</p>";
}
function m7_go_top_zbottom() {
    $options = get_option('m7_go_top_fields');
    echo "<p><input id='m7_go_top_zbottom' name='m7_go_top_fields[zbottom]' type='number' value='{$options['zbottom']}' /> px</p>";
}
function m7_go_top_zleft() {
    $options = get_option('m7_go_top_fields');
    echo "<p><input id='m7_go_top_zleft' name='m7_go_top_fields[zleft]' type='number' value='{$options['zleft']}' /> px</p>";
}
/** Цвета */
function m7_go_top_color() {
    $options = get_option('m7_go_top_fields');
    echo "<input id='m7_go_top_color' class='m7-color-field' name='m7_go_top_fields[color]' type='text' value='{$options['color']}' data-default-color='#45688e' />";
}
function m7_go_top_hover_color() {
    $options = get_option('m7_go_top_fields');
    echo "<input id='m7_go_top_hover_color' class='m7-color-field' name='m7_go_top_fields[hover_color]' type='text' value='{$options['hover_color']}' data-default-color='#45688e' />";
}
function m7_go_top_bg_color() {
    $options = get_option('m7_go_top_fields');
    echo "<input id='m7_go_top_bg_color' class='m7-color-field' name='m7_go_top_fields[bg_color]' type='text' value='{$options['bg_color']}' data-default-color='transparent' />";
}
function m7_go_top_bg_hover_color() {
    $options = get_option('m7_go_top_fields');
    echo "<input id='m7_go_top_bg_hover_color' class='m7-color-field' name='m7_go_top_fields[bg_hover_color]' type='text' value='{$options['bg_hover_color']}' data-default-color='#E1E7ED' />";
}
function m7_go_top_options_validate($input) {
    $newinput['type'] = wp_filter_nohtml_kses(trim($input['type']));
    $newinput['text'] = wp_filter_nohtml_kses(trim($input['text']));
    if($newinput['text'] == '' || !$newinput['text'] ){
        $newinput['text'] = '&uarr; '.__( 'Top', 'm7-go-top' );
    }
    $newinput['position'] = wp_filter_nohtml_kses(trim($input['position']));
    
    
    $newinput['width'] = wp_filter_nohtml_kses(trim($input['width']));
    if($newinput['width'] == '' || !$newinput['width'] ){
        $newinput['width'] = '0';
    }
    $newinput['height'] = wp_filter_nohtml_kses(trim($input['height']));
    if($newinput['height'] == '' || !$newinput['height'] ){
        $newinput['height'] = '0';
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