@extends('layouts.default')

@section('extra_content')

    <h2><p>Nationalities Index</p></h2>
    <!-- Button trigger modal -->
    <a class="btn btn-primary btn-md m-1" href="/admin/nationalities/create">Add Nationality</a>

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
            <th class="col-sm-6" scope="col">Name</th>
            <th class="col-sm-1" scope="col">Created At</th>
            <th class="col-md-3" scope="col">Options</th>
            <th class="col-sm-1"></th>
        </tr>
        </thead>
        <tbody>
        <tr class="row">
            <td class="col-sm-1"><input type="number" name="id" class="col-sm-12"  /></td>
            <td class="col-sm-6"><input type="text" name="name" class="col-sm-12" /></td>
            <td class="col-sm-1"><input type="number" name="created_at" class="col-sm-12" /></td>
            <td class="col-md-3" ></td>
        </tr>
        @foreach($nationalities as $nationality)
            <tr class="row">
                <td class="col-sm-1">{{ $nationality->id }}</td>
                <td class="col-sm-6">{{ $nationality->name }}</td>
                <td class="col-sm-1">{{ $nationality->created_at }}</td>
                <td class="col-md-3">
                    <a class="btn btn-warning" href="nationalities/edit/{{$nationality->id}}">Edit</a>
                    <a class="btn btn-danger" href="nationalities/delete/{{$nationality->id}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop