@extends('layouts.admin')


@section('content')


    <table class="table-striped">

        <tr>
            <td>фото</td>
            <td>название</td>
            <td>действие</td>
        </tr>

        <tbody>
        @foreach($articles as $article)
        <tr>
            <td><img src="{!! $article->path !!}" alt=""></td>
            <td>{{$article->title}}</td>
            <td>
                <a href="{{route('admin.ViewPost',$article->id)}}" class="btn btn-primary">Редактировать</a>
                <a href="{{route('admin.DeletePost',$article->id)}} " class="btn btn-danger">Удалить</a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
    <style>
        table img{
            width: 250px;
            height: 150px;


        }

        td{
            padding: 10px 10px;
        }
    </style>

    @endsection
