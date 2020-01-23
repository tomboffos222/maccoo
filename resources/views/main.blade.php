@extends('layouts.user')


@section('content')
    <div class="level bg-primary-gradient col-md-3">
        <p>Ваш уровень : </p> <b> {{$tree->level}}</b>

    </div>
    <div class="level green col-md-3">
        <p>Ваш счет : </p><b>{{$user->bill}} kzt</b>
    </div>
    <div class="level red col-md-3">
        <p>Люди приглашены :</p><b> 3 </b>
    </div>
    <div class="level purple col-md-3">
        <p>Ваши боты : </p><b> 2 </b>
    </div>
    <div class=""></div>



    <style>
        
    </style>
@endsection
