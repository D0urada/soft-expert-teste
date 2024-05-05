var $ = require( "jquery" );

const URL = 'http://localhost:8080';

$( "#target" ).on( "click", function() {
	alert( "clicou." );

	$.ajax({
		url : `${URL}/sobre`,
		type : 'GET',
		success : function(data) {              
			alert('Data: '+ data);
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
} );

function toggleSlideover(e) { 
    $('#slideover-container').toggleClass('invisible');
    $('#slideover-bg').toggleClass('opacity-0');
    $('#slideover-bg').toggleClass('opacity-50');
    $('#slideover').toggleClass('translate-x-full');
 }

 $('#cart-bt').click(toggleSlideover);
 $('#cart-bt-x').click(toggleSlideover);

