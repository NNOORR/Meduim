@extends('layouts.default')

@section('extra_content')

    <h1>{{ isset($nationality) ? 'Edit Nationality ' . $nationality->id : 'Add a New Nationality'}}</h1>
    <form action="/admin/nationalities/{{ isset($nationality) ? 'update/' . $nationality->id : 'store' }}" method="post">
        @csrf
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" name="name" value="{{ isset($nationality) ? $nationality->name : ''}}"  class="form-control" id="inputName" placeholder="Enter nationality name" required>
        </div>

        <button type="submit" class="btn btn-primary ">Submit</button>
    </form>

@stop
