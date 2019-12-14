<?php
    //Consulta SQL con AJAX para mostrar y recargar select de Categorias.
    require "../conexion/Conexion.php";
    $objetoBBDD = new Conexion();

    $categoria = $objetoBBDD->realEscapeString($_POST["dato"]);

    $query = "SELECT DISTINCT tipo FROM formacion WHERE categoria='".$categoria."'";

    $objetoBBDD->consultarBD($query);
    $fila = $objetoBBDD->devolverFilas();

    $sql = "SELECT subcategoria FROM formacion WHERE (tipo='".$fila["tipo"]."') AND (categoria='".$categoria."');";


    $objetoBBDD->consultarBD($sql);

    while($fila = $objetoBBDD->devolverFilas())
    {
        echo '<option value="'.$fila["subcategoria"].'">'.$fila["subcategoria"].'</option>';
    }

