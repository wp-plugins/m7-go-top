<?php
define( 'M7_GO_TOP_FRONT_PATH', plugin_dir_path( __FILE__ ) );
define( 'M7_GO_TOP_FRONT_URL', plugin_dir_url( __FILE__ ) );

//Подключаем пользовательские скрипты
add_action('wp_enqueue_scripts', 'm7_enqueue_scripts');

function m7_enqueue_scripts() {
    global $m7_ver;
    if ( !is_admin() ) {
        
        //wp_deregister_script('jquery');
        //wp_register_script('jquery', M7_GO_TOP_FRONT_URL . 'js/jquery-min.js', false, '1.9.1'); 
        // if there's some trubles/problems with wordpress jquery library - uncoment lines below.
        wp_enqueue_script('jquery');

        wp_enqueue_style( 'm7_go_top_style', M7_GO_TOP_FRONT_URL . 'css/m7_go_top_style.css', false, $m7_ver );
        
        wp_enqueue_script( 'm7_go_top_script', M7_GO_TOP_FRONT_URL . 'js/m7_go_top_script.js', array('jquery'), $m7_ver );
        
    }
}

add_action('wp_head', 'm7_echo_go_top_script');
function m7_echo_go_top_script() {
    $options = get_option('m7_fields');
    $m7_type = $options['type'];
    if(!$m7_type) $m7_type = 'button';
    $m7_text = $options['text'];
    if(!$m7_text) $m7_text = 'наверх';
    $m7_position = $options['position'];
    if(!$m7_position) $m7_position = 'left';
    $m7_width = $options['width'];
    if(!$m7_width) $m7_width = '300';
    $m7_height = $options['height'];
    if(!$m7_height) $m7_height = '50';
    $m7_ztop = $options['ztop'];
    if(!$m7_ztop) $m7_ztop = '50';
    $m7_zbottom = $options['zbottom'];
    if(!$m7_zbottom) $m7_zbottom = '50';
    $m7_zleft = $options['zleft'];
    if(!$m7_zleft) $m7_zleft = '50';
    $m7_zright = $options['zright'];
    if(!$m7_zright) $m7_zright = '50';
    
    $m7_color = $options['color'];
    if(!$m7_color) $m7_color = '#45688e';
    $m7_hover_color = $options['hover_color'];
    if(!$m7_hover_color) $m7_hover_color = '#45688e';
    $m7_bg_color = $options['bg_color'];
    if(!$m7_bg_color) $m7_bg_color = 'transparent';
    $m7_bg_hover_color = $options['bg_hover_color'];
    if(!$m7_bg_hover_color) $m7_bg_hover_color = '#E1E7ED';
    $script = '';
    $script .= 'var m7_go_top = {';
    $script .= '"m7_type": "'.$m7_type.'", ';
    $script .= '"m7_text": "'.$m7_text.'", ';
    $script .= '"m7_position": "'.$m7_position.'", ';
    $script .= '"m7_width": '.$m7_width.', ';
    $script .= '"m7_height": '.$m7_height.' ';
    $script .= '}';
    echo '<script type="text/javascript">'.$script.'</script>';
    $style = '';
    $style .= '#m7_go_top {';
    if($m7_type == 'vk'){
        $style .= 'top: 0px;';
        $style .= 'height: 100%;';
        $style .= 'width: auto;';
        $style .= 'line-height: 20px;';
        $style .= $m7_position.':0px;';
    } else {
        $style .= 'bottom: '.$m7_zbottom.'px;';
        $style .= 'height:'.$m7_height.'px;';
        $style .= 'width:'.$m7_width.'px;';
        $style .= 'line-height:'.$m7_height.'px;';
        if($m7_position == 'left'){
            $style .= $m7_position.':'.$m7_zleft.'px;';
        } else {
            $style .= $m7_position.':'.$m7_zright.'px;';
        }
    }
    $style .= '}';
    $style .= '#m7_go_top a {';
    $style .= 'color:'.$m7_color.';';
    $style .= 'background:'.$m7_bg_color.';';
    if($m7_type == 'vk'){
        $style .= 'height: 100%;';
        $style .= 'line-height: 20px;';
        $style .= 'width:'.$m7_width.'px;';
        $style .= 'padding-top: '.$m7_ztop.'px;';
        if($m7_position == 'left'){
            $style .= 'margin-right:'.$m7_zright.'px;';
        } else {
            $style .= 'margin-left:'.$m7_zleft.'px;';
        }
    } else {
        $style .= 'height:'.$m7_height.'px;';
        $style .= 'line-height:'.$m7_height.'px;';
    }
    $style .= '}';
    $style .= '#m7_go_top a:hover,#m7_go_top:hover a {';
    $style .= 'opacity: 1;';
    $style .= 'filter: alpha(opacity=100);';
    $style .= 'color:'.$m7_hover_color.';';
    $style .= 'background:'.$m7_bg_hover_color.';';
    $style .= '}';
    echo '<style>'.$style.'</style>';
}