@extends('layouts.admin')


@section('content')
    @if ($user->parent_id)
        <p><a class="btn btn-primary" href="{{route('admin.Tree',$user->parent_id)}}">Дерева Лидера</a></p>
    @endif

    <div style="overflow: auto;padding-bottom: 50px">
        <div class="children">
            @component('admin.treeUser',['user'=>$user,'maxColumnCount'=>5,'i'=>0])

            @endcomponent
        </div>
    </div>

    <style>
        .tree{
            border-bottom: 1px solid rgba(67, 67, 67, 0.77);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 0 10px;
            min-width: 150px;
            height: 80px;
        }
        .tree span{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 15px;
            height: 15px;
            background: #11ff0f;
            border-radius: 50%;
            color: #000;
            font-size: 10px;
            position: relative;
            right: -15px;
            top: 10px;
        }


        .children{
            display: flex;
        }
        .line{
            margin: 0   auto;
        }


    </style>


@endsection
@section('scripts')


    <script>
        function GetInfo(json) {
            let obj = JSON.parse(json);
            document.getElementById('GetInfo').innerHTML =
                `
             <div class="col-md-6">
                <h3>О пользователе:</h3>
                 <p><b>Индекс (3 курс) :</b> ${obj.three_id}</p>
                 <p><b>Ряд :</b> ${obj.three_row}</p>
                 <p><b>Уровень :</b> ${obj.three_level}</p>
                 <p><b>Дата регистрации (3 курс) :</b> ${obj.three_date}</p>
                 <p><b>ID пользователя :</b> ${obj.id}</p>
                 <p><b>ФИО :</b> ${obj.name}</p>
                 <p><b>Логин :</b> ${obj.username}</p>
                 <p><b>Телефон номер :</b> ${obj.phone}</p>
                 <p><b>Консультант:</b> ${obj.three_referBy}</p>
                 <p><a class="btn btn-primary" href="http://business-sauat.com/admin/user-details/${obj.id}" target="_blank">Открыть профил</a></p>
             </div>
          `

        }

    </script>


@endsection
