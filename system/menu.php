<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">
			   <li class="active">
				<a href="inicio.php">	<i class="fa fa-home"></i><span>Inicio</span></a>	</li>

				<?php if(isset($_SESSION['m1'])){ if($_SESSION['m1']=="1"){ ?>
			<li><a href="ingreso_clientes.php"><i class="fas fa-user-tie"></i>	<span> Clientes</span></a>	</li>
		<?php } } ?>
		<?php if(isset($_SESSION['m2'])){ if($_SESSION['m2']=="1"){ ?>
			<li><a href="vista_solicitud.php"><i class="fas fa-paper-plane"></i><span>Solicitudes De Servicio</span>	</a></li>
		<?php } } ?>
		<?php if(isset($_SESSION['m3'])){ if($_SESSION['m3']=="1"){ ?>
			 <li class="treeview">	<a href="#"><i class="fas fa-bus"></i><span> Buses</span>
 				<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
 				<ul class="treeview-menu">
 					<li><a href="ingreso_bus.php"><i class="fas fa-shuttle-van"></i> <span> Buses</span>	</a></li>
 					<li><a href="ingreso_revision_bus.php"><i class="fas fa-address-book"></i> <span> Revisión De Buses</span></a></li>
 			  </ul>
 			</li>
		<?php } } ?>
<?php if(isset($_SESSION['m4'])){ if($_SESSION['m4']=="1"){ ?>
			 <li class="treeview">	<a href="#"><i class="fas fa-map-marked-alt"></i><span> Rutas</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li><a href="ingreso_ruta.php"><i class="fas fa-route"></i><span> Rutas</span>	</a></li>
						<!-- <li><a href="cargos.php"><i class="fa fa-user"></i><span> Personas En Rutas</span></a></li> -->
					</ul>
				</li>
		<?php } } ?>


<?php if(isset($_SESSION['m5'])){ if($_SESSION['m5']=="1"){ ?>
			<li><a href="ingreso_ayudante.php"><i class="fa fa-user"></i><span>Ayudantes</span>	</a></li>
<?php } } ?>
<?php if(isset($_SESSION['m6'])){ if($_SESSION['m6']=="1"){ ?>
			<li><a href="ingreso_pagos_socios.php"><i class="fas fa-donate"></i><span> Cuotas Sociales</span>	</a></li>
	<?php } } ?>
	<?php if(isset($_SESSION['m7'])){ if($_SESSION['m7']=="1"){ ?>
			<li><a href="ingreso_liquidaciones.php"><i class="fas fa-hand-holding-usd"></i><span> Liquidaciones</span>	</a></li>
<?php } } ?>
<?php if(isset($_SESSION['m8'])){ if($_SESSION['m8']=="1"){ ?>
			<li class="treeview">	<a href="#"> <i class="fas fa-money-bill-wave"></i><span> Pagos Clientes</span>
				 <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				 <ul class="treeview-menu">
					 <li><a href="ingreso_pagos_clientes.php"><i class="fas fa-coins"></i> <span> Nuevo Pago</span>	</a></li>
					 <li><a href="buscar_pagos_clientes.php"><i class="fas fa-clipboard-list"></i> <span> Lista de Pagos</span>	</a></li>
					 <li><a href="ingreso_pago_externo.php"><i class="fas fa-coins"></i> <span> Pago Viajes Extra</span>	</a></li>
					 <!-- <li><a href="cargos.php"><i class="fa fa-user"></i><span> Personas En Rutas</span></a></li> -->
				 </ul>
			 </li>
	<?php } } ?>

<?php if(isset($_SESSION['m9'])){ if($_SESSION['m9']=="1"){ ?>
			<li class="treeview">	<a href="#"> <i class="fas fa-handshake"></i><span> Juntas</span>
				 <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				 <ul class="treeview-menu">
					 <li><a href="ingreso_reunion.php"><i class="far fa-handshake"></i> <span> Reunión</span>	</a></li>
					 <!-- <li><a href="cargos.php"><i class="fa fa-user"></i><span> Personas En Rutas</span></a></li> -->
				 </ul>
			 </li>
	<?php } } ?>
