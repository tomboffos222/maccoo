@extends('layouts.user')


@section('content')

    <div class="flex-row">

        <div class="col-lg-12">
            <div class="card text-center text-black-50 p-t-25 p-b-25 p-l-20">
                <h4>Вывод через KASPI GOLD</h4>
                <img src="http://business-sauat.com/assets/images/1565287338h8.jpg" alt="">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card text-center text-black-50 p-t-20 p-b-20">
                <h4>Ваша сумма вывода</h4>
                <h4 class="col-blue">
                    {{$withdraw}} KZT
                </h4>



            </div>
        </div>
        <div class="col-lg-8">

        </div>
        <div class="col-lg-4">
            <div class="card text-center text-black-50 p-t-20 p-b-20">
                <h4>Коммиссия</h4>
                <h4 class="col-blue">
                    50 KZT
                </h4>



            </div>
        </div>

        <div class="col-lg-4">
            <div class="card text-center text-black-50 p-t-20 p-b-20">
                <h4>Оставшаяся сумма</h4>
                <h4 class="col-blue">
                    {{$summary - 50}} KZT
                </h4>



            </div>
        </div>
        <div class="col-lg-12">
            <div class="card text-center p-t-20 p-b-20">
                <form action="">
                    <div class="form_group"><input type="text" class="form-control" placeholder="Фамилия"></div>
                    <div class="form_group"><input type="text" class="form-control" placeholder="Имя"></div>
                    <div class="form_group"><input type="text" class="form-control" placeholder="ИИН"></div>
                    <div class="form_group"><input type="file" class="form-control" accept="application/pdf,application/vnd.ms-excel" ></div>
                    <div class="form_group">
                        <input type="radio" class="" id="form_radio" required>
                        <label for="form_radio" >
                            Я принимаю условия вывода
                        </label>
                    </div>
                    <div class="form_group"><input type="submit" class="btn btn-primary red"></div>
                </form>
            </div>
        </div>
    </div>
    <style>
        .col-lg-12 img{
            width: 250px;
            height: 250px;
        }

        .form_group{
            margin:20px;
            margin-top: 20px;
        }

    </style>
@endsection
