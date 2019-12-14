<?php
    session_start();
    require('../conexion/Conexion.php');
    $objetoBBDD = new Conexion();
    header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../images/favicon.ico">
	<title>Bolsa de empleo</title>
    <style>#descripcion,#observaciones{resize: none}</style>
	<!-- Bootstrap core CSS -->
	<link href="../dist/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Icons -->
	<link href="../css/font-awesome.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body onload="bloquearBoton();">
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
				<h1 class="site-title"><a href="../inicio.php"><em class="fa fa-rocket"></em> Bolsa<br> de Empleo</a></h1>

				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				<ul class="nav nav-pills flex-column sidebar-nav">
					<li class="nav-item"><a class="nav-link" href="../inicio.php"><em class="fa fa-home"></em> Inicio <span class="sr-only">(current)</span></a></li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-1">
                            <em class="fa fa-clipboard">&nbsp;</em> Ofertas <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-1">
                            <li class="nav-item"><a class="nav-link" href="buscarEmpresa.php">Alta Oferta</a></li>
                            <li class="nav-item"><a class="nav-link" href="listarOfertas.php">Listar Ofertas</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-2">
                            <em class="fa fa-briefcase">&nbsp;</em> Empresas <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-2">
                            <li class="nav-item"><a class="nav-link" href="../empresa/altaEmpresa.php">Alta Empresa</a></li>
                            <li class="nav-item"><a class="nav-link" href="../empresa/listarEmpresas.php">Listar Empresas</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-3">
                            <em class="fa fa-book">&nbsp;</em> Formacion <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-3">
                            <li class="nav-item"><a class="nav-link" href="../formacion/altaFormacion.php">Alta Formacion</a></li>
                            <li class="nav-item"><a class="nav-link" href="../formacion/listarFormacion.php">Listar Formacion</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-4">
                            <em class="fa fa fa-child">&nbsp;</em> Alumnos <span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-4">
                            <li class="nav-item"><a class="nav-link" href="../alumnos/altaAlumnos.php">Alta Alumnos</a></li>
                            <li class="nav-item"><a class="nav-link" href="../alumnos/listarAlumnos.php">Listar Alumnos</a></li>
                        </ul>
                    </li>
				</ul>
				<a href="../index.html" class="logout-button"><em class="fa fa-power-off"></em> Salir</a>
			</nav>
				
			<a href="../index.html" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">Oferta de Empleo</h1>
					</div>
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="../images/profile-pic.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						<div class="username mt-1">
							<h4 class="mb-1">Usuario</h4>
                            <h6 class="text-muted"><?php echo $_SESSION["usuario"] ?></h6>
						</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="../index.html"><em class="fa fa-power-off mr-1"></em> Cerrar sesión</a>
						</div>
					</div>
					<div class="clear"></div>
				</header>
				<section class="row">
					<div class="col-sm-12">
						<section class="row">
							<div class="col-12">
								<div class="card mb-4">
									<div class="card-block">
                                        <h3><i>Datos de la empresa</i></h3>
                                        <?php
                                            //Si existe la empresa muestra sus datos
                                            if(isset($_POST["cif"]))
                                            {
                                                $cif = "'".$_POST["cif"]."'";
                                                $sql = "SELECT * FROM empresas WHERE cif=".$cif;
                                                $objetoBBDD->consultarBD($sql);
                                                $fila = $objetoBBDD->devolverFilas();

                                                if($cif === "'".$fila["cif"]."'")
                                                {
                                        ?>
                                        <!-- datos de la empresa buscada por cif-->
                                            <form enctype="multipart/form-data" action="altaOfertasVerificar.php" method="post">
                                                <label>Razón Social: </label>
                                                <input type="text" size="15" disabled name="razonSocial" id="razonSocial" value="<?php echo $fila["razonSocial"];?>"><br><br>
                                                <label>Nombre Comercial: </label>
                                                <input type="text" size="21" disabled name="nombreComercial" id="nombreComercial" value="<?php echo $fila["nombreComercial"];?>">
                                                <?php $_SESSION["nombreComercial"] = $fila["nombreComercial"]?>
                                                <label>CIF: </label>
                                                <input type="text" size="15" name="cif" id="cif" disabled="disabled" value="<?php echo $fila["cif"];?>">
                                                <label>Dirección: </label>
                                                <input type="text" size="20" disabled name="direccion" id="direccion" value="<?php echo $fila["direccion"];?>"><br><br>
                                                <label>Localidad: </label>
                                                <input type="text" size="15" disabled name="localidad" id="localidad" value="<?php echo $fila["localidad"];?>">
                                                <label>Provincia: </label>
                                                <input type="text" size="15" disabled name="provincia" id="provincia" value="<?php echo $fila["provincia"];?>">
                                                <label>País: </label>
                                                <input type="text" size="15"  disabled name="pais" id="pais" value="<?php echo $fila["pais"];?>"><br><br>
                                                <label>Telefono Empresa: </label>
                                                <input type="text" size="15" disabled name="telefonoEmpresa" id="telefonoEmpresa" value="<?php echo $fila["telefonoEmpresa"];?>"><br><br><br>

                                                <!--Formulario datos de la oferta-->
                                                <h3><i>Datos de la oferta</i></h3>
                                                 <div class="card-block ">
                                                         <label>* Nombre: </label>
                                                         <input type="text" size="40" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" id="nombreOferta" name="nombreOferta"><br><br>
                                                         <label>* Descripción: </label><br>
                                                         <textarea rows="2" cols="50"  onchange="comprobarCamposVacios();comprobarCamposNoVacios();" id="descripcion" name="descripcion"></textarea><br><br>
                                                         <label>* Duración: </label>
                                                         <select id="duracion" name="duracion" onchange="comprobarCamposVacios();comprobarCamposNoVacios()">
                                                             <option value=""></option>
                                                             <option value="tiempoParcial">Tiempo Parcial</option>
                                                             <option value="tiempoCompleto">Tiempo Completo</option>
                                                         </select>
                                                         <label>* Horario: </label>
                                                         <select id="horario" name="horario" onchange="comprobarCamposVacios();comprobarCamposNoVacios()">
                                                             <option value=""></option>
                                                             <option value="manana">Mañana</option>
                                                             <option value="tarde">Tarde</option>
                                                             <option value="mananaTarde">Mañana-Tarde</option>
                                                         </select>
                                                         <label>* Salario: </label>
                                                         <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" id="salario" name="salario">
                                                         <label>* Nº de vacantes: </label>
                                                         <input type="text" size="2" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" id="vacantes" name="vacantes">
                                                 </div><br><br>

                                                <!--Formulario para mostrar los requisitos-->
                                                <h3><i>Conocimientos</i></h3>
                                                <div class="card-block">
                                                        <?php
                                                            $sql = "SELECT * FROM formacion";
                                                            $objetoBBDD->consultarBD($sql);
                                                            if($objetoBBDD->devolverFilas()==0)
                                                            {
                                                                echo '<div style="color:red;font-weight: bold">No existen formaciones para asignar a esta oferta.</div><br>';
                                                            }
                                                            else
                                                            {
                                                                $i = 0;
                                                                for($i = 0;$i < 5;$i++)
                                                                {
                                                        ?>          <b><label>Requisito <?php echo ($i+1);?> →</label></b>
                                                                    <b><label>&nbsp&nbspTipo:&nbsp&nbsp</label></b>
                                                                    <select id="tipo<?php echo $i;?>" name="tipo<?php echo $i;?>" onchange="cargarCategoria2(this.value,this.id)">
                                                                        <?php
                                                                            $sql = "SELECT DISTINCT tipo FROM formacion";
                                                                            $objetoBBDD->consultarBD($sql);
                                                                            echo '<option value="Opcion">Seleccione una opcion</option>';
                                                                            while($fila = $objetoBBDD->devolverFilas())
                                                                            {
                                                                                echo '<option value="'.$fila["tipo"].'" id="'.$i.'">'.$fila["tipo"].'</option>';
                                                                            }
                                                                        ?>
                                                                    </select>

                                                                    <b><label>&nbsp&nbspCategoria:&nbsp&nbsp</label></b>
                                                                    <select id="categoria<?php echo $i;?>" name="categoria<?php echo $i;?>" onchange="cargarSubCategoria2(this.value,this.id)"></select>

                                                                    <b><label>&nbsp&nbspSubcategoria:&nbsp&nbsp</label></b>
                                                                    <select id="subcategoria<?php echo $i;?>" name="subcategoria<?php echo $i;?>"></select><br><br>
                                                        <?php

                                                                }
                                                            }
                                                        ?>
                                                </div>
                                                <!--Formulario con las actitudes-->
                                                <h3><i>Actitudes</i></h3>
                                                <div class="card-block">
                                                    <?php
                                                        $sql = "SELECT * FROM formacion";
                                                        $objetoBBDD->consultarBD($sql);
                                                        if($objetoBBDD->devolverFilas()==0)
                                                        {
                                                            echo '<div style="color:red;font-weight: bold">No existen actitudes para asignar a esta oferta.</div><br>';
                                                            echo '<a href="buscarEmpresa.php"><button type="button" class="btn btn-primary btn-md float-right">Volver</button></a>';
                                                        }
                                                        else
                                                        {
                                                            $i = 0;
                                                            for($i = 0;$i < 3;$i++)
                                                            {
                                                    ?>          <b><label>Actitud <?php echo ($i+1);?> →</label></b>
                                                                <select id="actitud<?php echo $i;?>" name="actitud<?php echo $i;?>">
                                                                    <?php
                                                                        $sql = "SELECT subcategoria FROM formacion WHERE categoria='Actitudes'";
                                                                        $objetoBBDD->consultarBD($sql);
                                                                        echo '<option value="Opcion">Seleccione una opcion</option>';
                                                                        while($fila = $objetoBBDD->devolverFilas())
                                                                        {
                                                                            echo '<option value="'.$fila["subcategoria"].'">'.$fila["subcategoria"].'</option>';
                                                                        }
                                                                    ?>
                                                                </select><br><br>
                                                    <?php

                                                            }
                                                        }
                                                    ?>
                                                        <label>* Observaciones: </label><br>
                                                        <textarea rows="2" cols="50"  onchange="comprobarCamposVacios();comprobarCamposNoVacios();" id="observaciones" name="observaciones"></textarea><br><br>
                                                            * Archivo oferta <input type="file" id="archivo" name="archivo">
                                                            <input type="submit" id="enviar" name="enviar" value="Enviar" class="btn btn-primary btn-md float-right">
                                                        </form>
                                                        <br><br><b><span>* Campos obligatorios</span></b>
                                                </div>
                                        <?php
                                                }
                                                else
                                                {
                                                    //Si la empresa no existe, ir al alta de empresas
                                                    echo'El CIF introducido no pertenece a ninguna empresa registrada. <br><br>¿Desea darla de alta?<br>';
                                                    echo'<a href="../empresa/altaEmpresa.php"> <button type="button" name=""  class="btn btn-primary btn-md">Si</button></a>&nbsp';
                                                    echo '<a href="buscarEmpresa.php"> <button type="button" name=""  class="btn btn-primary btn-md">No</button></a>';
                                                }
                                            }
                                      ?>

									</div>
								</div>
							</div>
						</section>
					</div>
		</div>


	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="../dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../js/cargarCategoria2.js"> </script>
    <script src="../js/cargarSubCategoria.js"> </script>
    <script src="../js/mod_borrar_Formacion.js"> </script>
    <script>
        function bloquearBoton()
        {
            $("#enviar").prop("disabled",true);
        }
        function comprobarCamposVacios()
        {
            if($("#nombreOferta").val()==="" || $("#descripcion").val()==="" || $("#duracion").val()==="" || $("#horario").val()==="" || $("#salario").val()==="" ||
                $("#vacantes").val()==="" || ($("#subcategoria0").val()===null) || ($("#subcategoria1").val()===null) || ($("#actitud0").val()==="Seleccione una opcion") || ($("#actitud1").val()==="Seleccione una opcion"))
            {
                $("#enviar").prop("disabled",true);
            }
        }

        function comprobarCamposNoVacios()
        {
            if($("#nombreOferta").val().length>0 && $("#descripcion").val().length>0 && $("#duracion").val().length>0 && $("#horario").val().length>0 && $("#salario").val().length>0 &&
                $("#vacantes").val().length>0 && ($("#subcategoria0").val().length>0) && ($("#subcategoria1").val().length>0) && ($("#actitud0").val()!=="Seleccione una opcion") && ($("#actitud1").val()!=="Seleccione una opcion"))
            {
                $("#enviar").prop("disabled",false);
            }
        }

    </script>
</body>
</html>