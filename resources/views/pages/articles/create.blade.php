@extends('layouts.default')

@section('extra_content')

<h1>Add a New Article</h1>
<form action="/admin/articles/store" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" name="title" value="{{ isset($article) ? $article->title : ''}}"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter article title" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Brief</label>
        <input type="text" name="brief" value="{{ isset($article) ? $article->brief : ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter article brief" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea name="description" value="{{ isset($article) ? $article->description : ''}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter article description" required></textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Author</label>
        <select class="form-control" id="exampleFormControlSelect1" name="author_id">
            <option value="">-</option>
            @foreach($authors as $author)
            <option value="{{$author->id}}" {{ isset($article) && $author->name == $article->author->name ? 'selected' : ''}}" >{{ $author->name }}</option>
            @endforeach
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@stop
