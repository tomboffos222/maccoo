@extends('layouts.base')




@section('content')




    <div class="container-fluid">

        <div class="container animate-box">

            <div class="row">

                <div class="post-header">

                    <div class="bread">

                        <ul class="breadcrumbs" id="breadcrumbs">

                            <li class="item-home">Вы здесь: <a title="Home" href="{{route('Home')}}" class="bread-link bread-home">Главная</a></li>

                            <li class="separator separator-home"> /</li>

                            <li class="item-current item-cat"><a title="Home" href="index.html" class="bread-link bread-home">{{$article->name}}</a></li>

                            <li class="separator separator-home"> /</li>

                            <li class="item-current item-cat"><strong class="bread-current bread-cat">{{$article->title}}</strong></li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="container-fluid">

        <div class="container">

            <div class="primary margin-15">

                <div class="row">

                    <div class="col-md-8">

                        <article class="section_margin">

                            <figure class="alith_news_img animate-box"><a href="{{route('Article',$article->id)}}"><img src="{!! $article->path !!}" alt="" style="width: 100%;"/></a></figure>

                            <div class="post-content">

                                <div class="single-header">

                                    <h3 class="alith_post_title">{{$article->title}}</h3>

                                    <div class="post_meta">



                                        <span class="meta_author_name"><a href="page-author.html" class="author">Steven Job</a></span>

                                        <span class="meta_categories"><a href="">{{$article->name}}</a></span>

                                        <span class="meta_date">{{$article->created_at}}</span>

                                    </div>

                                </div>

                                <div class="single-content animate-box">

                                   {!! $article->text !!}


                                    <!--post-related and navigation-->

                                </div> <!--single content-->



                            </div>

                        </article>

                        <div class="single-more-articles single-disable-inview">

                            <h4><span>Вы могли бы заинтересоваться</span></h4>

                            <span class="single-more-articles-close-button"><i class="fa fa-times" aria-hidden="true"></i></span>

                            <div class="latest_style_2">

                                <div class="latest_style_2_item">

                                    <figure class="alith_news_img"><a href="single.html"><img class="hover_grey" src="assets/images/thumb-square-1.png" alt=""></a></figure>

                                    <h3 class="alith_post_title"><a href="single.html">Magna aliqua ut enim ad minim veniam</a></h3>

                                </div>

                                <div class="latest_style_2_item">

                                    <figure class="alith_news_img"><a href="single.html"><img class="hover_grey" src="assets/images/thumb-square-2.png" alt=""></a></figure>

                                    <h3 class="alith_post_title"><a href="single.html">Magna aliqua ut enim ad minim veniam</a></h3>

                                </div>

                            </div>

                        </div> <!--end single more articles-->

                    </div>

                    <!--Start Sidebar-->

                    <aside class="col-md-4 sidebar_right">
                        <div class="sidebar-widget animate-box">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Популярные статьи</span></h4></div>
                            <div class="latest_style_1">
                                @foreach($articles as $article1)
                                    <div class="latest_style_1_item">
                                        <span class="item-count vertical-align"></span>
                                        <div class="alith_post_title_small">
                                            <a href="{{route('Article',$article1->id)}}"><strong>{{$article1->title}}</strong></a>
                                            <p class="meta"><span>{{$article1->created_at}}</span> <span>{{$article1->views}} просмотров</span></p>
                                        </div>
                                        <figure class="alith_news_img"><a href="{{route('Article',$article1->id)}}"><img style="height: 100px;width: 100%;" src="{!!$article1->path  !!}" alt=""/></a></figure>
                                    </div>
                                @endforeach

                            </div>
                        </div> <!--.sidebar-widget-->

                        <div class="sidebar-widget animate-box">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Поиск</span></h4></div>
                            <form action="#" class="search-form" method="get" role="search">
                                <label>
                                    <input type="search" name="s" value="" placeholder="Поиск …" class="search-field">
                                </label>
                                <input type="submit" value="Поиск" class="search-submit">
                            </form>
                        </div> <!--.sidebar-widget-->

                        <div class="sidebar-widget animate-box">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Трендовый</span></h4></div>
                            <div class="latest_style_2">
                                <div class="latest_style_2_item_first">
                                    <figure class="alith_post_thumb_big">
                                        <span class="post_meta_categories_label">{{$popularArticle->name}}</span>
                                        <a href="{{route('Article',$popularArticle->id)}}"><img src="{!! $popularArticle->path   !!}" alt=""/></a>
                                    </figure>
                                    <h3 class="alith_post_title">
                                        <a href="{{route('Article',$popularArticle->id)}}" style="text-transform: uppercase"><strong>{{$popularArticle->title}}</strong></a>
                                    </h3>
                                </div>

                            </div>
                        </div> <!--.sidebar-widget-->

                        <div class="sidebar-widget animate-box">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Облако тегов</span></h4></div>
                            <div class="alith_tags_all">
                                @foreach($cats as $cat)
                                    <a href="{{route('ArticleCategory',$cat->id)}}" class="alith_tagg">{{$cat->name}}</a>

                                @endforeach

                            </div>
                        </div> <!--.sidebar-widget-->

                    </aside>

                    <!--End Sidebar-->

                </div>

            </div> <!--.primary-->



        </div>

    </div>
    @endsection
