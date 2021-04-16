function sendMessage(url,id)
{
    const csrf = $("input:hidden[name='_token']").attr('value');
    const textMessage = $("#textMessage").val();

    $.ajax({
        method: "POST",
        url: url,
        data:{_token : csrf, textMessage: textMessage, user_to: id}
    }).done(function(){
        $("#msg").load(" #msg > *");
    }).fail(function(){
        console.log('error');
    })
}
setInterval(function(){
    $("#refresh").load(" #refresh > *");
},5000);
