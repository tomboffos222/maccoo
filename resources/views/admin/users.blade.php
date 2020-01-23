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
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
