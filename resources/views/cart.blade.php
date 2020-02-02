@extends('layouts.base')


@section('content')

<div class="container main">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Фото</th>
				<th>Название книги</th>
				<th>Количество</th>
				<th>Цена</th>
				<th>Действие</th>
				
			</tr>
		</thead>
		<tbody>
			<?php $counter = session()->get('cart')?>

			@foreach($products as $product)
			<tr>
				<td><img src="{{$product->image1}}" alt=""></td>
				<td>{{$product->title}}</td>
				<td>

					@if(array_key_exists($product->id, $counter))
							
						{{$counter[$product->id]}}
					@endif
				</td>
				<td>{{$product->price}}</td>
				<td>
					<a href="{{Route('DeleteProduct',$product->id)}}" class="btn btn-danger">Удалить</a>
				</td>
				
			</tr>
			@endforeach

		</tbody>
		
	</table>
	<div class="flex">
		<?php $total = session()->get('subTotals');?>
		{{$total}} KZT
		<a href="" class="btn btn-primary red">
			Оплатить
		</a>
		<a href="{{Route('DeleteAll')}}" class="btn btn-primary ">
			Очистить корзину
		</a>
	</div>
</div>
<style>

	 .container.main{
		padding:100px 0px; 
	}
	.flex{
		display: flex;
		justify-content: flex-end;
		padding:25px 0px;
		font-size: 20px;
	}
	.flex a{
		margin-left: 20px;
	}
	td{
		width: 25%;	
	}
	td img{
		width: 100%;
		height: 300px;
	}
</style>
@endsection