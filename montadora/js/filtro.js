$(function(){
    $("#tabela2 input").keyup(function(){
        var index = $(this).parent().index();
        var nth = "#tabela td:nth-child("+(index+2).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#tabela2 tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });

    $("#tabela2 input").blur(function(){
        $(this).val("");
    });
});
