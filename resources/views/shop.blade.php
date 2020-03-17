@extends('layouts.base')


@section('content')
    <link rel="shortcut icon" href="http://static.hommes.kz/s/favicon.png?v=1" type="image/png">


    <meta property="fb:app_id" content="1504499143206143">




    <link rel="stylesheet" href="http://static.hommes.kz/s/_compress/lightbox/css/lightbox.css?232cea54">
    <link rel="stylesheet" href="http://static.hommes.kz/s/_compress/css/style.css?7776954f">
    <link rel="stylesheet" href="{{asset('assets/css/tovary.css')}}">

    <div class="container">

        <div id="messages" >
            <form id="search_form" method="get" action="{{route('SearchProduct')}}">
                <input name="search" class="search" type="text" placeholder="Поиск" autocomplete="off" style="border:1px solid #000;">
                <span class="glyphicon glyphicon-search" onclick="document.getElementById('search_form').submit();"></span>
            </form>
        </div>


        <div class="" style="font-size: 25px;">

            <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
        </div>

        <div class="">
            <div class="col-md-12 col-xs-12 left-block">
                <h1>STORE</h1>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb"><li><a href="/">Главная</a></li>/<li class="active">HOMMES STORE</li></ul>
                    </div>
                    @foreach($products as $product)
                    <div class="col-md-4 col-xs-12 col-sm-6 product">
                        <a href="{{route('Product',$product->id)}}" title="{{$product->description}}">
                            <img class="img-responsive" alt="" style="height: 200px;width: 100%;" src="{!! $product->img !!}">
                        </a>
                        <div class="info">
                            <h3><a href="{{route('Product',$product->id)}}" title="">

                                    @php
                                        echo mb_strimwidth($product['title'],0,60,'...');
                                    @endphp

                                </a></h3>

                            <span class="price">

                            <span class="amount">{{$product->price}}</span>

                            <span class="currency"> ₸</span>
                        </span>
                            <p></p>
                            <button class="btn btn-default my-cart-btn" data-id="{{$product->id}}" data-id_real="{{$product->id}}" data-name="{{$product->title}}" data-summary="{{$product->price}}" data-price="{{$product->price}}" data-quantity="1" data-image="{!! $product->img !!}">В корзину</button>
                            <!--                         <a  href="/catalog/2-kofe-almaty-bleck/" title="Заказать Кофе Almaty Blэck 80% арабика и 20% робуста" class="btn btn-default">Заказать</a>-->
                        </div>


                    </div>
                    @endforeach





                   <div class="col-12">
                       {{$products->links()}}
                   </div>
                    <script src="http://static.hommes.kz/s/_compress/js/style.js?9fba8d3d"></script>

                    <script src="{{asset('assets/js/card.js')}}"></script>
                </div>
            </div>
        </div>

    </div>
<style>
    .pagination > .active > span{
        z-index: 3;
        color: #fff;
        cursor: default;
        background-color: #000;
        border-color: #000;
    }
    .pagination > li > a{
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #000;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
	.shopping_book{
		padding:50px 0px;
	}
	.booker .book{
		text-align: left !important;
	}
	.booker .book h1{
		    font-size: 18px;
    margin-top: 0;
    font-weight: 400;
    margin-bottom: 10px;
    font-family: Merriweather,serif;
    text-transform: capitalize;
	}
    .product img{
        height: 300px !important;
    }
	.book{
		padding:0px !important;
	}



</style>

@endsection
