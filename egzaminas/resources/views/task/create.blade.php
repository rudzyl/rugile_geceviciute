@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Task</div>
                <div class="card-body">
                    <form method="POST" action="{{route('task.store')}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="task_name" value="{{old('task_name')}}">
                            <small class="form-text text-muted">Task's name</small>
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="text" class="form-control" name="add_date" value="{{old('add_date')}}">
                            <small class="form-text text-muted">Task's date</small>
                        </div>
                        <div class="form-group">
                            <label>About:</label>
                            <textarea name="task_description" id="summernote" value="{{old('task_description')}}">{{old('task_description')}}</textarea>
                            <small class="form-text text-muted">Task's description</small>
                        </div>
                        <div class="form-group">
                            <select name="status_id">
                                @foreach ($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Task's status</small>
                        </div>
                        @csrf
                        <button class="btn btn-success" type="submit">ADD</button>
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
