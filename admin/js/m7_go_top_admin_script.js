jQuery(function($){
    $('.m7-color-field').wpColorPicker();
    
    m7_showhide();
    $('#m7_go_top form.m7_go_top select').change(function(){
        m7_showhide();
    });

function m7_showhide(){
    $('#m7_go_top form.m7_go_top select').each(function(){
        var el = $(this);
        if(el.attr('id') == 'm7_plugin_go_top_type'){
            var pos = $('#m7_plugin_go_top_position').val();
            if(el.val() == 'vk'){
                $('#m7_plugin_go_top_zbottom').parents('tr').hide();
                $('#m7_plugin_go_top_ztop').parents('tr').show();
            } else if(el.val() == 'button'){
                $('#m7_plugin_go_top_zbottom').parents('tr').show();
                $('#m7_plugin_go_top_ztop').parents('tr').hide();
            }
        } else if(el.attr('id') == 'm7_plugin_go_top_position'){
            var type = $('#m7_plugin_go_top_type').val();
            if(el.val() == 'right'){
                if(type == 'vk'){
                    $('#m7_plugin_go_top_zright').parents('tr').hide();
                    $('#m7_plugin_go_top_zleft').parents('tr').show();
                } else if(type == 'button'){
                    $('#m7_plugin_go_top_zright').parents('tr').show();
                    $('#m7_plugin_go_top_zleft').parents('tr').hide();
                }
            } else if(el.val() == 'left'){
                if(type == 'vk'){
                    $('#m7_plugin_go_top_zright').parents('tr').show();
                    $('#m7_plugin_go_top_zleft').parents('tr').hide();
                } else if(type == 'button'){
                    $('#m7_plugin_go_top_zright').parents('tr').hide();
                    $('#m7_plugin_go_top_zleft').parents('tr').show();
                }
            }
        }
    });
}
});