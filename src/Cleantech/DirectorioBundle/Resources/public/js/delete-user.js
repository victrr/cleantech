$(document).ready(function(){
    
    $('.btn-delete').click(function(e){
        e.preventDefault();
        
        var row =  $(this).parents('tr');
        
        var id = row.data('id');
        
        //alert(id);
        
        var form = $('#form-delete');
        
        var url = form.attr('action').replace(':USER_ID', id);
        
        var data = form.serialize();
        
        //alert(data);
        
        bootbox.confirm(message, function (res) {
            if(res == true)
            {
                $.post(url, data, function(result){
                    if(result.removed == 1)
                    {
                        row.fadeOut();
                    }
                    
                }).fail(function(){
                    alert('EROR')
                    row.show();
                });
            }
        });
    });
});