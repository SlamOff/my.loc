<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!-- build:css css/combined.css -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <!-- endbuild -->
	<title>{{$seo['title']}}</title>
	<meta name="description" content="{{$seo['description']}}">
	<meta name="keywords" content="{{$seo['keywords']}}">
</head>
<body class="main_page">
		<div class="menu">
            <div class="container">
                <div class="row">
                    <div class="menu__header">
                        <a class="hidden-xs" href='/'><img src="img/logo2.png" alt="Masha Yakush"></a>
                        <a class="visible-xs" href='/'><img src="img/logo2_m.png" alt="Masha Yakush"></a>
                        <img class="close" src="img/close.png" alt="">
                    </div>
                    <div class="menu__content">
                        <ul>
                            <li class="nu_filter"><a href='/nu'>nu</a></li>
                            <li class="my_filter"><a href='/my'>my</a></li>
                            <li class="re_filter"><a href='/re'>re</a></li>
                            <li><a href='who'>who we are</a></li>
                            <li><a href='how'>how it is created</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <main class="main">
        <header class="header">
            <div class="container">
                <div class="row">
                    <a href="/"><div class="header__logo">
                    	<img src="/img/logo_large.svg" class="hidden-xs logo_large" alt="Masha Yakush">
                    	<img src="/img/logo_small.svg" class="visible-xs logo_small" alt="Masha Yakush">
                    </div></a>
                    <div class="header__right">
						<a href='/cart'>
							<div class="header__cart {{$cart?'active_cart':''}}">cart{{$cart?'('.$cart.')':''}}</div>
						</a>
                        <button class="header__btn"><img src="img/header_btn.png" alt=""></button>
                    </div>
                </div>
            </div>
        </header>
		<a href="who">
			<div class="nav_left">
				<span>who we are</span>
			</div>
		</a>
		<a href='how'>
			<div class="nav_right">
				<span>how it is created</span>
			</div>
		</a>
        <div id="main_slider">
        	<div class="slider_item">
				<a href="/my/pacific_ocean"><img class="main__pict" src="img/main_my.png" alt=""></a>
				<div class="container container--abs">
					<div class="row">
						<div class="main__desc">
							<div class="brand_my active">
								my
							</div>
							<br>
							<span>tableware with author's drawings</span>
						</div>
					</div>
				</div>
			</div>
			<div class="slider_item">
           		<a href="/nu/first_nu"><img class="main__pict" src="img/main_nu.png" alt=""></a>
            	<div class="container container--abs">
            		<div class="row">
            			<div class="main__desc">
            				<div class="brand_nu active">
            					nu
            				</div>
            				<br>
            				<span>classic tableware</span>
            			</div>
            		</div>
            	</div>
           	</div>
        </div>

        <footer class="footer">
        	<a class="contact_btn visible-xs" href='/contacts'>contacts</a>
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
            <div class="container">
                <div class="row">
                	<i class="prev slider_nav icon-arrow_left icon"></i>
                	<i class="next slider_nav icon-arrow_right icon"></i>
                	<div class="flex-container">
						<div class="footer__contact">
							<a class="contact_btn" href='/contacts'>contacts</a>
						</div>
						<div class="footer__social">
							<a href="{{$contacts['facebook']}}" target="_blank"><i class="icon icon-fb"></i></a>
                            <a href="{{$contacts['instagram']}}" target="_blank"><i class="icon icon-insta"></i></a>
                            <a href="{{$contacts['pinterest']}}" target="_blank"><i class="icon icon-pinterest"></i></a>
						</div>
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
