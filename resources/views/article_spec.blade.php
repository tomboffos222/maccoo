@extends('layouts.base')



@section('content')
    <div class="container-fluid">
        <div class="container animate-box">
            <div class="row">
                <div class="archive-header">



                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="primary margin-15">
                <div class="row">
                    <div class="col-md-8">
                        <div class="post_list grid-blance">
                            <div class="row">

                                @foreach($articlesMain as $article)
                                    <article class="col-md-6 animate-box section_margin">
                                        <div class="wrap">
                                            <figure class="alith_news_img">
                                                <span class="post_meta_categories_label">{{$article->name}}</span>
                                                <a href="{{route('Article',$article->id)}}"><img src="{!! $article->path !!}" alt=""/></a>
                                            </figure>
                                        </div>
                                        <h3 class="alith_post_title"><a href="{{route('Article',$article->id)}}">{{$article->title}}</a></h3>
                                        <div class="post_meta">

                                            <span class="meta_author_name"><a href="{{route('Article',$article->id)}}" class="author">{{$article->author}}</a></span>
                                            <span class="meta_date">{{$article->created_at}}</span>
                                            <span class="meta_date">{{$article->views}} просмотров</span>
                                        </div>

                                        <div class="line-space"></div>
                                    </article>
                                @endforeach

                            </div>
                        </div>
                        {{$articlesMain->links()}}
                    </div>
                    <!--Start Sidebar-->
                    <aside class="col-md-4 sidebar_right">
                        <div class="sidebar-widget animate-box">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Популярные статьи</span></h4></div>
                            <div class="latest_style_1">
                                @foreach($articles as $article)
                                    <div class="latest_style_1_item">
                                        <span class="item-count vertical-align"></span>
                                        <div class="alith_post_title_small">
                                            <a href="{{route('Article',$article->id)}}"><strong>{{$article->title}}</strong></a>
                                            <p class="meta"><span>{{$article->created_at}}</span> <span>{{$article->views}} просмотров</span></p>
                                        </div>
                                        <figure class="alith_news_img"><a href="{{route('Article',$article->id)}}"><img style="height: 100px;width: 100%;" src="{!!$article->path  !!}" alt=""/></a></figure>
                                    </div>
                                @endforeach

                            </div>
                        </div> <!--.sidebar-widget-->

                        <div class="sidebar-widget animate-box">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Поиск</span></h4></div>
                            <form action="{{route('Search')}}" class="search-form" method="get" role="search">
                                <label>
                                    <input type="search" name="search" value="" placeholder="Поиск …" class="search-field">
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
    <div class="container-fluid">
        <div class="container animate-box">
            <div class="bottom margin-15">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="sidebar-widget">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Самый последний</span></h4></div>
                            <div class="latest_style_2">
                                @foreach($NewArticles as $newArticle)
                                    <div class="latest_style_2_item">
                                        <figure class="alith_news_img"><a href="{{route('Article',$newArticle->id)}}"><img alt="" src="{!! $newArticle->path !!}" class="hover_grey"></a></figure>
                                        <h3 class="alith_post_title"><a href="{{route('Article',$newArticle->id)}}">{{$newArticle->title}}</a></h3>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="sidebar-widget">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Категории</span></h4></div>
                            <ul class="bottom_menu">
                                @foreach($cats as $cat)
                                    <li><a href="{{route('ArticleCategory',$cat->id)}}" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; {{$cat->name}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="sidebar-widget">
                            <div class="widget-title-cover"><h4 class="widget-title"><span>Инстаграм</span></h4></div>
                            <ul class="alith-instagram-grid-widget alith-clr alith-row alith-gap-10">
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/9LlBP644jm-X_5jrHH0TRBaLmqw=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/04/29/78/54/5b/86/78545b867be4dbe30e53a338514e4f95_1.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/10QaCI9GTYhjU0adQO_-Dy-Lb6Q=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/04/26/4c/c4/8a/b0/4cc48ab06b23e19eb716ec9aebf1acf8_1.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/-IlyVqmWWT4R-aJ23B5ccAxnG7U=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/04/24/87/8e/32/92/878e329232adfdb0649d04a2fab2ab14_1.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/hsEroRBRAND1vZlUGuhXMuiGXiA=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/04/17/0c/86/24/8a/0c86248afd149ac77e1ad654ed0e8001.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/mNAVJW4WIKlA1PdH4cBpFoJ5OMs=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/04/08/b2/e5/45/27/b2e545275db2408448ff0b15a1c97639_1.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/0uwFm1TuT5ZX3b7hFUP6iDBfMl0=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/03/06/00/b5/9e/06/00b59e06036425e4d82f27fd74fc2968_1.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/ZctACUVxGyQkcC6xSQaiP0qTmzo=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/03/10/88/40/f3/98/8840f398c57ab1f76170951d3f2aa184.jpeg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/Dyda7nJZohS3H6mYPacZp2FyKTo=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/04/09/cc/91/86/5f/cc91865faff1e085cacb6e39f762ad3b.jpg">
                                    </a>
                                </li>
                                <li class="wow fadeInUp alith-col-nr alith-clr alith-col-3 animated">
                                    <a class="" target="_blank" href="index.html#">
                                        <img class="" title="" alt="" src="http://thumb.hommes.kz/D3SjIOf7X4nLE4nVzVF_dhwhekI=/700x700/smart/http://hommes.kz/media/blog/entries/photos/2019/03/04/7a/28/04/42/7a28044221e97b083d9d239ac13623bf.jpg">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> <!--.row-->
            </div>
        </div>
    </div>
@endsection
