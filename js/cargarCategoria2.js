function cargarCategoria(dato)
{
    //Dato que llega del select formacion para recagar el select segun la opcion
   $.ajax({
       data: {"dato": dato},
       type: "POST",
       url: '../consultas/consultarCategoria.php',
       success: function(resp){
           $('#categoria').html(resp);
       }
   });
}

function cargarCategoria2(dato,id)
{
    //Dato que llega del select formacion para recagar el select segun la opcion
    let numero = id.substring(4, 5);
    $.ajax({
        data: {"dato": dato},
        type: "POST",
        url: '../consultas/consultarCategoria2.php',
        success: function(resp){
            $('#categoria'+numero).html(resp);
        }
    });
}