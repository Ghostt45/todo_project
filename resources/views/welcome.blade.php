@extends('layouts.app')

@section('content')

    <div class="container">

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="calendar-event" viewBox="0 0 16 16">
                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
            </symbol>
        </svg>

        <div class="b-example-divider"></div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $types = [
                'Hotfix' => $hotfixes,
                'Tasks' => $tasks,
            ];
        @endphp

        @foreach ($types as $type => $items)
            @if($items->isNotEmpty())
                <h2 class="mb-2 mt-2">{{ $type }}</h2>
                <ul class="todo-list" data-widget="todo-list">
                    @foreach ($items as $item)
                        @if(Auth::user()->admin || $item->user_id == Auth::id())
                            <li class="container sortable-item w-100" data-id="{{ $item->order }}"> {{--style="border: 1px solid black;"--}}
                                <div class="d-flex gap-4 align-items-center" style="margin-bottom: 15px; justify-content: space-between;">

                                    <div class="d-flex align-items-center gap-3">
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>

                                        <a href="{{ route($item->status ? 'todo.uncomplete' : 'todo.complete', $item->id) }}" class="btn btn-sm {{$item->status ? 'btn-danger' : 'btn-success'}}" style="display: flex; justify-content: center; align-items: center;">
                                            {{ $item->status ? 'In Complete' : 'Complete' }}
                                        </a>

                                        <span class="pt-1 form-checked-content">
                                            <strong>{{ $item->name }}</strong>
                                            <small class="d-block text-muted">
                                                <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>
                                                {{ $item->created_at }}
                                            </small>
                                        </span>
                                    </div>


                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            @if(Auth::user()->admin == 1)
                                                <a href="{{ route('todo.panel', $item->user->id) }}" style="margin-bottom: 0; text-decoration: none; color: black">{{ $item->user->name }}</a>
                                            @endif
                                        </div>

                                        <div>
                                            <small class="badge" style="background-color: {{$item->task_color}};">
                                                <i class="far fa-clock"></i> {{ $item->available_days }}
                                            </small>
                                        </div>

                                        <div>
                                            <a href="{{ route('todo.view', $item->id) }}" class="btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg>
                                            </a>
                                        </div>

                                        <a href="{{ route('todo.edit', $item->id) }}" class="btn btn-warning btn-sm">Update</a>
                                        <form action="{{ route('todo.delete', $item->id) }}" method="POST" style="display: flex;">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </div>

                                </div>
                            </li>

                        @endif
                    @endforeach
                </ul>
            @endif
        @endforeach



        @if($hotfixes->isEmpty() && $tasks->isEmpty())
            <h3 class="mb-3">No records</h3>
        @endif



        <div class="container mt-2">
            <a href="{{ route('todo.create') }}" class="btn btn-primary" style="width: 100px">Add Todo</a>
        </div>






        <script>
            $(function() {
                $(".todo-list").sortable({
                    handle: ".handle",
                    update: function(event, ui) {
                        let sortedIDs = $(".todo-list").sortable("toArray");
                        console.log(sortedIDs);
                    }
                });
            });
        </script>

    </div>

@endsection
