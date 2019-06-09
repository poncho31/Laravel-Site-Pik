@extends('layouts.app')
    @section('content')
        @slot('title')
            @lang('Ajouter une image')
        @endslot
        <div class="container">
                <form method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row{{ $errors->has('image') ? ' is-invalid' : '' }}">        
                        
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="custom-file">
                                {{-- <label class="custom-file-label" for="image"></label> --}}
                                <input type="file" id="image" name="image[]" class="{{ $errors->has('image') ? ' is-invalid ' : '' }}custom-file-input" required multiple="multiple">
                                @if ($errors->has('image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <label for="category_id">@lang('Catégorie')</label>
                            <select id="category_id" name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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