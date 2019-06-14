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
            background: url('images/background.jpg');
            background-size: cover;
            background-position: 100;
            -webkit-animation-name: backgrAnim;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -webkit-animation-iteration-count: 1;
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
            position: absolute;
            color: white;
            text-shadow: 1px 1px 1px black;
            left:60%;
        }
        .row{
            padding: 10px;
            text-align: center;
            /* height: 50vh; */
        }.row img{
            max-width: 20vw;
            padding: 5px;
            background-color: white;
            /* border: solid 5px black; */
            /* max-height: 40vh; */
        }
        .panel{
            background: url('images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: 100;
            border-color: transparent;
        }

        .panel-heading h3{
            text-shadow: 2px 2px 2px gray, 1px 1px 1px black;
            color: whitesmoke;
        }
        .panel-heading{
            background: whitesmoke;
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
        
            <div class="panel-heading"><h3>Last projects</h3></div>
                <div class="row">
                    @foreach($lastCollection as $collection)
                        <div class="col-md-3 col-sm-3 col-xs-4">
                            <h4 class="image-title">Titre 2</h4>
                            <a href="{{ url("$collection->sectionName/$collection->projectName") }}">
                                <img src="{{ asset('images/'.$collection->name) }}" alt="" width="100%">
                            </a>
                        </div>
                    @endforeach
                </div>
            
            <div class="panel-heading"><h3>Last Collection</h3></div>
                <div class="row">
                    @foreach($lastProject as $project)
                            <div class="col-md-3 col-sm-3 col-xs-4">
                                <h4 class="image-title">Titre 2</h4>
                                <a href="{{ url("$project->sectionName/$project->projectName") }}">
                                    <img src="{{ asset('images/'.$project->name) }}" alt="" width="100%">
                                </a>
                            </div>
                    @endforeach
                </div>

            <div class="panel-heading"><h3>Latest news on Instagram</h3></div>
            
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <h4 class="image-title">Titre 2</h4>
                    <img src="{{ asset('images/womenswear.jpg') }}" alt="" width="100%">
                </div>
                <div class="col-md-3 col-sm-4">
                    <h4 class="image-title">Titre 2</h4>
                    <img src="{{ asset('images/womenswear.jpg') }}" alt="" width="100%">
                </div>
                <div class="col-md-3 col-sm-4">
                        <h4 class="image-title">Titre 2</h4>
                        <img src="{{ asset('images/womenswear.jpg') }}" alt="" width="100%">
                    </div>
            </div><br>
        </div>
    </div>

</div>
@endsection

