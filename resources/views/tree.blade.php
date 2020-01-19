@extends('layouts.user')


@section('content')
    <div style="overflow: auto;padding-bottom: 50px">
        <div class="children">
            @component('treeUser',['user'=>$user,'maxColumnCount'=>5,'i'=>0])

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
