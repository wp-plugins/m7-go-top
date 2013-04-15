<?php
define( 'M7_GO_TOP_FRONT_PATH', plugin_dir_path( __FILE__ ) );
define( 'M7_GO_TOP_FRONT_URL', plugin_dir_url( __FILE__ ) );

/** Adding front scripts */
add_action('wp_enqueue_scripts', 'm7_enqueue_scripts');

function m7_enqueue_scripts() {
    if ( !is_admin() && get_option('m7_go_top_fields') ) {
        $options = get_option('m7_go_top_fields');
        $m7_text = $options['text'];
        if(!$m7_text) $m7_text = __( 'Top', 'm7-go-top' );
        wp_enqueue_style( 'm7_go_top_style', M7_GO_TOP_FRONT_URL . 'css/m7_go_top_style.css', false, get_option('m7_go_top_version') );
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'm7_go_top_script', M7_GO_TOP_FRONT_URL . 'js/m7_go_top_script.js', array('jquery'), get_option('m7_go_top_version') );
        wp_localize_script( 'm7_go_top_script', 'm7_go_top', array( 'm7_text' => $m7_text ) );
    }
}

/** Displaying script and styles based on options we selected */
add_action('wp_head', 'm7_echo_go_top_script');
function m7_echo_go_top_script() {
    if( ! get_option('m7_go_top_fields') )
        return false;
    $options = get_option('m7_go_top_fields');
    $m7_type = $options['type'];
    if(!$m7_type) $m7_type = 'button';
    $m7_text = $options['text'];
    if(!$m7_text) $m7_text = __( 'Top', 'm7-go-top' );
    $m7_position = $options['position'];
    if(!$m7_position) $m7_position = 'left';
    $m7_width = $options['width'];
    if(!$m7_width) $m7_width = '100';
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
    $style .= '} ';
    $style .= '#m7_go_top a {';
    $style .= 'color:'.$m7_color.';';
    $style .= 'background:'.$m7_bg_color.';';
    if($m7_type == 'vk'){
        $style .= 'height: 100%;';
        $style .= 'line-height: 1.5;';
        $style .= 'width:'.$m7_width.'px;';
        $style .= 'padding-top: '.$m7_ztop.'px;';
        $style .= 'opacity: 0.5;
            filter: alpha(opacity=50);
            -webkit-transition: background-color 200ms linear;
            -moz-transition: background-color 200ms linear;
            transition: background-color 200ms linear;
            -webkit-transition: opacity 200ms linear;
            -moz-transition: opacity 200ms linear;
            transition: opacity 200ms linear;
        ';
        if($m7_position == 'left'){
            $style .= 'margin-right:'.$m7_zright.'px;';
        } else {
            $style .= 'margin-left:'.$m7_zleft.'px;';
        }
    } else {
        $style .= 'height:'.$m7_height.'px;';
        $style .= 'line-height:'.$m7_height.'px;';
    }
    $style .= '} ';
    $style .= '#m7_go_top a:hover, #m7_go_top:hover a {';
    $style .= 'opacity: 1;';
    $style .= 'filter: alpha(opacity=100);';
    $style .= 'color:'.$m7_hover_color.';';
    $style .= 'background:'.$m7_bg_hover_color.';';
    $style .= '}';
    
    $style .= '#m7_go_top a span {';
    if($m7_type == 'vk'){
        $style .= 'font-size: 12px;';
        $style .= 'line-height: 20px;';
    } else {
        $style .= 'font-size: 12px;';
        $style .= 'line-height:'.$m7_height.'px;';
    }
    $style .= '}';
    echo '<style>'.$style.'</style>';
}