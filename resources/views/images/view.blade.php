@extends('layouts.app')
@auth @php $admin = "admin" @endphp @endauth
@guest @php $admin = "" @endphp @endguest
@section('stylesheet')
<style>
    #gallery {
        /* -webkit-column-count: 4;
        -moz-column-count: 4;
        column-count: 4;
        -webkit-column-width: 25%;
        -moz-column-width: 25%;
        column-width: 25%; */
    }
    /* @media (max-width 1000px){
        #gallery {
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
            -webkit-column-width: 25%;
            -moz-column-width: 25%;
            column-width: 25%;
        }
    } */
    #gallery .image {
        -webkit-transition: all 750ms ease;
        transition: all 750ms ease; 
        cursor: pointer;
        border-radius: 10px;
        box-shadow: -1px 1px 1px 1px #7F0000, 1px 0px 0px 0px black;
        -webkit-filter: grayscale(60%);
        filter: grayscale(60%);
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out;
        margin: 10px;
    }
    #gallery .image:hover {
        -webkit-filter: grayscale(0);
        filter: grayscale(0);
        /* transform:scale(1.001); */
    }
    @media screen and (max-width: 600px){
            #gallery .image{
                -webkit-filter: grayscale(0%);
                filter: grayscale(0%);
            }
        }
    #bar{
        margin-bottom: 30px;
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
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
            -webkit-column-width: 50%;
            -moz-column-width: 50%;
            column-width: 50%;
        }
    }
    @media (max-width: 650px) {
        #gallery {
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
            /* -webkit-column-width: 100%;
            -moz-column-width: 100%;
            column-width: 100%; */
        }
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
    /* height: 100%;  */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: auto;
        /* max-height: 100%; */
    }

    .modal-content img{
        max-height: 100%;
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
    max-height: 100%;
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
            /* width: 100%; */
            /* max-height: 100%; */
        }
    }
    .navbar{
        margin: 0;
    }
    .title h2{
        font-weight:900;
        text-transform: uppercase;
    }
    .jumbotron{
        background: rgba(127,0,0,0.5);
        color: white;
        text-align: center;
    }
    /* .modal-content{transition:all 0.5 ease-in-out;} */
    .zoom{
        height: auto;
        width: 100%;
        position: absolute;
        object-fit:cover;
        max-height: 1000%;
        
    }
    .btn{
        font-weight: bold;
        background-color: #7F0000;
        color: white;
    }
    .btn:hover, .btn:focus{color: white;}
</style>
@endsection

@section('content')
<div class="jumbotron title">
        <h2 class="display-4">{{ ucfirst(trans($imageSection)) }} &#8212; {{ ucfirst(trans($imageProject)) }}</h2>
</div>
<div class="container">
    <div class="category">
        <ul id="bar">
            <button class="btn btn-category" value='all'>ALL</button>
            @foreach($categories as $category)
                <button class="btn btn-category"  value="{{$category->name}}">{{$category->name}}</button>
            @endforeach
        </ul>
    </div>

    <div id="gallery" class="row images endless-pagination text-center" data-next-page="{{ $images->nextPageUrl() }}">
        @foreach($images as $image)
            @if(pathinfo($image->name,PATHINFO_EXTENSION) == 'pdf')
                <a href="{{ url('/images/'.$image->name) }}"></a> 
                <iframe src="{{ url('/images/'.$image->name) }}" 
                    style="width:100%;height:100vh;"
                    ></iframe>
            @else
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                {{-- <picture> --}}
                    {{-- <source media = "(min-width:420px)"
                            data-srcset="{{  url('/images/' .$image->name) }}">
                    <source media = "(max-width:420px)"
                            data-srcset = "{{  url('/thumbs/' .$image->name) }}" > --}}

                    <img class="lazyload blur-up image {{ $admin }}" 
                        src="{{  url('/thumbs/' .$image->name) }}" 
                        data-src="{{  url('/images/' .$image->name) }}"
                        id="{{ $image->id}}"
                        data-category="{{ $image->categoryName }}">
                        {{-- </picture> --}}
                </div>
            @endif
        @endforeach
    </div>
</div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
      </div>
@endsection

@section('script')
<script>

    $(function() {
        $(window).scroll(fetchImage);
        $('.btn-category').on('click', function(){
            let category = $(this).val();
            
            $('.image').each(function(i, v){
                let imgCategory = $(this).data('category');
                if(category == 'all'){
                    $('.image').css('display', 'block');
                }
                else if(category != imgCategory){
                    $(this).css('display', 'none');
                }
                else{
                    $(this).css('display', 'block');
                }
            });
        });

        function fetchImage(){
            var page = $('.endless-pagination').data('next-page');
            if(page !== null){
                clearTimeout($.data(this, 'scrollCheck'));
                $.data(this, 'scrollCheck', setTimeout(function(){
                    var scrollPositionForImageLoad = $(window).height() + $(window).scrollTop() + 100;
                    if(scrollPositionForImageLoad >= $(document).height() && page != ""){
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
            $('#myModal').css('display', 'block').css('z-index', 100);
            $('#img01').attr('src', $(this).attr('src'));
            $('#caption').html($(this).attr('alt'));
        });
        $('.modal').on('click', function(e){
            if(e.target.id != 'img01'){
                $('#myModal').css('display', 'none');
            }
        });


        $('body').on('click','.admin', function() {
            var id = $(this).attr('id');
            // window.location ="localhost:8000/image/"+id;
            if(confirm('Are you sure you want delete this image ?')){
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                $.ajax({
                    type: 'DELETE',
                    url: "http://localhost:8000/image/"+id
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
    });

    $('#img01').on('click', function(){
        $(this).toggleClass('zoom');
    });
</script>
@endsection