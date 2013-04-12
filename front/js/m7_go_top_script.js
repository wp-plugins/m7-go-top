jQuery(function($) {
    var m7_type = m7_go_top['m7_type'];
    var m7_text = m7_go_top['m7_text'];
    var m7_position = m7_go_top['m7_position'];
    var m7_width = m7_go_top['m7_width'];
    var m7_height = m7_go_top['m7_height'];
    if(m7_type == 'vk'){
        m7_height = '100%';
    } else {
        m7_height = m7_height+'px';
    }
    var m7_output = '<div id="m7_go_top" data-type="'+m7_type+'"><a href="#"><span>'+m7_text+'</span></a></div>';
    $('body').prepend(m7_output);
    $('body #m7_go_top').hide();
    $(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#m7_go_top').fadeIn();
		} else {
			$('#m7_go_top').fadeOut();
		}
	});
	$('#m7_go_top a').click(function () {
		$('body,html').stop(false, false).animate({
			scrollTop: 0
		}, 800);
		return false;
	});
})