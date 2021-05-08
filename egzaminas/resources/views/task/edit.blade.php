@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    <form method="POST" action="{{route('task.update',[$task])}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="task_name" value="{{old('task_name',$task->task_name)}}">
                            <small class="form-text text-muted">Edit task's name</small>
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="text" class="form-control" name="add_date" value="{{old('add_date',$task->add_date)}}">
                            <small class="form-text text-muted">Edit task's date</small>
                        </div>
                        <div class="form-group">
                            <label>Task description:</label>
                            <textarea name="task_description" id="summernote" value="{{old('task_description',$task->task_description)}}">{{old('task_description',$task->task_description)}}</textarea>
                            <small class="form-text text-muted">Edit task's description</small>
                        </div>
                        <div class="form-group">
                            <select name="status_id">
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}" @if($status->id == $task->status_id) selected @endif>
                                    {{$status->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button class="btn btn-primary" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
    });

</script>
@endsection
