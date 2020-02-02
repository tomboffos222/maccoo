@extends('layouts.admin')



@section('content')


	<div class="container">
		
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Статус</th>
							<th>Количества</th>
							<th>Пользователь</th>
							<th>Дата заявки</th>
						</tr>
					</thead>
					<tbody>
						@foreach($withdraws as $withdraw)
						<tr>
							
							<td>
								@if($withdraw->withdraw_status == 'sent')
								 В ожиданий
								@elseif($withdraw->withdraw_status == 'allowed')
								 Одобрено
								@else
								 Отказано	
								@endif
							</td>
							<td>{{$withdraw->amount}}</td>
							<td>ID: {{$withdraw->login}}</td>
							<td>{{$withdraw->created_at}}</td>

							<td>
								@if($withdraw->withdraw_status == 'sent')
								 <a href="{{route('admin.WithdrawAllow',$withdraw->id)}}" class="btn btn-primary">Одобрить</a> <a href="{{route('admin.WithdrawReject',$withdraw->id)}}" class="btn btn-danger">Отклонить</a>
								@elseif($withdraw->withdraw_status == 'allowed')
									{{$withdraw->updated_at}}
								@else
									{{$withdraw->updated_at}}
								@endif
								
							</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>	
	</div>

@endsection