<?php if(isset($_SESSION['m10'])){ if($_SESSION['m10']=="1"){ ?>
			<li class="treeview">	<a href="#"> <i class="fas fa-folder-open"></i><span> Reportes</span>
				 <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				 <ul class="treeview-menu">
					 <li><a href="vista_reporte_empleado.php"><i class="fas fa-file-pdf"></i><span> Empleados</span>	</a></li>
					 <li><a href="vista_reporte_cliente.php"><i class="fas fa-file-pdf"></i><span> Clientes</span>	</a></li>
					 <li><a href="vista_reporte_personas_rutas.php"><i class="fas fa-file-pdf"></i><span> Personas por Ruta</span>	</a></li>
					 <li><a href="vista_reporte_socios.php"><i class="fas fa-file-pdf"></i><span> Socios</span>	</a></li>
					 <li><a href="vista_reporte_deuda_socios.php"><i class="fas fa-file-pdf"></i><span> deuda de Socios</span>	</a></li>
					 <li><a href="vista_reporte_liquidaciones.php"><i class="fas fa-file-pdf"></i><span> Liquidaciones</span>	</a></li>
					 <li><a href="vista_reporte_certificado.php"><i class="fas fa-file-pdf"></i><span> Certificados</span>	</a></li>
					 <!-- <li><a href="cargos.php"><i class="fa fa-user"></i><span> Personas En Rutas</span></a></li> -->
				 </ul>
			 </li>
  <?php } } ?>

<?php if(isset($_SESSION['m11'])){ if($_SESSION['m11']=="1"){ ?>
			<li class="treeview">	<a href="#"><i class="fa fa-list-ul"></i>	<span> Administrar</span>
				<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
					<li><a href="ingreso_empleado.php">	<i class="fas fa-user-cog"></i><span> Administrar Empleados</span>	</a></li>
					<li><a href="ingreso_cargo.php"><i class="fas fa-sitemap"></i><span> Administrar Cargos</span></a></li>
					<li><a href="ingreso_tipo_reunion.php"> <i class="fas fa-handshake"></i><span> Adm. Tipo de Reunion</span></a></li>
					<li><a href="ingreso_institucion.php">	<i class="fas fa-university"></i><span> Administrar Intituciones</span>	</a></li>
					<li><a href="ingreso_curso.php">	<i class="fas fa-table"></i><span> Administrar Curso</span>	</a></li>
					<li><a href="ingreso_deuda_cuota_social.php">	<i class="fas fa-donate"></i><span> Cuotas Sociales</span>	</a></li>
					<li><a href="ingreso_deuda_clientes.php">	<i class="fas fa-money-bill-wave"></i><span> Deuda Clientes</span>	</a></li>
					<li><a href="ingreso_noticias_web.php">	<i class="fas fa-globe"></i><span> Noticias Web</span>	</a></li>

			  </ul>
			</li>
		<?php } } ?>

		<?php if(isset($_SESSION['PRIV'])){ if($_SESSION['PRIV']=="Cliente"){ ?>
			<li><a href="ingreso_estudiantes.php"><i class="fa fa-user"></i><span>Estudiantes</span>	</a></li>
			<li><a href="ver_rutas_asignadas.php"><i class="fas fa-route"></i><span>Rutas Asignadas</span>	</a></li>
			<li><a href="ver_pagos_realizados.php"><i class="fas fa-hand-holding-usd"></i><span>Pagos Realizados</span>	</a></li>
			<!-- <li><a href="ingreso_solicitud_servi.php"><i class="fas fa-paper-plane"></i><span>Solicitar Servicio</span>	</a></li> -->
		<?php } } ?>
		<?php if(isset($_SESSION['socio'])){ if($_SESSION['socio']=="1"){ ?>
			<li><a href="ver_lista_juntas.php"><i class="fas fa-handshake"></i><span>Juntas</span>	</a></li>
			<li><a href="ver_cuotas_realizados.php"><i class="fas fa-hand-holding-usd"></i><span>Pagos Realizados</span>	</a></li>
			<!-- <li><a href="ingreso_solicitud_servi.php"><i class="fas fa-paper-plane"></i><span>Solicitar Servicio</span>	</a></li> -->
		<?php } } ?>

		<?php if(isset($_SESSION['socio'])){ if($_SESSION['socio']=="3"){ ?>
			<li><a href="ver_lista_personas.php"><i class="fas fa-users"></i><span>ver Pasajeros</span>	</a></li>
			<!-- <li><a href="ingreso_solicitud_servi.php"><i class="fas fa-paper-plane"></i><span>Solicitar Servicio</span>	</a></li> -->
		<?php } } ?>
		</ul>
	 </section>
</aside>
