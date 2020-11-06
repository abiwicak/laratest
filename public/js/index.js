$(".deletebtn").click(function () {
    var data = $(this).data('delete');
    var type = $(this).data('type');
    console.log(data);
    if (type == "user"){
        $('input:text').val(data['name']);
    }
    if (type == "post"){
        $('input:text').val(data['title']);
    }
    $('#deleteForm').attr('action','/'+type+'/'+data['id']);
});