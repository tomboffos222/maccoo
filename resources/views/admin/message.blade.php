@extends('layouts.admin')



@section('content')

	@foreach($messages as $message)
		
		<div class="card">
			<h4>Автор: {{$message->author}}</h4>

			<p>Сообщение: {{$message->question}}</p>
			<button class="btn btn-primary" data-toggle="modal" data-target= "#exampleModal">Ответить</button>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Ответ тех поддержке</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form action="{{route('admin.MessageAnswer')}}" method="get">
			        	<input type="hidden" name="message_id" value="{{$message->id}}">
			        	<textarea name="answer" class="form-control" placeholder="Ваш ответ" id="" cols="30" rows="10"></textarea>

			        	<input type="submit" class="btn btn-primary red" style="margin-top:20px;">
			        </form>
			      </div>
			      <div class="modal-footer">
			       
			       
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		

	@endforeach

	{{$messages->links()}}
	<style>
		.card{
			padding:20px;	
		}
	</style>
@endsection