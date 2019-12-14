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
<body>
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
                            <li class="nav-item"><a class="nav-link" href="altaAlumnos.php">Alta Alumnos</a></li>
                            <li class="nav-item"><a class="nav-link" href="listarAlumnos.php">Listar Alumnos</a></li>
                        </ul>
                    </li>
				</ul>
				<a href="../index.html" class="logout-button"><em class="fa fa-power-off"></em> Salir</a>
			</nav>
				
			<a href="../index.html" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">Alumnos</h1>
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
                                       <!-- formulario alta alumnos-->
                                        <h3><i>Alta de alumnos</i></h3><br>
                                            <form action="altaAlumnosVerificar.php" method="post">
                                                <label>* NIA: </label>
                                                <input type="text" size="15" onchange="comprobarCamposVacios1();comprobarCamposNoVacios1();" name="nia" id="nia"><br><br>
                                                <label>* Apellidos-Nombre: </label>
                                                <input type="text" size="20" onchange="comprobarCamposVacios1();comprobarCamposNoVacios1();" name="apellidosNombre" id="apellidosNombre">
                                                <label>* Correo: </label>
                                                <input type="text" size="25" onchange="comprobarCamposVacios1();comprobarCamposNoVacios1();" name="correo" id="correo"><br><br>
                                                <label>* Carnet: </label>
                                                <select id="carnet" name="carnet" >
                                                    <option value=""></option>
                                                    <option value="Ninguno">Ninguno</option>
                                                    <option value="A">A</option>
                                                    <option value="A1">A1</option>
                                                    <option value="A2">A2</option>
                                                    <option value="B">B</option>
                                                </select>
                                                <label>* Telefono: </label>
                                                <input type="text" size="15" onchange="comprobarCamposVacios1();comprobarCamposNoVacios1();" name="telefono" id="telefono">
                                                <label>* Situacion Laboral: </label>
                                                <select id="situacionLaboral" name="situacionLaboral"">
                                                    <option value=""></option>
                                                    <option value="Desempleado">Desempleado</option>
                                                    <option value="Trabajando">Trabajando</option>
                                                    <option value="MejorarTrabajo">MejorarTrabajo</option>
                                                </select><br><br>
                                                <label>* Observaciones: </label><br>
                                                <textarea rows="2" cols="50" onchange="comprobarCamposVacios1();comprobarCamposNoVacios1();" id="observaciones" name="observaciones"></textarea><br><br>
                                                <b><span>* Campos obligatorios</span></b><br><br>

                                                <h3><i>Conocimientos</i></h3>
                                                <div class="card-block">
                                                        <?php
                                                            //Consulta SQL con AJAX para rellenar los select y recargar los demas select segun la opcion elegida
                                                            $sql = "SELECT * FROM formacion";
                                                            $objetoBBDD->consultarBD($sql);
                                                            if($objetoBBDD->devolverFilas()==0)
                                                            {
                                                                echo '<div style="color:red;font-weight: bold">No existen formaciones para asignar a este alumno.</div><br>';
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
                                                <h3><i>Actitudes</i></h3>
                                                <div class="card-block">
                                                    <?php
                                                    //Consulta SQL con AJAX para rellenar los select y recargar los demas select segun la opcion elegida
                                                        $sql = "SELECT * FROM formacion";
                                                        $objetoBBDD->consultarBD($sql);
                                                        if($objetoBBDD->devolverFilas()==0)
                                                        {
                                                            echo '<div style="color:red;font-weight: bold">No existen actitudes para asignar a este alumno.</div><br>';
                                                            echo '<a href="../inicio.php"><button type="button" class="btn btn-primary btn-md float-left">Volver</button></a>';
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
                                                </div>
                                                <input type="submit" id="alta" name="alta" value="Alta" class="btn btn-primary btn-md float-right">
                                            </form>
									</div>
								</div>
							</div>
						</section>
					</div>
            </section>
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
        $(document).ready(function()
        {
            $("#alta").prop("disabled",true);
        });

        function comprobarCamposVacios1()
        {
            if($("#nia").val()==="" || $("#apellidosNombre").val()==="" || $("#correo").val()==="" || $("#telefono").val()==="" || $("#observaciones").val()==="")
            {
                $("#alta").prop("disabled",true);
            }
        }

        function comprobarCamposNoVacios1()
        {
            if($("#nia").val().length>0 && $("#apellidosNombre").val().length>0 && $("#correo").val().length>0 && $("#telefono").val().length>0 && $("#observaciones").val().length>0)
            {
                $("#alta").prop("disabled",false);
            }
        }

    </script>
</body>
</html>