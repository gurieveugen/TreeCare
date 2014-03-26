jQuery(function(){
	jQuery("#hover").lavaLamp({ fx: "backout", speed: 700 });

	$("#hover li a").each(function (i) {
		$(this).click(
		    function () {
			    if ($(this).parent().find('.children').length) {
				    $(this).parent().find('.children').show();
					return false;
				}
				if ($(this).parent().find('.children2').length) {
				    $(this).parent().find('.children2').show();
					return false;
				}
		    }
		);
		$(this).parent().hover(
		  function () {
		  }, 
		  function () {
			$(this).parent().find('.children').hide();
			$(this).parent().find('.children2').hide();
		  }
		);
    });
});
