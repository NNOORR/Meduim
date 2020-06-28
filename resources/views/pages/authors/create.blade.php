@extends('layouts.default')

@section('extra_content')

    <h1>{{ isset($author) ? 'Edit Author ' . $author->id : 'Add a New Author'}}</h1>
    <form action="/admin/authors/{{ isset($author) ? 'update/' . $author->id : 'store' }}" method="post">
        @csrf
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" name="name" value="{{ isset($author) ? $author->name : ''}}"  class="form-control" id="inputName" placeholder="Enter author name" required>
        </div>
        <div class="form-group">
            <label for="inputAge">Age</label>
            <input type="number" name="age" value="{{ isset($author) ? $author->age : ''}}" class="form-control" id="inputAge"  placeholder="Enter author age" required>
        </div>
        <div class="form-group">
            <label for="nationalityControlSelect">Nationality</label>
            <select class="form-control" id="nationalityControlSelect" name="nationality_id">
                <option value="">-</option>
                @foreach($nationalities as $nationality)
                    <option value="{{$nationality->id}}" {{ isset($author) && $author->nationality_id == $nationality->id ? 'selected=true' : ''}}" >{{ $nationality->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary ">Submit</button>
    </form>

@stop
