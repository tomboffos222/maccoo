<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Новостной портал</title>

    <!-- Bootstrap, Font Awesome, Aminate, Owl Carausel, Normalize CSS -->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/owl.theme.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/normalize.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/slicknav.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Site CSS -->

    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Modernizr JS -->
    <script src="{{asset('assets/js/modernizr-3.5.0.min.js')}}"></script>

    <!--favincon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/images/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/images/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/images/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/images/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/images/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/images/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/images/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/images/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/images/favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/images/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif:300,400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
    <!--Poprup-->
    <link href="{{asset('assets/css/popup.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.bpopup.min.js')}}"></script>
    <script>
        $( document ).ready(function() {
            $('#popup_this').bPopup();
        });
    </script>
</head>
<body>
<div class="spinner-cover">
    <div class="spinner-inner">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
</div>
<div class="spinner-cover">
    <div class="spinner-inner">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
</div>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-inner">
            <div class="off-canvas-close"><span>CLOSE</span></div>
            <div class="sidebar-widget">
                <div class="widget-title-cover">
                    <h4 class="widget-title"><span>Популярные статьи</span></h4>
                </div>
                <ul class="menu" id="sidebar-menu">
                    <li class="menu-item"><a href="index.html#">трендовый</a></li>
                    <li class="menu-item menu-item-has-children"><a href="index.html#">мышление</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="index.html#">Дом и жизнь</a></li>
                            <li class="menu-item menu-item-has-children"><a href="index.html#">Стиль жизни</a>
                                <ul class="sub-menu">
                                    <li class="menu-item"><a href="index.html#">Путешествовать</a></li>
                                    <li class="menu-item"><a href="index.html#">Садоводство</a></li>
                                    <li class="menu-item"><a href="index.html#">Вдохновения</a></li>
                                </ul>
                            </li>
                            <li class="menu-item"><a href="index.html#">Вдохновения</a></li>
                            <li class="menu-item"><a href="index.html#">Садоводство</a></li>
                        </ul>
                    </li>
                    <li class="menu-item menu-item-has-children"><a href="index.html#">Вдохновения</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="index.html#">Дом и Жизнь</a></li>
                            <li class="menu-item"><a href="index.html#">Путешествовать</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="index.html#">Контакт</a></li>
                </ul>
            </div>

            <div class="sidebar-widget">
                <div class="widget-title-cover"><h4 class="widget-title"><span>Трендовый</span></h4></div>
                <div class="latest_style_2">
                    <div class="latest_style_2_item_first">
                        <figure class="alith_post_thumb_big">
                            <span class="post_meta_categories_label">Легальный, Блог</span>
                            <a href="single.html"><img src="http://thumb.hommes.kz/3LBqrVvWaboSSXRhjJY31MJ-bC4=/filters:watermark(http://static.hommes.kz/s/img/hommes_logo.png,-10,-10,30)/http://hommes.kz/media/blog/entries/photos/2019/12/18/0c/92/e4/43/0c92e4437b4fd314a4ef39fd4478736a.58.21.jpeg" alt=""/></a>
                        </figure>
                        <h3 class="alith_post_title">
                            <a href="single.html"><strong>В Казахстане пройдет чемпионат по смешанным единоборствам “Gorilla Fighting Championship 23”. Почетным гостем мероприятия станет действующий чемпион UFC Хабиб Нурмагомедов.</strong></a>
                        </h3>
                    </div>
                    <div class="latest_style_2_item">
                        <figure class="alith_news_img"><a href="single.html"><img src="http://thumb.hommes.kz/78FsW6L1kK7WQxXlMYpJ6Jm8fA4=/filters:watermark(http://static.hommes.kz/s/img/watermar.png,-10,-10,30)/http://hommes.kz/media/blog/entries/photos/2016/11/16/d8/ca/2b/32/d8ca2b32652c16f40ad77b5b49abb4e5.jpg" alt=""/></a></figure>
                        <h3 class="alith_post_title"><a href="single.html">КУРАЛАЙ НУРКАДИЛОВА: «ОДЕЖДУ БРЕНДА KURALAI НОСЯТ ВСЕ – ОТ ВОЕННЫХ ДО МИШЕЛЬ РОДРИГЕЗ» </a></h3>

                        <div class="post_meta">
                            <p class="meta"><span>2 сентября 2018</span> <span>268 просмотров</span></p>
                        </div>
                    </div>
                    <div class="latest_style_2_item">
                        <figure class="alith_news_img"><a href="single.html"><img src="http://thumb.hommes.kz/Hpi6jc7aVoX2sdWUkGQ-UXN4nIg=/filters:watermark(http://static.hommes.kz/s/img/watermar.png,-10,-10,30)/http://hommes.kz/media/blog/entries/photos/2016/10/06/b2/c0/45/17/b2c04517b5ba384e901c52720a727e69.jpg" alt=""/></a></figure>
                        <h3 class="alith_post_title"><a href="single.html">10 ЛУЧШИХ СТОМАТОЛОГИЧЕСКИХ КЛИНИК АЛМАТЫ</a></h3>
                        <div class="post_meta">
                            <span class="meta_date">18 сентября 2018</span>
                        </div>
                    </div>
                    <div class="latest_style_2_item">
                        <figure class="alith_news_img"><a href="single.html"><img src="http://thumb.hommes.kz/nyp4IAOvgaMjhXjqhCrbGl5fFcg=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2016/09/02/c8/1e/72/8d/c81e728d9d4c2f636f067f89cc14862c_1.jpg" alt=""/></a></figure>
                        <h3 class="alith_post_title"><a href="single.html">КАК ВЗЯТЬ ДЕНЕГ ВЗАЙМЫ ЗА 10 МИНУТ? ТОП-5 ЛУЧШИХ СЕРВИСОВ ПО ОНЛАЙН-ЗАЙМАМ</a></h3>
                        <div class="post_meta">
                            <span class="meta_date">18 сентября 2018</span>
                        </div>
                    </div>
                </div>
            </div> <!--.sidebar-widget-->

            <div class="sidebar-widget">
                <div class="widget-title-cover"><h4 class="widget-title"><span>Афишировать</span></h4></div>
                <div class="banner-adv">
                    <div class="adv-thumb">
                        <a href="index.html#">
                            <img class="aligncenter" alt="img1" src="http://thumb.hommes.kz/N5bU-hvZdIbkOy8q-NlDZdwk5EA=/filters:watermark(http://static.hommes.kz/s/img/watermar.png,-10,-10,30)/http://hommes.kz/media/blog/entries/photos/2016/10/24/8f/41/8e/35/8f418e3585c86feb74a5775e4b1a82a7.jpg">
                        </a>
                    </div>
                </div>
            </div> <!--.sidebar-widget-->
        </div>
    </div>		<!--#sidebar-wrapper-->

    <div id="page-content-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

            <div class="container-fluid">
                <div class="container">
                    <div class="top_bar margin-15">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 time">
                                <div class="off-canvas-toggle" id="off-canvas-toggle"><span></span><p class="sidebar-open">БОЛЬШЕ</p></div>
                                <i class="fa fa-clock-o"></i><span>&nbsp;&nbsp;&nbsp; @php echo date('Y-m-d'); @endphp</span>
                            </div>
                            <div class="col-md-6 col-sm-12 social">
                                <ul>
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                                <div class="top-search">
                                    <i class="fa fa-search"></i><span>ПОИСК</span>
                                </div>
                                <div class="top-search-form">
                                    <form action="{{route('Search')}}" class="search-form" method="get" role="search">
                                        <label>
                                            <span class="screen-reader-text">Искать:</span>
                                            <input type="search" name="search" value="" placeholder="Поиск …" class="search-field">
                                        </label>
                                        <input type="submit" value="Search" class="search-submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 header">
                            <h1 class="logo"><a href="{{route('Home')}}">THE ALMATY TIME</a></h1>
                            <p class="tagline">ГАЗЕТА / ЖУРНАЛ / ИЗДАТЕЛЬ</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-nav section_margin">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-12 main_nav_cover" id="nav">
                                <ul id="main-menu">
                                    <li class="menu-item-has-children"><a href="{{route('Home')}}">Категорий</a>
                                        <ul class="sub-menu">
                                            @foreach($cats as $cat)
                                            <li><a href="{{route('ArticleCategory',$cat->id)}}">{{$cat->name}}</a></li>
                                            @endforeach

                                        </ul>
                                    </li>
                                   <!-- <li class="menu-item-has-children"><a href="index.html#">Стиль</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item-has-children"><a href="index.html#">Стиль жизни</a>
                                                <ul class="sub-menu">
                                                    <li><a href="category-list.html">Mens looks</a></li>
                                                    <li><a href="category-grid.html">Часы</a></li>
                                                    <li><a href="category-masonry.html">Каменная кладка</a></li>
                                                    <li><a href="category-big.html">Большой </a></li>
                                                </ul>
                                            </li>

                                            <li class="menu-item-has-children"><a href="index.html#">Увлечения</a>
                                                <ul class="sub-menu">
                                                    <li><a href="single.html">Автомобили</a></li>
                                                    <li><a href="post-video.html">Техника</a></li>
                                                    <li><a href="post-audio.html">Женщины</a></li>
                                                    <li><a href="post-gallery.html">Политика</a></li>
                                                    <li><a href="post-image.html">Бизнес</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-item-has-children"><a href="index.html#">События</a>
                                                <ul class="sub-menu">
                                                    <li><a href="page-author.html">Автор</a></li>
                                                    <li><a href="page-search.html">Поиск</a></li>
                                                    <li><a href="page-404.html">404</a></li>
                                                    <li><a href="page-contact.html">Контакт</a></li>
                                                    <li><a href="page-typography.html">Типография</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li> -->
                                    <li><a href="{{route('Popular')}}">Популярные</a></li>
                                    <li><a href="{{route('FreshArticles')}}">Новое</a></li>
                                    <!--<li class="menu-item-has-children"><a href="category-masonry.html">Спецпроекты</a>
                                        <ul class="sub-menu">
                                            <li><a href="category-big.html">MARTELL "10 лучших ресторанов Казахстана"</a></li>
                                            <li><a href="category-list.html">10 джентльменов Казахстана под эгидой CHIVAS</a></li>
                                            <li><a href="category-grid.html">30 успешных казахстанцев до 30 лет</a></li>
                                            <li><a href="category-list.html">10 ярких и успешных владельцев Jaguar</a></li>
                                        </ul>
                                    </li>-->
                                    <li><a href="{{route('shop')}}">Store</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="container animate-box">
                    <div class="row">
                        <div class="owl-carousel owl-theme js carausel_slider section_margin" id="slider-small">
                            @foreach($NewArticles as $newArticle)
                            <div class="item px-2">
                                <div class="alith_latest_trading_img_position_relative">
                                    <figure class="alith_post_thumb">
                                        <a href="{{route('Article',$newArticle->id)}}"><img width="100" src="{!! $newArticle->path !!}" style="height: 75px;" alt=""/></a>
                                    </figure>
                                    <div class="alith_post_title_small">
                                        <a href="{{route('Article',$newArticle->id)}}"><strong>{{$newArticle->title}}</strong></a>
                                        <p class="meta"><span>{{$newArticle->created_at}}</span> <span>{{$newArticle->views}} просмотров</span></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
            @yield('content')


            <div class="container-fluid alith_footer_right_reserved">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-12 bottom-logo">
                            <h1 class="logo"><a href="index.html">THE ALMATY TIME</a></h1>
                            <div class="tagline social">
                                <ul>
                                    <li class="facebook"><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href=""><i class="fab fa-whatsapp"></i></a></li>
                                    <li class="google-plus"><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li class="instagram"><a href=""><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 coppyright"> <p>© Copyright 2020, Все права защищены. Дизайнер <a href="https://alithemes.com" title="AliTheme">Next in</a></p> </div>
                    </div>
                </div>
            </div>
            <div class="gototop js-top">
                <a href="index.html#" class="js-gotop"><span>На верх</span></a>
            </div>
    </div> <!--page-content-wrapper-->
    <style>
        body{
            background-color:#f3f3f3;
        }
        .container{
            padding-left: 50px;
            padding-right: 50px;
            background-color: #fff;
        }
        .container.animate-box.fadeInUp.animated-fast{
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .section_margin{
            margin-bottom: 0px;
        }
    </style>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('assets/js/masonry.pkgd.min.js')}}"></script>
    <!-- Main -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/smart-sticky.js')}}"></script>
    <script src="{{asset('assets/js/theia-sticky-sidebar.js')}}"></script>
</div> <!--#wrapper-->
</body>
</html>


