<input type="text" placeholder="Type your comment"> <button  onclick="postComment(this, {{$post->id}})">Post comment</button>
@foreach($post->comments as $comment)
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
            <img style="float:left;padding-right: 4px;" class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
            <a href=""><span class=""> {{ $comment->user->name }}:</span></a>
            <span >{{ $comment->content }} </span>
        <span style="color: #6c757d!important;font-size: 0.8rem;">About {{ floor( (time() - strtotime($comment->created_at)) / 60) }} minutes ago</span>
        </p>
    </div>
@endforeach
