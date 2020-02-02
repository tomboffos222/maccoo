@extends('layouts.base')


@section('content')


	<table class="table table-striped">
		<thead>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				@foreach($products as $product)
				<tb>{{$product->image1}}</tb>
				@endforeach
			</tr>
		</tbody>
		
	</table>
@endsection