@extends('layouts.app')

@section('content')

    <div class="container">

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="bootstrap" viewBox="0 0 118 94">
                <title>Bootstrap</title>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
            </symbol>

            <symbol id="calendar-event" viewBox="0 0 16 16">
                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
            </symbol>

            <symbol id="alarm" viewBox="0 0 16 16">
                <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
            </symbol>

            <symbol id="list-check" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
            </symbol>
        </svg>

        <div class="b-example-divider"></div>

        <div class="container">
            @if($hotfixes->isNotEmpty())
                <h2>Hotfix</h2>
                @foreach($hotfixes as $hotfix)
                    <div class="list-group w-auto">
                        <div class="d-flex gap-4">
                            <div class="list_content list-group-item d-flex align-items-center"
                                 style="margin-bottom: 15px; width:100%;">
                                <div class="d-flex gap-3 justify-content-between w-100">
                                    <div class="d-flex gap-3">
                                    <a href="{{ route($hotfix->status ? 'todo.uncomplete' : 'todo.complete', $hotfix->id) }}"
                                       class="btn btn-success btn-sm"
                                       style="display: flex; align-items: center">{{ $hotfix->status ? 'inComplete' : 'Complete' }}</a>

                                    <span class="pt-1 form-checked-content">
                                    <strong>{{$hotfix->name}}</strong>
                                    <small class="d-block text-muted">
                                        <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>
                                        {{$hotfix->created_at}}
                                    </small>
                                </span>
                                    </div>
                                    <div style="display: flex; align-items: center" class="gap-3">
                                        @if(Auth::user()->admin == 1)
                                            <p style="margin-bottom: 0">{{ $hotfix->user->name }}</p>
                                        @endif

                                        <div style="width: 10px; height: 10px; border: none; border-radius: 100%; background-color: {{$hotfix->task_color}};"></div>

                                        <div class="list_content d-flex align-items-center">
                                            <p class="m-0">{{$hotfix->available_days}}</p>
                                        </div>

                                            <div>
                                                <a href="{{route('todo.view', $hotfix->id)}}" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                    </svg>
                                                </a>
                                            </div>

                                        <a href="{{route('todo.edit', $hotfix->id)}}" class="btn btn-warning btn-sm"
                                           style="display: flex; align-items: center">Update</a>
                                        <form action="{{ route('todo.delete', $hotfix->id) }}" method="POST"
                                              style="display: flex;">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" style="display: flex; align-items: center" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
        </div>

        <div class="container">
            @if($tasks->isNotEmpty())
                <h2>Tasks</h2>
                @foreach($tasks as $task)
                    <div class="list-group w-auto">
                        <div class="d-flex gap-4">
                            <div class="list_content list-group-item d-flex justify-content-between align-items-center"
                                 style="margin-bottom: 15px; width:100%; {{$task->type == 'hotfix' ? 'border: 2px solid red' : ''}} ">
                                <div class="d-flex gap-3">
                                    <a href="{{ route($task->status ? 'todo.uncomplete' : 'todo.complete', $task->id) }}"
                                       class="btn btn-success btn-sm"
                                       style="display: flex; align-items: center">{{ $task->status ? 'inComplete' : 'Complete' }}</a>

                                    <span class="pt-1 form-checked-content">
                                        <strong>{{$task->name}}</strong>
                                        <small class="d-block text-muted">
                                            <svg class="bi me-1" width="1em" height="1em"><use xlink:href="#calendar-event"/></svg>
                                            {{$task->created_at}}
                                        </small>
                                    </span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center" class="gap-3">
                                    @if(Auth::user()->admin == 1)
                                        <p style="margin-bottom: 0">{{ $task->user->name }}</p>
                                    @endif

                                    <div style="width: 10px; height: 10px; border: none; border-radius: 100%; background-color: {{$task->task_color}};"></div>

                                    <div class="list_content d-flex align-items-center">
                                        <p class="m-0">{{$task->available_days}}</p>
                                    </div>

                                    <div>
                                        <a href="{{route('todo.view', $task->id)}}" class="btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                            </svg>
                                        </a>
                                    </div>

                                    <a href="{{route('todo.edit', $task->id)}}" class="btn btn-warning btn-sm"
                                       style="display: flex; align-items: center">Update</a>
                                    <form action="{{ route('todo.delete', $task->id) }}" method="POST"
                                          style="display: flex;">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" style="display: flex; align-items: center" class="btn btn-danger">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            @if($tasks->isEmpty() && $hotfixes->isEmpty())
                <h3 class="mb-3">No records</h3>
            @endif

            <div class="container">
                <a href="{{route('todo.create')}}" class="btn btn-primary" style="width: 100px">Add Todo</a>
            </div>
        </div>

@endsection
