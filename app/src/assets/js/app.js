var $ = require( "jquery" );

const URL = 'http://localhost:8080';

// ----------- Abrir e fechar Carrinho ------------------
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


 // ----------- Abrir e fechar modal de cadastro de produto produto ------------------

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

$("#add-new-type-bt").click(function(){
	$('#type-select-label').addClass('hidden');
	$('#type-select').val("");
	$('#type-select').removeAttr("required");

	$('#add-new-type').append(buildNewTypeLabel());

	$('#add-new-type-bt').addClass('hidden');
	$('#add-new-type-bt').removeClass('block');

	$('#remove-new-type-bt').addClass('block');
	$('#remove-new-type-bt').removeClass("hidden");
}); 

$("#remove-new-type-bt").click(function(){
	$('#type-select-label').removeClass('hidden');
	$('#type-select-label').addClass("block");
	$('#type-select').val("");
	$('#type-select').attr("required", "required");

	$('#add-new-type-label').remove();

	$('#add-new-type-bt').addClass('block');
	$('#add-new-type-bt').removeClass('hidden');

	$('#remove-new-type-bt').addClass("hidden");
	$('#remove-new-type-bt').removeClass("block");
}); 

function buildNewTypeLabel() {
	var dom_product = `
		<div id="add-new-type-label">
			<p class="text-1x1 font-bold">Cadastro Novo Tipo</p>
			<div class="col-span-2">
				<label for="type-name" class="block mb-2 text-sm font-medium text-gray-900">Nome Tipo</label>
				<input type="text" name="type-name" id="type-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Type product name" required="">
			</div>
			<div class="col-span-2 sm:col-span-1">
				<label for="type-tax" class="block mb-2 text-sm font-medium text-gray-900">Imposto</label>
				<input type="number" step=0.01 name="type-tax" id="type-tax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="$2999" required="">
			</div>
		<div>
		`;

	return dom_product;
}





// ----------- Adicionar e Remove Produtos ao carrinho ------------------

$(".products").click(function(){
	let product_array = $.makeArray($(this).data('values'));

	apprendCartProducts(buildCartProducts(product_array));
	apprendCartProductsInput(buildCartProductsInput(product_array));
	cartCounter();
	sumValuesSell(product_array);


});


$(`#product_cart_exclude_bt_${$('#counter').val()}`).click(function(){
	alert('teste');
	console.log($(this).data('cart-item-id'));
});

function buildCartProducts (product_array) {
	var dom_product = `
		<div class="flex flex-col md:flex-row border-b border-gray-400 py-4" id="product_cart_${$('#counter').val()}">
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
						<span class="mx-2 text-gray-600">${product_array[0].tax}%</span>
					</div>
				</div>
				<span class="mt-1 ml-auto font-bold">R$ ${product_array[0].tax_value}</span>
				<button type="button" id="product_cart_exclude_bt_${$('#counter').val()}" data-cart-item-id="product_cart_${$('#counter').val()}" 
				class=" bg-red-500 cursor-pointer text-gray-100 absolute right-0 
				hover:bg-red-900 rounded  focus:ring-4 focus:outline-none focus:ring-gray-300 
				font-medium text-sm p-1 text-center inline-flex items-center me-5">
					<svg class="w-3.5 h-3.5 m-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 18 21">
						<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
						<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
					</svg>
				</button>
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
		let v1 = parseFloat(val.replace('R$ ',''));

		return `R$ ${(Number(product_array[0].value) + Number(v1)).toFixed(2)}`; 
	});

	$('#cart-end-values-total').html(function(i, val) { 
		let v1 = parseFloat(val.replace('R$ ',''));

		return `R$ ${(Number(product_array[0].end_value) + Number(v1)).toFixed(2)}`; 
	});
	
	$('#cart-tax-total').html(function(i, val) { 
		let v1 = parseFloat(val.replace('R$ ',''));

		return `R$ ${(Number(product_array[0].tax_value) + Number(v1)).toFixed(2)}`; 
	});
}

// ----------- Requisição post do castro do produto ------------------
// Bind to the submit event of our form
$("#form-prducts").submit(function(event){

	// Variable to hold request
	let request;

	// Prevent default posting of form - put here to work in case of errors
	event.preventDefault();

	console.log('entrou');

	// Abort any pending request
	if (request) {
		request.abort();
	}

	// setup some local variables
	let $form = $(this);

	// Let's select and cache all the fields
	let $inputs = $form.find("input, select, textarea");

	if(!validateForm($inputs)) {
		$inputs.prop("disabled", false);

		alert("Formulario invalido");
	
		return setTimeout(location.reload.bind(location), 600);
	}

	// Serialize the data in the form
	let serializedData = $form.serialize();

	// Let's disable the inputs for the duration of the Ajax request.
	// Note: we disable elements AFTER the form data has been serialized.
	// Disabled form elements will not be serialized.
	$inputs.prop("disabled", true);

	// Fire off the request to /form.php
	request = $.ajax({
		url: `${URL}/productcts/create`,
		type: "post",
		data: serializedData
	});

	// Callback handler that will be called on success
	request.done(function (response, textStatus, jqXHR){
		// Log a message to the console
		console.log(response);
		console.log(textStatus);
		console.log(jqXHR);

		alert("Produto Cadastrado com sucesso");
	});

	// Callback handler that will be called on failure
	request.fail(function (jqXHR, textStatus, errorThrown){
		// Log the error to the console
		console.error(
			"The following error occurred: "+
			jqXHR, textStatus, errorThrown
		);

		alert("Erro ao cadastrar produto");
	});

	// Callback handler that will be called regardless
	// if the request failed or succeeded
	request.always(function () {
		// Reenable the inputs
		$inputs.prop("disabled", false);

		return setTimeout(location.replace(location.href), 600);
	});

});

$(document).on("change","#type-select",function(){
	$("option[value=" + this.value + "]", this)
	.attr("selected", true).siblings()
	.removeAttr("selected")
});

function validateForm(inputs) {
	let result = true;

	console.log('validateForm');
	console.log(inputs);
	console.log($.makeArray(inputs));
	console.log('validateForm');

	$.makeArray(inputs).forEach(element => {
		if(!element.value && element.hasAttribute('required')) {
			element.classList.remove('bg-red-600');
			result = false;
		}
	});

	return result;
}