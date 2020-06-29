@extends('layouts.default')

@section('extra_content')

<h2><p>Articles Index</p></h2>
<!-- Button trigger modal -->
<a class="btn btn-primary btn-md m-1" href="/admin/articles/create">Add Article</a>

<hr/>
<div style="width: 100px; height: 50px; float: left;">
    <nav aria-label="Page navigation example">
        <div style=" width: 250px; display: inline-block;">
            <ul class="pagination" style="width: 250px;">
                <li class="{{!$pagination['prev_page_url'] ? 'disabled' : ''}} page-item"><a
                            class="page-link"
                            href="{{$pagination['prev_page_url']}}">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{
                                $pagination['current_page']}} of {{ $pagination['last_page'] }}</a></li>
                <li class="{{!$pagination['next_page_url'] ? 'disabled' : ''}} page-item" ><a
                            class="page-link"
                            href="{{$pagination['next_page_url']}}">Next</a></li>
            </ul>
        </div>
    </nav>
</div>



<table id="example1" class="table shadow p-3 mb-5 bg-white rounded">
    <thead class="thead-dark " >
        <tr class="row" >
            <th class="col-sm-1" scope="col">#</th>
            <th class="col-sm-1" scope="col">Title</th>
            <th class="col-sm-4" scope="col">Brief</th>
            <th class="col-sm-1" scope="col">Author</th>
            <th class="col-sm-1" scope="col">Preview count</th>
            <th class="col-md-3" scope="col">Options</th>
            <th class="col-sm-1"></th>
        </tr>
  </thead>
    <tbody>
    <tr class="row">
        <td class="col-sm-1"><input type="number" name="id" class="col-sm-12"  /></td>
        <td class="col-sm-1"><input type="text" name="title" class="col-sm-12" /></td>
        <td class="col-sm-4"><input type="text" name="brief" class="col-sm-12" /></td>
        <td class="col-sm-1"><input type="text" name="author" class="col-sm-12" /></td>
        <td class="col-sm-1"><input type="number" name="preview_count" class="col-sm-12" /></td>
        <td class="col-md-3" ></td>
    </tr>
    @foreach($articles as $article)
        <tr class="row">
            <td class="col-sm-1">{{ $article->id }}</td>
            <td class="col-sm-1">{{ $article->title }}</td>
            <td class="col-sm-4">{{ $article->brief }}</td>
            <td class="col-sm-1">{{ $article->author->name }}</td>
            <td class="col-sm-1">{{ $article->preview_count }}</td>
            <td class="col-md-3">
                <a class="btn btn-success" href="articles/view/{{$article->id}}">View</a>
                <a class="btn btn-warning" href="articles/edit/{{$article->id}}">Edit</a>
                <a class="btn btn-danger" href="articles/delete/{{$article->id}}">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop