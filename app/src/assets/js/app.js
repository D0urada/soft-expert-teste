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

$(document).on("change","#type-select",function(){
	$("option[value=" + this.value + "]", this)
	.attr("selected", true).siblings()
	.removeAttr("selected")
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

function buildCartProducts (product_array) {
	var dom_product = `
		<div class="flex flex-row md:flex-row border-b border-gray-400 py-4">
			<div class="mt-4 md:mt-0 md:ml-6">
				<h2 class="text-lg font-bold">${product_array[0].product_name}</h2>
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
			</div>
		</div>
		`;

	return dom_product;
}

function buildCartProductsInput (product_array) {
	
	var dom_product = `
		<input type="hidden" value='${JSON.stringify(product_array)}' name="sell_product_${$('#counter').val()}">
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



// ----------- Validaç~~ao dos forms ------------------

function validateForm(inputs) {
	let result = true;

	$.makeArray(inputs).forEach(element => {
		if(!element.value && element.hasAttribute('required')) {
			element.classList.remove('bg-red-600');
			result = false;
		}

		if(element.value == '0') {
			element.classList.remove('bg-red-600');
			result = false;
		}
	});

	return result;
}




// ----------- Requisição post do castro do produto ------------------

$("#form-prducts").submit(function(event){

	let request;

	event.preventDefault();

	if (request) {
		request.abort();
	}

	let $form = $(this);

	let $inputs = $form.find("input, select, textarea");

	if(!validateForm($inputs)) {
		$inputs.prop("disabled", false);

		alert("Formulario invalido");
	
		return setTimeout(location.reload.bind(location), 600);
	}

	let serializedData = $form.serialize();

	$inputs.prop("disabled", true);


	request = $.ajax({
		url: `${URL}/productcts/create`,
		type: "post",
		data: serializedData
	});

	request.done(function (response, textStatus, jqXHR){

		alert("Produto Cadastrado com sucesso");
	});

	request.fail(function (jqXHR, textStatus, errorThrown){
		console.error(
			"O seguinte error aconteceu: "+
			jqXHR, textStatus, errorThrown
		);

		alert("Erro ao cadastrar produto");
	});


	request.always(function () {
		$inputs.prop("disabled", false);

		return setTimeout(location.replace(location.href), 600);
	});

});




// ----------- Requisição post das vendas ------------------

$("#form-cart-sell").submit(function(event){

	let request;

	event.preventDefault();

	if (request) {
		request.abort();
	}

	let $form = $(this);

	let $inputs = $form.find("input");

	if($inputs.length == 0) {
		return alert("Adicione um produto para cadastrar uma venda");
	}

	if(!validateForm($inputs)) {
		alert("Formulario invalido");
		return setTimeout(location.reload.bind(location), 600);
	}

	let serializedData = $form.serialize();
	
	$inputs.prop("disabled", true);

	request = $.ajax({
		url: `${URL}/sells-list/create`,
		type: "post",
		data: serializedData
	});

	request.done(function (response, textStatus, jqXHR){

		alert("Venda Cadastrada com sucesso! Veja a lista de Vendas para ver o que ja comprou");
	});

	request.fail(function (jqXHR, textStatus, errorThrown){
		console.error(
			"O seguinte error aconteceu: "+
			jqXHR, textStatus, errorThrown
		);

		alert("Erro ao cadastrar Venda");
	});

	request.always(function () {
		return setTimeout(location.replace(location.href), 600);
	});

});

