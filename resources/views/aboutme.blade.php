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
            text-align: center;
            background: rgba(55,56,45,0.3);
            color: white;
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