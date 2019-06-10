@extends('layouts.app')

@section('stylesheet')
<style>
    #gallery {
        -webkit-column-count: 4;
        -moz-column-count: 4;
        column-count: 4;
        -webkit-column-width: 25%;
        -moz-column-width: 25%;
        column-width: 25%;
    }
    #gallery .image {
        -webkit-transition: all 750ms ease;
        transition: all 750ms ease; 
        cursor: pointer;
    }
    #gallery .image {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    #gallery img{
        /* display: block; */
        max-width: 100%;
        margin-bottom: 15px;
        -webkit-animation: fadeInFromNone 1.5s ease-in-out;
        -moz-animation: fadeInFromNone 1.5s ease-in-out;
        -o-animation: fadeInFromNone 1.5s ease-in-out;
        animation: fadeInFromNone 1.5s ease-in-out;
    }

    @-webkit-keyframes fadeInFromNone {
        0% {
            display: none;
            opacity: 0;
        }

        1% {
            display: block;
            opacity: 0;
        }

        100% {
            display: block;
            opacity: 1;
        }
    }

    @media (max-width: 1000px){
        #gallery {
            -webkit-column-count: 3;
            -moz-column-count: 3;
            column-count: 3;
            -webkit-column-width: 33%;
            -moz-column-width: 33%;
            column-width: 33%;
        }
    }
    @media (max-width: 650px) {
        #gallery img{
            max-width: 100%;
        }
        .btn.filter {
            padding-left: 1.1rem;
            padding-right: 1.1rem;
        }
    } 
	.blur-up {
		-webkit-filter: blur(5px);
		filter: blur(5px);
		transition: filter 400ms, -webkit-filter 400ms;
	}

	.blur-up.lazyload {
		-webkit-filter: blur(0);
		filter: blur(0);
    }
        
    /* Style the Image Used to Trigger the Modal */
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
    }

    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
    }

    @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
    position: absolute;
    top: 40px;
    right: 35px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
    }

    .close:hover,
    .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
    }
    .navbar{
        margin: 0;
    }
    .title h2{
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="jumbotron title">
        <h2 class="display-4">{{ ucfirst(trans($imageSection)) }} &#8212; {{ ucfirst(trans($imageProject)) }}</h2>
        {{-- <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>  --}}
</div>
<div class="container">

    <div class="category">
        <ul id="bar">
            <button class="btn btn-primary btn-category" selected='selected' value=''>ALL</button>
            @foreach($categories as $category)
                <button class="btn btn-primary btn-category" selected='' value="{{$category->name}}">{{$category->name}}</button>
            @endforeach
        </ul>
    </div>

    <div id="gallery" class="images endless-pagination" data-next-page="{{ $images->nextPageUrl() }}">
        @foreach($images as $image)
            {{-- <img category="" class="" src="{{  url('/thumbs/' .$image->name) }}" alt="{{ $image->name }}" > --}}
            {{-- <a href="{{  url('/images/' .$image->name) }}"> --}}
                <picture>
                    <source media = "(min-width:420px)"
                            data-srcset="{{  url('/images/' .$image->name) }}">
                    <source media = "(max-width:420px)"
                            data-srcset = "{{  url('/thumbs/' .$image->name) }}" >
                    <img class="lazyload blur-up image" 
                         src="{{  url('/thumbs/' .$image->name) }}" 
                         data-src="{{  url('/images/' .$image->name) }}"
                         id="{{ $image->id}}" >
                </picture>
            {{-- </a> --}}
        @endforeach
    </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>
      
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
      
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
      </div>
@endsection

@section('script')
<script>

    $(function() {
        $(window).scroll(fetchImage);
        var category = "";
        $('.btn-category').on('click', function(){
            category = $(this).val();
            var selected = $(this).attr('selected');
            $('.btn-category').removeAttr('selected');
            $(this).attr('selected', 'selected');
            var page = $('.endless-pagination').data('next-page') + "?category="+category;
            $.get(page, function(data){
                $('.images').html(data.images);
                $('.endless-pagination').data('next-page',  data['next-page']);
            })
        });

        function fetchImage(){
            var page = $('.endless-pagination').data('next-page') + "?category="+category;
            console.log(page);
            if(page !== null){
                clearTimeout($.data(this, 'scrollCheck'));
                $.data(this, 'scrollCheck', setTimeout(function(){
                    var scrollPositionForImageLoad = $(window).height() + $(window).scrollTop() + 100;
                    if(scrollPositionForImageLoad >= $(document).height()){
                        $.get(page, function(data){
                            $('.images').append(data.images);
                            $('.endless-pagination').data('next-page',  data['next-page']);
                        })
                    }
                }, 100))
            }
        }

        // modal image
        $('body').on('click','.image', function(){
            $('#myModal').css('display', 'block');
            $('#img01').attr('src', $(this).attr('src'));
            $('#caption').html($(this).attr('alt'));
        });
        $('.close').on('click', function(){
            $('#myModal').css('display', 'none');
        });
        // $('html').on('click', function(){
        //     console.log($(this));

        //     if(!($(this).hasClass('lazyload'))){
        //         $('#myModal').css('display', 'none');
        //     }
        // });
    });


</script>
@endsection