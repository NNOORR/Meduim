@extends('layouts.default')

@section('extra_content')

    <h2><p>Authors Index</p></h2>
    <!-- Button trigger modal -->
    <a class="btn btn-primary btn-md m-1" href="/admin/authors/create">Add Author</a>


    <table id="example1" class="table shadow p-3 mb-5 bg-white rounded">
        <thead class="thead-dark " >
        <tr class="row" >
            <th class="col-sm-1" scope="col">#</th>
            <th class="col-sm-4" scope="col">Name</th>
            <th class="col-sm-1" scope="col">Age</th>
            <th class="col-sm-1" scope="col">Nationality</th>
            <th class="col-sm-1" scope="col">Created At</th>
            <th class="col-md-3" scope="col">Options</th>
            <th class="col-sm-1"></th>
        </tr>
        </thead>
        <tbody>
        <tr class="row">
            <td class="col-sm-1"><input type="number" name="id" class="col-sm-12"  /></td>
            <td class="col-sm-4"><input type="text" name="name" class="col-sm-12" /></td>
            <td class="col-sm-1"><input type="text" name="age" class="col-sm-12" /></td>
            <td class="col-sm-1"><input type="text" name="nationality" class="col-sm-12" /></td>
            <td class="col-sm-1"><input type="number" name="created_at" class="col-sm-12" /></td>
            <td class="col-md-3" ></td>
        </tr>
        @foreach($authors as $author)
            <tr class="row">
                <td class="col-sm-1">{{ $author->id }}</td>
                <td class="col-sm-4">{{ $author->name }}</td>
                <td class="col-sm-1">{{ $author->age }}</td>
                <td class="col-sm-1">{{ $author->nationality->name }}</td>
                <td class="col-sm-1">{{ $author->created_at }}</td>
                <td class="col-md-3">
                    <a class="btn btn-warning" href="authors/edit/{{$author->id}}">Edit</a>
                    <a class="btn btn-danger" href="authors/delete/{{$author->id}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop