<style>
  #tablaEstudiantes
  {
    width: 90%;
    min-width: 90%;
    max-width: 90%;
    margin: auto;
  }
  .id
  {
    display: none;
  }
</style>

<div class="table-responsive center-block text-center" id="tableResponsive">
  <table class="table table-bordered table-hover text-center" id="tablaEstudiantes">
    <caption><h3 class="text-center text-info"><?=$title;?></h3></caption>
    <thead>
      <tr>
        <th class="id">id</th>
        <th class="text-center text-info">Nombres</th>
        <th class="text-center text-info">Apellidos</th>
        <th class="text-center text-info">Cedulas</th>
        <th class="text-success text-center">Elegir</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($estudiante as $estudiantes):?>
    <tr>
      <td class="id"><?=$estudiantes['id'];?></td>
      <td><?=$estudiantes['nombre'];?></td>
      <td><?=$estudiantes['apellido'];?></td>
      <td><?=$estudiantes['cedula'];?></td>
      <td>
        <button type="button" id="verInfoEstudiante" class="btn btn-success">Elegir <span class="glyphicon glyphicon-ok-sign"></span></button>
      </td>
    </tr>
  <?php endforeach;?>
  <tbody>
  </table>
  <br>
  <div class="lead text-info"> Cantidad Total: <span id="cantidad"><?= $cantidad;?></span></div>
</div>
