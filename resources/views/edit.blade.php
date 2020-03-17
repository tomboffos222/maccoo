@extends('layouts.user')

@section('content')
	<form action="{{route('EditUser')}}" class="" method="get">
		<div class="">
			<input type="hidden" name="id" value="{{$user->id}}">
			<label for="email" class="">Ваша почта</label>
			<input type="text" class="form-control" name="email" placeholder="Ваша почта" value="{{$user->email}}">


		</div>

		<div class="">
			<label for="email" class="">Ваше ФИО</label>
			<input type="text" class="form-control" name="name" placeholder="Ваша почта" value="{{$user->name}}">


		</div>
		<div class="">
			<label for="email" class="">Ваш телефон</label>
			<input type="text" class="form-control" name="phone" placeholder="Ваша почта" value="{{$user->phone}}">


		</div>
		<div class="">
			<label for="email" class="">Ваш пароль</label>
			<input type="text" class="form-control" name="password" placeholder="Ваша почта" value="{{$user-> password}}">


		</div>
		<div class="" style="margin-top:20px;">
			<input type="submit" class="btn red ">
		</div>

	</form>
	<style>
		form{
			width: 50%;
			margin:0 auto;
		}
		.btn{
			color:#fff;
			transition: .5s ease;
		}

	</style>

@endsection
