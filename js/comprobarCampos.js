function comprobarCamposVacios()
{
    //Si los campos estan vacios, bloquear boton
    if($("#razonSocial").val()==="" || $("#nombreComercial").val()==="" || $("#cif").val()==="" || $("#direccion").val()==="" || $("#localidad").val()==="" ||
        $("#provincia").val()==="" || $("#pais").val()==="" || $("#responsableEmpresa").val()==="" || $("#telefonoEmpresa").val()==="")
    {
        $("#enviar").prop("disabled",true);
    }
}

function comprobarCamposNoVacios()
{
    //Si los campos tienen valor, quitar el bloqueo al boton
    if($("#razonSocial").val().length>0 && $("#nombreComercial").val().length>0 && $("#cif").val().length>0 && $("#direccion").val().length>0 && $("#localidad").val().length>0 &&
        $("#provincia").val().length>0 && $("#pais").val().length>0 && $("#responsableEmpresa").val().length>0 && $("#telefonoEmpresa").val().length>0)
    {
        $("#enviar").prop("disabled",false);
    }
}
