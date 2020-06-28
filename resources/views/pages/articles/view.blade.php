@extends('layouts.default')

@section('extra_content')
<style>
 .carousel-item img, .carousel {
    max-height: 250px;
    max-width: 600px;
    min-width: 600px;
    min-height: 250px;
}
    .carousel {
        margin: 0 auto;
    }

</style>

         <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
             <ol class="carousel-indicators">
                 @foreach($article->attachments as $key => $attachment)
                 <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                 @endforeach
             </ol>
             <div class="carousel-inner">
                 @foreach($article->attachments as $key => $attachment)
                 <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                     <img src="{{Illuminate\Support\Facades\Storage::url($attachment->path)}}" class="d-block w-100" alt="...">
                 </div>
                 @endforeach
             </div>
             <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="sr-only">Next</span>
             </a>
         </div>

<hr/>
<div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 65rem;">
    <div class="card-body">
        <h3 class="card-title" style="font-weight: bolder;">{{$article->title}}</h3>
        <p class="card-text">{{$article->description}}</p>
        <a href="/admin/articles" class="btn btn-primary">Go Back</a>
        <hr/>
        @foreach($article->tags as $key => $tag)
            <span class="{{ $labelClasses[$faker->numberBetween(0, 100) % count($labelClasses)]}}">{{ $tag->name }}</span>
        @endforeach
    </div>
</div>


@stop