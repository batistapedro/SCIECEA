<style>
    #formBuscarEstudiantes
    {
      width: 50%;
      min-width: 50%;
    }
    #cedulaEstudiantes
    {
      display: none;
    }
</style>
<script>
  $(document).ready(function(){
      $("#opcion").on('change',function(e){
        e.preventDefault();
        valor = $(this).val()
        if(valor=="cedula")
        {
          $("#cedulaEstudiantes").css('display','block').val('');
        }
        else
        {
          $("#cedulaEstudiantes").css('display','none');
        }
      });

      $("#formBuscarEstudiantes").on('submit',function(e){
        e.preventDefault();
        $.ajax({
          type: $(this).attr('method'),
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success : function(respuesta)
          {
            $("#busquedaDeEstudiantes").html(respuesta);
          }
        });
      });

      $(document).on('click','#verInfoEstudiante',function(e)
      {
        e.preventDefault();
        valor = $(this).closest('tr').find('.id').text();
        if(valor!="")
        {
            $.ajax({
              type:'post',
              url:'Estudiantes/verInfo',
              data:{id:valor},
              success : function(respuesta)
              {
                $("#section").html(respuesta);
              }
            });
        }
      });

  });
</script>

<?php echo form_open('Estudiantes/buscarEstudiantes',array('class'=>'form text-center center-block','role'=>'form','id'=>'formBuscarEstudiantes'));?>
  <caption> <h3 class="text-center text-info">Buscar Estudiantes</h3></caption>
  <div class="form-group">
    <select class="form-control" name="opcion" id="opcion">
        <option value=''>Selecione Opcion</option>
        <option value='cedula'>Buscar Por Cedula</option>
        <option value='todos'>Buscar Todos</option>
    </select>
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="cedulaEstudiantes" id="cedulaEstudiantes" placeholder="digite numero de cedula">
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Buscar <span class="glyphicon glyphicon-search"></span></button>
    <button type="reset" id="limpiarFormEstudiantes" class="btn btn-danger">Limpiar <span class="glyphicon glyphicon-remove-sign"></span></button>
  </div>
<?php echo form_close();?>

<div class="text-center" id="busquedaDeEstudiantes"> </div>
