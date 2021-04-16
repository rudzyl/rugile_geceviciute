@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Status</div>

                <div class="card-body">
                    <form method="POST" action="{{route('status.update',[$status->id])}}">
                        Name: <input type="text" name="status_name" value="{{old('status_name',$status->name)}}">
                        @csrf
                        <button class="btn btn-primary" type="submit">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
