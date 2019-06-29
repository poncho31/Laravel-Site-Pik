@extends('layouts.app')
@auth @php $admin = "admin" @endphp @endauth
@guest @php $admin = "" @endphp @endguest
@section('stylesheet')
    <style>
    .navbar{
        margin:0;
    }

    .jumbotron{
        background: rgba(127,0,0,0.5);
        color: white;
        text-align: center;
    }
    .title h2{
        font-weight:900;
        text-transform: uppercase;
    }
    .image-title{
        font-weight: bold;
        color: #7F0000;
        text-align: center;
    }
    .image-content{
        /* font-family: "Raleway", sans-serif; */
        /* font-size: 1.2em; */
        background: rgba(255,255,255,0.3);
        border-radius: 5px;
        padding:10px;
        color: black;
    }

    @font-face {
        font-family: "oswald";
        src: url("/fonts/oswald.light.ttf") format("ttf");
    }

    p{
        font-size: 1.1em;
        color: #444;
        font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    }
    .image-content img{
        border: double 5px #7F0000;
        width: auto;
        height : auto;
        /* max-height: 100%; */
        max-width: 30%;
        object-fit:scale-down;
        /* display:block; */
    }
    .date{
        color: white;
        padding: 1%;
        font-size: 1em;
    }
    .label-default{
        background-color: #7F0000;
    }
    .container hr {
        height: 2px;
        color: #7F0000;
        background-color: #7F0000;
        width: 70%;
    }

    </style>
@endsection


@section('content')
<div class="jumbotron title">
        <h2 class="display-4">In progress</h2>
</div>
<div class="container">
        <div class="row">
            @if(!isset($articles[0]))
            <div class="text-center">
                <p class="label label-danger">No articles for the moment</p>
            </div>
            @endif
            @foreach($articles as $article)
                <div class="col-md-6 col-sm-6 col-xs-12 {{ $admin }}" style="min-height: 50vh; text-align:justify" id="{{ $article->id }}" >
                    <h3 class="image-title">{{ $article->name }}</h3>
                    <p class="pull-right date label label-default">{{ strftime("%A %d %B %G", strtotime($article->updated_at)) }}</p>
                    <hr>
                    <p class="image-content">
                        <img src="{{ asset('images/'.$article->image) }}" alt="" style="float:{{ $article->imagePosition}};margin:10px">
                        {{ $article->content }}
                    </p>
                </div>
            @endforeach
        </div>
        <div class="pagination" style="text-align:center;">
            {{ $links }}
        </div>
</div>
@endsection

@section('script')
    <script>
        $('body').on('click','.admin', function() {
            if (confirm('Are you sure you want to delete this article ?')) {
                var id = $(this).attr('id');
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                $.ajax({
                    type: 'DELETE',
                    url: "http://localhost:8000/in-progress/"+id
                })
                .done(function(e){
                    var httpStatus = e.code ==200 ? true : false;
                    if(httpStatus){
                        location.reload();
                    }
                    else{
                        alert(e['message']);
                    }
                })
                .fail(function(e){
                    alert(e);
                })
            }
        })
    </script>
@endsection