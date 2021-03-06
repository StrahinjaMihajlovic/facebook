<style>
    .time{
        color: #6c757d!important;
        font-size: 0.8rem;
    }
</style>

<input type="text" placeholder="Type your comment"> <button class="btn btn-primary"  onclick="postComment(this, {{$post->id}})">Post comment</button>
@foreach($post->comments as $comment)
    <div class="card-body">
        <div class="dropdown" style="float: right;">
            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                <a class="dropdown-item" href="#">like</a>
                @can('update', $comment)<a onclick="editElement('{{ route('comment.edit', ['comment' => $comment]) }}')" class="dropdown-item" href="#" data-toggle="modal" data-target="#post_modal">Edit</a>@endcan
                @can('delete', $comment)<p class="dropdown-item" onclick="deleteComment('{{ route('comment.destroy', ['comment' => $comment]) }}', this)">Delete</p>
                @endcan
            </div>
        </div>



        <p class="card-text">
            <img style="float:left;padding-right: 4px;" class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
            <a href=""><span class=""> {{ $comment->user->name }}:</span></a>
            <span >{{ $comment->content }} </span>
        </p>
        <p>

        <span class="time">Posted about {{ floor( (time() - strtotime($comment->created_at)) / 60) }} minutes ago</span>
        </p>

        <p>
            @if($comment->created_at != $comment->updated_at)
                <span class="time">
                    Updated About {{ floor( (time() - strtotime($comment->updated_at)) / 60) }} minutes ago
                </span>
            @endif
        </p>

        <div class="subcomments pl-2">
            @each('comments.subcomments', $comment->subcomments, 'subcomment')
        </div>
        <div class="answer">
            <input type="text" placeholder="Answer to this comment"> <button class="btn btn-primary"  onclick="postComment(this, {{$post->id}}, {{ $comment->id }})">Post comment</button>
        </div>
    </div>
@endforeach
