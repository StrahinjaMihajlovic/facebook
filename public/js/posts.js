
function storePost(route) {
    const csrf = $("input:hidden[name='_token']").attr('value');

    const val = $("#message").val();

    $.post(route, {message: val, _token: csrf}, function (data) {
        $('#post_wrap').html(data);

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
