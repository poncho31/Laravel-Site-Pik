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
            background: rgba(0,127,0,0.7);
            color: white;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="jumbotron title">
            <h2 class="display-4">Ajouter un article</h2>
    </div>
    <div class="container" style="text-align:center">
            <form method="POST" action="{{ route('in-progress.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row{{ $errors->has('image') ? ' is-invalid' : '' }}"> 
                    {{-- TITRE ARTICLE --}}
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="title">@lang('title')</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="new title">
                    </div>
                    {{-- CONTENU ARTICLE --}}
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for="article">@lang('article')</label>
                        <textarea class="form-control" id="article" name="article" rows="7"></textarea>
                    </div>
                </div><br><br>
                {{-- POSITION DE L IMAGE --}}
                <label for="imagePosition">Image position</label><br><br>
                <div class="col-md-12 col-sm-12 col-xs-12" style="display:flex;">
                    <div class="imagePosition">
                        <label><input type="radio" name="imagePosition" value="left">Left</label>
                    </div>
                    <div class="imagePosition">
                        <label><input type="radio" name="imagePosition" value="right">Right</label>
                    </div>
                </div>
                {{-- ADD IMAGES --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="custom-file">
                            <label class="custom-file-label" for="image"></label>
                            <input type="file" id="image" name="image[]" class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input">
                            @if ($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <input type="submit" value="submit" class="btn btn-primary">
                    </div>
                </div>
                {{-- @include('partials.form-group', [
                    'title' => __('Description (optionnelle)'),
                    'type' => 'text',
                    'name' => 'description',
                    'required' => false,
                    ])    --}}
                    {{-- <div class="form-control-file"></div> --}}
                
            </form>
    </div><br><br>
@endsection

@section('script')
@endsection