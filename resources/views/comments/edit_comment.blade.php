
<div class="card gedf-card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center">
                <div class="mr-2">
                    <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                </div>
                <div class="ml-2">
                    <div class="h5 m-0">@ {{ $comment->user->name }}</div>
                    <div class="h7 text-muted">{{ $comment->user->name }}</div>
                </div>

            </div>
            <div>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body container">
        <div class="row">
            <div><h2>Edit your comment</h2></div>
        </div>
        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> Posted at: {{ date('d.M.Y H:m', strtotime( $comment->created_at ))}}</div>
        <div class="row">

            <!-- <a class="card-link" href="#">
                <h5 class="card-title">Totam non adipisci hic! Possimus ducimus amet, dolores illo ipsum quos
                    cum.</h5>
            </a> -->
            <div class="col-4">
                    <textarea class="card-text display-inline" id="edit_message">
                        {{ $comment->content }}

                    </textarea>
            </div>

        </div>
        @csrf
        <button type="submit" class="btn btn-primary" onclick="updateComment('{{ route('comment.update', ['comment' => $comment]) }}')">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>

    @error('message')
    <div class="alert alert-danger">not successful</div>
    @enderror
</div>

