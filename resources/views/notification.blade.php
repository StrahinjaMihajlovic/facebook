@extends('layouts.template')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="col-md-6 gedf-main" style="background: white;">
            <p id="success" class="mt-3" style="color:green;display: none;"></p>
            <div class="card-body">
                <div class="h5" style="text-align: center;">
                   Notifications
                </div>
            </div>
            <ul class="list-group list-group-flush">

                @foreach(Auth::user()->notifications as $notification)
                    <li class="list-group-item">
                        <p> {{ $notification->data['message'] }}</p>
                    </li>
                @endforeach

                @if($notifications->count() > 0)
                    @foreach($notifications as $notification)
                        <li class="list-group-item">
                            <a href="{{ asset('/') }}">{{ $notification->user->name }}</a> send you request
                            <form  @if($notification->accept == 1) action="{{ route('friend.destroy',['id'=>$notification->id ]) }}" @else action="{{ route('request',['id'=>$notification->user->id]) }}" @endif method="POST" style="float:right;">
                                @csrf
                                <button style="border: none;background: #007bff;color: white;">@if($notification->accept == 1) Delete friend @else Accept friend @endif</button>
                            </form>
                        </li>
                    @endforeach
                @else
                    <div class="h5" style="text-align: center;color:grey;">
                        No notifications to display
                    </div>
                @endif
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
