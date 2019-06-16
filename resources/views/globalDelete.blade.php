@extends('layouts.app')
@section('stylesheet')
    <style>
        .jumbotron{
            background: rgba(0,127,0,0.7);
            color: white;
            text-align: center;
        }
    </style>
@endsection
    @section('content')
        @slot('title')
            @lang('Ajouter une image')
        @endslot
<div class="jumbotron title text-center">
        <h2 class="display-4">Supprimer des sections / projets / catégories</h2>
</div>
        <div class="container">
                <form method="POST" action="{{ route('delete') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row{{ $errors->has('image') ? ' is-invalid' : '' }}">        
                        {{-- SECTION --}}
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="section">@lang('Section')</label>
                            <select id="section" name="section" class="form-control">
                                <option value=""></option>
                                @foreach($sections as $section)
                                    {{ $section->id }}-{{ $section->name }}
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- PROJECT --}}
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="project">@lang('Project')</label>
                            <select id="project" name="project" class="form-control">
                                <option value=""></option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- CATEGORY --}}
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="category">@lang('Category')</label>
                            <select id="category" name="category" class="form-control">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-6">
                                <label for="role" class="col-md-4 control-label">All</label>
                                <input id="role" type="checkbox" class="" name="all" value="all">
                            </div>
                    </div><br><br>


                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <input type="submit" value="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
        </div>
    @endsection            
@section('script')

@endsection