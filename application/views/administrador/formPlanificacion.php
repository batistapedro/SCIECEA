<style>
#formBuscarPlanificacion
{
  width:60%;
}
</style>
<script>
  $("#formBuscarPlanificacion").on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type:$(this).attr('method'),
      url:$(this).attr('action'),
      data:$(this).serialize(),
      success : function(respuesta)
      {
        $("#principalPalnificacion").html(respuesta);
      }
    });
  });
</script>
<?= form_open(base_url('administrador/Administrador/buscarPlanificacion'),array('id'=>'formBuscarPlanificacion','class'=>'form center-block text-center','role'=>'form'));?>
  <h3 class='text-primary'>Elija Planificacion a Registrar</h3>
  <div class="form-group">
    <select class="form-control" name="planificacion" required>
      <option value=''>Elige una planificacion</option>
      <option value='doctorado'>Doctorado</option>
      <option value='maestria'>Maestria</option>
      <option value='especializacion'>Especializacion</option>
    </select>
  </div>
  <div class="form-group">
    <button class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Buscar </button>
    <button class="btn btn-default"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
  </div>
<?=form_close();?>

<div class='text-center center-block' id="principalPalnificacion"></div>
