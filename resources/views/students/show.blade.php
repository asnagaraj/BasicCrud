@extends('students.layout')
@section('content')
<div class="card mt-2">
    <div class="card-header">Students View Page</div>
    <div class="card-body">

        <div class="card-body">
            <h5 class="card-title">Name : {{ $students->name }}</h5>
            <p class="card-text">Address : {{ $students->address }}</p>
            <p class="card-text">Mobile : {{ $students->mobile }}</p>
            <p class="card-text">Image:{{$students->image}}</p>
        </div>

        </hr>

    </div>
</div>