// function collectionsRequest(type) {
//
// 	var filter = document.getElementsByClassName('filter__item');
// 	//console.log(arguments);
// 	var selectedType;
// 	var collectionsUrl = '/collections/get?type=' + type;
// 	var xhr = new XMLHttpRequest();
// 	xhr.open('GET', collectionsUrl, false);
// 	xhr.send();
// 	if (xhr.status != 200){
// 		console.log('error ..I..');
// 	}
// 	else{
// 		var collections = JSON.parse(xhr.responseText).collection;
// 		setCollectionsNodes();
// 		//var pagination2 = new Pagination(paginationObj);
// 		//pagination.init();
// 		//console.log(collections);
// 	}
// 	function setCollectionsNodes(){
// 		function CreateElement(el){
// 			return document.createElement(el);
// 		};
// 		var subFilter = document.querySelectorAll('.subfilter');
// 		for (var j = 0; j < collections.length; j++){
// 			var li = new CreateElement('li');
// 			li.classList.add('subfilter__item');
// 			subFilter[type - 1].appendChild(li);
// 			var lis = subFilter[type - 1].getElementsByClassName('subfilter__item');
// 			lis[j].textContent = collections[j].name;
// 			lis[j].dataset.type = collections[j].id;
// 			//console.log(collections[j]);
// 			lis[j].addEventListener('click', function(){
// 				for(var i = 0; i < lis.length; i++){
// 					lis[i].style.color = '#727a73';
// 				};
// 				this.style.color = '#c7452c';
// 				getId = this.dataset.type;
// 				//console.log(getId);
// 				//console.log(i);
// 				cymbalsRequest(getId);
//
// 				//selectedType = this.dataset.type;
//
// 				// function getIdFunc(){
// 				// 	return selectedType;
// 				// };
// 				// getId = getIdFunc();
// 				// console.log(getId);
// 				//getId = changeCymbals();
// 			});
// 			//setTimeout(function(){console.log(getId)},5000);
//
// 		}
// 	};
//
// 	quantityCymbals = cymbalsRequest(getId);
// };
// function cymbalsRequest(id){
// 	//console.log(id);
// 	var catContainer = document.querySelector('.cat__wrapper');
//
// 	var cymbalsUrl = '/cymbals/get?id=' + id;
//
// 	var xhr = new XMLHttpRequest();
//
// 	xhr.open('GET', cymbalsUrl, false);
//
// 	xhr.send();
//
// 	if (xhr.status != 200) {
// 		console.log('error ..I..');
// 	} else {
// 		var cymbals = JSON.parse(xhr.responseText).cymbals;
// 		deleteNodes();
// 		setCymbalsNodes();
// 		//console.log(cymbals);
// 		var catItem = document.querySelectorAll('.cat__wrapper__item');
// 		for(var i = 0; i < cymbals.length; i++) {
// 			var src = cymbals[i].image;
// 			//console.log(src);
// 			var price = cymbals[i].price;
// 			catItem[i].getElementsByTagName('img')[0].setAttribute('src', '/upload/' + src);
// 			catItem[i].getElementsByClassName('price')[0].textContent = price;
// 		}
// 	}
// 	function setCymbalsNodes(){
// 		function CreateElement(el){
// 			return document.createElement(el);
// 		};
// 		var item = new CreateElement('div');
// 		var span = new CreateElement('span');
// 		var img = new CreateElement('img');
// 		var subwrapper = new CreateElement('div');
// 		subwrapper.classList.add('cat__subwrapper');
// 		var catWrapperItem = document.createElement('div');
// 		catWrapperItem.classList.add('cat__wrapper__item');
// 		span.classList.add('price');
// 		item.classList.add('cat__wrapper__item');
//
// 		for (var j = 0; j < cymbals.length/4; j++){
// 			catContainer.appendChild(subwrapper.cloneNode(true));
// 			document.querySelectorAll('.cat__subwrapper')[j].appendChild(catWrapperItem.cloneNode(true));
// 			document.querySelectorAll('.cat__subwrapper')[j].appendChild(catWrapperItem.cloneNode(true));
// 			document.querySelectorAll('.cat__subwrapper')[j].appendChild(catWrapperItem.cloneNode(true));
// 			document.querySelectorAll('.cat__subwrapper')[j].appendChild(catWrapperItem.cloneNode(true));
// 		}
// 		//console.log(document.querySelectorAll('.cat__wrapper__item'));
// 		for (var k = 0; k < cymbals.length; k++){
// 			document.querySelectorAll('.cat__wrapper__item')[k].appendChild(img.cloneNode(true));
// 			document.querySelectorAll('.cat__wrapper__item')[k].appendChild(span.cloneNode(true));
// 		}
// 	};
// 	function deleteNodes(){
// 		var wrapper = document.getElementsByClassName('cat__wrapper')[0];
// 		wrapper.innerHTML = '';
// 	}
// 	return cymbals.length;
// };
//
// export {cymbalsRequest, collectionsRequest};
