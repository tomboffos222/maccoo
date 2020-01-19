@extends('layouts.base')

@section('content')
<div class="authors">
	<div class="container">
		<div class="row">
			@foreach($authors as $author)
				<div class="col-lg-3">
					<div class="image_frame">
						<a href="{{route('Author',$author->id)}}" class="image_linker"><img src="{{$author->image1}}" alt=""></a>
					</div>

					<a href=""><h5>{{$author->Name}}</h5></a>
					<h6>{{$author->Books}} выпущенные книги</h6>
				</div>


			@endforeach
		</div>
	</div>
</div>


@endsection
<style>
	.authors{
		padding:100px 0px;
	}
	img:hover{
		transform: scale(1.1);
		transition: 1s ease;

	}
	.image_frame{
		width: 100%;
		overflow: hidden;
	}
	.authors h5{
		font-size: 18px;
    	font-weight: 700;
    	font-family: Merriweather,serif;
    	margin-bottom: 10px;
    	color:#000;
	}
	.authors a:hover{
		text-decoration: none;
	}
	.authors h6{
		    font-family: Muli,sans-serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.6;
    color: #666;

	}
	.authors .col-lg-3 img{
		width: 100%;

	}
	section .content{
		padding:100px 0px;
	}
	.authors .col-lg-3{
		text-align: center;
	}
</style>