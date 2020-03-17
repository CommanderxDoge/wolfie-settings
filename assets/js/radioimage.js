jQuery(document).ready(function($){ 
$('.radioimage').click(function(){
	var t = $(this);
	if(t.hasClass('active')) {
		console.log('do nothing');
	} else {
		t.siblings('.active').removeClass('active');
		t.addClass('active');
		t.find('input').prop('checked', true);
	}
});
});