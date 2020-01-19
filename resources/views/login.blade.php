@extends('layouts.base')

@section('content')
    <div class="container">
       <div class="row">

           <form class="col-md-4 col-md-offset-4" action="{{route("Login")}}" method="post">
               <h2>Логин</h2>
               {{csrf_field()}}
               <div class="form-group">
                   <label for="login">Введите ваш Login</label>
                   <input class="form-control" placeholder="" type="text" required id="login" name="login">
               </div>
               <div class="form-group">
                   <label for="password">Пароль</label>
                   <input class="form-control" type="password" required id="password" name="password">
               </div>
               <div>
                    <button class="btn btn-primary">Отправить</button>
               </div>
           </form>
       </div>
    </div>
@endsection

@push('cs')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endpush
