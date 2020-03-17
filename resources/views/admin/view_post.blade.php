@extends('layouts.admin')

@section('content')
    <div class="col-lg-12">

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Создание категории постов</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-center">
        Создание поста
    </h2>
    <form action="{{route('admin.EditArticle')}}" class="text-left" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="path"> <br>
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <input type="text" class="form-control" name="title" placeholder="Название поста" value="{{$article->title}}"> <br>
        <input type="text" name="author" class="form-control m-b-20" placeholder="Введите имя автора" value="{{$article->author}}">
        <div name="text" class="text-left" style="text-align: left !important; height: 500px;" id="summernote">{!! $article->text !!}</div >

        <select name="cat_id"  id="" class="">

            @foreach($cats as $cat)
                <option value="{{$cat->id}}">
                    {{$cat->name}}

                </option>
            @endforeach
        </select> <br>
        <input type="submit" class="btn btn-primary m-t-10">

    </form>
    <style>
        .btn-group.bootstrap-select .btn.dropdown-toggle.btn-default{
            display: none;

        }
    </style>


    <script>
        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]


        });

        function sendFile(file, el) {
            var  data = new FormData();
            data.append("file", file);
            var url = '{{ route('admin.upload') }}';
            $.ajax({
                data: data,
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function(url2) {
                    el.summernote('insertImage', url2);
                }
            });
        }
    </script>
@endsection
