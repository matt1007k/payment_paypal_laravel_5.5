@extends('layouts.app')

@section('content')
   <h1>Listado de productos</h1>
    <div class="productos">
	   	@foreach($products as $product) 
	   		<h3>{{$product->name}} </h3>
	   		<img src="{{ $product->image }}" width="300" alt="{{$product->name}} ">
	   		<h3><span class="label label-success">Precio: ${{ number_format($product->price, 2)}} </span></h3>
	   		<p>
	   			<a href="{{ route('cart-add',$product->slug) }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> ADD CART</a>
	   		</p>
	  	@endforeach
  	</div>   
@endsection