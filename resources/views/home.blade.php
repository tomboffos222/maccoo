@extends('layouts.base')

@section('content')
    <div class="owl-carousel4 owl-carousel">
        @foreach($sliders as $slider)
            <div class="owl_slider_product">
                <div class="slider_item">

                    <div class="image_slider">
                        <img src="{{$slider->image1}}" alt="">

                    </div>
                    <div class="info_slider">
                        <h2>{{$slider->title}}</h2>
                        <h3> {{$slider->author}} </h3>
                        <p>
                            {{$slider->description}}

                        </p>
                        <a href="{{route('AddProduct',$slider->id)}}" class="cart">
                            В корзину
                        </a>
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>
    <div class="container second_screen">
    	<div class="row">
    		<div class="col-lg-4">
    			<img src="https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/04/policy-1.png" alt="">
    			<div class="">
    				<h3>
    					Бесплатная доставка
    				</h3>
    				<p>
    					Выберите между широким спектром текстовых книг и медиа.

    				</p>
    			</div>
    		</div>
    		<div class="col-lg-4">
    			<img src="https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/04/policy-2.png" alt="">
    			<div class="">
    				<h3>
    					Быстрая доставка
    				</h3>
    				<p>
    					Наслаждайтесь бесплатной доставкой и нашей быстрой доставкой.

    				</p>
    			</div>

    		</div>
    		<div class="col-lg-4">
    			<img src="https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/04/policy-3.png" alt="">
    			<div class="">
    				<h3>
    					
                        Со скидкой 
    				</h3>
    				<p>
    					Получите хорошую скидку на наш продукт с самым высоким рейтингом каждое воскресенье.

    				</p>
    			</div>
    		</div>
    	</div>
    	<hr>
    	<div class="row search_form">
    		<div class="col-lg-12">
    			<form action="{{route('Search')}}">
    				<select name="category" id="">
                        <option value="All">Все категории</option>
                        @foreach($categories as $category)
    					<option value="{{$category->chars}}">{{$category->chars}}</option>
                        @endforeach
    					
    				</select>
    				<select name="author" id="">
                        <option value="All">Все Авторы</option>
                        @foreach($authors as $author)

    					<option value="{{$author->Name}}">{{$author->Name}}</option>
                        @endforeach
    					
    				</select>
    				<button type="submit">
    					<i class="material-icons">
    						search
    					</i>
    					Искать книгу
    				</button>

    			</form>
    		</div>

    	</div>
    </div>

    <div class="books" style="background-color: #f5f5f5 !important;">
    	<div class="container">
	    	<div class="row">
	    		<div class="col-lg-12" style="text-align: center;">
	    			<h2>
	    				Популярные книги
	    			</h2>
	    		</div>
	    		@foreach($products as $product)
		    		<a href="{{route('Product',$product->id)}}" >
		    			<div class="col-lg-4">
			    			<div class="book  book_index">
								<h1>
									<img src="{{$product->image1}}" alt="">
								</h1>
				    			<h4>{{$product->title}}</h4>
				    			<h6>{{$product->price}} KZT</h6>
				    			<h5>{{$product->chars}}</h5>
				    			<p>
				    				{{$product->author}}
				    			</p>
				    			<a href="{{route('AddProduct',$product->id)}}" class="cart">
				    				В корзину
				    			</a>
			    			</div>
		    			</div>
		    		</a>
	    		@endforeach
	    		
	    	</div>
	    </div>
    </div>
    <div class="book_one">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-5">
    				<h3>
    					Лучшая книга

    				</h3>
    				<a href="">
    					<h1>
    						Богатый папа бедный папа
    					</h1>
    				</a>
    				<h4>
    					от <a>Роберта Кийосаки</a>
    				</h4>
    				<h5>
    					3500 KZT

    				</h5>
    				<p>
    					Эта книга поменяла мировоззрение не одному человеку на планете. Ведь представление о деньгах у многих граждан довольно стереотипное и устаревшее. Поэтому и живут такие люди всю жизнь работая на свои «пассивы», то есть машины, квартиры и дома, не вылезая из долгов и кредитов. 



    				</p>
    				<a href="" class="cart">
    					В корзину
    				</a>
    			</div>
    			<div class="col-lg-7">
    				<img src="https://img2.wbstatic.net/big/new/7820000/7821786-1.jpg" alt="" style="height: 800px;margin-top:-100px;">
    			</div>
    		</div>
    	</div>
    </div>
    <div class="" style=" background-image: url(https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/04/banner2-1.jpg?id=7763);">
    	

    </div>
    <div class="featured_authors">
    	<div class="container">
    		<div class="row owl-carousel owl-carousel2">
    			@foreach($authors as $author)
    			<div class="col-lg-12">

    				<div class="author">
    					
    					<div class="author_img">
    						<img src="{{$author->image1}}" alt="">

    					</div>
    					<span class="badge">#1</span>
    					<a href="{{route('Author',$author->id)}}" class="name_author"> 
    						<span>{{$author->Name}}</span>
    					</a> <br>
    					<a href="{{route('Author',$author->id)}}" class="counter">
    						<span>{{$author->Books}} выпущенные книги </span>
    					</a>
    					
    				</div>
    				
    			</div>
    			@endforeach
    			

    		</div>
    	</div>
    </div>

    <div class="gift" style="text-align: center;">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12">
    				<h1>
    					Прекрасный подарок

    				</h1>
    				<h2>
    					Подари своим родным книгу в подарок!

    				</h2>
    				<a href="/shop">
    					В магазин
    				</a>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="events">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-12">
    				<h1>События</h1>

    			</div>
    			<div class="col-lg-12">
    				<div class="owl-carousel owl-carousel1">
    				<div class="col-lg-12 carousel_part">
	    				<img src="https://www.hongkongdividendstocks.com/wp-content/uploads/2019/10/5.jpg" alt="">
	    				<h1>Получи 5% скидки</h1>
	    				<p>от <span>Admin</span> Апрель 17, 2017	</p>
	    				<p>
                            При регистрации на бонусную систему вы получаете  5% скидки на дальнейшие покупки книг
	    				</p>
	    			</div>
	    			<div class="col-lg-12 carousel_part">
	    				<img src="https://cdn.worldvectorlogo.com/logos/whatsapp-symbol.svg" alt="">
	    				<h1>Пиши на Whatsapp </h1>
                        <p>от <span>Admin</span> Апрель 17, 2017    </p>
                        <p>
                            По всем вопросом вы можете написать на Whatsapp и вас проконсультируют в течение 60 секунд
                        </p>
	    			</div>
	    			<div class="col-lg-12 carousel_part">
	    				<img src="http://enlik.kz/images/book.png" alt="">
	    				<h1>В магазинах Marwin</h1>
                        <p>от <span>Admin</span> Апрель 17, 2017    </p>
                        <p>
                            В сети магазинов Marwin появилось книга нашей отечествинницы Енлік Абдикадір.
                            Название книги "Бриллиант леди"
                        </p>
    				</div>
                    <div class="col-lg-12 carousel_part">
                        <img src="https://justtralala.com/wp-content/uploads/2016/07/zhizn-bez-granic-nik-vuichich-otzyv.jpg" alt="">
                        <h1>Лучшая книга</h1>
                        <p>от <span>Admin</span> Апрель 17, 2017    </p>
                        <p>
                            Книга Ника Вуйчича является номером один среди мотивационных книг
                        </p>
                    </div>
    				
    			</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="letter">
    	<div class="container">
    		<div class="row">
	    			<div class="col-lg-4" class="imager">
	    				<img src="https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/07/banner1-5.jpg" alt="">
	    			</div>
	    			<div class="col-lg-4">
	    				<h1>
	    					Присоединяйтесь к сообществу
	    				</h1>
	    				<p>
	    					Прочитать новости
	    				</p>
	    				<form action="">
	    					<input type="text" placeholder="Ваша почта...">
	    					<input type="submit" value=">">
	    				</form>
	    			</div>
	    			<div class="col-lg-4" class="imager">
	    				<img src="https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/07/banner1-4.jpg" alt="">
	    			</div>
    			</div>
    		</div>
    	</div>
    </div>
   
@endsection

	




 
