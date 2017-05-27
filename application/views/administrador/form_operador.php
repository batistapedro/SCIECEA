<style>
#formOperador
{
  width: 50%;
  height: auto;
  margin: auto;
}
#error_nombre, #error_cedula
{
  display: none;
}
</style>
<script>

  $("#formOperador").on('submit',function(e){
    e.preventDefault();

    $.ajax({
      type : $(this).attr('method'),
      url : $(this).attr('action'),
      data : $(this).serialize(),
      success :  function(respuesta)
      {
        $("#error_nombre, #error_cedula, #mensajetodos").html('').css('display','none');
        json = JSON.parse(respuesta);

        if(json.respuesta=='error')
        {
          if(json.nombre)
          {
            $("#error_nombre").css('display','block').append(json.nombre);
          }

          if(json.cedula)
          {
            $("#error_cedula").css('display','block').append(json.cedula);
          }

          if(json.validar)
          {
            $("#mensajetodos").css({'display':'block','background-color':'red'}).html('<h3>'+json.validar+'</h3>').fadeOut(6000);

          }

        }
        else
        {
          $("#mensajetodos").css({'display':'block','background-color':'green'}).html("<h3>"+json.exito+"</h3>").fadeOut(6000);
          $("#nombre, #cedula").val('');
        }

      }

    });

    $("#limpiar").on('click',function(){
      $("#error_nombre, #error_cedula, #validar_error, #exito").html('').css('display','none');
      $("#nombre, #cedula").val('');
    });
  });

</script>
<?=form_open(base_url('administrador/Administrador/registrarOperador'),array('class'=>'form','role'=>'form','id'=>'formOperador'));?>
  <caption><h3 class="text-center text-info">Registrar Operador</h3></caption>
  <p class="text-left text-danger">Todos los datos son obligatorios</p>
  <div class="form-group">
    <label class="text-left text-info" for="nombre">Nombre :</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" maxlength="15">
  </div>
  <div class="alert alert-danger text-center" id="error_nombre" role="alert"></div>

  <div class="form-group">
    <label class="text-left text-info" for="clave">Cedula :</label>
    <input type="text" name="cedula" id="cedula" placeholder="cedula ejemplo: 19871554" class="form-control" maxlength="8">
  </div>

  <div class="alert alert-danger text-center" id="error_cedula" role="alert"></div>

  <div class="form-group text-center">
    <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-ok-sign"></span> Registrar </button>
    <button type="button" class="btn btn-danger" id="limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
  </div>


<?=form_close();?>
