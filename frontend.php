<?php $options = self::$options; ?>
<div id="m7-go-top" class="<?php echo $options['classes']['wrapp']; ?>">
    <a href="#" title="<?php echo $options['settings']['text']; ?>" class="<?php echo $options['classes']['link']; ?>">
        <?php if( 'image' == $options['settings']['type'] && isset( $options['settings']['src'] ) && ! empty( $options['settings']['src'] ) ) { ?>
            <img src="<?php echo $options['settings']['src']; ?>" alt="<?php echo $options['settings']['text']; ?>" class="<?php echo $options['classes']['image']; ?>" data-hover-image="<?php echo ( isset( $options['settings']['src_hover'] ) && ! empty( $options['settings']['src_hover'] ) ) ? 'true' : 'false'; ?>" />
            <?php if( isset( $options['settings']['src_hover'] ) && ! empty( $options['settings']['src_hover'] ) ) { ?>
                <img src="<?php echo $options['settings']['src_hover']; ?>" alt="<?php echo $options['settings']['text']; ?>" class="<?php echo $options['classes']['image']; ?>" />
            <?php } ?>
        <?php } else { ?>
            <span class="<?php echo $options['classes']['span']; ?>"><?php echo $options['settings']['text']; ?></span>
        <?php } ?>
    </a>
</div>
<?php
$aling_h        =   $options['settings']['align_h'];
$aling_w        =   $options['settings']['align_w'];
$border_radius  =   $options['border_radius']['top_left'] . 'px ' . $options['border_radius']['top_right'] . 'px ' . $options['border_radius']['bottom_right'] . 'px ' . $options['border_radius']['bottom_left'] . 'px';
$box_shadow     =   $options['box_shadow']['x'] . 'px ' . $options['box_shadow']['y'] . 'px ' . $options['box_shadow']['blur'] . 'px ' . $options['box_shadow']['spread'] . 'px ' . $options['box_shadow']['color'];
if( 1 == (int) $options['box_shadow']['inset'] )
    $box_shadow     .= ' inset';
