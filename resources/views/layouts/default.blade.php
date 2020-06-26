@extends('adminlte::page')

@section('content')

@if(\Illuminate\Support\Facades\Session::has('flash_message'))
    <div class="alert alert-success">
        {{ \Illuminate\Support\Facades\Session::get('flash_message') }}
    </div>
   <?php  \Illuminate\Support\Facades\Session::remove('flash_message') ?>
@endif

@if(\Illuminate\Support\Facades\Session::has('error_message'))
    <div class="alert alert-danger">
        {{ \Illuminate\Support\Facades\Session::get('error_message') }}
        {{ \Illuminate\Support\Facades\Session::remove('error_message') }}
    </div>
    <?php  \Illuminate\Support\Facades\Session::remove('error_message') ?>
@endif

@yield('extra_content')

@stop