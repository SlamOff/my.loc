// 'use strict';
//
// import Vue from 'vue';
// import router from './routes';
// //
// //
// //
// import start from './components/start.vue';
// import who from './components/who.vue';
// import how from './components/how.vue';
// import menu from './components/menu.vue';
// import cat from './components/cat.vue';
// import contatcs from './components/contacts.vue';
//
//
//
// var appRoot = new Vue({
//     el: '#app',
//     router,
//     data: {
//         collections: [],
//         cymbals: []
//     },
//     created: function (e) {
//             console.log(e);
//             axios.get('/collections/get', {
//                 params: {
//                     type: 2
//                 }
//             }).then(function (response) {
//                 console.log(appRoot.collections);
//                 appRoot.collections = response.data.collection;
//             }).catch(function (error) {
//                 //console.log(error);
//             });
//     },
//     methods : {
//      getH: function(){
//          console.log(12222223);
//      }
//     }
// });
// // /console.log(appRoot);
// function ready(d){
// 	// var how = d.querySelector('.how');
// 	// var who = d.querySelector('.who');
// 	// var menu = d.querySelector('.menu');
// 	// function showElem(elem) {
// 	// 	elem.classList.add('shown');
// 	// };
// 	// function hideElem(elem) {
// 	// 	elem.classList.remove('shown');
// 	// };
// 	// var whoBtn = d.querySelector('.nav_left');
// 	// var menuBtn = d.querySelector('.header__btn');
// 	// var howBtn = d.querySelector('.nav_right');
// 	// var closeWho = d.querySelector('.who .close');
// 	// var closeHow = d.querySelector('.how .close');
// 	// var closeMenu = d.querySelector('.menu .close');
// 	// whoBtn.addEventListener('click', showElem.bind(null, who));
// 	// howBtn.addEventListener('click', showElem.bind(null, how));
// 	// menuBtn.addEventListener('click', showElem.bind(null, menu));
// 	// closeWho.addEventListener('click', hideElem.bind(null, who));
// 	// closeHow.addEventListener('click', hideElem.bind(null, how));
// 	// closeMenu.addEventListener('click', hideElem.bind(null, menu));
//     //console.log(getComputedStyle(d.querySelector('.who__content__pict').height));
// 	function equalHeight() {
//
// 	   var pict = d.getElementsByClassName('who__content__pict')[0];
//         //console.log(pict);
// 	    var pictHeight = parseInt(getComputedStyle(pict).height);
// 	   var text = d.querySelector('.who__content__text');
//
// 	   text.style.height = pictHeight + 'px';
// 	    //console.log(pictHeight);
// 	};
// 	//equalHeight();
// 	//window.addEventListener('onresize', function(){
//    //     equalHeight();
//    // });
//     var whoBtn = d.querySelector('.nav_left');
//     whoBtn.addEventListener('click', equalHeight);
//
//
// };
// document.addEventListener("DOMContentLoaded", ready.bind(null, document));
