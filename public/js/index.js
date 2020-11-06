$(".userdeletebtn").click(function () {
    var data = $(this).data('delete');
    var type = $(this).data('type');
    console.log(type);
    if (type == "user"){
        $('input:text').val(data['name']);
    }else {
        $('input:text').val(data['title']);
    }
    $('#deleteForm').attr('action','/'+type+'/'+data['id']);
});