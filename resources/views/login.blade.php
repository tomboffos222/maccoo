@extends('layouts.base')

@section('content')
    <div class="container">
       <div class="row">

           <form class="col-md-4 col-md-offset-4" action="{{route("Login")}}" method="post">
               <h2>Вход в систему</h2>
               {{csrf_field()}}
               <div class="form-group">
                   <label for="login">Введите ваш Id</label>
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
    <style>
      form{
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
        padding:20px 10px;
        margin-bottom: 40px;
      }
      input{
        box-shadow: 0 0 2px rgba(0,0,0,0.5) !important;
        border:1px solid #000;
        padding:10px 10px !important;
      }
    </style>
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
