
function storePost(route) {
    const csrf = $("input:hidden[name='_token']").attr('value');
    var form = new FormData();
    const val = $("#message").val();
    form.append('message', val);
    form.append('_token', csrf);
    if($('#picture')[0].files[0]){
        try {
            form.append('picture', $('#picture')[0].files[0]) //for now only one image can be sent
        }catch (e){
            console.log(e.message);
        }
    }

    $.ajax({
        type: 'POST',
        url: route,
        data: form,
        processData: false,
        contentType: false,


    }).done(function(data){
        $('#post_wrap').html(data);
    }).fail(function ( data , error){

    });

}

function editPost(route){
    $.get(route, function (data) {
        $('#post_modal').html(data);
    });
}

function updatePost(url){
    const post = $("#edit_message").val();
    const csrf = $("input:hidden[name='_token']").attr('value');
    $.ajax({
        type: 'PATCH',
        url: url,
        data: {message: post, _token : csrf}

    }).done(function(){
        $('#edit_message').parent().after('<p>Successfuly updated</p>');
    }).fail(function(){
        $('#edit_message').parent().after('<p>fail</p>');
    });
}

function deletePost(currentElement,url){
    const csrf = $("input:hidden[name='_token']").attr('value');
    $.ajax({
        type: "DELETE",
        url: url,
        data:{_token : csrf}
    }).done(function(){
        $(currentElement).parentsUntil(".gedf-card", ).parent().remove();
    }).fail(function(){
        console.log('radi');
    })
}
