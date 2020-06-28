@extends('layouts.default')

@section('extra_content')

<h1>{{ isset($article) ? 'Edit Article ' . $article->id : 'Add a New Article'}}</h1>
<form action="/admin/articles/{{ isset($article) ? 'update/' . $article->id : 'store' }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="inputTitle">Title</label>
        <input type="text" name="title" value="{{ isset($article) ? $article->title : ''}}"  class="form-control" id="inputTitle" placeholder="Enter article title" required>
    </div>
    <div class="form-group">
        <label for="inputBrief">Brief</label>
        <input type="text" name="brief" value="{{ isset($article) ? $article->brief : ''}}" class="form-control" id="inputBrief"  placeholder="Enter article brief" required>
    </div>
    <div class="form-group">
        <label for="inputDescription">Description</label>
        <textarea name="description" class="form-control" id="inputDescription" placeholder="Enter article description" required>{{ isset($article) ? $article->description : ''}}
        </textarea>
    </div>

    <div class="form-group">
        <label for="authorControlSelect">Author</label>
        <select class="form-control" id="authorControlSelect" name="author_id">
            <option value="">-</option>
            @foreach($authors as $author)
            <option value="{{$author->id}}" {{ isset($article) && $author->name == $article->author->name ? 'selected=true' : ''}}" >{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="imagesFormControlFile1">Article images</label>
        <input type="file" name="articleImgs[]" class="form-control-file" multiple id="imagesFormControlFile1">
    </div>
    <div class="form-group">
        <label for="inputTags">Tags</label>
        <input type="text" name="tags" value="{{ isset($tags) ? $tags : ''}}" class="form-control" id="inputBrief"  placeholder="Enter some tags, separate them by comma" required>
    </div>


    <button type="submit" class="btn btn-primary ">Submit</button>
</form>

@stop

<!-- Scripts-->
<script src="{{  asset('js/jquery.min.js')}}"></script>


