<script>
  $(document).ready(function(){

    $(document).on('click','#elegirMaestria',function(e){
      e.preventDefault();
      $.ajax({
        type :'post',
        url : $(this).data('url'),
        success : function(respuesta){
          $("#section").html(respuesta);
        }
      });
    });
  });
</script>
<div class="table-responsive center-block" style="width:60%;">
<table class="table table-hover">
  <tbody>
    <tr>
      <td class="text-info lead">Maestria en Ciencias Sociales</td>
      <td><button class="btn btn-success" id="elegirMaestria" data-url=<?=base_url('administrador/Administrador/formMaestria');?>>Elegir <span class="glyphicon glyphicon-ok-sign"></span> </button></td>
    </tr>
  </tbody>
</table>
</div>
