<?php
/* Copyright (C) 2013  [M7] Михаил Семёнов (Mihail Semjonov)  (email : mihailsemjonov@mail.ru) */

/* Название прявязано к плагину.. т.к. класс пишеться на ходу, может не до конца продуманно.. в дальнейшем напишу класс M7_Fields_Class и буду использовать его во всех своих плагинах */
/**
 * Если файл вызван на прямую то прекращаем работу
**/
if ( ! function_exists( 'add_action' ) ) exit;

/**
 * Проверяем существует ли класс
**/
if( ! class_exists( 'M7_Go_Top_Fields_Class' ) ):

class M7_Go_Top_Fields_Class {
    
    public $textdomain;
    
    public $fields      =   array();
    
    public $settings;
    
    public function __construct( $args = array() ) {
        $defaults = array(
            'textdomain'    =>  'm7-fields-class',
            'tag'           =>  'ul',
            'class'         =>  'fieldset',
            'id'            =>  '',
            'el_tag'        =>  'li',
            'structure'     =>  '%1$s %2$s %3$s' // label field description
        );
        $args               =   wp_parse_args( $args, $defaults );
        
        $this->textdomain  =   $args['textdomain'];
        unset( $args['textdomain'] );
        $this->settings     =   $args;
    }
    
    public function output() {
        $settings   =   $this->settings;
        return sprintf( '<%1$s %2$s %3$s>%4$s</%1$s>',
            $settings['tag'],
            ( $settings['id'] && $settings['id'] != '' ) ? 'id="' . $settings['id'] . '"' : '',
            ( $settings['class'] && $settings['class'] != '' ) ? 'class="' . $settings['class'] . '"' : '',
            $this->output_fields()
        );
    }
    
    public function output_fields() {
        $fields     =   $this->fields;
        $settings   =   $this->settings;
        if( ! isset( $fields ) || empty( $fields ) )
            return '';
        $out        =   '';
        foreach( $fields as $field ) :
            if( ! isset( $field['type'] ) || empty( $field['type'] ) )
                continue;
                
            $field_out = $this->output_field( $field['type'], $field );
            if( ! isset( $field_out ) || empty( $field_out ) )
                continue;
            
            $field_settings     =   ( isset( $field['settings'] ) && ! empty( $field['settings'] ) ) ? $field['settings'] : false;
            $field_hide         =   ( isset( $field['hide'] ) && ! empty( $field['hide'] ) ) ? $field['hide'] : false;
            
            $field_hide_out     =   $this->field_hide( $field_hide );
            
            $field_hide_what     =   $this->field_hide_what( $field_hide );
            
            $out    .=  sprintf( '<%1$s %2$s>%3$s%4$s</%1$s>',
                $settings['el_tag'],
                $this->field_atts( $field_settings ),
                ( ! $field_hide ) ? '' : sprintf( '<span style="display:none; width:0px; height:0px; overflow: hidden; visibility: hidden;" data-hide="%1$s" >%2$s</span>',
                    $field_hide_what,
                    $field_hide_out
                ),
                $field_out
            );
        endforeach;
        return $out;
    }
    
    public function field_atts( $args ) {
        if( $args == false || ! is_array( $args ) ) return '';
        $defaults   =   array(
            'id'    =>  '',
            'class' =>  '',
            'atts'  =>  array()
        );
        $args       =   wp_parse_args( $args, $defaults );
        
        $atts       =   '';
        if( isset( $args['atts'] ) && ! empty( $args['atts'] ) ) {
            foreach( $args['atts'] as $key => $val ) :
                $atts   .=  $key . '="' . $val . '" ';
            endforeach;
        }
        
        return sprintf('%1$s %2$s %3$s',
            ( isset( $args['id'] ) && ! empty( $args['id'] ) ) ? 'id="' . $args['id'] . '"' : '',
            ( isset( $args['class'] ) && ! empty( $args['class'] ) ) ? 'class="' . $args['class'] . '"' : '',
            ( isset( $atts ) && ! empty( $atts ) ) ? $atts : ''
        );
    }
    
