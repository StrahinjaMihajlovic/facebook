
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

function editElement(route){
    $.get(route, function (data) {
        $('#post_modal').html(data);
    });
}

function updatePost(url){
    var form = new FormData();
    const csrf = $("input:hidden[name='_token']").attr('value');
    const message =  $("#edit_message").val();
    form.append('_token', csrf);
    form.append('message', message);

    if($('#editImage')[0].files[0]) {
        form.append('picture', $('#editImage')[0].files[0]);
    }

    form.append('_method', 'patch');
    $.ajax({
        type: 'POST',
        url: url,
        data: form,
        contentType: false,
        processData: false,

    }).done(function(){
        $('#edit_message').parent().after('<p>Successfuly updated</p>');
        window.setTimeout(function(){
            location.reload();
        }, 1000);

    }).fail(function(xhr){
        $('#edit_message').parent().after('<p>Failed with: </p>' + xhr.status);
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
    }).fail(function(xhr){
        $(currentElement).parentsUntil(".gedf-card", ).parent().append('p').addClass('alert-danger').text(errorDisplay(xhr));
    })
}

function likePost(currObject, post){
    const url = 'like';
    const csrf = $("input:hidden[name='_token']").attr('value');
    $.ajax({
        type: "POST",
        url: url,
        data:{_token : csrf, post: post}
    }).done(function( data ){

        $(currObject).children('p.count').text(data.likes_count);
        var text = $(currObject).children('p.action');
        $(text).text($.trim($(text).text()) === 'Like' ? 'Dislike': 'Like');
    })
}

function showComments(currObject, post){

    $.ajax({
        type:"GET",
        url: 'post/'+post+'/comments',
    }).done(function(data){
        $(currObject).parent().next().html(data ? data:'No comments' + data);
        $(currObject).parent().next().css('display', 'block');
    })
}

function postComment(currObject, post){
    const csrf = $("input:hidden[name='_token']").attr('value');
    const content = $(currObject).prev().val();
    console.log(content);
    $.ajax({
        type:'POST',
        url: 'post/'+post+'/comments',
        data:{content:content, _token:csrf}
    }).done(function(data){
        showComments($(currObject).parent().prev().children('a').first(), post);
    });
}

function deleteComment(url, currElement){
    const csrf = $("input:hidden[name='_token']").attr('value');
    $.ajax({
        type:'DELETE',
        url:url,
        data:{_token:csrf}
    }).done( function(data){
        if(data == 1){
            $(currElement).parentsUntil('.card-body').parent().remove();
        }
    }).fail(function(xhr){
        console.log('fail');
    });
}

function updateComment(url){
    const csrf = $("input:hidden[name='_token']").attr('value');
    var form = new FormData();
    form.append('content', $("#edit_message").val());
    form.append('_token', csrf);
    form.append('_method', 'patch');

    const message =  $("#edit_message").val();
    $.ajax({
        type: 'patch',
        url: url,
        data: {_token:csrf, content:message},

    }).done(function(){
        $('#edit_message').parent().after('<p>Successfuly updated</p>');
        window.setTimeout(function(){
            location.reload();
        }, 1000);

    }).fail(function(xhr){
        $('#edit_message').parent().after('<p>failed with </p>' + xhr.status);
    });
}


function errorDisplay(xhr){
    if(xhr.status === 403){
        return 'You are not allowed to do that!';
    }
}
