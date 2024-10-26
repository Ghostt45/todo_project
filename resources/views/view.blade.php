@extends('layouts.app')

@section('content')
    <div class="container">
            @csrf
            <div class="mb-3 from-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" value="{{$todo->name}}" class="form-control" placeholder="Write your task" id="exampleInputEmail1" disabled>
            </div>

            <div class="mb-3 from-group has-validation">
                <label class="form-label">Type</label>
                <select class="form-control" id="type" name="type" disabled>
                    <option selected>{{$todo->type}}</option>
                </select>
            </div>

        <div class="mb-3 from-group has-validation">
            <label for="exampleInputEmail1" class="form-label">Order number</label>
            <input type="text" name="order" class="form-control" placeholder="Write order number" id="exampleInputEmail1" value="{{$todo->order}}" disabled>
        </div>

            <div class="form-group mb-3">
                <label for="datetimepicker">Choose deadline</label>
                <input type="text" id="datetimepicker" class="form-control" placeholder="Choose deadline" name="datetime" value="{{$todo->deadline_datetime}}" disabled>
            </div>

        <div class="form-group mb-1">
            <label for="formFile" class="form-label">Selected image</label>
        </div>

        @if($todo->image)
            <div>
                <img class="img-fluid mb-3" style="width: 250px; height: 250px" src="{{ asset('storage/' . $todo->image) }}">
            </div>
        @endif


        <a href="{{route('todo.index')}}" class="btn btn-primary">Return to main page</a>


    </div>
@endsection
