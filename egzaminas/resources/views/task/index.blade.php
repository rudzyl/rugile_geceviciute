@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h2>Tasks List</h2>
                    <div class="make-inline">
                        <form action="{{route('task.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label> Status: </label>
                                <select class="form-control" name="status_id">
                                    <option value="0" disabled @if($filterBy==0) selected @endif>Select Status</option>
                                    @foreach ($statuses as $status)
                                    <option value="{{$status->id}}" @if($filterBy==$status->id) selected @endif>
                                        {{$status->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-info">FILTER</button>
                        </form>

                        <a href="{{route('task.index')}}" class="btn btn-primary"> Clear filter</a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <div class="card-body">
                            @foreach ($tasks as $task)
                            <li class="list-group-item list-line">
                                {{-- Antraste --}}
                                <div class="list-line_car">
                                    {{-- pavadinimas --}}
                                    <div class="list-line_title">
                                        <h5>Name:</h5>{{$task->task_name}}
                                        <h5>Description:</h5>{!!$task->task_description!!}
                                        <h6>Date: {{$task->add_date}}</h6>
                                    </div>
                                    <div class="list-line_author">
                                        {{$task->taskStatus->name}}
                                    </div>
                                </div>
                                <div class="list-line_button">
                                    <a href="{{route('task.edit',[$task])}}" class="btn btn-primary">EDIT</a>
                                    <form method="POST" class="task-delete" action="{{route('task.destroy', [$task])}}">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">DELETE</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </div>
                    </ul>
                    {{-- <div class="paginate-col">
                        {{$tasks->onEachSide(2)->links()}}
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
