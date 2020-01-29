@extends('layouts.user')


@section('content')

	<form action="{{route('MessageSend')}}" method="get">
		<label for="question" >Вопрос тех поддержке</label>
		<input type="hidden" name="author" value="{{$user->login}}">
		<textarea name="question" class="form-control" id="question" cols="30" rows="10"></textarea>
		<input type="submit" class="btn  red" style="margin-top:40px;color:#fff;">
	</form>
	<div class="answer_sheet">
		
		@foreach($messages as $message)

			<div class="card">

				<p><b>Ваш вопрос : </b> {{$message->question}}</p>
				<p><b>Ответ тех поддержки : </b> {{$message->answer}}</p>
			</div>
		@endforeach
		{{$messages->links()}}
	</div>
	<style>
		label{
			font-size: 24px;
		}
		textarea{
			font-size: 24px;
		}
		.answer_sheet{
			position: relative;
			top:50px;
		}
		.answer_sheet .card{
			padding:20px;
		}
	</style>
	

@endsection
