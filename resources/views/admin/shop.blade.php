@extends('layouts.admin')



@section('content')

	<div class="flex">
		
		<button class="categoryButton">Категории</button><button class="authors">Авторы</button>
	</div>
	<div class="categories tablet">
		<table class="table table-striped ">
			<thead>
				<tr>
					<th>ID</th>
					<th>Категории</th>
					<th>Действия</th>
				</tr>
			</thead>
			<tbody>
				@foreach($categories as $category)
				<tr>
					<td>{{$category->id}}</td>
					<td>{{$category->chars}}</td>
					<td></td>
				</tr>
				@endforeach
			</tbody>
	
		</table>
		{{$categories->links()}}
	</div>
	<div class="author tablet">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Фото</th>
					<th>Имя</th>

					<th>Год рождения</th>
					<th>Пол</th>
					<th>Книг выпущенно</th>
					<th>Адрес</th>
					<th>Действие</th>

				</tr>

			</thead>
			<tbody>

				@foreach($authors as $author)
				<tr>

					<td><img src="{{$author->image1}}" alt=""></td>
					<td>{{$author->Name}}</td>
					<td>{{$author->Birth}}</td>
					<td>{{$author->gender}}</td>
					<td>{{$author->Books}}</td>
					<td>{{$author->Address}}</td>
					<td></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$authors->links()}}
	</div>

	<style>
		td img{
			width: 100%;
			height: 100px;	
		}
		.author td{
			width: 15%;

		}
		.flex{
			display: flex;
			justify-content: space-around;
			margin-bottom: 20px;

		}
		.flex button{
			display: block;
			width: 150px;
			height: 50px;
			background-color: #F44336;
			border:none;
			color:#fff;
			font-weight: 700;
			cursor: pointer;
			transition: .5s ease;

		}
		.flex button:hover{
			background-color: blue;
		}

	</style>
@endsection