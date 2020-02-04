@extends('layouts.admin')

@section('content')

    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Количество</th>
                <th>Сумма</th>
                <th>Логин пользователя</th>
                <th>Вид доставки</th>
                <th>Адрес</th>
                <th>Город</th>
                <th>Регион</th>
                <th>Почтовый индекс</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>

                <td><a href="{{route('admin.OrdersView',$order->id)}}">{{$order->id}}</a></td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->user_id}}</td>
                <td>
                    @if($order->type_of_order == 'pick_up')
                        Самовывоз
                        @else
                        Каз почта

                        @endif
                </td>
                <td>
                    {{$order->address}}
                </td>
                <td>
                    {{$order->city}}
                </td>
                <td>
                    {{$order->region}}
                </td>
                <td>
                    {{$order->index}}
                </td>

            </tr>
                @endforeach
            </tbody>

        </table>
        {{$orders->links()}}
    </div>


@endsection
