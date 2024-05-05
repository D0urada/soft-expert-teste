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

