export default function Slider(options) {
	var slider = document.getElementById(options.id);
	var sliderWidth = parseFloat(getComputedStyle(slider).width);
	var sliderItems = document.getElementsByClassName('slider_item');
	var sliderItemWidth = 0;

	var prev = document.querySelector(options.prevBtn);
	var next = document.querySelector(options.nextBtn);

	var self = this;



	this.showSlides = function(d) {
		if (!d) {
			d = 0;
		}
		if (sliderItems[0]) {
			sliderItems[0].classList.add('active');
		}
		for (var i = 0; sliderItems.length > i; i++) {

			if (sliderItems[i].style.left !== '') {
				var currentLeft = parseFloat(sliderItems[i].style.left);
				sliderItems[i].style.left = currentLeft + (sliderItemWidth * d) + 'px';
				sliderItems[i].style.width = sliderItemWidth + 'px';
				sliderItems[i].classList.remove('active');
				if (sliderItems[i].style.left == '0px') {
					sliderItems[i].classList.add('active');
				}
				console.log('width 111 ' + sliderItemWidth);
				console.log('left 111 ' + sliderItems[i].style.left);
			}

			else {
				sliderItems[i].style.width = sliderItemWidth + 'px';
				sliderItems[i].style.left = sliderItemWidth * i + 'px';
				console.log('width 222 ' + sliderItemWidth);
				console.log('left 222 ' + sliderItems[i].style.left);
			}
		}
		if(options.translate){
			for (var j = 0; j < sliderItems.length; j++){
				sliderItems[j].classList.remove('next_slide');
				sliderItems[j].classList.remove('prev_slide');
			}

			var prev = document.querySelector('.slider_item.active').previousElementSibling;
			var next = document.querySelector('.slider_item.active').nextElementSibling;
			function translatePict(el, className){
				if(el.classList.contains('slider_item')){
					el.classList.add(className);
				}
			}
			translatePict(next, 'next_slide');
			translatePict(prev, 'prev_slide');
		}
	};
	this.slideLeft = function () {
		if (parseFloat(sliderItems[0].style.left) < 0) {
			self.showSlides(1);
		}
	};
	this.slideRight = function () {
		if (parseFloat(sliderItems[sliderItems.length - 1].style.left) >= sliderWidth) {

			self.showSlides(-1);
		}

	};
	this.init = function () {
		for (var i = 0; i < sliderItems.length; i++){
			sliderItems[i].style.display = 'block';
		}
		if (!options.slidesToShow || isNaN(+options.slidesToShow)) {
			options.slidesToShow = 1;
		}
		sliderItemWidth = sliderWidth / options.slidesToShow;
		self.showSlides();
		prev.addEventListener('click', self.slideLeft);
		next.addEventListener('click', self.slideRight);
		console.log('init');
	};
	this.destroy = function(){
		for (var i = 0; i < sliderItems.length; i++){
			sliderItems[i].style.left = '0px';
			sliderItems[i].style.width = '0px';
		}
	}
};
