import Slider from './slider';
import Pagination from './pagination';
import PerfectScrollbar from 'perfect-scrollbar';
import IMask from 'imask';

var mainObj = {
	id: 'main_slider',
	slidesToShow: 1,
	infinite: false,
	prevBtn: '.prev',
	nextBtn: '.next',
	translate: false
};
var cymbalObj = {
	id: 'cymbal_slider',
	slidesToShow: 1,
	infinite: false,
	prevBtn: '.prev',
	nextBtn: '.next',
	translate: true
};
var primaryQuantity;
var paginationOptions = {
	id: 'pagination',
	nextBtn: '.next',
	prevBtn: '.prev',
	elQuantity: 4,
	cymbalsQuantity: primaryQuantity
};
function IsJsonString(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}
var ajaxPagination;


function cymbalsRequest(type){
	!type ? type = 8 : type = type;
	var cymbalsUrl = '/cymbals/get?id=' + type;
	var xhr = new XMLHttpRequest();
	xhr.open('GET', cymbalsUrl, false);
	xhr.send();
	xhr.onreadystatechange = function() {
		if (xhr.readyState != 4) return;
		if (xhr.status != 200) {
			console.log('error ..I..');
		}
		else {
			var cymbalsObj = JSON.parse(xhr.responseText);
			var quantity = cymbalsObj.count;
			var cymbals = cymbalsObj.cymbals;
			paginationOptions.cymbalsQuantity = quantity;

			var catWrapper = document.querySelector('.cat__wrapper');
			catWrapper.innerHTML = cymbals;
			if (document.querySelector('#pagination')) {
				ajaxPagination = new Pagination(paginationOptions);
			}

		}
	}
};



var quantityItem;

function cartRequest(e) {
	e.preventDefault();
	var url = this.getAttribute('href');
	var btn = document.getElementsByClassName('header__cart')[0];
	var xhr = new XMLHttpRequest();
	xhr.open('GET', url, true);
	xhr.send();
	xhr.onreadystatechange = function() {
		if (xhr.readyState != 4) return;

		if (xhr.status != 200) {
			console.log('error ..I..');
		}
		else {
			var cart = JSON.parse(xhr.responseText).cart;
			quantityItem = JSON.parse(xhr.responseText).quantity;
			var amount = JSON.parse(xhr.responseText).amount;
			function setTotal(){
				var text = document.querySelector('.total_price');
				text.textContent = '€ ' + amount;
			}

			if (cart > 0) {
				btn.textContent = 'cart' + '(' + cart + ')';

				btn.classList.add('active_cart');
				btn.classList.add('animated');
				setTimeout(function () {
					btn.classList.remove('animated');
				}, 500);
				if(window.location.pathname == '/cart'){
					setTotal();
				}
			}
			else {
				btn.textContent = 'cart';
				btn.classList.remove('active_cart');
				window.location.reload();
				document.querySelector('.header__return').classList.add('centered');
			}
		}
	}
}


