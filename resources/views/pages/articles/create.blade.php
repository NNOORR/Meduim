@extends('layouts.default')

@section('extra_content')

<h1>Add a New Article</h1>
<form action="/admin/articles/store" method="post" enctype="multipart/form-data">
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
        <textarea name="description" value="{{ isset($article) ? $article->description : ''}}" class="form-control" id="inputDescription" placeholder="Enter article description" required></textarea>
    </div>

    <div class="form-group">
        <label for="authorControlSelect">Author</label>
        <select class="form-control" id="authorControlSelect" name="author_id">
            <option value="">-</option>
            @foreach($authors as $author)
            <option value="{{$author->id}}" {{ isset($article) && $author->name == $article->author->name ? 'selected' : ''}}" >{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="imagesFormControlFile1">Article images</label>
        <input type="file" name="articleImgs[]" class="form-control-file" multiple id="imagesFormControlFile1">
    </div>
    <div class="form-group">
        <label for="inputTags">Tags</label>
        <input type="text" name="tags" value="" class="form-control" id="inputBrief"  placeholder="Enter some tags, separate them by comma" required>
    </div>

    <div class="row">
        <div class="col-md-12">

            <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here..">
                <option value="" disabled selected>Choose your country</option>
                <option value="1">USA</option>
                <option value="2">Germany</option>
                <option value="3">France</option>
                <option value="4">Poland</option>
                <option value="5">Japan</option>
            </select>
            <label class="mdb-main-label">Label example</label>
            <button class="btn-save btn btn-primary btn-sm">Save</button>

        </div>
    </div>


    <button type="submit" class="btn btn-primary m-5">Submit</button>
</form>

@stop

<!-- Scripts-->
<script src="{{  asset('js/jquery.min.js')}}"></script>


