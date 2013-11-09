<?php 
require_once self::$path . '/inc/m7-fields-class.php';
$options = self::$options; ?>
<div class="wrap">
    <?php screen_icon('m7-go-top'); ?> <h2><?php _ex('M7 Go Top', 'submenu page title' ,self::$textdomain ); ?></h2>
    <div id="m7-go-top" class="clear">
    
        <div class="left-side">
            <ul class="tabs-select clear" data-tabs="#m7-go-top-tabs" data-selector="li[data-tab]">
				<li data-tab="#settings" title="<?php _e('Settings', self::$textdomain ); ?>">
					<img src="<?php echo self::$url; ?>/images/icons/settings.png" width="32" height="32" alt="<?php _e('Settings', self::$textdomain ); ?>" />
					<span><?php _e('Settings', self::$textdomain ); ?></span>
				</li>
				<!--<li data-tab="#faq" title="<?php _e('FAQ', self::$textdomain ); ?>">
					<img src="<?php echo self::$url; ?>/images/icons/faq.png" width="32" height="32" alt="<?php _e('FAQ', self::$textdomain ); ?>" />
					<span><?php _e('FAQ', self::$textdomain ); ?></span>
				</li>-->
                <li data-tab="#donate" title="<?php _e('Donate', self::$textdomain ); ?>">
					<img src="<?php echo self::$url; ?>/images/icons/donate.png" width="32" height="32" alt="<?php _e('Donate', self::$textdomain ); ?>" />
					<span><?php _e('Donate', self::$textdomain ); ?></span>
				</li>
			</ul>
        </div>
        
        <div class="right-side">
                        
                <div id="m7-go-top-tabs">
                        
                    <div id="settings">
                        <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST">
                            <?php wp_nonce_field( self::$plugin_slug . '_action', self::$plugin_slug . '_nounce' ); ?>
                			<input type="hidden" name="action" value="<?php echo self::$plugin_slug; ?>" />
                			<input type="hidden" name="doing_ajax" value="0" />
                            
                            <p class="submit"><input type="submit" class="button button-primary" name="submit" value="<?php _ex('Save', 'submenu page save changes', self::$textdomain ); ?>" /></p>
                            <?php
                            $M7_Fields = new M7_Go_Top_Fields_Class( array(
                                'textdomain'    =>  self::$textdomain,
                                'tag'           =>  'ul',
                                'class'         =>  'fieldset',
                                'el_tag'        =>  'li',
                                'structure'     =>  '<div class="label">%1$s</div><div class="field">%2$s</div><div class="description"><p>%3$s</p></div>'
                            ) );
                            $M7_Fields->add_fields( array(
                                array(
                                    'type'  =>  'true-false',
                                    'id'    =>  self::$plugin_slug . '[disabled]',
                                    'name'  =>  self::$plugin_slug . '[disabled]',
                                    'value' =>  $options['disabled'],
                                    'label' =>  __( 'Disable plugin', self::$textdomain ), 
                                    'descr' =>  __( 'If checked plugin won\'t work in front-end', self::$textdomain ),
                                ), 
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // script
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[script][start]',
                                    'name'  =>  self::$plugin_slug . '[script][start]',
                                    'value' =>  $options['script']['start'],
                                    'label' =>  __( 'Show from', self::$textdomain ), 
                                    'descr' =>  __( 'Distance from the top of the page after which button will appear', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    )
                                ),
                                array(
                                    'type'  =>  'select',
                                    'id'    =>  self::$plugin_slug . '[script][start_unit]',
                                    'name'  =>  self::$plugin_slug . '[script][start_unit]',
                                    'value' =>  $options['script']['start_unit'],
                                    'label' =>  __( 'Show from unit', self::$textdomain ), 
                                    'descr' =>  __( 'You can specify "Show from" in pixels or percentages', self::$textdomain ),
                                    'options'   =>  array(
                                        'px'    =>  __( 'Pixels ( px )', self::$textdomain ),
                                        '%'     =>  __( 'Percentage ( % )', self::$textdomain )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[script][speed]',
                                    'name'  =>  self::$plugin_slug . '[script][speed]',
                                    'value' =>  $options['script']['speed'],
                                    'label' =>  __( 'Scroll speed', self::$textdomain ), 
                                    'descr' =>  __( 'How fast should button get to top in milliseconds ( 1000 milliseconds = 1 second )', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // settings
                                array(
                                    'type'  =>  'select',
                                    'id'    =>  self::$plugin_slug . '[settings][type]',
                                    'name'  =>  self::$plugin_slug . '[settings][type]',
                                    'value' =>  $options['settings']['type'],
                                    'label' =>  __( 'Button type', self::$textdomain ), 
                                    'descr' =>  __( 'Select how to display "m7 go top" button', self::$textdomain ),
                                    'options'   =>  array(
                                        'button' => __( 'Button', self::$textdomain ),
                                        'vk'    =>  __( 'vk.com style', self::$textdomain ),
                                        'image' =>  __( 'Image', self::$textdomain )
                                    )
                                ),
                                array(
                                    'type'  =>  'text',
                                    'id'    =>  self::$plugin_slug . '[settings][text]',
                                    'name'  =>  self::$plugin_slug . '[settings][text]',
                                    'value' =>  $options['settings']['text'],
                                    'label' =>  __( 'Button text', self::$textdomain ), 
                                    'descr' =>  __( 'Enter text that will be displayed in button.<br />If "Button type" is set to image these text will be placed in alt param of img', self::$textdomain ),
                                    'atts'   =>  array(
                                        'placeholder'   =>  __( 'Up', self::$textdomain )
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  ' ',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-file',
                                    'id'    =>  self::$plugin_slug . '[settings][src]',
                                    'name'  =>  self::$plugin_slug . '[settings][src]',
                                    'value' =>  $options['settings']['src'],
                                    'label' =>  __( 'Button image', self::$textdomain ), 
                                    'descr' =>  __( 'Copy-paste image url or select from library', self::$textdomain ),
                                    'options'   =>  array(
                                        'btn_text'  =>  __( 'Select', self::$textdomain ),
                                        'pop_text'  =>  __( 'Select', self::$textdomain ),
                                        'pop_title' =>  __( 'Upload Image', self::$textdomain )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'show'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-file',
                                    'id'    =>  self::$plugin_slug . '[settings][src_hover]',
                                    'name'  =>  self::$plugin_slug . '[settings][src_hover]',
                                    'value' =>  $options['settings']['src_hover'],
                                    'label' =>  __( 'Button hover image', self::$textdomain ), 
                                    'descr' =>  __( 'Copy-paste image url or select from library', self::$textdomain ),
                                    'options'   =>  array(
                                        'btn_text'  =>  __( 'Select', self::$textdomain ),
                                        'pop_text'  =>  __( 'Select', self::$textdomain ),
                                        'pop_title' =>  __( 'Upload Image', self::$textdomain )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'show'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // style
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[style][font_size]',
                                    'name'  =>  self::$plugin_slug . '[style][font_size]',
                                    'value' =>  $options['style']['font_size'],
                                    'label' =>  __( 'Text font size', self::$textdomain ), 
                                    'descr' =>  __( 'Font size (height of text)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'select',
                                    'id'    =>  self::$plugin_slug . '[style][font_size_unit]',
                                    'name'  =>  self::$plugin_slug . '[style][font_size_unit]',
                                    'value' =>  $options['style']['font_size_unit'],
                                    'label' =>  __( 'Text font size unit', self::$textdomain ), 
                                    'descr' =>  __( 'Select font size unit', self::$textdomain ),
                                    'options'   =>  array(
                                        'px'    =>  __( 'Pixels (px)', self::$textdomain ),
                                        '%'     =>  __( 'Percentage (%)', self::$textdomain ),
                                        'pt'    =>  __( 'Points (pt)', self::$textdomain ),
                                        'em'    =>  __( 'Em\'s (em)', self::$textdomain )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[style][width]',
                                    'name'  =>  self::$plugin_slug . '[style][width]',
                                    'value' =>  $options['style']['width'],
                                    'label' =>  __( 'Width', self::$textdomain ), 
                                    'descr' =>  __( 'Width of the button in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[style][height]',
                                    'name'  =>  self::$plugin_slug . '[style][height]',
                                    'value' =>  $options['style']['height'],
                                    'label' =>  __( 'Height', self::$textdomain ), 
                                    'descr' =>  __( 'Height of the button in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'vk'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // aligns
                                array(
                                    'type'  =>  'select',
                                    'id'    =>  self::$plugin_slug . '[settings][align_w]',
                                    'name'  =>  self::$plugin_slug . '[settings][align_w]',
                                    'value' =>  $options['settings']['align_w'],
                                    'label' =>  __( 'Wertical align', self::$textdomain ), 
                                    'descr' =>  __( 'Where to show button', self::$textdomain ),
                                    'options'   =>  array(
                                        'top'       =>  __( 'Top', self::$textdomain ),
                                        'bottom'    =>  __( 'Bottom', self::$textdomain )
                                    )
                                ),
                                array(
                                    'type'  =>  'select',
                                    'id'    =>  self::$plugin_slug . '[settings][align_h]',
                                    'name'  =>  self::$plugin_slug . '[settings][align_h]',
                                    'value' =>  $options['settings']['align_h'],
                                    'label' =>  __( 'Horizontal align', self::$textdomain ), 
                                    'descr' =>  __( 'Where to show button', self::$textdomain ),
                                    'options'   =>  array(
                                        'left'  =>  __( 'Left', self::$textdomain ),
                                        'right' =>  __( 'Right', self::$textdomain )
                                    )
                                ),
                                /*array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),*/
                                // offset
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[offset][top]',
                                    'name'  =>  self::$plugin_slug . '[offset][top]',
                                    'value' =>  $options['offset']['top'],
                                    'label' =>  __( 'Offset top', self::$textdomain ), 
                                    'descr' =>  __( 'Offset from top of browser in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][align_w]"]',
                                        'show'      =>  'top'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[offset][bottom]',
                                    'name'  =>  self::$plugin_slug . '[offset][bottom]',
                                    'value' =>  $options['offset']['bottom'],
                                    'label' =>  __( 'Offset bottom', self::$textdomain ), 
                                    'descr' =>  __( 'Offset from bottom of browser in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][align_w]"]',
                                        'show'      =>  'bottom'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[offset][left]',
                                    'name'  =>  self::$plugin_slug . '[offset][left]',
                                    'value' =>  $options['offset']['left'],
                                    'label' =>  __( 'Offset left', self::$textdomain ), 
                                    'descr' =>  __( 'Offset from left of browser in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][align_h]"]',
                                            'show'      =>  'left'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[offset][right]',
                                    'name'  =>  self::$plugin_slug . '[offset][right]',
                                    'value' =>  $options['offset']['right'],
                                    'label' =>  __( 'Offset right', self::$textdomain ), 
                                    'descr' =>  __( 'Offset from right of browser in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][align_h]"]',
                                            'show'      =>  'right'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // padding
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[padding][left]',
                                    'name'  =>  self::$plugin_slug . '[padding][left]',
                                    'value' =>  $options['padding']['left'],
                                    'label' =>  __( 'Padding left', self::$textdomain ), 
                                    'descr' =>  __( 'Padding of link in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'show'      =>  'vk'
                                        ),
                                        array(
                                            'compare'   =>  ' && ',
                                            array(
                                                'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                                'hide'      =>  'vk'
                                            ),
                                            array(
                                                'element'   =>  'select[name="' . self::$plugin_slug . '[settings][align_h]"]',
                                                'show'      =>  'right'
                                            )
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[padding][right]',
                                    'name'  =>  self::$plugin_slug . '[padding][right]',
                                    'value' =>  $options['padding']['right'],
                                    'label' =>  __( 'Padding right', self::$textdomain ), 
                                    'descr' =>  __( 'Padding of link in pixels (px)', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'show'      =>  'vk'
                                        ),
                                        array(
                                            'compare'   =>  ' && ',
                                            array(
                                                'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                                'hide'      =>  'vk'
                                            ),
                                            array(
                                                'element'   =>  'select[name="' . self::$plugin_slug . '[settings][align_h]"]',
                                                'show'      =>  'left'
                                            )
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  __( '<span>Padding will be applyed to wrapper and will make wrapper wider for value you have entered. These way when people will move their mouse to wrapper the button will become hovered</span>', self::$textdomain ),
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'show'      =>  'vk'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'show'      =>  'vk'
                                    )
                                ),
                                // opacity
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[style][opacity]',
                                    'name'  =>  self::$plugin_slug . '[style][opacity]',
                                    'value' =>  $options['style']['opacity'],
                                    'label' =>  __( 'Opacity', self::$textdomain ), 
                                    'descr' =>  __( 'Opacity on default state. Number from 0 to 10 where 0 stands for transparent and 10 - visible', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0,
                                        'max'   =>  10
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[style][opacity_hover]',
                                    'name'  =>  self::$plugin_slug . '[style][opacity_hover]',
                                    'value' =>  $options['style']['opacity_hover'],
                                    'label' =>  __( 'Opacity on hover', self::$textdomain ), 
                                    'descr' =>  __( 'Opacity on hovers. Number from 0 to 10 where 0 stands for transparent and 10 - visible', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0,
                                        'max'   =>  10
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // colors
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[color][wrapp]',
                                    'name'  =>  self::$plugin_slug . '[color][wrapp]',
                                    'value' =>  $options['color']['wrapp'],
                                    'label' =>  __( 'Wrapper color', self::$textdomain ), 
                                    'descr' =>  __( 'Select wrapper background color', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  'transparent',
                                        'palettes'      =>  true
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[color][wrapp_hover]',
                                    'name'  =>  self::$plugin_slug . '[color][wrapp_hover]',
                                    'value' =>  $options['color']['wrapp_hover'],
                                    'label' =>  __( 'Wrapper hover color', self::$textdomain ), 
                                    'descr' =>  __( 'Select wrapper background hover color', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  'transparent',
                                        'palettes'      =>  true
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[color][text]',
                                    'name'  =>  self::$plugin_slug . '[color][text]',
                                    'value' =>  $options['color']['text'],
                                    'label' =>  __( 'Text color', self::$textdomain ), 
                                    'descr' =>  __( 'Select text color', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  '#000000',
                                        'palettes'      =>  true
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[color][text_hover]',
                                    'name'  =>  self::$plugin_slug . '[color][text_hover]',
                                    'value' =>  $options['color']['text_hover'],
                                    'label' =>  __( 'Text hover color', self::$textdomain ), 
                                    'descr' =>  __( 'Select text hover color', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  '#000000',
                                        'palettes'      =>  true
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // border
                                array(
                                    'type'  =>  'true-false',
                                    'id'    =>  self::$plugin_slug . '[border][use]',
                                    'name'  =>  self::$plugin_slug . '[border][use]',
                                    'value' =>  $options['border']['use'],
                                    'label' =>  __( 'Enable border', self::$textdomain ), 
                                    'descr' =>  __( 'If checked you\'ll be abel to set border', self::$textdomain ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'vk'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[border][width]',
                                    'name'  =>  self::$plugin_slug . '[border][width]',
                                    'value' =>  $options['border']['width'],
                                    'label' =>  __( 'Border width', self::$textdomain ), 
                                    'descr' =>  __( 'Set border width', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'select',
                                    'id'    =>  self::$plugin_slug . '[border][style]',
                                    'name'  =>  self::$plugin_slug . '[border][style]',
                                    'value' =>  $options['border']['style'],
                                    'label' =>  __( 'Border style', self::$textdomain ), 
                                    'descr' =>  __( 'Select border style', self::$textdomain ),
                                    'options'   =>  array(
                                        'dotted'    =>  __( 'Dotted', self::$textdomain ),
                                        'dashed'    =>  __( 'Dashed', self::$textdomain ),
                                        'solid'     =>  __( 'Solid', self::$textdomain ),
                                        'double'    =>  __( 'Double', self::$textdomain ),
                                        'groove'    =>  __( 'Groove', self::$textdomain ),
                                        'ridge'     =>  __( 'Ridge', self::$textdomain ),
                                        'inset'     =>  __( 'Inset', self::$textdomain ),
                                        'outset'    =>  __( 'Outset', self::$textdomain )
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[border][color]',
                                    'name'  =>  self::$plugin_slug . '[border][color]',
                                    'value' =>  $options['border']['color'],
                                    'label' =>  __( 'Border color', self::$textdomain ), 
                                    'descr' =>  __( 'Select border color', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  '#ffffff',
                                        'palettes'      =>  true
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'vk'
                                    )
                                ),
                                // border-radius
                                array(
                                    'type'  =>  'true-false',
                                    'id'    =>  self::$plugin_slug . '[border_radius][use]',
                                    'name'  =>  self::$plugin_slug . '[border_radius][use]',
                                    'value' =>  $options['border_radius']['use'],
                                    'label' =>  __( 'Enable border radius', self::$textdomain ), 
                                    'descr' =>  __( 'If checked you\'ll be abel to set border radius', self::$textdomain ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'vk'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  ' ',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'vk'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[border_radius][top_left]',
                                    'name'  =>  self::$plugin_slug . '[border_radius][top_left]',
                                    'value' =>  $options['border_radius']['top_left'],
                                    'label' =>  __( 'Border radius top left', self::$textdomain ), 
                                    'descr' =>  __( 'Top left border radius', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border_radius][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[border_radius][top_right]',
                                    'name'  =>  self::$plugin_slug . '[border_radius][top_right]',
                                    'value' =>  $options['border_radius']['top_right'],
                                    'label' =>  __( 'Border radius top right', self::$textdomain ), 
                                    'descr' =>  __( 'Top right border radius', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border_radius][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[border_radius][bottom_left]',
                                    'name'  =>  self::$plugin_slug . '[border_radius][bottom_left]',
                                    'value' =>  $options['border_radius']['bottom_left'],
                                    'label' =>  __( 'Border radius bottom left', self::$textdomain ), 
                                    'descr' =>  __( 'Bottom left border radius', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border_radius][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[border_radius][bottom_right]',
                                    'name'  =>  self::$plugin_slug . '[border_radius][bottom_right]',
                                    'value' =>  $options['border_radius']['bottom_right'],
                                    'label' =>  __( 'Border radius bottom right', self::$textdomain ), 
                                    'descr' =>  __( 'Bottom right border radius', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[border_radius][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'vk'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'vk'
                                    )
                                ),                                
                                //text-shadow
                                array(
                                    'type'  =>  'true-false',
                                    'id'    =>  self::$plugin_slug . '[text_shadow][use]',
                                    'name'  =>  self::$plugin_slug . '[text_shadow][use]',
                                    'value' =>  $options['text_shadow']['use'],
                                    'label' =>  __( 'Enable text shadow', self::$textdomain ), 
                                    'descr' =>  __( 'If checked you\'ll be abel to set text shadow', self::$textdomain ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  ' ',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[text_shadow][x]',
                                    'name'  =>  self::$plugin_slug . '[text_shadow][x]',
                                    'value' =>  $options['text_shadow']['x'],
                                    'label' =>  __( 'Text shadow x position', self::$textdomain ), 
                                    'descr' =>  __( 'The position of the horizontal shadow. Negative values are allowed', self::$textdomain ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[text_shadow][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'image'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[text_shadow][y]',
                                    'name'  =>  self::$plugin_slug . '[text_shadow][y]',
                                    'value' =>  $options['text_shadow']['y'],
                                    'label' =>  __( 'Text shadow y position', self::$textdomain ), 
                                    'descr' =>  __( 'The position of the vertical shadow. Negative values are allowed', self::$textdomain ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[text_shadow][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'image'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[text_shadow][blur]',
                                    'name'  =>  self::$plugin_slug . '[text_shadow][blur]',
                                    'value' =>  $options['text_shadow']['blur'],
                                    'label' =>  __( 'Text shadow blur', self::$textdomain ), 
                                    'descr' =>  __( 'The blur distance', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[text_shadow][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'image'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[text_shadow][color]',
                                    'name'  =>  self::$plugin_slug . '[text_shadow][color]',
                                    'value' =>  $options['text_shadow']['color'],
                                    'label' =>  __( 'Text shadow color', self::$textdomain ), 
                                    'descr' =>  __( 'The color of the shadow.', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  '#000000',
                                        'palettes'      =>  true
                                    ),
                                    'hide'  =>  array(
                                        'compare'   =>  ' || ',
                                        array(
                                            'element'   =>  'input[name="' . self::$plugin_slug . '[text_shadow][use]"]',
                                            'show'      =>  '1'
                                        ),
                                        array(
                                            'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                            'hide'      =>  'image'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'select[name="' . self::$plugin_slug . '[settings][type]"]',
                                        'hide'      =>  'image'
                                    )
                                ),
                                //box_shadow
                                array(
                                    'type'  =>  'true-false',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][use]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][use]',
                                    'value' =>  $options['box_shadow']['use'],
                                    'label' =>  __( 'Enable box shadow', self::$textdomain ), 
                                    'descr' =>  __( 'If checked you\'ll be abel to set box shadow', self::$textdomain )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  ' ',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][x]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][x]',
                                    'value' =>  $options['box_shadow']['x'],
                                    'label' =>  __( 'Box shadow x position', self::$textdomain ), 
                                    'descr' =>  __( 'The position of the horizontal shadow. Negative values are allowed', self::$textdomain ),
                                    'hide'  =>  array(
                                        'element'   =>  'input[name="' . self::$plugin_slug . '[box_shadow][use]"]',
                                        'show'      =>  '1'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][y]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][y]',
                                    'value' =>  $options['box_shadow']['y'],
                                    'label' =>  __( 'Box shadow y position', self::$textdomain ), 
                                    'descr' =>  __( 'The position of the vertical shadow. Negative values are allowed', self::$textdomain ),
                                    'hide'  =>  array(
                                        'element'   =>  'input[name="' . self::$plugin_slug . '[box_shadow][use]"]',
                                        'show'      =>  '1'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][blur]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][blur]',
                                    'value' =>  $options['box_shadow']['blur'],
                                    'label' =>  __( 'Box shadow blur', self::$textdomain ), 
                                    'descr' =>  __( 'The blur distance', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'input[name="' . self::$plugin_slug . '[box_shadow][use]"]',
                                        'show'      =>  '1'
                                    )
                                ),
                                array(
                                    'type'  =>  'number',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][spread]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][spread]',
                                    'value' =>  $options['box_shadow']['spread'],
                                    'label' =>  __( 'Box shadow size', self::$textdomain ), 
                                    'descr' =>  __( 'The size of shadow', self::$textdomain ),
                                    'options'   =>  array(
                                        'min'   =>  0
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'input[name="' . self::$plugin_slug . '[box_shadow][use]"]',
                                        'show'      =>  '1'
                                    )
                                ),
                                array(
                                    'type'  =>  'wp-color',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][color]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][color]',
                                    'value' =>  $options['box_shadow']['color'],
                                    'label' =>  __( 'Box shadow color', self::$textdomain ), 
                                    'descr' =>  __( 'The color of the shadow.', self::$textdomain ),
                                    'options'   =>  array(
                                        'default'       =>  '#000000',
                                        'palettes'      =>  true
                                    ),
                                    'hide'  =>  array(
                                        'element'   =>  'input[name="' . self::$plugin_slug . '[box_shadow][use]"]',
                                        'show'      =>  '1'
                                    )
                                ),
                                array(
                                    'type'  =>  'true-false',
                                    'id'    =>  self::$plugin_slug . '[box_shadow][inset]',
                                    'name'  =>  self::$plugin_slug . '[box_shadow][inset]',
                                    'value' =>  $options['box_shadow']['inset'],
                                    'label' =>  __( 'Box shadow inset', self::$textdomain ), 
                                    'descr' =>  __( 'Changes the shadow from an outer shadow (outset) to an inner shadow. If checked will use inner', self::$textdomain ),
                                    'hide'  =>  array(
                                        'element'   =>  'input[name="' . self::$plugin_slug . '[box_shadow][use]"]',
                                        'show'      =>  '1'
                                    )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                // classes
                                array(
                                    'type'  =>  'text',
                                    'id'    =>  self::$plugin_slug . '[classes][wrapp]',
                                    'name'  =>  self::$plugin_slug . '[classes][wrapp]',
                                    'value' =>  $options['classes']['wrapp'],
                                    'label' =>  __( 'Wrapper class', self::$textdomain ), 
                                    'descr' =>  __( 'You can specify wrapper class', self::$textdomain )
                                ),
                                array(
                                    'type'  =>  'text',
                                    'id'    =>  self::$plugin_slug . '[classes][link]',
                                    'name'  =>  self::$plugin_slug . '[classes][link]',
                                    'value' =>  $options['classes']['link'],
                                    'label' =>  __( 'Link class', self::$textdomain ), 
                                    'descr' =>  __( 'You can specify link class', self::$textdomain )
                                ),
                                array(
                                    'type'  =>  'text',
                                    'id'    =>  self::$plugin_slug . '[classes][span]',
                                    'name'  =>  self::$plugin_slug . '[classes][span]',
                                    'value' =>  $options['classes']['span'],
                                    'label' =>  __( 'Span class', self::$textdomain ), 
                                    'descr' =>  __( 'You can specify span class', self::$textdomain )
                                ),
                                array(
                                    'type'  =>  'text',
                                    'id'    =>  self::$plugin_slug . '[classes][image]',
                                    'name'  =>  self::$plugin_slug . '[classes][image]',
                                    'value' =>  $options['classes']['image'],
                                    'label' =>  __( 'Image class', self::$textdomain ), 
                                    'descr' =>  __( 'You can specify image class', self::$textdomain )
                                ),
                                array(
                                    'type'  =>  'custom',
                                    'value' =>  '<hr />',
                                    'settings'  =>  array(
                                        'class' =>  'clear',
                                        'atts'  =>  array(
                                            'style' =>  'width: 100%'
                                        )
                                    )
                                ),
                                array(
                                    'type'  =>  'textarea',
                                    'id'    =>  self::$plugin_slug . '[style][custom]',
                                    'name'  =>  self::$plugin_slug . '[style][custom]',
                                    'value' =>  $options['style']['custom'],
                                    'label' =>  __( 'Custom styles', self::$textdomain ), 
                                    'descr' =>  __( 'You can add custom styles', self::$textdomain ),
                                    'structure' => '<div class="label">%1$s</div><div class="description"><p>%3$s</p></div><div class="clear field">%2$s</div>'
                                ),
                            ));
                            echo $M7_Fields->output();
                            ?>
                            <div class="clear"></div>
                			<p class="submit-2"><input type="submit" class="button button-primary" name="submit" value="<?php _ex('Save', 'submenu page save changes', self::$textdomain ); ?>" /></p>
                        </form>
                    </div>
                    
                    <!--<div id="faq">
                        <h2>FAQ</h2>
                    </div>-->
                    
                    <div id="donate">
                        <h2><?php _ex( 'Donate to suppot WordPress Plugin Development', 'donate title', self::$textdomain ); ?></h2>
                        <?php _ex( '<p>I spend a much of my spare time as possible working on WordPress plugins and themes and any donation is appreciated. Donations play a crucial role in supporting Free and Open Source Software projects.</p>
                        <p>So why are donations important? As a developer the more donations I receive the more time I can invest in working on Free and Open Source Software projects. Donations help cover the cost of hardware for development and to pay hosting bills. <strong>This is critical to the development of free software.</strong></p>
                        <p>I know a lot of other developers do the same and I try to donate to them whenever I can. As a developer I greatly appreciate any donation you can make to help support further development of quality plugins and themes for WordPress as well as other open source software.</p>', 'donate text', self::$textdomain ); ?>
                        <br />
                        
                        <div style="width: 50%; float: left;">
                            <p><strong><?php _e( 'PayPal', self::$textdomain ); ?></strong></p>
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick" />
                                <input type="hidden" name="hosted_button_id" value="MKEDFTVMPGNFY" />
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
                                <!--<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" />-->
                            </form>
                        </div>
                        
                        <table>
                            <tr>
                                <td><strong><?php _e( 'Webmoney', self::$textdomain ); ?></strong>&nbsp;&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><?php _e( 'WMR', self::$textdomain ); ?></td>
                                <td>R237366684963</td>
                            </tr>
                            <tr>
                                <td><?php _e( 'WMZ', self::$textdomain ); ?></td>
                                <td>Z340297611778</td>
                            </tr>
                        </table>
                        <br />
                        <hr />
                        <br />
                        <div class="credits">
                            <p><a target="_blank" href="#"><?php _ex( 'Plugin Web Site (in development)', 'credits plugin', self::$textdomain ); ?></a> <?php _ex( 'and', 'credits "and"', self::$textdomain ); ?> <a target="_blank" href="http://m7-pro.ru/"><?php _ex( 'Author Web Site (in development)', 'credits author', self::$textdomain ); ?></a></p>
                        </div>
                    </div>
                
                </div>

        </div>
        
    </div>
</div>