@extends('layouts.template')

@section('title')
    Message
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('css/messageStyle.css') }}">
    @parent
@show
@section('content')
        <div class="container" id="msg">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Recent</h4>
                            </div>
                            <div class="srch_bar">
                                <div class="stylish-input-group">
                                    <input type="text" class="search-bar"  placeholder="Search" >
                                    <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
                            </div>
                        </div>
                        <div class="inbox_chat">
                            @foreach($users as $user)
                                <a href="{{ route('message.show',['id'=>$user->id]) }}">
                                    <div class="chat_list active_chat">
                                        <div class="chat_people">
                                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                            <div class="chat_ib">
                                                @php
                                                    $lastMessage = $user->senderConverastion->merge($user->recipientConverastion)->sortBy('created_at')->last();
                                                @endphp
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
                               @if(empty($messages))
                                   @else
                                @foreach($messages as $message)
                                        @if($message->user_from == Auth()->user()->id)
                                            <div class="outgoing_msg">
                                                <div class="sent_msg">
                                                    <p>{{ $message->message }}</p>
                                                    <span class="time_date">{{ $message->created_at }}</span> </div>
                                            </div>
                                        @else
                                            <div class="incoming_msg">
                                                <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                                <div class="received_msg">
                                                    <div class="received_withd_msg">
                                                        <p>{{ $message->message }}</p>
                                                        <span class="time_date"> {{ $message->created_at }}</span></div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                   @endif
                            </div>
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                @csrf
                                <input type="text" class="write_msg" id="textMessage" name="textMessage" placeholder="Type a message" />
                                <button class="msg_send_btn" onClick="sendMessage('{{ route('message.send',['id'=> $user->id ]) }}', {{ $user->id }})" type="submit"><i class="fa fa-send" aria-hidden="true""></i></button>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('js')
    @parent
    <script src="{{ asset('js/message.js') }}"></script>
@endsection
