<link rel="stylesheet" href="./public/css/verInfoEstudiantes.css">
<div class="table-responsive">
  <h2 class="text-info text-center center-block">Información del Estudiante</h2>
<table class="table table-bordered">
  <caption><h3 class="text-center text-success tex-center center-block">Datos Personales</h3></caption>
  <thead>
    <tr>
      <th class="text-center text-info id">id</th>
      <th class="text-center text-info">Nombres</th>
      <th class="text-center text-info">Apellidos</th>
      <th class="text-center text-info">Cedula</th>
      <th class="text-center text-info">Telefono</th>
      <th class="text-center text-info">Correo</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center id"><?=$data[0]['usuarios_id'];?></td>
      <td class="tipo hidden">usuarios</td>
      <td class="text-center editableEstudiantes" data-campo='nombre'> <span><?=$data[0]['nombre'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="apellido"> <span><?=$data[0]['apellido'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="cedula"> <span><?=$data[0]['cedula'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="telefono"> <span><?=$data[0]['telefono'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="correo"> <span><?=$data[0]['correo'];?></span></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered">
  <caption><h3 class="text-success text-center">Direccion de Estudiantes</h3></caption>
  <thead>
    <tr>
      <th class="text-center text-info id">Id</th>
      <th class="text-center text-info">Direccion</th>
      <th class="text-center text-info">Lugar de Trabajo</th>
      <th class="text-center text-info">Cargo </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center id"><?=$data[0]['usuarios_id'];?></td>
      <td class="tipo hidden">usuarios</td>
      <td class="text-center editableEstudiantes" data-campo="direccion"><span><?=$data[0]['direccion'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="lugar_de_trabajo"><span><?=$data[0]['lugar_de_trabajo'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="cargo_o_departamento"><span><?=$data[0]['cargo_o_departamento'];?></span></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered">
  <caption><h3 class="text-center center-block text-success">Usuario del Estudiante</h3></caption>
  <thead>
    <tr>
      <th class="text-center text-info id">Id</th>
      <th class="text-center text-info">Usuario</th>
      <th class="text-center text-info">Tipo Usuario</th>
      <th class="text-center text-info">Clave de Usuario</th>
      <th class="text-center text-info">Estado de Usuario</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center id"><?=$data[0]['usuarios_id'];?></td>
      <td class="tipo hidden">usuarios</td>
      <td class="text-center editableEstudiantes"data-campo='usuario'><span><?=$data[0]['usuario'];?></span></td>
      <td class="text-center"><?=$data[0]['tipo_usuario'];?></td>
      <td class="text-center editableEstudiantes"data-campo='clave'><span><?=$data[0]['clave'];?></span></td>
      <?php if($data[0]['estado']=="activo"){?>
      <td class="text-center text-success editableEstudiantes" data-campo="estado"><span><?=$data[0]['estado'];?></span></td>
      <?php
      }
      else
      {
        ?>
      <td class="text-center text-danger editableEstudiantes" data-campo="estado"><span><?=$data[0]['estado'];?></span></td>
        <?php
      }
     ?>
    </tr>
  </tbody>
</table>

<table class="table table-bordered">
  <caption><h3 class="text-center center-block text-success">Datos de Estudios</h3></caption>
  <thead>
    <tr>
      <th class="id">id</th>
      <th class="text-center text-info">Area de Conocimiento</th>
      <th class="text-center text-info">Línea de Investigacion</th>
      <th class="text-center text-info">Tipo de Estudios</th>
      <th class="text-center text-info">Seccion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="id text-center"><?=$data[0]['usuarios_id'];?></td>
      <td class="text-center editableEstudiantes" data-campo='area_conocimiento'><span><?=$data[0]['area_conocimiento'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo='propuesta_de_investigacion'><span><?=$data[0]['propuesta_de_investigacion'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo='tipo_estudio'><span><?=$data[0]['tipo_estudio'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo='seccion'><span><?=$data[0]['seccion'];?></span></td>
    </tr>
  </tbody>
</table>

<table class="table table-bordered">
  <caption><h3 class="text-center center-block text-success">Unidades Curriculares</h3></caption>
  <thead>
    <tr>
      <th class="text-center text-info id">ID</th>
      <th class="text-center text-info">Nombres de las Unidades</th>
      <th class="text-center text-info">Tipo de Unidad</th>
      <th class="text-center text-info">Ponderacion Cualitativa</th>
      <th class="text-center text-info">Ponderacion Cuantitativa</th>
      <th class="text-center text-info">Periodo</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data as $datos ){?>
    <tr>
      <td class="id"><?=$data[0]['usuarios_id'];?></td>
      <td class="id_unidad hidden"><?=$datos['id_unidad']?></td>
      <td class="tipo hidden">unidades_curriculares</td>
      <td class="text-center editableEstudiantes" data-campo="nombre_unidad" ><span><?=$datos['nombre_unidad'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="tipo" ><span><?=$datos['tipo'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="ponderacion_cualitativa" ><span><?=$datos['ponderacion_cualitativa'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="ponderacion_cuantitativa" ><span><?=$datos['ponderacion_cuantitativa'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo="periodo" ><span><?=$datos['periodo'];?></span></td>
    </tr>
  <?php }?>
  </tbody>
</table>

<table class="table table-bordered">
  <caption><h3 class="text-center center-block text-success">Otras Informaciones</h3></caption>
  <thead>
    <tr>
      <th class="text-center text-info id">Id</th>
      <th class="text-center text-info">Responsable</th>
      <th class="text-center text-info">Año de Ingreso</th>
      <th class="text-center text-info">Condicion de Pago</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-center id"><?=$data[0]['usuarios_id'];?></td>
      <td class="tipo hidden">prosecuciones</td>
      <td class="text-center"><?=$data[0]['responsable'];?></td>
      <td class="text-center editableEstudiantes" data-campo='ano_ingreso'><span><?=$data[0]['ano_ingreso'];?></span></td>
      <td class="text-center editableEstudiantes" data-campo='condicion_de_pago'><span><?=$data[0]['condicion_de_pago'];?></span></td>
    </tr>
  </tbody>
</table>
</div>
<br><br>
<div class="row">
  <div class="col-xm-4 col-sm-4 col-md-4 col-lg-4 text-center">
    <a href="Estudiantes/pdfCartaDeEstudios/<?php echo $data[0]['usuarios_id'];?>" class="btn btn-primary" >Imprimir Carta de Estudios</a>
  </div>
  <div class="col-xm-4 col-sm-4 col-md-4 col-lg-4 text-center">
    <a href="Estudiantes/pdfInscripcion/<?php echo $data[0]['usuarios_id'];?>" class="btn btn-primary">Imprimir Planilla de Inscripcion </a>
  </div>
  <div class="col-xm-4 col-sm-4 col-md-4 col-lg-4 text-center">
    <a href="Estudiantes/pdfNotas/<?php echo $data[0]['usuarios_id'];?>" class="btn btn-primary">Imprimir Record de Notas</a>
  </div>
</div>
<br><br>
