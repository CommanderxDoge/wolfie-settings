jQuery(document).ready(function($){ 
	$('.switch').click(function(e){
		e.preventDefault();
		if( $(this).hasClass( 'active' ) ) {
			$(this).removeClass('active');
			$(this).find('input').val('off');
		} else {
			$(this).addClass('active');
			$(this).find('input').attr('checked', true);
			$(this).find('input').val('on');
		}
	});
});