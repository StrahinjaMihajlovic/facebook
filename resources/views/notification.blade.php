@extends('layouts.template')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="col-md-6 gedf-main" style="background: white;">
            <p id="success" class="mt-3" style="color:green;display: none;"></p>
            <div class="card-body">
                <div class="h5">
                    Friend request
                </div>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($notifications as $notification)
                    <li class="list-group-item">
                        <a href="{{ asset('/') }}">{{ $notification->user->name }}</a> send you request
                        <form  method="POST" style="float:right;">
                            @csrf
                            <button style="border: none;background: #007bff;color: white;">Accept friend</button>
                        </form>
                    </li>
                @endforeach
            </ul>
    </div>
    <div class="col-md-3">
        <div class="card gedf-card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <div class="h6 text-muted">Users</div>

                </ul>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
@endsection
