jQuery(function($){
    //$('#m7_plugin_go_top_width').mask('9?999 px');
    //$('#m7_plugin_go_top_height').mask('9?999 px');
    $('.m7-color-field').wpColorPicker();
    var type = $('#m7_plugin_go_top_type').val();
    showhide('m7_plugin_go_top_type',type);
    var pos = $('#m7_plugin_go_top_position').val();
    showhide('m7_plugin_go_top_position',pos);
    $('#m7_plugin_go_top_type').change(function(){
        var id = $(this).attr('id');
        var val = $(this).val();
        showhide(id,val);
    });
    $('#m7_plugin_go_top_position').change(function(){
        var id = $(this).attr('id');
        var val = $(this).val();
        showhide(id,val);
    });
function showhide(id,value){
    if(!id) return false;
    if(!value) return false;
    var array = { 
        'm7_plugin_go_top_type': {'button':'m7_plugin_go_top_zbottom','vk':'m7_plugin_go_top_ztop'},
        'm7_plugin_go_top_position': {'right':'m7_plugin_go_top_zright','left':'m7_plugin_go_top_zleft'},
    }
    if(id == 'm7_plugin_go_top_type'){
        $('#m7_plugin_go_top_ztop').parents('tr').hide();
        $('#m7_plugin_go_top_zbottom').parents('tr').hide();
        $('#'+array['m7_plugin_go_top_type'][value]).parents('tr').show();
        if(array['m7_plugin_go_top_type'][value] == 'm7_plugin_go_top_ztop'){
            $('#m7_plugin_go_top_height').parents('tr').hide();
        } else {
            $('#m7_plugin_go_top_height').parents('tr').show();
        }
    }
    if(id == 'm7_plugin_go_top_position'){
        $('#m7_plugin_go_top_zright').parents('tr').hide();
        $('#m7_plugin_go_top_zleft').parents('tr').hide();
        $('#'+array['m7_plugin_go_top_position'][value]).parents('tr').show();
        if($('#m7_plugin_go_top_type').val() == 'vk'){
            $('#m7_plugin_go_top_zright').parents('tr').show();
            $('#m7_plugin_go_top_zleft').parents('tr').show();
            $('#'+array['m7_plugin_go_top_position'][value]).parents('tr').hide();
        }
    }
}
});