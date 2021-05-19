<!DOCTYPE html>
<head>
    <title>Facebook | Support</title>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/supportStyle.css') }}">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('js/support.js') }}"></script>
</head>
<body>
<div class="container">
    <div class="row form-group">
        <div class="col-xs-12 col-md-offset-2 col-md-8 col-lg-8 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Support
                </div>
                <div class="panel-body body-panel">
                    <ul class="chat">
                    </ul>
                </div>
                <div class="panel-footer clearfix">
                        @csrf
                    <textarea class="form-control" rows="3" name="msg" id="msg"></textarea>
                        <span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="margin-top: 10px">
                            <button onclick="sendMsg('{{route('support.send')}}')" class="btn btn-warning btn-lg btn-block" id="btn-chat">Send</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
