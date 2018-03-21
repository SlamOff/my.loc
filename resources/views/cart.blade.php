<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Masha Yakush</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<!-- build:css css/combined.css -->
	<meta id="csrf" name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
	<!-- endbuild -->
</head>
<body class="form_page">
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
				<a href="/">
					<div class="header__logo">
						<img src="/img/logo_large.svg" class="hidden-xs logo_large" alt="Masha Yakush">
                        <img src="/img/logo_small.svg" class="visible-xs logo_small" alt="Masha Yakush">
					</div>
				</a>
				<div class="header__return">
					<a href="/my/pacific_ocean">continue shopping</a>
				</div>
				<div class="header__right">
					<a href='/cart'>
						<div class="header__cart {{$cart?'active_cart':''}}">cart{{$cart?'('.$cart.')':''}}</div>
					</a>
					<button class="header__btn"><img src="img/header_btn.png" alt=""></button>
				</div>
			</div>
		</div>
	</header>
	<div class="container">
		@if(isset($message))
			<span class="message">{!! $message !!}</span>
		@else
			<p>Contact details</p>
			<div class="form_wrapper">
				<form action="/order" id="form" method="POST">
					<fieldset>
						<label>
							<span class="error"></span>
							<input class="required" pattern="^[a-zA-Z]+$" type="text" name="name" placeholder="Name">
						</label>
						<label>
							<span class="error"></span>
							<input class="required" type="tel" minlength="16" id="phone" name="phone" placeholder="Phone number">
						</label>
						<label>
							<span class="error"></span>
							<input class="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="email"
							   placeholder="E-mail">
						</label>
					</fieldset>
					<fieldset>
						<label>
							<span class="error"></span>
							<img class="down" alt="" src="/img/down.png">
							<select class="required" name="delivery">
								<option disabled selected value>Delivery Method</option>
								<option value="Self-delivery">Self-delivery</option>
								<option value="NOVA POSHTA">NOVA POSHTA</option>
								<option value="Express delivery">Express delivery</option>
							</select>
						</label>
						<label>
							<span class="error"></span>
							<input class="required" type="text" name="address" placeholder="Address / NOVA POSHTA department">
						</label>
					</fieldset>
					<textarea placeholder="Comments" name="comment"></textarea>
					{{ csrf_field() }}

				</form>
				<div class="cart_info">
					<p>* Delivery is paid separately.</p>

					<p>The cost of delivery in Kiev will be <span
							class="delivery_price"> ₴ {{$options['delivery']}}</span>.</p>

					<p>Delivery by NOVA POSHTA is paid <br/>according to the tariffs of the company.</p>
				</div>
			</div>
			<div class="order">
				@foreach($cymbals as $item)
					<div class="order__item">
						<a class="buy close_item" href="/buy_abort_all/cymbals/{{$item['id']}}">
							<i class="icon icon-x"></i>
						</a>
						<div class="order__pict">
							@if(isset($item['plates']))
								@foreach($item['plates'] as $plate)
									<img alt="" src="/upload/{{$plate}}">
								@endforeach
							@else
								<img alt="" src="/upload/{{$item['image']}}">
							@endif
						</div>


						<div class="order__pict order__pict_mobile">
							<img alt="" src="/upload/{{$item['image']}}">
						</div>
						<div class="order__info">
							<p>{{$item['name']}}</p>
							<p>qt.
								<a class="buy" href="/buy_abort/cymbals/{{$item['id']}}">

									<i class="minus icon icon-minus"></i>
								</a>
								<span>{{$item['count']}}</span>
								<a class="buy" href="/buy/cymbals/{{$item['id']}}">

									<i class="plus icon icon-plus"></i>
								</a>
							</p>
							<p>€ {{$item['price']}}</p>
						</div>
					</div>
				@endforeach
			</div>
			<div class="form_submit">
				<button type="submit" form="form" class="main_btn">send</button>
				<p class="total">
					Delivery <span class="delivery_price">₴ {{$options['delivery']}}</span><br/>
					Total: <span class="total_price">€ {{$amount}}</span>
				</p>

			</div>
		@endif
	</div>
</main>
<!--[if lt IE 9]>
<script src="libs/html5shiv/dist/es5-shim.min.js"></script>
<script src="libs/html5shiv/dist/html5shiv.min.js"></script>
<script src="libs/html5shiv/dist/html5shiv-printshiv.min.js"></script>
<script src="libs/respond/dest/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="/js/app.js"></script>-->
<!--<script src="/js/script.js"></script>-->
<!-- endbuild -->

</body>
</html>
