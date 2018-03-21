<span>Имя : {{$order->name}}</span><br>
<span>Телефон : {{$order->phone}}</span><br>
<span>Email : {{$order->email}}</span><br>
<span>Тип доставки : {{$order->delivery}}</span><br>
<span>Адрес : {{$order->address}}</span><br>
<span>Комментарий : {{$order->comment}}</span><br>
<ul>
@foreach($cart as $item)
		<li>
			<span>Артикул : {{$item->vendor_code}}</span><br>
			<span>Количество : {{$item->quantity}}</span><br>
			<span>Цена за штуку : {{$item->price}}</span><br>
			<span>Общая : {{$item->quantity*$item->price}}</span>
		</li>
@endforeach
</ul>
<span>Всего : {{$order->amount}}</span>
