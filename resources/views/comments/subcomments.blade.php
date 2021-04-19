<div class="pl-2 border-left border-dark">
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
</div>
<div class="subcomments pl-2">
    @each('comments.subcomments', $subcomment->subcomments, 'subcomment')
</div>


