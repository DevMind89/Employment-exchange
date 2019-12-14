function cargarSubCategoria(dato)
{
    //Dato que llega del select formacion para recagar el select segun la opcion
    $.ajax({
        data: {"dato": dato},
        type: "POST",
        url: '../consultas/consultarSubCategoria.php',
        success: function(resp){
            $('#subcategoria').html(resp);
        }
    });
}

function cargarSubCategoria2(dato,id)
{
    //Dato que llega del select formacion para recagar el select segun la opcion
    let numero = id.substring(9, 10);
    $.ajax({
        data: {"dato": dato},
        type: "POST",
        url: '../consultas/consultarSubCategoria.php',
        success: function(resp){
            $('#subcategoria'+numero).html(resp);
        }
    });
}