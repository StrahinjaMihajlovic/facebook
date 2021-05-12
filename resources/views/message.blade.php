@extends('layouts.template')

@section('title')
    Message
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/messageStyle.css') }}">
    @parent
@show
@section('content')
        <div class="col-md-9" id="msg">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Inbox</h4>
                            </div>
                        </div>
                        <div class="inbox_chat" id="inbox_chat">
                            @foreach($users as $user)
                                <a onclick="showMessages('{{ $user->id }}','{{ Auth()->user()->id }}','{{ route('message.send',['id'=> $user->id ]) }}')">
                                    @php
                                        $lastMessage = $user->senderConverastion->merge($user->recipientConverastion)->sortBy('created_at')->last();
                                    @endphp
                                    <div class="chat_list @if($lastMessage != null && $lastMessage->user_to == Auth()->user()->id && $lastMessage->status == 0) active_chat @endif">
                                        <div class="chat_people">
                                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                            <div class="chat_ib">
                                                <h5>{{ $user->name }}</h5>
                                                @if(empty($lastMessage))
                                                    <p>Tap to chat</p>
                                                @else
                                                    <p>{{ $lastMessage->message }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="mesgs"  id="mesgs">
                        <div id="refresh">
                            <div class="msg_history">
                                   <h1>Chat with people</h1>
                            </div>
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                @csrf
                                <input type="text" class="write_msg" id="textMessage" name="textMessage" placeholder="Type a message" />
                                <div id="msgBtn">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('js')
    @parent
    <script src="{{ asset('js/message.js') }}"></script>
@endsection
