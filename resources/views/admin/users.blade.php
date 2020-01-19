@extends('layouts.admin')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>ФИО</th>
            <th>Логин</th>
            <th>Телефон номер</th>
            <th>email</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->bs_id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->login}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_{{$user->id}}">зарегистрировать</button>
                    <!-- Modal -->
                    <div id="modal_{{$user->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <form action="{{route('admin.RegisterUser')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Введите пароль для {{$user->name}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="password" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Зарегистрировать</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <a href="{{route('admin.RejectUser',$user->id)}}" class="btn btn-danger">Отклонить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
