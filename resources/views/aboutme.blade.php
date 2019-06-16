@extends('layouts.app')
@section('stylesheet')
    <style>
        .navbar{
            margin:0;
        }
        .title h2{
            text-align: center;
        }
        .jumbotron{
            background: rgba(127,0,0,0.5);
            color: white;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="jumbotron title">
            <h2 class="display-4">About me</h2>
    </div>
    <div class="container" style="text-align:center">
            <iframe src="{{  url('/images/cv.pdf') }}" width="80%" style="height:200vh"></iframe>
    </div>
@endsection

@section('script')
@endsection