@extends('layouts.user')


@section('content')
    <div class="level col-md-2">
        <p>Ваш уревен : </p> <b> {{$tree->level}}</b>
    </div>




    <style>
        .level{
            background-color: #00adff;
            color: #fff;
            font-size: 20px;
            display: flex;
            padding: 15px;
        }
        .level b{
            margin-left: 5px;
        }
    </style>
@endsection
