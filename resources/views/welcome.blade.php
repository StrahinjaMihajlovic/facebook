<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/posts.js') }}"></script>
@extends('layouts.template')


@section('title')
Welcome
@endsection

<div class="modal fade" id='post_modal' tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
</div>

@section('content')
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="h5">
                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt=""> LeeCross
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="h6 text-muted">Friends</div>
                    <div class="h5">20</div>
                </li>
                <li class="list-group-item">
                    <div class="h6 text-muted">Posts</div>
                    <div class="h5">20</div>
                </li>
                <li class="list-group-item"><a href="{{ asset('/') }}">Home</a></li>
                <li class="list-group-item"><a href="">Messages</a></li>
                <li class="list-group-item"><a href="">Profile</a></li>
                <li class="list-group-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 gedf-main">

        <!--- \\\\\\\Post-->
        <div class="card gedf-card">
            <div class="card-body">
                <div class="card-deck">
                    <div class="card"  data-toggle="modal" data-target=".bd-example-modal-xl">
                        <img class="card-img-top" src="https://cdn.worldvectorlogo.com/logos/story.svg" alt="Card image cap">
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card" data-toggle="modal" data-target=".bd-example-modal-xl">
                        <img class="card-img-top" src="https://cdn.worldvectorlogo.com/logos/story.svg" alt="Card image cap">
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card" data-toggle="modal" data-target=".bd-example-modal-xl">
                        <img class="card-img-top" src="https://cdn.worldvectorlogo.com/logos/story.svg" alt="Card image cap">
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card" data-toggle="modal" data-target=".bd-example-modal-xl">
                        <img class="card-img-top" src="https://cdn.worldvectorlogo.com/logos/story.svg" alt="Card image cap">
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card" data-toggle="modal" data-target=".bd-example-modal-xl">
                        <img class="card-img-top" src="https://cdn.worldvectorlogo.com/logos/story.svg" alt="Card image cap">
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for story -->
        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="card-body">
                        <div class="card-deck">
                            <div class="card">
                                <img src="https://cdn.worldvectorlogo.com/logos/story.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://cdn.worldvectorlogo.com/logos/story.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://cdn.worldvectorlogo.com/logos/story.svg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal for story -->
        <!-- Post /////-->

        <!--- \\\\\\\Post-->
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
                        <div id="message_status" class="h5">

                        </div>
                        <div class="custom-file" style="margin-bottom:1rem;">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary" onclick="storePost('{{ route('post.store') }}')")>share</button>
                                @csrf
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
                        <div class="custom-file" style="margin-bottom:1rem;">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Upload image</label>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">share</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Post /////-->

        <div id="post_wrap">
        <!--- \\\\\\\Post-->
            @include('posts/partial_render');
        </div>

    </div>
    <div class="col-md-3">
        <div class="card gedf-card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <div class="h6 text-muted">Active friends</div>
                    <li class="list-group-item"><a href=""><img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt=""> LeeCross</a></li>
                    <li class="list-group-item"><a href=""><img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt=""> LeeCross</a></li>
                    <li class="list-group-item"><a href=""><img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt=""> LeeCross</a> </li>
                </ul>
                </ul>
            </div>
        </div>
    </div>
@endsection
