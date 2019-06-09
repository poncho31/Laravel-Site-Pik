@foreach($images as $image)
{{-- <img category="" class="" src="{{  url('/thumbs/' .$image->name) }}" alt="{{ $image->name }}" > --}}
{{-- <a href="{{  url('/images/' .$image->name) }}"> --}}
    <picture>
        <source media = "(min-width:420px)"
                data-srcset="{{  url('/images/' .$image->name) }}">
        <source media = "(max-width:420px)"
                data-srcset = "{{  url('/thumbs/' .$image->name) }}" >
        <img class="lazyload blur-up image" 
             src="{{  url('/thumbs/' .$image->name) }}" 
             data-src="{{  url('/images/' .$image->name) }}" >
    </picture>
{{-- </a> --}}
@endforeach