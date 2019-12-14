<?php
    session_start();
    require('../conexion/Conexion.php');
    $objetoBBDD = new Conexion();
    header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../images/favicon.ico">
	<title>Bolsa de empleo</title>
    <style>
        input[type="text"][disabled] {
            color: black;
        }

    </style>
	<!-- Bootstrap core CSS -->
	<link href="../dist/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Icons -->
	<link href="../css/font-awesome.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="../css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body onload="botonEnviarBloqueado()";>
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
                            <li class="nav-item"><a class="nav-link" href="../ofertas/buscarEmpresa.php">Alta Oferta</a></li>
                            <li class="nav-item"><a class="nav-link" href="../ofertas/listarOfertas.php">Listar Ofertas</a></li>
                        </ul>
                    </li>
                    <li class="parent nav-item"><a class="nav-link" data-toggle="collapse" href="#sub-item-2">
                            <em class="fa fa-briefcase">&nbsp;</em> Empresas <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><i class="fa fa-plus"></i></span>
                        </a>
                        <ul class="children collapse" id="sub-item-2">
                            <li class="nav-item"><a class="nav-link" href="altaEmpresa.php">Alta Empresa</a></li>
                            <li class="nav-item"><a class="nav-link" href="listarEmpresas.php">Listar Empresas</a></li>
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
						<h1 class="float-left text-center text-md-left">Datos de la empresa</h1>
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
                                        <?php
                                            //Mostrar todos los datos de la empresa seleccionada
                                            $idEmpresa = $_POST["idEmpresa"];
                                            $sql = 'SELECT * FROM empresas WHERE idEmpresa = '.$idEmpresa;
                                            $objetoBBDD->consultarBD($sql);
                                            $fila = $objetoBBDD->devolverFilas();
                                        ?>
                                        <form method="post" id="form" name="form" action="modificarEmpresa.php">
                                            <input type="hidden" name="idEmpresa"  id="idEmpresa" value="<?php echo $fila["idEmpresa"];?>">
                                            <label>Razón Social: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="razonSocial" id="razonSocial" disabled="disabled" value="<?php echo $fila["razonSocial"];?>">
                                            <button type="button" onclick=" desbloquearInputs();" id="modificar" name="modificar" class="btn btn-sm btn-secondary float-right">Modificar</button><br><br>
                                            <label>Nombre Comercial: </label>
                                            <input type="text" size="21" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="nombreComercial" id="nombreComercial" disabled="disabled" value="<?php echo $fila["nombreComercial"];?>">
                                            <label>CIF: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="cif" id="cif" disabled="disabled" value="<?php echo $fila["cif"];?>">
                                            <label>Dirección: </label>
                                            <input type="text" size="20" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="direccion" id="direccion" disabled="disabled" value="<?php echo $fila["direccion"];?>"><br><br>
                                            <label>Localidad: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="localidad" id="localidad" disabled="disabled" value="<?php echo $fila["localidad"];?>">
                                            <label>Provincia: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="provincia" id="provincia" disabled="disabled" value="<?php echo $fila["provincia"];?>">
                                            <label>País: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="pais" id="pais" disabled="disabled" value="<?php echo $fila["pais"];?>"><br><br>
                                            <label>Responsable Empresa: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="responsableEmpresa" id="responsableEmpresa" disabled="disabled" value="<?php echo $fila["responsableEmpresa"];?>">
                                            <label>Telefono Responsable: </label>
                                            <input type="text" size="15" name="telefonoResponsable" id="telefonoResponsable" disabled="disabled" value="<?php echo $fila["telefonoResponsable"];?>"><br><br>
                                            <label>Telefono Empresa: </label>
                                            <input type="text" size="15" onchange="comprobarCamposVacios();comprobarCamposNoVacios();" name="telefonoEmpresa" id="telefonoEmpresa" disabled="disabled" value="<?php echo $fila["telefonoEmpresa"];?>">
                                            <label>Tipo de Convenio: </label>
                                            <select disabled="disabled" name="tipoEmpresa" id="tipoEmpresa">
                                                <option value="<?php echo $fila["tipoEmpresa"];?>"><?php echo $fila["tipoEmpresa"];?></option>
                                                <?php
                                                    if($fila["tipoEmpresa"]=="FCT")
                                                    {
                                                        echo'<option value="NoFCT">NoFCT</option>';
                                                    }
                                                    else
                                                    {
                                                        echo'<option value="FCT">FCT</option>';
                                                    }
                                                ?>
                                            </select>
                                            <button type="submit"  id="enviar" name="enviar" style="margin-left: 80%;" class="btn btn-primary btn-md float-left">Enviar</button>
                                        </form>
                                        <button type="button"  id="borrar" onclick="borrar();" name="borrar" class="btn btn-primary btn-md float-right">Borrar</button><br><br>
                                        <div hidden id="resp">
                                            <form action="borrarEmpresa.php" method="post">
                                                ¿Estas seguro que deseas borrar esta empresa?
                                                <input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $fila["idEmpresa"];?>">
                                                <button type="submit" name=""  class="btn btn-primary btn-md">Si</button>&nbsp
                                                <button type="button" onclick="ocultarMenu();" name="No" class="btn btn-primary btn-md ">No</button>
                                            </form>
                                        </div>
                                    </div>
								</div>
							</div>
						</section>
					</div>
				</section>
			</main>
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
    <script src="../js/cargarCategoria.js"> </script>
    <script src="../js/cargarSubCategoria.js"> </script>
    <script src="../js/mod_borrar_Formacion.js"> </script>
    <script src="../js/comprobarCampos.js"></script>
    <script>
        function botonEnviarBloqueado()
        {
            $("#idEmpresa").attr("enabled", true);
            if($("input").prop("disabled",true) && $("select").prop("disabled",true))
            {
                $("#enviar").attr("disabled", true);
                $("#borrar").attr("disabled", true);
            }
        }

        function desbloquearInputs()
        {
            $("input").prop("disabled", false);
            $("select").prop("disabled", false);
            $("#enviar").prop("disabled",false);
            $("#borrar").attr("disabled", false);
        }

        function borrar()
        {
            $("#resp").prop("hidden", false);
        }

        function ocultarMenu() {
            $("#resp").prop("hidden", true);
        }
    </script>
</body>
</html>