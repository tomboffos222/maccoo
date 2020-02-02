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
					<a href="/">Главная</a><span class="delimiter"></span><a href="/shop" class="">Магазин</a><span class="delimiter"></span><a href="{{route('Product',$product->id)}}" class="active">{{$product->title}}</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="product">
	<div class="container">
		<div class="row">
			<div class="col-lg-2 image_thumbnail" >
				<div class=""><img src="{{$product->image1}}" alt=""></div>
				<div class=""><img src="{{$product->image2}}" alt=""></div>
				<div class=""><img src="{{$product->image3}}" alt=""></div>
			</div>
			<div class="col-lg-4 image_promo">
				<div class=""><img src="{{$product->image1}}" alt=""></div>
			</div>
			<div class="col-lg-6">
				<div class="information_description">
					<h1>
						{{$product->title}}
					</h1>
					<h2>
						{{$product->price}}
					</h2>
					<hr>
					<h3>
						@if($product['status']==1)

							В наличий
						@endif
					</h3>
				
					<p>
						{{$product->description}}
					</p>
					<a href="{{route('AddProduct',$product->id)}}" class="cart_product">
						Добавить в корзину
					</a>
					<hr>
					<h3><span>Категория: </span>{{$product->chars}}</h3>
					<h3><span>Автор: </span>{{$product->author}}</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="related_products">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 style="margin-bottom: 100px;">Рекомендованные продукты</h1>
				<div class="owl-carousel owl-carousel3">
					@foreach($products as $key)
					<a href="{{route('Product',$key->id)}}" style="color:inherit;">
						<div class="product_slider">
							<img src="{{$key->image1}}" alt="">
							<h3>{{$key->title}}</h3>
							<h4><span>от </span> {{$key->author}}</h4>
							<h5 class="price">{{$key->price}}</h5>

						</div>
					</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@endsection