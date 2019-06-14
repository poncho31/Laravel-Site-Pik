@extends('layouts.app')
@auth @php $admin = "admin" @endphp @endauth
@guest @php $admin = "" @endphp @endguest
@section('stylesheet')
    <style>
    .navbar{
        margin:0;
    }
    .title h2{
        text-align: center;
    }
    .jumbotron{
        text-align: center;
        background: rgba(55,132,45,0.3);
        color: white;
    }
    .image-title{
        font-weight: bold;
        color: #7F0000;
        text-decoration: underline;
        text-align: center;
    }
    .image-content{
        font-family: "Raleway", sans-serif;
    }

    </style>
@endsection


@section('content')
<div class="jumbotron title">
        <h2 class="display-4">In progress</h2>
</div>
<div class="container">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-3 col-sm-4 col-xs-6 {{ $admin }}" style="min-height: 50vh; text-align:justify" id="{{ $article->id }}" >
                    <h4 class="image-title">{{ $article->name }}</h4>
                    <p class="image-content">
                    <img src="{{ asset('images/'.$article->image) }}" alt="" width="50%" style="float:{{ $article->imagePosition}};margin:5px;">
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
            var val = $(this).attr('id');
            alert(val);
        })
    </script>
@endsection