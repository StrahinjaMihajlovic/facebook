@foreach($posts as $post)
        <div class="card gedf-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mr-2">
                            <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                        </div>
                        <div class="ml-2">
                            <div class="h5 m-0">@ {{ $post->user->name }}</div>
                            <div class="h7 text-muted">{{ $post->user->name }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-h"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                <a class="dropdown-item" href="#">Pin</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#post_modal"  onclick="editPost('{{ route('post.edit', ['post' => $post->id]) }}')" >Edit</a>
                                <a class="dropdown-item" onclick="deletePost({{ route('post.destroy', ['post' => $post])}} )">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> Hace 40 min</div>
                <!-- <a class="card-link" href="#">
                    <h5 class="card-title">Totam non adipisci hic! Possimus ducimus amet, dolores illo ipsum quos
                        cum.</h5>
                </a> -->

                <p class="card-text">
                    {{ $post->content }}
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
@endforeach
@yield('posts')
