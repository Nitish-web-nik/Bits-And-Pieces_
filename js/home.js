$(document).ready(function(){
	$('.menu-toggler').on('click',function(){
	    $(this).toggleClass('open');
		$('.top-nav').toggleClass('open');
	});
	$('.top-nav .nav-link').on('click',function(){
	    $('.menu-toggler').removeClass('open');
		$('.top-nav').removeClass('open');
	});
	$(window).scroll(function(){
		if($(window).scrollTop()>=100){
			$(".top-nav").css('background','linear-gradient(to bottom left, #ef8d9c 40%, #ffc39e 100%)');
			
		}else{
			$(".top-nav").css('background','transparent');
		}
	})

	function truncate(str,n){
        return str?.length>n?str.substr(0,n-1)+"..":str;
    }
	
	
});


