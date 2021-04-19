<html>
<head>
    <title>Facebook | Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profileStyle.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <div class="fb-profile-block">
                <div class="fb-profile-block-thumb cover-container"></div>
                <div class="profile-img">
                    <a href="#">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" title="">
                    </a>
                </div>
                <div class="profile-name">
                    <h2>{{ Auth()->user()->name }}</h2>
                </div>

                <div class="fb-profile-block-menu">
                    <div class="block-menu">
                        <ul>
                            <li><a href="{{asset('/')}}">Home</a></li>
                            <li><a href="{{ route('message.index') }}">Messages</a></li>
                            <li><a href="{{ route('notification') }}">Notifications</a></li>
                            <li><a href="#">Photos</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="block-menu">
                        <ul>
                            <li><a href="#">Timeline</a></li>
                            <li><a href="#">about</a></li>
                            <li><a href="#">Friends</a></li>
                            <li><a href="#">Photos</a></li>
                            <li><a href="#">More...</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3 mt-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <p>Lorem Ipsum</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Post</a>
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
                                    <input type="file" name="picture" class="custom-file-input" id="picture" multiple accept="image/x-png, image/gif, image/jpeg, image/jpg">
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
                        </div>
                    </div>
                </div>
                <div id="post_wrap">
                    @include('posts/partial_render')
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <p>Lorem Ipsum</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/posts.js') }}"></script>
</body>
</html>
