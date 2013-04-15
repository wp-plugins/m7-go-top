jQuery(function ($) {
    var m7_go_top_text = m7_go_top['m7_text'];
    var m7_go_top_prepend_data = '<div id="m7_go_top"><a href="#"><span>'+m7_go_top_text+'</span></a></div>';
    $('body').prepend(m7_go_top_prepend_data);
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
});