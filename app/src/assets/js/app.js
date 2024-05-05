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

 $( "#cart-bt" ).hover(
	function() {
		$('#cart-bt-text').toggleClass('hidden');
		$('#cart-bt-text').toggleClass('block');
	}
);

 $('#cart-bt').click(toggleSlideover);
 $('#cart-bt-x').click(toggleSlideover);


 kofiWidgetOverlay.draw("mohamedghulam", {
	type: "floating-chat",
	"floating-chat.donateButton.text": "Support me",
	"floating-chat.donateButton.background-color": "#323842",
	"floating-chat.donateButton.text-color": "#fff"
});
  