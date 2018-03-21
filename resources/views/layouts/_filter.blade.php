<div class="cat__filter">
	<ul class="filter">
		<li class="filter__item filter__item_nu" data-type="1">
			<a href="/nu">
				<div class="brand_nu">
					nu
				</div>
			</a>
			<ul class="subfilter" {!! $type=='nu'?'style="display: block"':'' !!}>
				@foreach($collections['nu'] as $item)
					<li class="subfilter__item {!! $item->id==$collections_id?'active':'' !!}"
						data-type="{{$item->id}}">
						<a href="/nu/{{$item->alias}}">
							{{$item->name}}
						</a>
					</li>
				@endforeach
			</ul>
		</li>
		<li class="filter__item filter__item_my" data-type="2">
			<a href="/my">
				<div class="brand_my">
					my
				</div>
			</a>
			<ul class="subfilter" {!! $type=='my'?'style="display: block"':'' !!}>
				@foreach($collections['my'] as $item)
					<li class="subfilter__item {!! $item->id==$collections_id?'active':'' !!}"
						data-type="{{$item->id}}">
						<a href="/my/{{$item->alias}}">
							{{$item->name}}
						</a>
					</li>
				@endforeach
			</ul>
		</li>
		<li class="filter__item filter__item_re" data-type="3">
			<a href="/re">
				<div class="brand_re">
					re
				</div>
			</a>
		</li>
	</ul>
</div>
