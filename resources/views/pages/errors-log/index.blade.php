@extends('layouts.default')

@section('extra_content')

    <h2><p>Errors log</p></h2>

    <table id="example1" class="table shadow p-3 mb-5 bg-white rounded">
        <thead class="thead-dark " >
        <tr class="row" >
            <th class="col-sm-1" scope="col">#</th>
            <th class="col-sm-2" scope="col">Message</th>
            <th class="col-sm-1" scope="col">File</th>
            <th class="col-sm-1" scope="col">Line</th>
            <th class="col-sm-4" scope="col">Trace</th>
            <th class="col-sm-1" scope="col">Error code</th>
            <th class="col-sm-1" scope="col">Created at</th>
            <th class="col-sm-1"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($errorsLog as $error)
            <tr class="row">
                <td class="col-sm-1">{{ $error->id }}</td>
                <td class="col-sm-2" style="overflow-wrap: break-word;">{{ $error->message }}</td>
                <td class="col-sm-1" style="overflow-wrap: break-word;">{{ $error->file }}</td>
                <td class="col-sm-1" >{{ $error->line }}</td>
                <td class="col-sm-4" style="overflow-wrap: break-word;">{{ $error->trace }}</td>
                <td class="col-sm-1" >{{ $error->err_code }}</td>
                <td class="col-sm-1">{{ $error->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop