$(document).ready(function(){

    $('.tooltipped').tooltip({delay: 30});
 	
 	$('.button-collapse').sideNav({
	    menuWidth: 300, 
		edge: 'left',   
		closeOnClick: true, 
		draggable: true
	});

 	$('.t-open').click(function(){
 		$('.tap-target').tapTarget('open');
 	});
 	
 	
 });
