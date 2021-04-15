<div class="col-md-3">
    <div class="alert alert-success" role="alert" id="success" style="display: none;">

    </div>
    <div class="card">
        <p id="success" class="mt-3" style="color:green;display: none;"></p>
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
            <li class="list-group-item"><a href="{{ route('message.index') }}">Messages</a></li>
            <li class="list-group-item"><a href="">Profile</a></li>
            <li class="list-group-item"><a href="{{ route('notification') }}">Notifications</a></li>
            <li class="list-group-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"> Logout</a>
                </form>
            </li>
        </ul>
    </div>
</div>
