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


 var openmodal = document.querySelectorAll('.modal-open')
 for (var i = 0; i < openmodal.length; i++) {
   openmodal[i].addEventListener('click', function(event){
	 event.preventDefault()
	 toggleModal()
   })
 }
 
 const overlay = document.querySelector('.modal-overlay')
 overlay.addEventListener('click', toggleModal)
 
 var closemodal = document.querySelectorAll('.modal-close')
 for (var i = 0; i < closemodal.length; i++) {
   closemodal[i].addEventListener('click', toggleModal)
 }
 
 document.onkeydown = function(evt) {
   evt = evt || window.event
   var isEscape = false
   if ("key" in evt) {
	 isEscape = (evt.key === "Escape" || evt.key === "Esc")
   } else {
	 isEscape = (evt.keyCode === 27)
   }
   if (isEscape && document.body.classList.contains('modal-active')) {
	 toggleModal()
   }
 };
 
 
 function toggleModal () {
   const body = document.querySelector('body')
   const modal = document.querySelector('.modal')
   modal.classList.toggle('opacity-0')
   modal.classList.toggle('pointer-events-none')
   body.classList.toggle('modal-active')
 }
  
$("#add-new-type").click(function(){
	$('#add-new-type-label').addClass('block');
	$('#add-new-type-label').removeClass("hidden");

	$('#type-select').addClass('hidden');
	$('#type-select').removeClass('block');

	$('#add-new-type').addClass('hidden');
	$('#add-new-type').removeClass('block');

	$('#remove-new-type').addClass('block');
	$('#remove-new-type').removeClass("hidden");
}); 

$("#remove-new-type").click(function(){
	$('#add-new-type-label').addClass('hidden');
	$('#add-new-type-label').removeClass('block');

	$('#type-select').addClass("block");
	$('#type-select').removeClass("hidden");

	$('#add-new-type').addClass('block');
	$('#add-new-type').removeClass('hidden');

	$('#remove-new-type').addClass("hidden");
	$('#remove-new-type').removeClass("block");
}); 
