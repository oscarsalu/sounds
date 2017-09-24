$(document).ready(function() {
        var cl = $('#midgardcreate-edit a');
        if(cl.html() == 'Cancel   <i class="glyphicon glyphicon-remove-circle pad-move"></i>'){     
            setTimeout(function(){ $('#midgardcreate-edit a').click(); }, 3000);                                                                                                                             
        }               
    });