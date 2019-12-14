function mod_borrar_Formacion()
{
    //Coger los datos de los select formacion y crear cookies para su posterior borrado
    let tipo = document.getElementById("tipo").value;
    let categoria = document.getElementById("categoria").value;
    let subcategoria = document.getElementById("subcategoria").value;

    document.cookie = "tipo="+encodeURIComponent(tipo);
    document.cookie = "categoria="+encodeURIComponent(categoria);
    document.cookie = "subcategoria="+encodeURIComponent(subcategoria);

}
