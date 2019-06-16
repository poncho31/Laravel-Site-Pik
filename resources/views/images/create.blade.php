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
<div class="jumbotron title">
        <h2 class="display-4">Ajouter des images par section / projet / catégorie</h2>
</div>
        <div class="container">
                <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
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
                            <input type="text" name="section_new" id="section_new" class="form-control" placeholder="new section">
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
                            <input type="text" name="project_new" id="project_new" class="form-control"  placeholder="new project">
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
                            <input type="text" name="category_new" id="category_new" class="form-control"  placeholder="new category">
                        </div>
                    </div><br><br>


                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="custom-file">
                                <label class="custom-file-label" for="image"></label>
                                <input type="file" id="image" name="image[]" class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required multiple="multiple">
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
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
        </div>
    @endsection            
@section('script')

@endsection