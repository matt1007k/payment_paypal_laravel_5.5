<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
    	if (!\Session::has('cart')) \Session::put('cart', array());
    }

    public function show()
    {
    	$cart = \Session::get('cart');
    	$total = $this->total();
    	return view('cart.show',['cart' => $cart,'total' => $total]);
    }
    public function add(Product $product)
    {
    	$cart = \Session::get('cart');
    	$product->quantity = 1;
    	$cart[$product->slug] = $product;
    	\Session::put('cart', $cart);

    	return redirect()->route('cart-show');
    }
    public function delete(Product $product)
    {
    	$cart = \Session::get('cart');
    	unset($cart[$product->slug]);
    	\Session::put('cart', $cart);
    	return redirect()->route('cart-show');
    }
    public function total()
    {
    	$cart = \Session::get('cart');
    	$total = 0;
    	foreach ($cart as $item) {
    		$total += $item->price * $item->quantity;
    	}

    	return $total;
    }
}