function ready(d){

	var form = document.getElementById('form');
	if(form){

		form.onsubmit = function(e){
			var formData = new FormData(this);
			console.log(formData);
			e.preventDefault();
			var urlForm = '/order';
			var required = document.getElementsByClassName('required');
			var xhrForm = new XMLHttpRequest();
			var csrf = document.getElementById('csrf').getAttribute('content');
			var obj = {};
			//console.log(required);
			for (var i = 0; i < required.length; i++){
				obj[required[i].getAttribute('name')] = required[i].value;
			}
			var data = JSON.stringify(obj);
			console.log(data);
			if(IsJsonString('')){
				console.log('123');
			};
			xhrForm.open('POST', urlForm, true);
			xhrForm.setRequestHeader('X-CSRF-TOKEN', csrf);
			xhrForm.send(data);
			xhrForm.onreadystatechange = function() {
				if (xhrForm.readyState != 4) return;
				if (xhrForm.status != 200) {
					console.log('error ..I..');
				}
				else {
					//console.log(xhrForm.responseText);
				}
			}
		}


	}

	// var required = document.getElementsByClassName('required');
	// for (let count = 0; count < required.length; count++){
	// 	required[count].addEventListener("invalid", function (e) {
	// 		console.log(required[count].validity.valid);
	// 		if (!required[count].validity.valid) {
	// 			required[count].setCustomValidity("Fill in this field");
	// 		} else {
	// 			required[count].setCustomValidity("");
	// 		}
	// 	});
	// }

	// var required = document.getElementsByClassName('required');
	// function validate(form) {
	// 	var elems = document.getElementsByClassName('required');
	// 	var emailCheck = new RegExp('[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$');
	// 	var nameCheck = '^[a-zA-Z]+$';
	// 	console.log(emailCheck);
	// 	for(let i = 0; i < elems.length; i++){
	// 		if (!elems[i].value) {
	// 			elems[i].previousElementSibling.textContent = 'Fill in this field';
	// 		}
	// 		elems[i].onfocus = function(){
	// 			this.previousElementSibling.textContent = '';
	// 		}
	// 	}
	// 	if(elems.name.value.length <= 2){
	// 		elems.name.previousElementSibling.textContent = 'Fill in a valid name';
	// 		//elems.email.previousElementSibling.textContent = 'Fill in a valid e-mail';
	// 	}
	// 	console.log(emailCheck.test(String(elems.email).toLowerCase()));
	// 	function validateEmail(email) {
	// 		return emailCheck.test(String(email).toLowerCase());
	// 	}
	// 	if(emailCheck.test(String(elems.email).toLowerCase())){
	// 		console.log(11);
	// 	}
	// }
	// var form = document.getElementById('form');
	// if(form){
	// 	form.onsubmit = function(e){
	// 		e.preventDefault();
	// 		validate(this);
	// 	}
	// }



	var contact = document.querySelector('.contact_info');
	var closeContact = document.querySelectorAll('.close_contact');
	var contactBtn = document.querySelectorAll('.contact_btn');
	if(contact){
		for(var g = 0; g < contactBtn.length; g++) {
			contactBtn[g].onclick = function (e) {
				e.preventDefault();
				console.log(1);
				contact.classList.add('shown');
			}
		}
		for(var f = 0; f < closeContact.length; f++){
			closeContact[f].onclick = function(){
				this.parentElement.classList.remove('shown');
			}
		}
	}


	if(document.getElementById('phone')){
		var masked = document.getElementById('phone');
		var maskOptions = {
			mask: '+{3}(\\000)000-00-00',
		};
		var mask = new IMask(masked, maskOptions);
	}
	if (document.querySelector('.order__item')) {
		var minus = document.querySelectorAll('.minus');
		var plus = document.querySelectorAll('.plus');
		var closeBtn = document.querySelectorAll('.close_item');

		for (var j = 0; j < minus.length; j++) {

			minus[j].onclick = function () {
				var span = this.parentElement.nextElementSibling;
				var quantity = +span.textContent;
				if (quantity <= 1) {
					this.closest('.order__item').remove();
				}
				else {
					quantity--;
					span.textContent = quantity;
				}
			}
			plus[j].onclick = function () {

				var span = this.parentElement.previousElementSibling;
				var quantity = +span.textContent;

				quantity++;
				span.textContent = quantity;
			}
			closeBtn[j].onclick = function () {
				var orderItem = this.parentElement;
				orderItem.remove();
			}
		}
	}


	var buy = document.getElementsByClassName('buy');
	if(buy){
		for(var b = 0; b < buy.length; b++){
			buy[b].addEventListener('click', cartRequest);

		}
	}

	var input = document.querySelectorAll('input');
	for(var n = 0; n < input.length; n++){
		var placeholder;
		input[n].onfocus = function(){
			placeholder = this.getAttribute('placeholder');
			this.setAttribute('placeholder', '');
		}
		input[n].onblur = function(){
			this.setAttribute('placeholder', placeholder);
		}
	}
	var select = document.querySelector('select');

	if(select){
		select.onchange = function(){
			var address = document.querySelector('input[name="address"]');
			var option = this.children;
			if(option[1].selected){
				address.setAttribute('disabled', 'disabled');
				this.parentElement.classList.add('last');
			}
			else{
				address.removeAttribute('disabled');
				this.parentElement.classList.remove('last');
			}
		}
	}

	if(document.getElementById('scroll_wrapper') && window.innerWidth > 766){
		var scrollBar = new PerfectScrollbar('#scroll_wrapper', {
			wheelSpeed: 2,
			//wheelPropagation: true,
			minScrollbarLength: 20
		});
	}
	var back = document.querySelector('.back');
	if(back){
		back.onclick = function(){
			window.history.back();
		}
	}

	var menuBtn = d.querySelector('.header__btn');
	var closeBtn = d.querySelector('.close');
	var menu = d.querySelector('.menu');
	var scrollTop = d.querySelector('.scroll_top');
	var menuFunc = function(){
		menu.classList.toggle('shown');
	};


	var scrolled, timer;
	function scrollUp() {
		if(scrolled > 0){
			window.scrollTo(0, scrolled);
			scrolled -= 10;
			timer = setTimeout(scrollUp, 10);
		}
		else{
			clearTimeout(timer);
			window.scrollTo(0,0);
		}
	}
	if(scrollTop){
		scrollTop.onclick = function(){
			scrolled = window.pageYOffset;
			console.log(scrolled);
			scrollUp();
		}
	}
	if(menuBtn){
		menuBtn.addEventListener('click', menuFunc.bind(null, 'block'));
	}
	if(closeBtn){
		closeBtn.addEventListener('click', menuFunc.bind(null, 'none'));
	}

	var catObj = {
		id: 'cat_slider',
		slidesToShow: 1,
		infinite: false,
		prevBtn: '.prev',
		nextBtn: '.next'
	};

	var desc = document.querySelector('.cymbal_desc');
	var close = document.querySelector('.cymbal_desc .close');
	var open = document.querySelector('.cymbal_slider .info');

	if(close){
		close.onclick = function(e){
			this.parentElement.classList.remove('active');
		}
	}
	if(open){
		open.onclick = function(){
			desc.classList.add('active');
		}
	}
	var pathname = window.location.pathname;
	if(document.querySelector('#main_slider')){
		var mainSlider = new Slider(mainObj);
		mainSlider.init();
		window.onresize = function(){
			window.location.reload();
		}
		window.addEventListener("orientationchange", function() {
			window.location.reload();
		});
	}
	else if(document.querySelector('#cymbal_slider')){

		var cymbalSlider = new Slider(cymbalObj);
		if(document.querySelectorAll('.slider_item').length > 0 && window.innerWidth > 766){
			cymbalSlider.init();
		}
		else {
			document.querySelector('.prev').style.display = 'none';
			document.querySelector('.next').style.display = 'none';
		}

	}
	else if(pathname.substr(0, 3) == '/nu' || pathname.substr(0, 3) == '/my' || pathname.substr(0, 3) == '/re'){
		var wrapper = document.querySelector('.cat__wrapper');
		primaryQuantity = wrapper.dataset.count;
		paginationOptions.cymbalsQuantity = primaryQuantity;
		if(document.querySelector('#pagination')){
			var pagination = new Pagination(paginationOptions);
			pagination.init();
		}
	}

	var nuFilterCat = d.querySelector('.filter__item_nu');
	var myFilterCat = d.querySelector('.filter__item_my');
	var reFilterCat = d.querySelector('.filter__item_re');

	var filterObj = {
		filter: {
			nu: {
				selector: nuFilterCat,
				path: '/nu'
			},
			my: {
				selector: myFilterCat,
				path: '/my'
			},
			re: {
				selector: reFilterCat,
				path: '/re'
			}
		},
		filterSet: function(){
			for(var key in this.filter){
				if(window.location.pathname.substr(0,3) === this.filter[key].path){
					this.filter[key].selector.classList.add('active');
					this.filter[key].selector.getElementsByTagName('div')[0].classList.add('active');

					var subfilter = this.filter[key].selector.getElementsByClassName('subfilter')[0];
					var li = subfilter.querySelectorAll('.subfilter__item');
					if(li.length > 0){
						for(var i = 0; i < li.length; i++){
							li[i].addEventListener('click', handler);
						}
					}
					function handler(){
						for(var i = 0; i < li.length; i++){
							li[i].classList.remove('active');
							var data = this.dataset.type;
						}

						this.classList.add('active');
						cymbalsRequest(data);
					}
				}
			}
		}
	};
	filterObj.filterSet();
};
document.addEventListener("DOMContentLoaded", ready.bind(null, document));
