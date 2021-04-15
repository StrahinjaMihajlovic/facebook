@extends('layouts.template')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="col-md-6 gedf-main">
        <!--- \\\\\\\Post-->
        <div class="card gedf-card">
            <div class="card-body">
                <div class="card-deck" id="cardDeck">
                    @if($firstStory->count() > 0)
                    @foreach($firstStory as $fStory)
                    <div class="card">
                        @if($fStory->firstStory->user_id == Auth()->user()->id)
                        <button clas="del" style="position: absolute;border: none;background: none;" onclick="deletePost('{{ route('storyDelete', ['id' => $fStory->firstStory->id])}} ')">
                            <i style="color:red;" class="fas fa-trash"></i>
                        </button>
                        @endif
                        <img  data-toggle="modal" data-target="#bd-example-modal-xl{{ $fStory->id }}"  class="card-img-top" src="{{ asset('images/story/'.$fStory->firstStory->image) }}" alt="Card image cap">
                        <div class="card-footer">
                            <small class="text-muted">{{ $fStory->name }}</small>
                        </div>
                    </div>
                        <!-- Modal for story -->
                        <div class="modal fade" id="bd-example-modal-xl{{ $fStory->id }}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="card-body">
                                        <div class="card-deck">
                                            <div class="card">
                                                <img src="{{ asset('images/story/'.$fStory->firstStory->image) }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <p class="card-text"><small class="text-muted">Posted at: {{ $fStory->firstStory->created_at }}</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End modal for story -->
                    @endforeach
                    @else
                    <h1 style="width: 100%;text-align: center;">No story</h1>
                    @endif
                </div>
            </div>
        </div>
        <!-- Post /////-->

        <!--- \\\\\\\Post-->
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif
        <div class="card gedf-card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="posts-tab" data-toggle="tab" href="#story" role="tab" aria-controls="posts" aria-selected="true">Story</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="form-group">
                            <label class="sr-only" for="message">post</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                        </div>
                        <div class="custom-file" style="margin-bottom:1rem;">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">share</button>
                            </div>
                            <div class="btn-group">
                                <select class="form-control form-control-sm">
                                    <option>Public</option>
                                    <option>Private</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="story" role="tabpanel" aria-labelledby="posts-tab">
                            @csrf
                            <div class="custom-file" style="margin-bottom:1rem;">
                                <input type="file" class="custom-file-input" id="storyImage" name="storyImage">
                                <label class="custom-file-label" for="customFile">Upload image</label>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary"  onclick="storeStory('{{ route('story.store') }}')">share</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Post /////-->

        <!--- \\\\\\\Post-->
        <div class="card gedf-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-2">
                            <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                        </div>
                        <div class="ml-2">
                            <div class="h5 m-0">@LeeCross</div>
                            <div class="h7 text-muted">Miracles Lee Cross</div>
                        </div>
                    </div>
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                <a class="dropdown-item" href="#">Pin</a>
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> Hace 40 min</div>
                <a class="card-link" href="#">
                    <h5 class="card-title">Totam non adipisci hic! Possimus ducimus amet, dolores illo ipsum quos
                        cum.</h5>
                </a>

                <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam sunt fugit reprehenderit consectetur exercitationem odio,
                    quam nobis? Officiis, similique, harum voluptate, facilis voluptas pariatur dolorum tempora sapiente
                    eius maxime quaerat.
                    <a href="https://mega.nz/#!1J01nRIb!lMZ4B_DR2UWi9SRQK5TTzU1PmQpDtbZkMZjAIbv97hU" target="_blank">https://mega.nz/#!1J01nRIb!lMZ4B_DR2UWi9SRQK5TTzU1PmQpDtbZkMZjAIbv97hU</a>
                </p>
            </div>
            <div class="card-footer">
                <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                <a style="color:#007bff;cursor: pointer;" class="card-link"> <i class="fa fa-comment" onclick="showComments()" > Comment</i></a>
                <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
            </div>
            <div id="comments" style="display: none;">
                <div class="card-body">
                    <div class="dropdown" style="float: right;">
                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <a class="dropdown-item" href="#">Pin</a>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                    <p class="card-text">
                        <img style="float:left;padding-right: 4px;" class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt=""> Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam sunt fugit reprehenderit consectetur exercitationem odio.
                        <span style="color: #6c757d!important;font-size: 0.8rem;">About 3 minutes</span>
                    </p>
                </div>
            </div>
        </div>
        <!-- Post /////-->
    </div>
    <div class="col-md-3">
        <div class="card gedf-card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <div class="h6 text-muted">Notification</div>
                    <li class="list-group-item">
                        You have {{ $notifications }} friend request
                    </li>
                    @foreach($users as $user)
                        <li class="list-group-item"><a href=""><img class="rounded-circle" width="45" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt=""> <span>{{ $user->name }}</span> </a>
                        <form style="float: right;padding: 8px;" action="{{ route('request',['id'=>$user->id]) }}" method="POST">
                            @csrf
                            <button style="border: none;background: #007bff;color: white;">@if($user->ifFriendRequestAccept || $user->ifAuthRequestAccept) Friend @elseif($user->ifSendRequest) Unsend request @elseif($user->ifReceiveRequest) Accept friend @else Send request @endif</button>
                        </form>
                        </li>
                    @endforeach
                </ul>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script src="{{ asset('js/story.js') }}"></script>
@endsection
