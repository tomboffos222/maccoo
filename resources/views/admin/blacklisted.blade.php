@extends('layouts.admin')

@section('content')
    <form action="{{route('admin.AddBlackList')}}">
        <label for="">
            Добавит  в черный список
        </label> <br>
        <input type="number" placeholder="ИИН" name="zhsn" class=""> <input type="submit" class="btn btn-primary red">
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>
                ЖСН
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($zhsns as $zhsn)
            <tr>
               <td>{{$zhsn->zhsn}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <style>
       
    </style>

@endsection
