<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Cymbals;
use App\Plate;
use App;
use App\Order;
use App\Order_cart;
use App\Seo_option;
use App\Page;
use Config;
use Mail;
use App\Option;

class SiteController extends Controller
{
    public function index()
    {
        App::setLocale('en');
        return view('index')->with([
            'cart' => array_sum(session('cart', [])),
            'seo' => Seo_option::where('page_id','=',1)->where('language','=', App::getLocale(),'and')->first()->toArray(),
            'contacts' => Option::getOptions('contacts',App::getLocale())
        ]);
    }

    public function catalog(Request $request)
    {

        App::setLocale('en');
        $collections['nu'] = Collection::select('id', 'name', 'alias', 'type')->where('type', 1)->get();
        $collections['my'] = Collection::select('id', 'name', 'alias', 'type')->where('type', 2)->get();
        $collections['re'] = Collection::select('id', 'name', 'alias', 'type')->where('type', 3)->get();
        $sections = ['nu' => 1, 'my' => 2, 're' => 3];

        if (isset($request->collection)) {
            $collections_id = Collection::select('id', 'type', 'alias')->Where('alias', $request->collection)->first();
            if (!$collections_id)
                abort(404);
        } else {
            $collections_id = Collection::select('id', 'type', 'alias')->Where('type', $sections[$request->section])->first();
            return redirect()->route('catalog', [$request->section, $collections_id->alias]);

        }
        $cymbals = Cymbals::select('id', 'image', 'image2', 'price')->where('collection_id', $collections_id->id)->get()->toArray();
        $count_cymbals = count($cymbals);
        $cymbals = array_chunk($cymbals, 4);

        return view('collections/index')->with([
            'collections' => $collections,
            'type' => $request->section,
            'cymbals' => view('collections/_cymbals')->with([
                'cymbals' => $cymbals,
                'active_page' => isset($request->page) ? $request->page : 1,
                'type' => $request->section,
                'alias' => $collections_id->alias,
            ])->render(),
            'count_cymbals' => $count_cymbals,
            'collections_id' => $collections_id,
            'cart' => array_sum(session('cart', [])),
            'seo' =>Page::select()->join('seo_options', function ($join) use ($request) {
                $join->on('seo_options.page_id','=','pages.id')
                    ->where('pages.name', '=', $request->section)
                    ->where('seo_options.language', '=', App::getLocale(),'and');
            })->select('seo_options.title','seo_options.description','seo_options.keywords')
                ->first()->toArray(),
            'contacts' => Option::getOptions('contacts',App::getLocale())

        ]);
    }

    public function cymbals(Request $request)
    {
        App::setLocale('en');
        $collection = Collection::select('alias')->Where('alias', $request->collection)->first();
        if ((!$collection) & $request->section != 're')
            abort(404);
        App::setLocale('en');
        $collections['nu'] = Collection::select('id', 'name', 'alias', 'type')->where('type', 1)->get();
        $collections['my'] = Collection::select('id', 'name', 'alias', 'type')->where('type', 2)->get();
        $collections['re'] = Collection::select('id', 'name', 'alias', 'type')->where('type', 3)->get();
        $cymbals = Cymbals::getCymbalsLocalById($request->id, App::getLocale());

        if (!$cymbals)
            abort(404);
        $plates = Plate::where('cymbals_id', $request->id)->orderBy('order')->get();
        //dd($plates);
        return view('cymbals/index')->with([
            'collections' => $collections,
            'type' => $request->section,
            'collections_id' => $cymbals->collection_id,
            'cymbals' => $cymbals,
            'plates' => $plates,
            'cart' => array_sum(session('cart', [])),
            'seo'=>Seo_option::where('page_id','=',8)->where('language','=', App::getLocale(),'and')->first()->toArray(),
            'contacts' => Option::getOptions('contacts',App::getLocale())
        ]);
    }

    private function getAmount($cart)
    {
        $cymbals = Cymbals::select('id', 'price')
            ->whereIn('id', array_keys($cart))->get();
        $amount=0;
        foreach ($cymbals as $item)
        {
            $amount+=$cart[$item->id]*$item->price;
        }

        return $amount;
    }

    public function buy(Request $request)
    {
        $cart = session('cart', []);
        if (array_key_exists($request->id, $cart))
            $cart[$request->id]++;
        else
            $cart[$request->id] = 1;

        session(['cart' => $cart]);
        return json_encode(['cart'=>array_sum(session('cart', [])),'quantity'=>$cart[$request->id],'amount'=>$this->getAmount($cart)]);
    }

