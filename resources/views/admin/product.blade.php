@extends('layouts.admin')


@section('content')
	<table class="table table-striped">
		<thead>
			<tr>
				<th>
					фото
				</th>
				<th>
					Имя
				</th>
				<th>
					Цена
				</th>
				<th>
					Характеристики
				</th>
				
				<th>
					Статус
				</th>
				<th>
					Автор
				</th>
				<th>
					Действия
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($products as $product)
				<tr>
					<td>
						<img src="{{$product->image1}}" alt="">
					</td>
					<td>
						{{$product->title}}
					</td>
					<td>
						{{$product->price}}

					</td>
					<td>
						{{$product->chars}}
					</td>
					<td>
						@if($product->status  == 1)
							В наличии
						@else
							Нет в наличии
						@endif

					</td>
					<td>
						{{$product->author}}
					</td>


					
				</tr>

			@endforeach
			
		</tbody>

		
	</table>
	{{$products->links()}}
	<style>
		td img{
			
			height: 150px;
			width: 100%;
		}
		td{
			width: 12%;
		}

	</style>

@endsection