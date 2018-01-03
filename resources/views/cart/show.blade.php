@extends('layouts.app')

@section('content')
   <h1>Carrito</h1>
    @if(count($cart) > 0)
    	<div class="table-responsive">
	   	<table class="table table-striped table-hover rable-bordered">
	   		<thead>
	   			<tr>
	   				<th>Imagen</th>
	   				<th>Producto</th>
	   				<th>Precio</th>
	   				<th>Cantidad</th>
	   				<th>Subtotal</th>
	   				<th>Quitar</th>
	   			</tr>
	   		</thead>
	   		<tbody>
	   		@foreach($cart as $item)
	   			<tr>
	   				<td><img src="{{$item->image}}" width="100"></td>
	   				<td>{{$item->name}} </td>
	   				<td>{{ number_format($item->price,2)}} </td>
	   				<td>{{ $item->quantity}}</td>
	   				<td>{{number_format($item->quantity * $item->price,2)}}</td>
	   				<td>
	   					<a href="{{route('cart-delete',$item->slug)}} " class="btn btn-danger"><i class="fa fa-remove"></i> </a>
	   				</td>
	   			</tr>
	   		@endforeach	
	   		  	<tr>
	   		  		<td colspan="6"><h3>Total: ${{ number_format($total, 2) }}</h3></td>
	   		  	</tr>		
	   		</tbody>
	   	</table>
  	</div>
  	<div class="row">
  		<div class="col-md-6">
  			<a href="{{route('payment')}}" class="btn btn-primary">Pagar con <i class="fa fa-paypal"></i> </a>
  		</div>
  	</div> 
  	@else 
  		<h2><span class="label label-success">No tiene productos en su carrito</span></h2>
    @endif
  	
@endsection