
function storePost(route) {
    const csrf = $("input:hidden[name='_token']").attr('value');

    const val = $("#message").val();

    $.post(route, {message: val, _token: csrf}, function (data) {
        $('#post_wrap').html(data);

    });
}
