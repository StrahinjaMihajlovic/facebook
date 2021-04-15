function deleteStory(url){
    const csrf = $("input:hidden[name='_token']").attr('value');
    $.ajax({
        method: "POST",
        url: url,
        data:{_token : csrf}
    }).done(function(){
        $("#cardDeck").load(location.href+" #cardDeck>*","");
        $('#success').show();
        document.getElementById("success").innerHTML="Successeful delete story";
    }).fail(function(){
        console.log('error');
    })
}

function storeStory(url)
{
    const csrf = $("input:hidden[name='_token']").attr('value');
    var form = new FormData();
    form.append('_token', csrf);
    try {
        form.append('storyImage', $('#storyImage')[0].files[0]) //for now only one image can be sent
    }catch (e){
        console.log(e.message);
    }

    $.ajax({
        type: 'POST',
        url:url,
        data: form,
        processData: false,
        contentType: false,


    }).done(function(data){
        $("#cardDeck").load(location.href+" #cardDeck>*","");
        $('#success').show();
        document.getElementById("success").innerHTML="Successeful share story";
    }).fail(function ( data , error){

    });

}
