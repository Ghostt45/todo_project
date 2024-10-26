@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('todo.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Write your task" id="exampleInputEmail1">
                @error('name')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-3 from-group has-validation">
                <label class="form-label">Type</label>
                <select class="form-control" id="type" name="type">
                    <option value="">Select Type</option>
                    <option value="task">Task</option>
                    <option value="hotfix">Hotfix</option>
                </select>
                @error('type')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="mb-3 form-group has-validation">
                <label for="exampleInputEmail1" class="form-label">Order number</label>
                <input type="text" name="order" class="form-control" placeholder="Write order number" id="exampleInputEmail1">
                @error('order')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <div class="form-group date" id="datetimepicker">
                    <label for="datetimepicker">Choose deadline</label>
                    <input type="datetime-local" class="form-control" placeholder="Choose date and time" name="datetime" autocomplete="off">
                </div>
                @error('datetime')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="formFile" class="form-label">Choose file</label>
                <input class="form-control" type="file" id="formFile" name="image">
                @error('image')
                <div class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <a href="{{route('todo.index')}}" class="btn btn-primary">Return to main page</a>
            <button type="submit" class="btn btn-success">Create</button>
        </form>

        @isset($path)
            <img class="img-fluid" src="{{asset('/storage/' . $path)}}">
        @endisset
    </div>


@endsection
