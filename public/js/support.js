Pusher.logToConsole = true;

var pusher = new Pusher('e99001c1b570cb467614', {
    cluster: 'eu'
});

var channel = pusher.subscribe('laravel');
channel.bind('NewMessage', function(data) {
    var html = `
                <li class="left clearfix">
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">${data.message.email}</strong>
                        </div>
                        <p>
                            ${data.message.message}
                        </p>
                    </div>
                </li>
            `
    $('.chat').append(html)
});

function sendMsg(url)
{
    const csrf = $("input:hidden[name='_token']").attr('value');
    const textMessage = $("#msg").val();

    $.ajax({
        method: "POST",
        url: url,
        data:{_token : csrf, msg: textMessage}
    }).done(function(){
        $('#msg').val('');
    }).fail(function(e){
        console.log(e.message);
    })
}
