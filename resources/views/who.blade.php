<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- build:css css/combined.css -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/perfect-scrollbar.css')}}">
    <!-- endbuild -->
	<title>{{$seo['title']}}</title>
	<meta name="description" content="{{$seo['description']}}">
	<meta name="keywords" content="{{$seo['keywords']}}">
</head>
<body class="main_page">
	<div class="who">
		<div class="nav_left">
			<span>who we are</span>
		</div>
		<hr />
        <div class="container">
            <div class="row">
                <div class="who__header">
                    <a class="hidden-xs" href='/'><img src="img/logo2.png" alt="Masha Yakush"></a>
                    <a class="visible-xs" href='/'><img src="img/logo2_m.png" alt="Masha Yakush"></a>
                    <a href='/'><img class="close" src="img/close.png" alt=""></a>
                </div>
                <div class="who__content">
                    <div class="who__content__text" id="scroll_wrapper">
                       <p>
							Привет. Меня зовут Маша Якуш, и я чувствую себя в своей тарелке.
                       </p>
						<p>
							Я занимаюсь ресторанным консалтингом, путешествую в поисках гастрономических открытий
							и верю в то, что из красивой тарелки и есть приятно. Вкус и эмоции от блюда, поданного
							на ржавом подносе и принесенного в дизайнерской высококачественной керамической
							тарелке — диаметрально противоположные. Я за эстетику и хороший вкус еды.
                       </p>
						<p>
							Вместе с художником Serge Payet (его работы также можно увидеть на витринах Cartier
							и на индивидуальных выставках художника) мы создали три направления керамических
							тарелок ручной работы.
                       </p>
						<p>
							NU — это тарелки с природными явлениями и проявлениями, нюдовые коллекции.
							MY — это тарелки с авторскими рисунками и дизайном, более яркие и смелые решения.
							RE — тарелки на заказ для HoReCa, которые изготавливаются исключительно для вашего
							ресторана и по индивидуальному дизайну.
                       </p>
						<p>
							Часть тарелок мы производим в Италии на мануфактуре, которая создает посуду вручную
							с 1967 года — на них написано «Made in Italy». Некоторые тарелки производим в Украине
							и тоже вручную, с любовью к своему потребителю. 
                       </p>
                       <p>
                       		Тарелки продаются в наборах по 4 штуки (две для супа и две для основного блюда).
                       </p>
                    </div>
                    <div class="who__content__pict">
                        <img src="img/who.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--[if lt IE 9]>
    <script src="libs/html5shiv/dist/es5-shim.min.js"></script>
    <script src="libs/html5shiv/dist/html5shiv.min.js"></script>
    <script src="libs/html5shiv/dist/html5shiv-printshiv.min.js"></script>
    <script src="libs/respond/dest/respond.min.js"></script>
    <![endif]-->

    <!-- build:js scripts/combined.js -->
     <script src="/js/app.js"></script>
    <!-- endbuild -->

</body>
</html>
