@extends('layouts.base')



@section('content')
    <link rel="shortcut icon" href="http://static.hommes.kz/s/favicon.png?v=1" type="image/png">


    <meta property="fb:app_id" content="1504499143206143">




    <link rel="stylesheet" href="http://static.hommes.kz/s/_compress/lightbox/css/lightbox.css?232cea54">
    <link rel="stylesheet" href="http://static.hommes.kz/s/_compress/css/style.css?7776954f">
    <link rel="stylesheet" href="{{asset('assets/css/tovary.css')}}">

    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="font-size: 25px;">
                <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
            </div>

            <div class="col-md-8 col-xs-12 left-block">
                <ul class="breadcrumb"><li><a href="/">Главная</a></li><li><a href="{{route('shop')}}"> STORE</a></li><li class="active">{{$product->title}}</li></ul>
                <div class="col-sm-12">
                    <h1>{{$product->title}}</h1>
                </div>
                <div class="col-sm-12">
                    <div class="product-slider">

                        <img src="{!! $product->img !!}" alt="" class="img-responsive m-b-25" style="height: 600px;width: 100%;">


                    </div>
                </div>
                <div class="col-sm-12">
                    <h3>Цена:&nbsp;{{$product->price}}&nbsp;₸&nbsp;



                        &nbsp;&nbsp;
                        <button class="btn  btn-danger my-cart-btn" data-id="{{$product->id}}_" data-id_real="{{$product->id}}" data-name="{{$product->title}}"

                                data-summary="{{$product->description}}" data-price="{{$product->price}}" data-quantity="1" data-image="{!! $product->img !!}">В корзину</button>
                    </h3>
                </div>

                <br>
                <div class="col-sm-12 content">
                    <p>{{$product->description}}. &nbsp;</p><p>@if($product->size != null){{$product->size}}@endif</p><p>Доставка - бесплатная при заказе от 2 кг и выше</p><p>По всем вопросам - +7 777 777 75 73</p><hr id="horizontalrule">
                    <p><strong>Самовывоз:</strong> ул. Хаджимукана, 59, ЖК ILE DE FRANCE, 9 подъезд, </p><p>Вход слева от подъезда</p>
                    <br>
                </div>






            </div>
            <div class="col-md-4 col-xs-12 right-block2">


                <div class="top-news">
                    <div class="block-head">Новые новости</div>
                    <div class="top-news-slider_">
                        @foreach($NewArticles as $article)
                        <div class="top">
                            <a href="{{route('Article',$article->id)}}">
                                <div class="content-img">
                                    <img src="{!! $article->path !!}" alt="WISHLIST: Что дарят друг другу на 14 февраля Айдос и Мольдер Рысалиевы? " class="img-responsive">
                                </div>
                                <div class="content">
                                    <div class="content-head">{{$article->name}}</div>
                                    <div class="content-text">{{$article->title}}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach



                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="http://static.hommes.kz/s/_compress/js/style.js?9fba8d3d"></script>

    <script src="{{asset('assets/js/card.js')}}"></script>
@endsection
