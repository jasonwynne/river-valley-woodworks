$(document).ready(function(){ 

  $('li:first-child').addClass('first-item');
	$('li:last-child').addClass('last-item');	
	
	$('.mobile-menu').click(function(){
		$('.main-menu').toggleClass('expanded');
	});	
	
	
});

// this is a function that returns true or false for has attribute	
$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};

// this is a function that can set columns the same height if named the same
function setTallest(x){

		var tallest = new Array();
			
		$(x).each(function(index) {
			var myHeight = $(this).height();
			tallest.push(myHeight);

		});
		
		var isTallest = Math.max.apply(null, tallest);	

		$(x).css('height',isTallest+'px');

}

function singleThanks(x){		
	if (x.mailSent === true) {
		// _gaq.push(['_trackEvent', 'SingleItem', 'Submit', 'Item Ordered']);
		$('.order-form-container').hide();
		$('.sales-single-response').show();
	}
}