    public function field_hide( $args ) {
        if( $args == false || ! is_array( $args ) ) return '';
        $out    =   '';
        if( isset( $args['element'] ) && ! is_array( $args['element'] ) ) {
            
            $el =   '$(\'' . esc_attr( $args['element'] ) . '\').val()';
            
            if( isset( $args['hide'] ) && ! empty( $args['hide'] ) ) {
                if( is_array( $args['hide'] ) ){
                    $out    .=  ' ( ';
                    foreach( $args['hide'] as $val ) {
                        $out    .=  $el . ' == \'' . $val . '\' ||';
                    }
                    $out    =   rtrim( $out, '  ||' );
                    $out    .=  ' ) ';
                } else {
                    $out    .=  $el . ' == \'' . $args['hide'] . '\'';
                }
                $out    .=  ' && ';
            }
            
            if( isset( $args['show'] ) && ! empty( $args['show'] ) ) {
                if( is_array( $args['show'] ) ){
                    $out    .=  ' ( ';
                    foreach( $args['show'] as $val ) {
                        $out    .=  $el . ' != \'' . $val . '\' ||';
                    }
                    $out    =   rtrim( $out, '  ||' );
                    $out    .=  ' ) ';
                } else {
                    $out    .=  $el . ' != \'' . $args['show'] . '\'';
                }
            } else {
                $out    =   rtrim( $out, ' && ' );
            }
            
        } else {
            $compare        =   ( isset( $args['compare'] ) && ! empty( $args['compare'] ) ) ? $args['compare'] : ' || ';
            $compare_length =   count( $args );
            
            if( $compare_length != 1 )
                $out    .=  ' ( ';
                
            foreach( $args as $val ) {
                $wolkthrought   =   $this->field_hide( $val );
                if( ! empty( $wolkthrought ) )
                    $out    .=  $wolkthrought . ' ' . $compare;
            }
            $out    =   rtrim( $out, ' ' . $compare );
            
            if( $compare_length != 1 )
                $out    .=  ' ) ';
        }
        return esc_attr( $out );
    }
    public function field_hide_what( $args ) {
        if( $args == false || ! is_array( $args ) ) return '';
        $out    =   '';
        if( isset( $args['element'] ) && ! is_array( $args['element'] ) ) {
            $out    .= esc_attr( $args['element'] );
        } else {
            foreach( $args as $val ) {
                $wolkthrought   =   $this->field_hide_what( $val );
                if( ! empty( $wolkthrought ) )
                    $out    .=  $wolkthrought  . '|';
            }
            $out    =   rtrim( $out, '|' );
        }
        return $out;
    }
    