    public function buyAbort(Request $request)
    {
        $cart = session('cart', []);
        if (array_key_exists($request->id, $cart))
        {
            $count = $cart[$request->id]--;
            if($cart[$request->id]==0)
                unset($cart[$request->id]);

            session(['cart' => $cart]);
            //return array_sum(session('cart', []));
            return json_encode(['cart'=>array_sum(session('cart', [])),'quantity'=>$count,'amount'=>$this->getAmount($cart)]);

        }
        return json_encode(['cart'=>array_sum(session('cart', [])),'quantity'=>0,'amount'=>$this->getAmount($cart)]);
    }

    public function buyAbortAll(Request $request)
    {
        $cart = session('cart', []);
        if (array_key_exists($request->id, $cart))
        {
            unset($cart[$request->id]);
            session(['cart' => $cart]);
            return json_encode(['cart'=>array_sum(session('cart', [])),'quantity'=>0,'amount'=>$this->getAmount($cart)]);
        }
        return false;
    }

    public function cart()
    {
        App::setLocale('en');
        $cart = session('cart', []);
        if(!array_sum($cart))
            return view('cart')->with([
                'message' => 'The cart is empty<br>But it\'s never too late to improve it',
                'cart' => array_sum(session('cart', [])),
                'options' => Option::getOptions('options',App::getLocale())
            ]);

        $cymbals = Cymbals::select('cymbals.id', 'cymbals.image', 'cymbals.price', 'collections.name')
            ->whereIn('cymbals.id', array_keys($cart))
            ->join('collections', 'cymbals.collection_id', '=', 'collections.id')
            ->orderByRaw('FIELD(cymbals.id, ' . implode(",", array_keys($cart)) . ')')
            ->get();
        $amount = 0;
        foreach ($cymbals as $item) {
            $item->count = $cart[$item->id];
            $plates = Plate::select('image')
                ->where('cymbals_id', $item->id)
                ->limit(4)
                ->orderBy('order')
                ->get()->toArray();
            foreach ($plates as $key => $plate)
                $item->plates[$key] = $plate['image'];
            $amount += $item->count * $item->price;
        }
        return view('cart')->with([
            'cymbals' => $cymbals->toArray(),
            'amount' => $amount,
            'cart' => array_sum(session('cart', [])),
            'options' => Option::getOptions('options',App::getLocale())
        ]);
    }

    public function order(Request $request)
    { //dd(json_encode(['tyt'=>'tyt']));
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $filds = $request->input();
        $cart = session('cart', []);
        $filds['amount'] = $this->getAmount($cart);
        $order = Order::create($filds);

        foreach ($cart as $key=>$item)
        {
            Order_cart::create(['order_id'=>$order->id,'cymbals_id'=>$key,'quantity' => $item]);
        }
        session(['cart' => []]);
        $this->sendMail($order);
        return view('cart')->with([
            'message' => 'Thank you. Your order is accepted. Our manager will contact you soon',
            'cart' => array_sum(session('cart', []))
        ]);

    }

    private function sendMail($order)
    {
        $email['from'] = Config::get('mail.home');
        $email['to'] = Config::get('mail.admin');
        Mail::send('emails.send_order', ['order'=>$order,'cart'=>Order_cart::where('order_id','=',$order->id)
        ->select('cymbals.vendor_code','order_cart.quantity','cymbals.price')
        ->join('cymbals', 'cymbals.id', '=', 'order_cart.id')
        ->get()], function ($u) use ($email) {
            $u->from($email['from']);
            $u->to($email['to']);
            $u->subject('Новый заказ');
        });
    }

    public function who()
    {
        App::setLocale('en');
        return view('who')->with([
            'seo'=>Seo_option::where('page_id','=',5)->where('language','=', App::getLocale(),'and')->first()->toArray(),
        ]);
    }

    public function how()
    {
        App::setLocale('en');
        return view('how')->with([
            'seo'=>Seo_option::where('page_id','=',6)->where('language','=', App::getLocale(),'and')->first()->toArray(),
        ]);
    }

    /*public function test()
    {
        $order = Order::find(1);
        return view('emails/send_order')->with([
            'order'=>$order,
            'cart'=>Order_cart::where('order_id','=',$order->id)
                ->select('cymbals.vendor_code','order_cart.quantity','cymbals.price')
                ->join('cymbals', 'cymbals.id', '=', 'order_cart.id')
                ->get()
        ]);
    }*/
}
