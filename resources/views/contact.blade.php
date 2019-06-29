@extends('layouts.app')
@section('stylesheet')
    <style>
        .navbar{
            margin:0;
        }
        .jumbotron{
            text-align: center;
            background: rgba(127,0,0,0.5);
            color: white;
        }
        .title h2{
            font-weight:900;
            text-transform: uppercase;
        }
        .container{
            padding: 10%;
            padding-top: 0;
        }
        .btn{
            background-color: rgb(127,0,0);
            color: white;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
<div class="jumbotron title">
        <h2 class="display-4">Contact</h2>
</div>
<div class="container">
    <div class="form">


            {!! Form::open(['route'=>'contact']) !!}
        
                {{-- NAME --}}
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::label('Name:') !!}
                    {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Enter Name']) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div>
        
                {{-- EMAIL --}}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('Email:') !!}
                    {!! Form::text('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Enter Email']) !!}
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                </div>
        
                {{-- OBJECT --}}
                <div class="form-group {{ $errors->has('object') ? 'has-error' : '' }}">
                    {!! Form::label('Subject:') !!}
                    {!! Form::text('object', old('object'), ['class'=>'form-control', 'placeholder'=>'Enter subject']) !!}
                    <span class="text-danger">{{ $errors->first('object') }}</span>
                </div>

                {{-- MESSAGE --}}
                <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                    {!! Form::label('Message:') !!}
                    {!! Form::textarea('message', old('message'), ['class'=>'form-control', 'placeholder'=>'Enter Message']) !!}
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                </div>
        
        
                <div class="form-group">
                    <button class="btn float-right">Contact me</button>
                </div>
            {!! Form::close() !!}
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>
    @endif
</div>
@endsection

@section('script')
@endsection