    public function output_field( $type, $args ) {
        $defaults   =   $this->field_defaults( $type );
        $args       =   wp_parse_args( $args, $defaults );
        
        $incv       =   sprintf( '%1$s %2$s %3$s %4$s %5$s %6$s %7$s %8$s %9$s',
            ( empty( $args['id'] ) )    ? '' : 'id="' . esc_attr( $args['id'] ) . '"',
            ( empty( $args['name'] ) )  ? '' : 'name="' . esc_attr( $args['name'] ) . '"',
            ( empty( $args['class'] ) ) ? '' : 'class="' . esc_attr( $args['class'] ) . '"',
            ( ( empty( $args['value'] ) && $args['value'] != 0 ) || $type == 'textarea' ) ? '' : 'value="' . esc_attr( $args['value'] ) . '"',
            ( ! isset( $args['atts']['placeholder'] ) || empty( $args['atts']['placeholder'] ) ) ? '' : 'placeholder="' . esc_attr( $args['atts']['placeholder'] ) . '"',
            ( ! isset( $args['atts']['pattern'] ) || empty( $args['atts']['pattern'] ) ) ? '' : 'pattern="' . esc_attr( $args['atts']['pattern'] ) . '"',
            ( ! isset( $args['atts']['readonly'] ) || empty( $args['atts']['readonly'] ) ) ? '' : 'readonly="readonly"',
            ( ! isset( $args['atts']['disabled'] ) || empty( $args['atts']['disabled'] ) ) ? '' : 'disabled="disabled"',
            ( ! isset( $args['atts']['required'] ) || empty( $args['atts']['required'] ) ) ? '' : 'required="required"'
        );
        
        $field      =   '';
        switch( $type ){
            case 'text' :
                $field  =   sprintf( '<input type="text" %1$s />',
                    $incv
                );
                break;
            case 'textarea' :
                $field  =   sprintf( '<textarea type="text" %1$s >%2$s</textarea>',
                    $incv,
                    $args['value']
                );
                break;
            case 'number' :
                $field  =   sprintf( '<input type="number" %1$s %2$s />',
                    $incv,
                    sprintf ( '%1$s %2$s %3$s',
                        ( ! isset( $args['options']['min'] ) || ( empty( $args['options']['min'] ) && $args['options']['min'] !== 0 ) ) ? '' : 'min="' . esc_attr( $args['options']['min'] ) . '"',
                        ( ! isset( $args['options']['max'] ) || ( empty( $args['options']['max'] ) && $args['options']['min'] !== 0 ) ) ? '' : 'max="' . esc_attr( $args['options']['max'] ) . '"',
                        ( ! isset( $args['options']['step'] ) || ( empty( $args['options']['step'] ) && $args['options']['min'] !== 0 ) ) ? '' : 'step="' . esc_attr( $args['options']['step'] ) . '"'
                    )
                );
                break;
            case 'file' :
                $field  =   sprintf( '<input type="file" %1$s %2$s />',
                    $incv,
                    sprintf ( '%1$s %2$s',
                        ( ! isset( $args['options']['accept'] ) || empty( $args['options']['accept'] ) ) ? '' : 'accept="' . $args['options']['accept'] . '"',
                        ( ! isset( $args['options']['multiple'] ) || empty( $args['options']['multiple'] ) ) ? '' : 'multiple'
                    )
                );
                break;
            case 'wp-file' :
                if( ! isset( $args['name'] ) || empty( $args['name'] ) )
                    break;
                     
                $field  =   sprintf( '<input type="text" %1$s />%2$s',
                    $incv,
                    sprintf ( '<input type="button" value="%2$s" class="button button-secondary" data-media="input[name=\'%1$s\']" data-media-title="%4$s" data-media-button="%3$s" />',
                        esc_attr( $args['name'] ),
                        ( ! isset( $args['options']['btn_text'] ) || empty( $args['options']['btn_text'] ) ) ? __( 'Select', $this->textdomain ) : esc_attr( $args['options']['btn_text'] ),
                        ( ! isset( $args['options']['pop_text'] ) || empty( $args['options']['pop_text'] ) ) ? __( 'Select', $this->textdomain ) : esc_attr( $args['options']['pop_text'] ),
                        ( ! isset( $args['options']['pop_title'] ) || empty( $args['options']['pop_title'] ) ) ? __( 'Upload Image', $this->textdomain ) : esc_html ( $args['options']['pop_title'] )
                    )
                );
                break;
            case 'wp-file-multi' :
                $field  =   '';
                // Under construction
                break;
            case 'true-false' :
                $field  =   sprintf( '<input type="hidden" %1$s /><input type="checkbox" %2$s />',
                    $incv,
                    sprintf ( 'data-checkbox="%1$s" %2$s %3$s',
                        'input[name=\'' . esc_attr( $args['name'] ) . '\']',
                        ( ! isset( $args['options']['checked'] ) || ( empty( $args['options']['checked'] )  && $args['options']['checked'] !== 0 ) ) ? '' : 'data-checked="' . esc_attr( $args['options']['checked'] ) . '"',
                        ( ! isset( $args['options']['unchecked'] ) || ( empty( $args['options']['unchecked'] )  && $args['options']['unchecked'] !== 0 ) ) ? '' : 'data-unchecked="' . esc_attr( $args['options']['unchecked'] ) . '"'
                    )
                );
                break;
            case 'select' :
                $options    =   '';
                if( isset( $args['options'] ) && ! empty( $args['options'] ) ) {
                    if( isset( $args['options']['null'] ) ) {
                        $tmp = $args['options']['null'];
                        unset( $args['options']['null'] );
                        $args['options']    =   array( 'null' => $tmp ) + $args['options'];
                    }
                    foreach( $args['options'] as $key => $val ) {
                        $options    .=  sprintf( '<option %3$s value="%1$s">%2$s</option>',
                            esc_attr( $key ),
                            esc_html( $val ),
                            ( $args['value'] == $key || ( $key == 'null' && ( empty( $args['value'] ) || ! isset( $args['value'] ) ) ) ) ? 'selected="selected"' : ''
                        );
                    }
                } else {
                    break;
                }
                $field      =   sprintf( '<select %1$s >%2$s</select>',
                    $incv,
                    $options
                );
                break;
            case 'wp-color' :
                $field  =   sprintf( '<input type="text" %1$s %2$s />',
                    $incv,
                    sprintf ( 'data-color="%1$s" %2$s',
                        ( ! isset( $args['options']['default'] ) || empty( $args['options']['default'] ) ) ? '' : esc_attr( $args['options']['default'] ),
                        ( ! isset( $args['options']['palettes'] ) || empty( $args['options']['palettes'] ) ) ? '' : 'data-palettes="' . esc_attr( $args['options']['palettes'] ) . '"'
                    )
                );
                break;
            case 'custom' :
                $field  =   $args['value'];
                break;
            default :
                $field  =   '';
                break;
        }
        
        if( empty( $field ) )
            return '';
            
        return sprintf( $args['structure'],
            ( ! isset( $args['label'] ) || empty( $args['label'] ) ) ? '' : sprintf( '<label for="%1$s">%2$s</label>',
                ( empty( $args['id'] ) ) ? '' : esc_attr( $args['id'] ),
                esc_html( $args['label'] )
            ),
            $field,
            ( ! isset( $args['descr'] ) || empty( $args['descr'] ) ) ? '' : esc_attr( $args['descr'] )
        );
    }
    
