@extends('layouts.app')
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
    </style>
@endsection

@section('content')
    <div class="jumbotron title">
            <h2 class="display-4">About me</h2>
    </div>
    <div class="" style="text-align:center">
            <iframe src="{{  url('/images/cv.pdf') }}" width="100%" style="height:160vh;"></iframe>
    </div>
@endsection

@section('script')
@endsection