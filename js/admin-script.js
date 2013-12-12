jQuery(function($){
    var doc = $(document);
    var win = $(window);
    
    function startTabs() {
        doc.find('[data-tabs]').each(function(){
            // Получаем и проверяем переменные
            var data_tabs       =   $(this).data( 'tabs' );
            var data_selector   =   $(this).data( 'selector' );
            var tabs            =   doc.find( data_tabs );
            var selectors       =   $(this).find( data_selector );
            
            if( ! tabs || tabs.length == 0 || ! selectors || selectors.length == 0 )
                return;
            
            // Проверяем куки
            var cookie_key      =   cookify( data_tabs ) + '_cookie';
            var cookie_val      =   $.cookie( cookie_key );
            
            // Находим выбранную вкладку или выбираем 1-ую
            var select          =   selectors.first();
            if( cookie_val && selectors.siblings('[data-tab="'+cookie_val+'"]').length == 1 )
                select          =   selectors.siblings('[data-tab="'+cookie_val+'"]');
                
            cookie_val          =   select.data('tab');
            var tab             =   tabs.find( cookie_val );
            
            // Скрываем все содержимое и показываем выбранное
            selectors.each(function(){
                $(this).removeClass('selected');
                tabs.find( $(this).data('tab') ).removeClass('selected').fadeOut(0);
            });
            
            select.addClass('selected');
            tab.addClass('selected').fadeIn(0);
            
            // Сохраняем куки
            $.cookie( cookie_key, cookie_val );
            
            // Обрабатываем клик по вкладке, ничего не делаем если вкладка уже выбрана
            selectors.on('click', function(){
                if( $(this).hasClass('selected') )
                    return false;
                
                // Сохраняем старые значения
                var select_old  =   select;
                var tab_old     =   tab;
                
                // Определяем новые вкладки
                select          =   $(this);
                cookie_val      =   select.data('tab');
                tab             =   tabs.find( cookie_val );
                
                // Скрываем старое содержимое и показываем новое
                select_old.removeClass('selected');
                tab_old.removeClass('selected').fadeOut( 300, function(){
                    
                    tab.fadeIn( 500 ).addClass('selected');
                    select.addClass('selected');
                    
                    $.cookie( cookie_key, cookie_val );
                    
                });
                
                return false;
            });
            
        });
    }
    
    function startCheckboxes() {
        doc.find('[data-checkbox]').each(function(){
            // Получаем и проверяем переменные
            var checkbox = ( ! $(this).data('checkbox') || $(this).data('checkbox') == '' ) ? $(this) : doc.find( $(this).data('checkbox') );
            var checked = ( ! $(this).data('checked') || $(this).data('checked') == '' ) ? 1 : $(this).data('checked');
            
            // Отмечаем если значение == чекед и убираем выделение если нет
            var value = checkbox.val();
            if( value == checked ){
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
        doc.on( 'change', '[data-checkbox]', function(){
            // Получаем и проверяем переменные
            var checkbox = ( ! $(this).data('checkbox') || $(this).data('checkbox') == '' ) ? $(this) : doc.find( $(this).data('checkbox') );
            var checked = ( ! $(this).data('checked') || $(this).data('checked') == '' ) ? 1 : $(this).data('checked');
            var value = ( ! $(this).data('unchecked') || $(this).data('unchecked') == '' ) ? 0 : $(this).data('unchecked');
            if( $(this).is(':checked') )
                value = checked;
            checkbox.attr( 'value', value ).val( value ).trigger('change');
        });
    }
    
    function startHide() {
        var changeArray = {};
        doc.find('[data-hide]').each(function(){
            // Получаем и проверяем переменные
            var el      =   $(this).parent();
            var expr    =   $(this).text();
            var change  =   $(this).data('hide');

            if( ! el || ! expr || expr == '' || ! change || change == '' )
                return;
            
            // Прячем на старте
            showhide( el, expr, true );
            
            // Сохраняем всё в массив, что бы менять в будующем
            var elements = change.split('|');
            $.each(elements, function( key, val ){
                if( ! changeArray[val] ){
                    changeArray[val] = [];
                }
                changeArray[val].push({
                    'el': el, 
                    'expr':  expr
                });
            });
        });
        
        // Биндим изменения
        $.each(changeArray, function( key, val ){
            doc.on( 'change', key, function(){
                $.each(val, function( k, v ){
                    showhide( v.el, v.expr );
                });
            });
        });
        
        function showhide( el, expr, first ) {
            var f_in    = 0;
            if( ! first ){
                f_in    = 500;
            }
            
            if( eval( expr ) ) {
                el.fadeOut( 0 );
            } else {
                el.fadeIn( f_in );
            }
        }
    }
    
    function startUploader() {         
        doc.on( 'click', '[data-media]', function( e ){
            var title = $(this).data('media-title');
            var button  = $(this).data('media-button');
            var el = ( ! $(this).data('media') || $(this).data('media') == '' ) ? $(this) : doc.find( $(this).data('media') );
            
            // Создаём медиа фрейм
            var file_frame = wp.media.frames.file_frame = wp.media({
              title: title,
              button: {
                text: button,
              },
              multiple: false
            });
                     
            // Обработка при выборе картинки
            file_frame.on( 'select', function() {
              attachment = file_frame.state().get('selection').first().toJSON();
              
              el.attr( 'value', attachment.url ).val( attachment.url );
            });
            // Открываем фрейм
            file_frame.open();
            return false;
        });
    }
    
    function startColor() {
        doc.find('[data-color]').each(function(){
            var el = $(this);
            var data_color = ( ! el.data('color') || el.data('color') == '' ) ? false : el.data('color');
            var data_palettes = ( ! el.data('palettes') || el.data('palettes') == '' ) ? true : false;
            el.wpColorPicker( {
                // you can declare a default color here,
                // or in the data-default-color attribute on the input
                defaultColor: data_color,
                // a callback to fire whenever the color changes to a valid color
                change: function(event, ui){
                    
                    el.attr( 'value', ui.color.toString() ).val( ui.color.toString() );
                },
                // a callback to fire when the input is emptied or an invalid color
                clear: function() {
                    el.attr( 'value', 'transparent' ).val( 'transparent' );
                },
                // hide the color picker controls on load
                hide: true,
                // show a group of common colors beneath the square
                // or, supply an array of colors to customize further
                palettes: data_palettes
            } );
        });
    }
    
    doc.ready(function(){
        startTabs();
        startCheckboxes();
        startHide();
        startUploader();
        startColor();
    });
    
    win.load(function(){
        doc.find('#m7-go-top').prev('.updated').delay(2000).fadeOut(500);
    })
    
    function cookify( string ) {
		string = string.toLowerCase();
		string = string.replace( / /g, '');
		string = string.replace( /[^a-zA-Z0-9_]+/g, '');
		return string;
	}
    /* Функия которая улавливает изменение value в checkbox скрытых инпутах и просто изменение значения value */
	$.event.special.inputchange = {
	    setup: function() {
	        var self = this, val;
	        $.data(this, 'timer', window.setInterval(function() {
	            val = self.value;
	            if ( $.data( self, 'cache') != val ) {
	                $.data( self, 'cache', val );
	                $( self ).trigger( 'inputchange' );
	            }
	        }, 20));
	    },
	    teardown: function() {
	        window.clearInterval( $.data(this, 'timer') );
	    },
	    add: function() {
	        $.data(this, 'cache', this.value);
	    }
	};
});