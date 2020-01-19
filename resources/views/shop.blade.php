@extends('layouts.base')


@section('content')

<div class="page_title" style="background-image:url(https://wpbingosite.com/wordpress/bootin/wp-content/uploads/2019/05/Breadcumd.jpg);">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 page_title" >
				<h1>
					Магазин
				</h1>
				<div class="breadcrumb">
					<a href="/">Главная</a><span class="delimiter"></span><a href="" class="active">Магазин</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container shopping_book">
	<div class="row">
		<div class="col-lg-3 sidebar_shop">
			<div class="searchbar">
				<form action="">
					<input type="text" placeholder="Поиск">
					<button type="submit"><i class="material-icons">search</i></button>
				</form>
			</div>

			<div class="categories">
				<h1>
					Жанры
				</h1>
				@foreach($categories as $category)
				<li>
					<a href="{{route('Category',$category->id)}}">{{$category->chars}}</a>
					
				</li>
				@endforeach
				
			</div>
			<div class="price">
				
			</div>
			<div class="authors">
				<a href="{{route('Authors')}}"><h1>Авторы</h1></a>
				@foreach($authors as $author)
				<li><a href="{{route('Author',$author->id)}}">{{$author->Name}}({{$author->Books}})</a></li>
				@endforeach
				
			</div>
			<div class="tags">
				<h1>Tags</h1>
				<div class="flex">
					<a href="">Классика</a>
					<a href="">Ужасы</a>
					<a href="">Дети</a>
					<a href="">Мужчины</a>
					<a href="">Тренды</a>
					<a href="">Женщины</a>
				</div>
			</div>
		</div>
		<div class="col-lg-9 shop">
			<div class="setting_bar">
				<div class="layers">
					<div class="layer_one">
						<span class="layer first">
							<span></span>
							<span></span>
						</span>
						<span class="layer middle">
							<span></span>
							<span></span>
						</span>
						<span class="layer last">
							<span></span>
							<span></span>
						</span>
					</div>
					<div class="layer_two">
						<span class="layer first">
							<span></span>
							<span></span>
							<span></span>
						</span>
						<span class="layer middle">
							<span></span>
							<span></span>
							<span></span>
						</span>
						<span class="layer last">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</div>
					<div class="layer_third">
						<span class="layer first">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</span>
						<span class="layer middle">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</span>
						<span class="layer last">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</span>
					</div>

				</div>
			</div>
			<hr>
			<div class="row">
			@foreach($products as $product)
				<a href="{{route('Product',$product->id)}}">
					<div class="col-lg-3 booker">
			    			<div class="book">
								<h1>
									<img src="{{$product->image1}}" alt="">
								</h1>
				    			<h4>{{$product->title}}</h4>
				    			<h5>{{$product->chars}}</h5>
				    			<h6>{{$product->price}} KZT</h6>
				    			
				    		
				    			
			    			</div>
		    		</div>
				</a>

			@endforeach

			</div>

		</div>
		<div class="col-lg-3">
			
		</div>
		<div class="col-lg-9">
			{{$products->links()}}
		</div>
	</div>

</div>

<style>
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
	.book{
		padding:0px !important;
	}



</style>

@endsection