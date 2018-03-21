@foreach($cymbals as $key => $page)
	<div class="cat__subwrapper {{$key==$active_page-1?'active':''}}">
		@foreach($page as $item)
			<div class="cat__wrapper__item">

					<a href="/{{$type}}/{{$alias}}/set/{{$item['id']}}">
						<img src="/upload/{{$item['image']}}">
						<img alt="" src="/upload/{{$item['image2']}}">
					</a>

				<span class="price">€ {{$item['price']}}</span>
			</div>
		@endforeach
	</div>
@endforeach