    public function field_defaults( $type ) {
        $defaults = array(
            'id'        =>  '',
            'name'      =>  '',
            'class'     =>  '',
            'value'     =>  '',
            'label'     =>  '',
            'descr'     =>  '',
            'structure' =>  $this->settings['structure'],
            'atts'   =>  array(
                'disabled'      =>  false,
                'pattern'       =>  false,
                'readonly'      =>  false,
                'required'      =>  false,
                'size'          =>  false,
                'placeholder'   =>  false
            )
        );
        switch( $type ){
            case 'text' :
                // no uniqueue options
                break;
            case 'textarea' :
                // no uniqueue options
                break;
            /*case 'wp-editor' : // wisyvig editor
                // no uniqueue options
                break;*/
            case 'number' :
                $defaults['options']    =   array(
                    'step'      =>  false,
                    'min'       =>  false,
                    'max'       =>  false
                );
                break;
            case 'file' :
                $defaults['options']    =   array(
                    'accept'    =>  false,
                    'multiple'  =>  false
                );
                break;
            case 'wp-file' :
                $defaults['options']    =   array(
                    'btn_text'  =>  false,
                    'pop_text'  =>  false,
                    'pop_title' =>  false
                );
                break;
            case 'wp-file-multi' :
                $defaults['options']    =   array(
                    'btn_text'  =>  false,
                    'pop_text'  =>  false,
                    'pop_title' =>  false
                );
                break;
            case 'true-false' :
                $defaults['options']    =   array(
                    'checked'       =>  false,
                    'unchecked'     =>  false,
                    'selector'      =>  false
                );
                break;
            case 'select' :
                $defaults['options']    =   array();
                break;
            case 'wp-color' :
                $defaults['options']    =   array(
                    'default'       =>  false,
                    'palettes'      =>  false
                );
                break;
            case 'custom' :
                $defaults   =   array( 'value' => '', 'structure' => '%2$s' );
                break;
        }
        
        return $defaults;
    }
    
    public function add_field( $args ) {
        $this->fields[] =   $args;
    }
    public function add_fields( $args ) {
        if( isset( $args['type'] ) && isset( $args['name'] ) ) { // Проверяем на всякий случай не добавление 1-го поля происходит 
            $this->add_field( $args );
        } else {
            $this->fields   =   $this->fields + $args;
        }
    }
}

endif; // / ( class_exists( 'M7_Fields_Class' ) )