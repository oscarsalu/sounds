	$(document).ready(function() {
    	    $('.list-item').on('click','ul li .btn-edit', function (){
    	        var parent = $(this).parent();
    	        var id = parent.find('.id').val();
    	        var user_id =  parent.find('.user_id').val();
    	        var desc= parent.find('.desc').val();
                var name = parent.find('.name').val();
                var genre = parent.find('.genre').val();
                var image = parent.find('.image').val();
    	        $('#editplaylist .id').val(id);
                $('#editplaylist .name').val(name);
                $('#editplaylist .desc').val(desc); 
                $('#editplaylist .user_id').val(user_id);
                $('#editplaylist .genre').val(genre);
                $('#editplaylist .image').val(image);
    	    });
    	    $('.list-item').on('click','ul li .btn-del', function (){
    	        if(confirm("Are you sure you want to delete this record?")){
    	            var parent = $(this).parent();
    	            var id = parent.find('.id').val();
    	            $('#form_delete .delete_id').val(id); 
                    $('#form_delete').submit();
    	        }
    	        
    	    });
    	});