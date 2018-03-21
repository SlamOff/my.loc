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
	<div class="how">
		<div class="nav_right">
    		<span>how it is created</span>
    	</div>
    	<hr />
        <div class="container">
             <div class="row">
                 <div class="how__header">
                     <a class="hidden-xs" href='/'><img src="img/logo2.png" alt="Masha Yakush"></a>
                     <a class="visible-xs" href='/'><img src="img/logo2_m.png" alt="Masha Yakush"></a>
                     <a href='/'><img class="close" src="img/close.png" alt=""></a>
                 </div>
                 <div class="how__content">
                     <div class="video_wrapper">
                         <video controls src="/img/main.mp4"></video>
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
