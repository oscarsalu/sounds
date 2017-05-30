  $(document).ready(function() {
        $('#press_item').on('click','.btn-edit', function (){
            var id = $(this).find('#id_').val();
            var quote = $(this).find('#quote_').val();
            var name = $(this).find('#name_').val();
            var author = $(this).find('#author_').val();
            var link = $(this).find('#link_').val();
            var date_on = $(this).find('#date_on_').val();
             
            $('#id').val(id);
            $('#quote').val(quote);
            $("#author").val(author);
            $("#link").val(link);
            $("#name").val(name);
            $("#date_on").val(date_on);
        });
        $('#press_item').on('click','.btn-del', function (){
            if(confirm("Are you sure you want to delete this record?")){
                var id = $(this).attr('data-idpress');
                $('#delete_id').val(id); 
                $('#form_delete').submit();
            }
        });
    }); 