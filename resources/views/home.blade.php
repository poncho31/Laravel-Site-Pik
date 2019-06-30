@extends('layouts.app')
@section('stylesheet')
    <style>
        /* header{
            position: absolute;
            min-width: 85vh;
            margin-bottom: 85vh;
        } */
        header.HEADER{
            height: 95vh;
            width: 100%;
            display: block;
            min-height: 80vh;
            position: absolute;
            top: 0;
            background-attachment: fixed;
        }
            .header-title{
                padding: 10% 18%;
                color: white;
                position: relative;
                top: 80px;
                
            }

			/* // text-shadow: 3px 3px 5px black;
			// position: fixed; */
			.header-title h1{
				text-shadow: 1px 2px 2px black;
				font-size: 5em;
				-webkit-animation-name: titleH1Anim;
			    -webkit-animation-duration: 1s;
			    -webkit-animation-timing-function: ease;
			    -webkit-animation-iteration-count: 1;
                font-family: "Raleway", sans-serif;
                font-weight: bold;
			}
			.header-title h2{
				text-shadow: 1px 1px 1px black;
				text-indent: 10%;
				color: #7F0000;
				-webkit-animation-name: titleH2Anim;
			    -webkit-animation-duration: 1s;
			    -webkit-animation-timing-function: ease;
			    -webkit-animation-iteration-count: 1;
            }
            @keyframes backgrAnim {
                from{background-position: 50% 50%;}
                to{background-position: 100;}
            }
            @keyframes titleH2Anim {
		            from {color: transparentize(#fff, 1);}
		            50% {color: transparentize(#fff, 0);}
		            to {color: transparentize(black, 0);}
            }
			@keyframes titleH1Anim {
		        from {color: transparentize(black, 1);}
		        50% {color: transparentize(black, 0);}
		        to {color: transparentize(#fff, 0);}
		    }
        .navbar{
            margin: 0;
        }
        .home-menu{
            position: relative;
            /* min-width: 85vh; */
            margin-top: 80vh;
        }
        .image-title{
            /* display: none; */
            position: relative;
            font-family: "Raleway", sans-serif;
            color: white;
            /* font-weight: bolder; */
            text-shadow: 1px 1px 2px #7F0000, -1px -1px 1px white;
            background: rgba(127, 0, 0, 0.5);
            top: 103%;
            left:29%;
            width: 70%;
            border: double white 5px;
            /* left:50%; */
            /* border: solid 5px #7F0000; */
            /* top: 0;
            right: 0; */
            padding: 4%;
            z-index: 100;

        }
        .row{
            padding: 10px;
            
            /* text-align: center; */
            /* height: 50vh; */
        }
        .panel-default{
            background-color: transparent;
        }
        .row img{
            /* width: 20vw; */
            padding: 5px;
            background-color: white;
            object-fit: cover;
            /* border: solid 5px black; */
            /* max-height: 40vh; */
        }
        .panel{
            border-color: transparent;
        }

        .panel-heading h3{
            /* text-shadow: 2px 2px 2px gray, 1px 1px 1px black; */
            /* color: white; */
            font-weight: bold;
        }
        .panel-default > .panel-heading{
            background-color: whitesmoke;
            box-shadow: 1px 2px 4px 1px black;
        }

        .image{
            height: 40vh;
            margin-bottom: 20px;
        }
        .image img {
            display: block;
            width: 100%;
            max-height: 100%;
            -webkit-filter: grayscale(60%);
            filter: grayscale(60%);
            -webkit-transition: .3s ease-in-out;
            transition: .3s ease-in-out;
            z-index: 0;
            border-radius: 10px;
            box-shadow: -1px 1px 1px 1px #7F0000, 1px 0px 0px 0px black;
            /* height: auto; */
            height: 40vh;
            object-fit: cover;
        }
        .image img:hover{
            -webkit-filter: grayscale(0);
            filter: grayscale(0);
            transform:scale(1.05);
        }

        
        .row{
            margin-bottom:50px;
        }
    </style>
@endsection
@section('content')
<header class="HEADER">
    <div class="header-title">
        <h1>Pik Pinchart</h1>
        <h2>Womanswear designer</h2>
    </div>
</header>


<div class="container home-menu">
    <div class="panel panel-default">
        
            <div class="panel-heading text-center"><h3>Last Collections</h3></div>
            <div class="panel-body">
                    <div class="row">
                            @foreach($lastCollection as $collection)
                                <div class="col-md-3 col-sm-3 col-xs-12 image">
                                    <h4 class="image-title">{{ ucfirst($collection->sectionName) }}</h4>
                                    <a href="{{ url("$collection->sectionName/$collection->projectName") }}">
                                        <img src="{{ asset('images/'.$collection->name) }}" alt="" width="100%">
                                    </a>
                                </div>
                            @endforeach
                        </div>
            </div>
    </div>
    <div class="panel panel-default">        
            <div class="panel-heading text-center"><h3>Last Projects</h3></div>
            <div class="row">
                @foreach($lastProject as $project)
                        <div class="col-md-3 col-sm-3 col-xs-12 image">
                            <h4 class="image-title">{{ ucfirst($project->projectName) }}</h4>
                            <a href="{{ url("$project->sectionName/$project->projectName") }}">
                                <img src="{{ asset('images/'.$project->name) }}" alt="" width="100%">
                            </a>
                        </div>
                @endforeach
            </div><br>
    </div>
    <div class="panel panel-default">  
            <div class="panel-heading text-center"><h3>Latest news on Instagram</h3></div>
            <div class="row">
                @if($instagram != 404)
                    @foreach($instagram as $instaImg)
                            <div class="col-md-3 col-sm-3 col-xs-12 image">
                                <h4 class="image-title">
                                        #{{ ucfirst($instaImg['tags'][2]) }} 
                                </h4>
                                <a href="{{ $instaImg['link'] }}" target="_blank">
                                    <img src="{{ $instaImg['images']['low_resolution']['url'] }}" alt="" width="100%">
                                </a>
                            </div>
                    @endforeach
                @else
                    <div class="col-md-3 col-sm-3 col-xs-12 image text-center">
                        <p class="label label-default">
                            Pas de connexion internet
                        </p>       
                    </div>
                @endif
            </div><br>
        </div>
        </div>
    </div>

</div>
@endsection

@section('script')

@endsection