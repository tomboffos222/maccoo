@extends('layouts.base')




@section('content')
	<div class="author_block">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="image_frame">
						<img src="{{$author->image1}}" alt="">
					</div>
					
				</div>
				<div class="col-lg-8">
					<div class="info_author">
						<h2>{{$author->Name}}</h2>
						<p>
							{{$author->Description}}
						</p>
						<p>
							<span>Адрес:</span> {{$author->Address}}
						</p>
						<p>
							<span>Дата рождения:</span> {{$author->Birth}}

						</p>
						<p>
							<span>Пол:</span> 
							@if($author->gender == 'male')
								Мужчина
							@elseif($author->gender == 'female')
								Женщина
							@endif

						</p>
						<p>
							<span>Выпущенные книги:</span>  {{$author->Books}}
						</p>
					</div>


				</div>
			</div>
		</div>
	</div>
	<div class="container author_books">
		<div class="row">
			
			<div class="col-lg-12 shop">
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
				    			<div class="book author_book">
									<h1>
										<img src="{{$product->image1}}" alt="">
									</h1>
					    			<h4>{{$product->title}}</h4>
					    			<h5>{{$product->author}}</h5>
					    			<h6>{{$product->price}}</h6>
					    			
					    		
					    			
				    			</div>
			    		</div>
					</a>
				@endforeach
				</div>
			</div>
		</div>
	</div>


@endsection
	<style>
		.author_block img{

			width: 100%;


		}
		.book{
			height: auto !important;
		}
		.col-lg-3 .book img{
			height: 350px !important;
		}
		.col-lg-4 .book img{
			height: 400px !important;
		}
		.col-lg-6 .book img{
			height: 700px !important;
		}
		.author_books.container{
			padding-bottom: 50px;
		}
		.image_frame{
			overflow: hidden;
		}
		.author_block img:hover{
			transform: scale(1.1);
			transition: 0.5s ease;
		}
		.author_block{
			padding:100px 0px;
		}
		.col-lg-8 div{
			padding:0px 40px;
		}
		.info_author h2{
			color: #2b2b2b;
    		font-size: 35px;
    		margin-bottom: 40px;

		}
		.book.author_book{
			padding:0px !important;
			text-align: left;
		}
		.info_author p{
			margin-bottom: 20px;
		}
		.info_author p span{
			font-weight: 700;
			margin-right: 40px;
		}
	</style>