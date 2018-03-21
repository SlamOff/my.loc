<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<!-- build:css css/combined.css -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
	<!-- endbuild -->
	<title>{{$seo['title']}}</title>
	<meta name="description" content="{{$seo['description']}}">
	<meta name="keywords" content="{{$seo['keywords']}}">
</head>
<body class="cymbal_page">
<div class="menu">
	<div class="container">
		<div class="row">
			<div class="menu__header">
				<a class="hidden-xs" href='/'><img src="/img/logo2.png" alt="Masha Yakush"></a>
                <a class="visible-xs" href='/'><img src="/img/logo2_m.png" alt="Masha Yakush"></a>
				<img class="close" src="/img/close.png" alt="">
			</div>
			<div class="menu__content">
				<ul>
					<li class="nu_filter"><a href='/nu'>nu</a></li>
					<li class="my_filter"><a href='/my'>my</a></li>
					<li class="re_filter"><a href='/re'>re</a></li>
					<li><a href='/who'>who we are</a></li>
					<li><a href='/how'>how it is created</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<main class="main">
	<header class="header">
		<div class="container">
			<div class="row">
				<a href="/">
					<div class="header__logo">
						<img src="/img/logo_large.svg" class="hidden-xs logo_large" alt="Masha Yakush">
                        <img src="/img/logo_small.svg" class="visible-xs logo_small" alt="Masha Yakush">
					</div>

				</a>
				<div class="header__right">
					<a href='/cart'>
						<div class="header__cart {{$cart?'active_cart':''}}">cart{{$cart?'('.$cart.')':''}}</div>
					</a>
					<button class="header__btn"><img src="/img/header_btn.png" alt=""></button>
				</div>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="cat">

			@php
				echo view('layouts/_filter')->with(['collections' => $collections,'type' => $type,'collections_id' => $collections_id])->render();
			@endphp
			<div class="cat__wrapper">
				<div class="cymbal_slider" id="cymbal_slider">
					<i class="prev slider_nav icon-arrow_left icon"></i>
                    <i class="next slider_nav icon-arrow_right icon"></i>

					<div class="cymbal_desc">
						<span class="close"><img alt="" src="/img/close2.png"></span>
						<p>
							{{$cymbals->description}}
						</p>
					</div>
					@foreach($plates as $plate)
						<div class="slider_item">
							<img alt="" src="/upload/{{$plate->image}}">
						</div>
					@endforeach
					<span class="price">
                     	<b class="price_digit">€ {{$cymbals->price}}</b>
                     	<div class="visible-xs-inline">
                        	<a href="/buy/cymbals/{{$cymbals->id}}" class="main_btn buy">want to buy</a>
                        </div>
                    	<i class="info icon icon-q"></i>
                    </span>
				</div>
			</div>
			<div class="container container--abs">
				<span class="back hidden-xs">back</span>
				<div class="row">
					<div class="main__desc">
						<div class="buy_wrapper hidden-xs-inline">
							<a href="/buy/cymbals/{{$cymbals->id}}" class="main_btn buy">want to buy</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
		<div class="contact_info">
                		<img class="close_contact" src="/img/close.svg">
                		<div class="container">
							<div class="container_inner">
								<div class="contact_info__item">contacts</div>
								<div class="contact_info__item phones">
									<a href="tel:{{$contacts['phone1']}}">{{$contacts['phone1']}}</a><br />
									<a href="tel:{{$contacts['phone2']}}">{{$contacts['phone2']}}</a>
								</div>
								<div class="contact_info__item">
									<a href="mailto:{{$contacts['email']}}">{{$contacts['email']}}</a>
								</div>
								<div class="footer__social">
									<a href="{{$contacts['facebook']}}" target="_blank"><i class="icon icon-fb"></i></a>
									<a href="{{$contacts['instagram']}}" target="_blank"><i class="icon icon-insta"></i></a>
									<a href="{{$contacts['pinterest']}}" target="_blank"><i class="icon icon-pinterest"></i></a>
								</div>
							</div>
                		</div>
                	</div>
		<img alt="" src="/img/up.png" class="visible-xs scroll_top">
		<div class="container">
			<div class="row">
				<!--<img class="prev slider_nav" src="img/prev.png">
                <img class="next slider_nav" src="img/next.png">-->
				<div class="footer__contact">
					<a class="contact_btn" href='/contacts'>contacts</a>
				</div>
				<div class="footer__social">
					<a href="https://www.facebook.com/" target="_blank"><i class="icon icon-fb"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="icon icon-insta"></i></a>
                    <a href="https://ru.pinterest.com/" target="_blank"><i class="icon icon-pinterest"></i></a>
				</div>
			</div>
		</div>
	</footer>
</main>

<!--[if lt IE 9]>
<script src="libs/html5shiv/dist/es5-shim.min.js"></script>
<script src="libs/html5shiv/dist/html5shiv.min.js"></script>
<script src="libs/html5shiv/dist/html5shiv-printshiv.min.js"></script>
<script src="libs/respond/dest/respond.min.js"></script>
<![endif]-->

<script src="/js/app.js"></script>
<!-- endbuild -->

</body>
</html>
