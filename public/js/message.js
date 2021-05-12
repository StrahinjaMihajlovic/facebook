function sendMessage(url,id,auth)
{
    const csrf = $("input:hidden[name='_token']").attr('value');
    const textMessage = $("#textMessage").val();

    $.ajax({
        method: "POST",
        url: url,
        data:{_token : csrf, textMessage: textMessage, user_to: id}
    }).done(function(){
       showMessages(id,auth, 'http://localhost/message/'+id+'/send');
        $("#textMessage").val('');
    }).fail(function(){
        console.log('error');
    })
}

function showMessages(id,auth,url){
    if($("#pdfButton").length == 0) {
        var pdfButton = $(document.createElement('a'));
        pdfButton.addClass('btn btn-success float-right');
        pdfButton.attr('id', 'pdfButton')
        pdfButton.append('<i class="far fa-file-pdf"></i>');
        pdfButton.append(document.createElement('i'));
    }
    pdfButton.attr('href', 'message/pdf/' + id);
    $('#msgBtn').append(pdfButton);
    $.ajax({
        url: 'message/'+id,
        type: 'get',
        data: { get_param: 'value' },
        dataType: 'json',
        success: function(data){
            $(".msg_history").empty();
            $.each(data, function(index, element) {
                if(element.user_from == auth)
                {
                    var html = `
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                             <p>${element.message} <i class="fa fa-trash delMsg" onclick="deleteMessage(${id},${auth},${element.id})"></i></p>
                             <span class="time_date">${element.created_at}</span>
                        </div>
                    </div>
                    `
                }else {
                    var html = `
                     <div class="incoming_msg">
                          <div class="incoming_msg_img">
                               <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                          </div>
                          <div class="received_msg">
                               <div class="received_withd_msg">
                                    <p>${element.message}</p>
                                    <span class="time_date"> ${element.created_at}</span>
                               </div>
                          </div>
                     </div>
                    `
                }
                $('.msg_history').append(html);
            });
            var btn = `
                <button class="msg_send_btn" onClick="sendMessage('`+url+`', `+id+`,`+ auth +`)" type="submit"><i class="fa fa-send" aria-hidden="true""></i></button>
                `
            $('#msgBtn').append(btn);

            readMessage(id);
            $("#inbox_chat").load(location.href+" #inbox_chat>*","");
        }
    });
}

function readMessage(id)
{
    $.ajax({
        method: "GET",
        url: 'message/'+id+'/read',
        data:{id:id}
    }).done(function(){

    }).fail(function(){
        console.log('error');
    })
}

function deleteMessage(id,auth,idMsg)
{
    const csrf = $("input:hidden[name='_token']").attr('value');

    $.ajax({
        method: "POST",
        url: 'message/'+idMsg+'/delete',
        data: {_token:csrf,id:idMsg}
    }).done(function(){
        showMessages(id,auth);
    }).fail(function(){
        console.log('error');
    })
}
