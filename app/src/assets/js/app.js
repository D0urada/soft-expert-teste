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

// ----------- Carrinho ------------------
function toggleSlideover () {
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


 // ----------- Modal produto ------------------

 toggleModalInit();

 function toggleModalInit(params) {
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
 }

 function toggleModal(params) {
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

$("#remove-new-type").click(function(){
	$('form[name="frmSave"]').append("<input type='text'/>");
}); 

// ----------- Adicionar Produtos ao carrinho ------------------

$(".products").click(function(){
	let product_array = $.makeArray($(this).data('values'));

	apprendCartProducts(buildCartProducts(product_array));
	apprendCartProductsInput(buildCartProductsInput(product_array));
	cartCounter();
	sumValuesSell(product_array);
});

function buildCartProducts (product_array) {
	var dom_product = `
		<div class="flex flex-col md:flex-row border-b border-gray-400 py-4">
			<div class="mt-4 md:mt-0 md:ml-6">
				<h2 class="text-lg font-bold">${product_array[0].name}</h2>
				<div class="mt-4 flex items-center">
				<span class="mr-2 text-gray-600">Valor:</span>
				<div class="flex items-center">
					<span class="mx-2 text-gray-600">R$ ${product_array[0].value}</span>
				</div>
				<div class="mt-1 flex items-center">
					<span class="mr-2 text-gray-600">Imposto:</span>
					<div class="flex items-center">
						<span class="mx-2 text-gray-600">${product_array[0].tax_value}%</span>
					</div>
				</div>
				<span class="mt-1 ml-auto font-bold">R$ ${product_array[0].full_value}</span>
			</div>
		</div>
		`;

	return dom_product;
}

function buildCartProductsInput (product_array) {
	var dom_product = `
		<input type="hidden" value=${JSON.stringify(product_array)} name="sell_product_${$('#counter').val()}">
		`;

	return dom_product;
}

function apprendCartProducts (dom_product) {
	$("#product-cart").append(dom_product);
}

function apprendCartProductsInput (dom_product) {
	$("#form-cart-sell").append(dom_product);
}

function cartCounter() {
	$('#cart-counter').html(function(i, val) { return +val+1 });

	let sum = Number($('#counter').val())+1;
	document.getElementById("counter").value = sum;

	if($('#counter').val() > 0) {
		$('#cart-counter').addClass('block');
	} else {
		$('#add-new-type').removeClass('hidden');
	}
}

function sumValuesSell(product_array) {
	$('#cart-value-total').html(function(i, val) { 
		let v1 = parseFloat(val)
		return Number(product_array[0].value) + Number(v1); 
	});
	$('#cart-tax-total').html(function(i, val) { 
		let v1 = parseFloat(val)
		return Number(product_array[0].tax_value) + Number(v1); 
	});
	$('#cart-end-values-total').html(function(i, val) { 
		let v1 = parseFloat(val)
		return Number(product_array[0].full_value) + Number(v1); 
	});
}



function sumValues(product_array) {

}

function sumTax(product_array) {
	
}

function sumEndValues(product_array) {
	
}