jQuery(function() {
	if(window.PIE){
		jQuery('.rounded').each(function(){
			PIE.attach(this);
		});
	}
});