$text_shadow    =   $options['text_shadow']['x'] . 'px ' . $options['text_shadow']['y'] . 'px ' . $options['text_shadow']['blur'] . 'px ' . $options['text_shadow']['color'];
$opacity        =   str_replace( '.0', '', number_format( $options['style']['opacity']/10, 1, '.', '') );
$opacity_hover  =   str_replace( '.0', '', number_format( $options['style']['opacity_hover']/10, 1, '.', '') );
?>
<style type="text/css">
    #m7-go-top {
        position: fixed;
        overflow: hidden;
        text-align: center;
        <?php if( 'vk' != $options['settings']['type'] ) { ?>
        
            width: <?php echo $options['style']['width']; ?>px;
            height: <?php echo $options['style']['height']; ?>px;
            line-height: <?php echo $options['style']['height']; ?>px;
            background: <?php echo $options['color']['wrapp']; ?>;
            <?php if( 1 == (int) $options['border_radius']['use'] ) { ?>
                -webkit-border-radius: <?php echo $border_radius; ?>;
                -moz-border-radius: <?php echo $border_radius; ?>;
                border-radius: <?php echo $border_radius; ?>;
                background-clip: padding-box;
            <?php } ?>
            <?php if( 1 == (int) $options['border']['use'] ) { ?>
                border: <?php echo $options['border']['width'] . 'px '. $options['border']['style'] . ' ' . $options['border']['color']; ?>;
            <?php } ?>
            <?php if( 1 == (int) $options['box_shadow']['use'] ) { ?>
                -moz-box-shadow: <?php echo $box_shadow; ?>;
                -webkit-box-shadow: <?php echo $box_shadow; ?>;
                box-shadow: <?php echo $box_shadow; ?>;
            <?php } ?>
            <?php echo $aling_h . ': ' . $options['offset'][$aling_h] . 'px;'; ?>
            
            <?php echo $aling_w . ': ' . $options['offset'][$aling_w] . 'px;'; ?>
        <?php } else { ?>
            height: 100%;
            top: 0px;
            <?php if( 'left' == $aling_h ) { ?>
                padding-right: <?php echo $options['padding']['right']; ?>px;
            <?php } elseif( 'right' == $aling_h ) { ?>
                padding-left: <?php echo $options['padding']['left']; ?>px;
            <?php } ?>
            <?php echo $aling_h ?>: 0px;
        <?php } ?>
        <?php if( 'image' != $options['settings']['type'] ) { ?>
            -moz-text-shadow: <?php echo $text_shadow; ?>;
            -webkit-text-shadow: <?php echo $text_shadow; ?>;
            text-shadow: <?php echo $text_shadow; ?>;
            font-size: <?php echo $options['style']['font_size'] . $options['style']['font_size_unit']; ?>;
        <?php } else { ?>
            background: transparent;
        <?php } ?>
        -moz-opacity: <?php echo $opacity; ?>;
        -khtml-opacity: <?php echo $opacity; ?>;
        opacity: <?php echo $opacity; ?>;
        -webkit-transition: all 300ms linear;
        -moz-transition: all 300ms linear;
        -o-transition: all 300ms linear;
        -ms-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    #m7-go-top:hover {
        -moz-opacity: <?php echo $opacity_hover; ?>;
        -khtml-opacity: <?php echo $opacity_hover; ?>;
        opacity: <?php echo $opacity_hover; ?>;
        <?php if( 'vk' != $options['settings']['type'] && 'image' != $options['settings']['type'] ) { ?>
        
            background: <?php echo $options['color']['wrapp_hover']; ?>;
            
        <?php } ?>
    }
    #m7-go-top a {
        display: block;
        text-decoration: none;
        position: relative;
        height: 100%;
        color: <?php echo $options['color']['text']; ?>;
        <?php if( 'vk' == $options['settings']['type'] ) { ?>
        
            width: <?php echo $options['style']['width']; ?>px;
            background: <?php echo $options['color']['wrapp']; ?>;
            <?php if( 1 == (int) $options['box_shadow']['use'] ) { ?>
                -moz-box-shadow: <?php echo $box_shadow; ?>;
                -webkit-box-shadow: <?php echo $box_shadow; ?>;
                box-shadow: <?php echo $box_shadow; ?>;
            <?php } ?>
            
        <?php } ?>
        -webkit-transition: background-color 200ms linear;
        -moz-transition: background-color 200ms linear;
        -o-transition: background-color 200ms linear;
        -ms-transition: background-color 200ms linear;
        transition: background-color 200ms linear;
    }
    <?php if( 'vk' == $options['settings']['type'] ) { ?>
        #m7-go-top:hover a {
            background: <?php echo $options['color']['wrapp_hover']; ?>;
        }  
    <?php } ?>
    #m7-go-top a:hover {
        color: <?php echo $options['color']['text_hover']; ?>;
    }
    #m7-go-top a span {
        font-size: <?php echo $options['style']['font_size'] . $options['style']['font_size_unit']; ?>;
        <?php if( 'vk' == $options['settings']['type'] ) { ?>
        
            width: 100%;
            left: 0px;
            position: absolute;
            <?php echo $aling_w . ': ' . $options['offset'][$aling_w] . 'px;'; ?>
        <?php } ?>
    }
    #m7-go-top a img {
        display: block;
        position: absolute;
        top: 0px;
        left: 0px;
        -webkit-transition: all 300ms linear;
        -moz-transition: all 300ms linear;
        -o-transition: all 300ms linear;
        -ms-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    #m7-go-top a img + img {
        position: absolute;
        top: 0px;
        left: 0px;
        -moz-opacity: 0;
        -khtml-opacity: 0;
        opacity: 0;
        -webkit-transition: all 300ms linear;
        -moz-transition: all 300ms linear;
        -o-transition: all 300ms linear;
        -ms-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    #m7-go-top:hover a img[data-hover-image="true"] {
        -moz-opacity: 0;
        -khtml-opacity: 0;
        opacity: 0;
    }
    #m7-go-top:hover a img[data-hover-image="true"] + img {
        -moz-opacity: 1;
        -khtml-opacity: 1;
        opacity: 1;
        z-index: 2;
    }
    <?php echo $options['style']['custom']; ?>
</style>
<script type="text/javascript">
    jQuery(function($){
        
        var doc         =   $( document );
        var win         =   $( window );
        var m7_go_top   =   doc.find( '#m7-go-top' );
        
        if( ! m7_go_top || m7_go_top.length == 0 )
        return;
        
        m7_go_top.fadeOut( 0 );
        
        win.scroll(function () {
            var scrolltop   =   $(this).scrollTop();
            if( '%' == '<?php echo $options['script']['start_unit']; ?>' )
                scrolltop   =   scrolltop / doc.height() * 100;
                
            if ( scrolltop > <?php echo (int) $options['script']['start']; ?> ) {
                m7_go_top.fadeIn( 500 );
            } else {
                m7_go_top.fadeOut( 500 );
            }
        });
        
        m7_go_top.on('click', 'a', function () {
            $('body,html').stop(false, false).animate({
                scrollTop: 0
            }, <?php echo (int) $options['script']['speed']; ?> );
            return false;
        });
    });
</script>