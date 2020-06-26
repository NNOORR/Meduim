@extends('layouts.default')

@section('extra_content')

<p>Articles Index</p>
<!-- Button trigger modal -->
<a class="btn btn-primary btn-lg" href="/admin/articles/create">Add Article</a>


<table id="example1" class="table table-bordered table-hover">
    <tr class="row">
        <td class="col-sm-1">#</td>
        <td class="col-sm-1">Title</td>
        <td class="col-sm-1">Brief</td>
        <td class="col-sm-3">Desc</td>
        <td class="col-sm-1">Author</td>
        <td class="col-sm-1">Preview count</td>
        <td class="col-md-3">Options</td>
    </tr>
    @foreach($articles as $article)
        <tr class="row">
            <td class="col-sm-1">{{ $article->id }}</td>
            <td class="col-sm-1">{{ $article->title }}</td>
            <td class="col-sm-1">{{ $article->brief }}</td>
            <td class="col-sm-3">{{ $article->description }}</td>
            <td class="col-sm-1">{{ $article->author->name }}</td>
            <td class="col-sm-1">{{ $article->preview_count }}</td>
            <td class="col-md-3">
                <a class="btn btn-success" href="articles/view/{{$article->id}}">View</a>
                <a class="btn btn-warning" href="articles/edit/{{$article->id}}">Edit</a>
                <a class="btn btn-danger" href="articles/delete/{{$article->id}}">Delete</a>
            </td>
        </tr>
    @endforeach
</table>
@stop
