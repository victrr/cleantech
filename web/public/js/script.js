$(document).ready(function(){

	$("#banner").css({"height":$(window).height() + "px"});
	
	$("#login").css({"height":$(window).height() + "px"});
	$(".intro-body").css({"height":$(window).height() + "px"});

	var flag = false;
	var scroll;

	$(window).scroll(function(){
		scroll = $(window).scrollTop();

		if(scroll > 100){
			if(!flag){
				$("#logo").css({"margin-top": "-1px", "width": "50px","height":"50px","z-index":"-3"});

				$("#menu").css({"background-color": "#3C3C3C","z-index":"2"});
				flag = true;
				
				$("section#banner").css({"-webkit-filter": "blur(2px)"});

				//$(".intro-body").css({"background": "#000000","opacity":".6"});
				
				//$('#table').addClass("pullDown");
		
			}
		}else{
			if(flag){
				$("#logo").css({"margin-top": "150px", "width": "300px","height":"300px","z-index":"-3"});

				$("#menu").css({"background-color": "transparent","z-index":"2"});
				flag = false;

				$("section#banner").css({"-webkit-filter": "blur(0px)"});

				//$(".intro-body").css({"opacity":"transparent"});
			}
		}


	});





});

