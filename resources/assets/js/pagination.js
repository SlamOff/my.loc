function Pagination(options) {
	var pagination = document.getElementById(options.id);
	var pageQuantity = Math.ceil(options.cymbalsQuantity/options.elQuantity);
	var prev = document.querySelector(options.prevBtn);
	var next = document.querySelector(options.nextBtn);
	var ul = pagination.lastElementChild;
	//var currentPage;
	var self;

	var createPages = function(){

		if(pageQuantity != 0) {

			for (var j = 0; j < pageQuantity; j++) {
				function CreateElement(el) {
					return document.createElement(el);
				}

				var li = new CreateElement('li');
				var a = new CreateElement('a');

				li.textContent = j + 1;
				//a.setAttribute('href', window.location.href + li.textContent);
				a.setAttribute('href', li.textContent);
				li.appendChild(a);
				ul.appendChild(li);
				var num = window.location.pathname.split('/');
				var link = +num[num.length - 1];
			}
			if(!isNaN(link)){
				ul.children[link - 1].classList.remove('invisible');
				ul.children[link - 1].classList.add('active');

			}
			else{
				ul.children[0].classList.add('active');
				ul.children[0].classList.remove('invisible');
			}
		}
	};
	createPages();
	var li = ul.getElementsByTagName('li');
	for (var i = 0; i < li.length; i++){
		li[i].classList.add('invisible');
	}
	var sidePages = function(c){
		c.classList.remove('invisible');
		if(c.nextElementSibling){
			c.nextElementSibling.classList.remove('invisible');
		}
		if(c.previousElementSibling){
			c.previousElementSibling.classList.remove('invisible');
		}
	};
	function changePages(btn){

		var link;
		var currentLink = window.location.pathname;
		var arrLink = currentLink.split('/');

		if(typeof +arrLink[arrLink.length - 1] == 'number' && !isNaN(arrLink[arrLink.length - 1])){
			arrLink.pop();
			link = self.textContent;
			arrLink.push(link);

			//window.location.pathname = arrLink.join('/');
			history.pushState(null, null, arrLink.join('/'));
			var linkPage = +arrLink[arrLink.length - 1];
			sidePages(li[linkPage - 1]);
			var items = document.getElementsByClassName('cat__subwrapper');

			for (var i = 0; i < items.length; i++){
				items[i].classList.remove('active');
			}

			if(items[+self.textContent - 1]){
				items[+self.textContent - 1].classList.add('active');
			}
		}
		else {
			if(self){
				link = '/' + self.textContent;
				arrLink.push(link);
				history.pushState(null, null, currentLink + arrLink[arrLink.length - 1]);
			}
		}


	};
	function clickPages(){

		for(var i = 0; i < li.length; i++){
			li[i].classList.remove('active');
			//li[i].classList.add('invisible');
		}
		this.classList.add('active');
		self = this;

		changePages(-1);
		sidePages(this);
	};


	// function clickArrows(a, b, c){
	// 	if(a){
	// 		currentPage.classList.remove('active');
	// 		a.classList.add('active');
	// 		if(c){
	// 			c.classList.remove('invisible');
	// 		}
	// 		if(b) {
	// 			b.classList.add('invisible');
	// 		}
	// 	}
	// };
	this.clickArrowLeft = function(){
		var currentPage = document.querySelector('.pagination ul li.active');

		//var active = currentPage;
		if(currentPage.previousSibling){
			sidePages(currentPage.previousSibling);
			currentPage.classList.remove('active');
			currentPage.previousSibling.classList.add('active');
			self = currentPage.previousSibling;
		}
		changePages(-1);

	};

	this.clickArrowRight = function(){
		var currentPage = document.querySelector('.pagination ul li.active');

		if(currentPage.nextSibling){
			sidePages(currentPage.nextSibling);
			currentPage.classList.remove('active');
			currentPage.nextSibling.classList.add('active');
			self = currentPage.nextSibling;
		}

		changePages(-1);
	};

	this.init = function(){
		var list =  ul.getElementsByTagName('li');
		for (var j = 0; j < li.length; j++){
			li[j].addEventListener('click', clickPages);
		}
		for (var i = options.visiblePages; i < list.length; i++){
			list[i].classList.add('invisible');
		}
		prev.addEventListener('click', this.clickArrowLeft);
		next.addEventListener('click', this.clickArrowRight);
	};
	this.destroy = function(){
		ul.innerHTML = '';
	};
};
export default Pagination;
