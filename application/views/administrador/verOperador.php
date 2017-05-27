
<link rel="stylesheet" href="./public/css/verOperador.css">
<div class="modal fade" tabindex="-1" role="dialog" id="dialogoOperador" aria-labelledby="myModalLabel" aria-hidden='true'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					Eliminar Operador
				</h4>
			</div>
			<div class="modal-body text-center">
					Deseas Eliminar Este Operador ?
			</div>
			<div class="modal-footer">
				<div class="text-center">
				<button type="button" class="btn btn-danger" id="sieliminaroperador" value="sieliminaroperador">Eliminar <span class="glyphicon glyphicon-ok-sign"></span></button>
				<button type="button" class="btn btn-done" id="noeliminaroperador" value="noeliminaroperador">Cancelar <span class="glyphicon glyphicon-remove-sign"></span> </button>
				</div>
			</div>
		</div>
	</div>
</div>
<div  class="table-responsive text-center center-block" style="width:80%; min-width:368px; padding:5px;">
<table class="table table-bordered text-center">
  <caption> <h3 class="text-center text-info">Listado de Operadores</h3></caption>
  <thead>
    <tr>
      <th class="id">id</th>
      <th class="text-center text-info">Nombre</th>
      <th class="text-center text-info">Usuario</th>
      <th class="text-center text-info">Cedula</th>
      <th class="text-center text-info">Clave</th>
      <th class="text-center text-info">
	  
	  </th>
      <th class="text-center text-danger">Eliminar</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($operadores as $operador):?>
      <tr>
        <td class="id"><?=$operador['id'];?></td>
        <td class="editable" data-campo="nombre"><span><?=$operador['nombre'];?></span></td>
        <td class="editable" data-campo="usuario"><span><?=$operador['usuario'];?></span></td>
        <td class="editable" data-campo="cedula"><span><?=$operador['cedula'];?></span></td>
        <td class="editable" data-campo="clave"><span><?=$operador['clave'];?></span></td>
        <?php
        if($operador['estado']=="activo")
        {?>
            <td><button class="btn btn-success" id="estadoOperador"><?=$operador['estado'];?></button></td>
        <?php
        }
        else
        {?>
            <td><button class="btn btn-default" id="estadoOperador"><?=$operador['estado'];?> </button></td>
          <?php
        }
        ?>

        <td> <button class="btn btn-danger" id="eliminarOperador">Eliminar <div class="glyphicon glyphicon-remove-sign"></div></button></td>
      <tr>
      <?php endforeach;?>
  </tbody>
</table>
<div class="text-center text-info lead"> Cantidad Total:  <span id="cantidad"><?=$cantidad;?></span></div>
</div>
