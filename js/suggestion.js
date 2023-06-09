creature_names = {}
$("#creatura").autocomplete({
    source: function(request, response){
        $.ajax({
            url: '../suggestion.php',
            type: 'GET',
            dataType: 'json',
            success:function(data){
                creature_names = $.map(data,function(value){
                    return{
                        id:value.nome,
                        label:value.nome
                    };
                });
                var result = $.ui.autocomplete.filter(creature_names,request.term);
                response(result);
            }
            })
    }
});