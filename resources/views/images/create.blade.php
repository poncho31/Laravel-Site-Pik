@extends('layouts.app')
    @section('content')
        @slot('title')
            @lang('Ajouter une image')
        @endslot
        <div class="container mt-5">
                <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row{{ $errors->has('image') ? ' is-invalid' : '' }}">        
                        {{-- SECTION --}}
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="category_section">@lang('Section')</label>
                            <select id="category_section" name="category_section" class="form-control">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->section }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="category_section_new" id="category_section_new" class="form-control" placeholder="new section">
                        </div>
                        {{-- PROJECT --}}
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="category_project">@lang('Project')</label>
                            <select id="category_project" name="category_project" class="form-control">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->project }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="category_project_new" id="category_project_new" class="form-control"  placeholder="new project">
                        </div>
                        {{-- CATEGORY --}}
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="category_name">@lang('Category')</label>
                            <select id="category_name" name="category_name" class="form-control">
                                <option value=""></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="category_name_new" id="category_name_new" class="form-control"  placeholder="new category">
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