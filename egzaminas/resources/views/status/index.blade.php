@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h2>Statuses List</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <div class="card-body">
                            @foreach ($statuses as $status)
                            <li class="list-group-item list-line">
                                {{-- Antraste --}}
                                <div class="list-line_car">
                                    {{-- pavadinimas --}}
                                    <div class="list-line_title">
                                        {{$status->name}}
                                    </div>
                                </div>
                                <div class="list-line_button">
                                    <a href="{{route('status.edit',[$status])}}" class="btn btn-primary">EDIT</a>
                                    <form method="POST" action="{{route('status.destroy', [$status])}}">
                                        @csrf
                                        <button class="btn btn-danger" type="submit">DELETE</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
