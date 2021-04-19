
<div class="card-body pl-2 border-left border-dark pr-0">
        <div class="dropdown" style="float: right;">
            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                <a class="dropdown-item" href="#">Pin</a>
                <a onclick="editElement('{{ route('comment.edit', ['comment' => $subcomment]) }}')" class="dropdown-item" href="#" data-toggle="modal" data-target="#post_modal">Edit</a>
                <p class="dropdown-item" onclick="deleteComment('{{ route('comment.destroy', ['comment' => $subcomment]) }}', this)">Delete</p>
            </div>
        </div>
        <p class="card-text">
            <img style="float:left;padding-right: 4px;" class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
            <a href=""><span class=""> {{ $subcomment->user->name }}:</span></a>
            <span >{{ $subcomment->content }} </span>
        </p>
        <p>

            <span class="time">Posted about {{ floor( (time() - strtotime($subcomment->created_at)) / 60) }} minutes ago</span>
        </p>

        <p>
            @if($subcomment->created_at != $subcomment->updated_at)
                <span class="time">
                    Updated About {{ floor( (time() - strtotime($subcomment->updated_at)) / 60) }} minutes ago
                </span>
            @endif
        </p>

    <div class="subcomments pl-2">
        @each('comments.subcomments', $subcomment->subcomments, 'subcomment')
    </div>
    <div class="answer">
        <input type="text" placeholder="Answer to this comment"> <button class="btn btn-primary" onclick="postComment(this, {{$subcomment->post_id}}, {{ $subcomment->id }})">Post comment</button>
    </div>
</div>

