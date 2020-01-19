@extends('layouts.base')

@section('content')
    <div class="container">
       <div class="row">

           <form class="col-md-4 col-md-offset-4" action="{{route("Register")}}" method="post">
               <h2>Регистрация</h2>
               {{csrf_field()}}
               <div class="form-group">
                   <label for="bs_id">Введите ваш ID</label>
                   <input class="form-control" placeholder="Например 123456" type="text" required id="bs_id" name="bs_id">
               </div>
               <div class="form-group">
                   <label for="login">Введите ваш Login</label>
                   <input class="form-control" placeholder="" type="text" required id="login" name="login">
               </div>
               <div class="form-group">
                   <label for="name">Введите ваше ФИО</label>
                   <input class="form-control" placeholder="Например Кайрат Нуртас" type="text" required id="name" name="name">
               </div>
               <div class="form-group">
                   <label for="email">Введите ваш Email</label>
                   <input class="form-control" type="email" required id="email" name="email">
               </div>
               <div class="form-group">
                   <label for="phone">Введите ваш Телефон номер</label>
                   <input class="form-control" type="number" required id="phone" name="phone">
               </div>
               <div class="form-group">
                   <p>Выберите</p>
                   <div>
                       <input type="radio" id="home" name="prize" value="home">
                       <label for="home">Дом</label>

                       <input type="radio" id="car" name="prize" value="car">
                       <label for="car">Автомобиль</label>

                       <input type="radio" id="tech" name="prize" value="tech">
                       <label for="tech">Спецтехника</label>
                   </div>
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
