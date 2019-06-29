@auth @php $admin = "admin" @endphp @endauth
@guest @php $admin = "" @endphp @endguest
@foreach($images as $image)
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <img class="lazyload blur-up image {{ $admin }}" 
             src="{{  url('/thumbs/' .$image->name) }}" 
             data-src="{{  url('/images/' .$image->name) }}"
             id="{{ $image->id}}" 
             data-category="{{ $image->categoryName }}">

</div>
@endforeach