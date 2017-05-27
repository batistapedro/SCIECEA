<style>
#formUnidadC
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
  $("#formUnidadC").on('submit',function(e){
    e.preventDefault();

    $.ajax({
      type : $(this).attr('method'),
      url : $(this).attr('action'),
      data : $(this).serialize(),
      success :  function(respuesta)
      {
        $("#error_nombre, #mensajetodos").html('').css('display','none');
        json = JSON.parse(respuesta);

        if(json.respuesta=='error')
        {
          if(json.nombre_unidad)
          {
            $("#error_nombre").css('display','block').append(json.nombre_unidad);
          }


          if(json.validar)
          {
            $("#mensajetodos").css({'display':'block','background-color':'red'}).html('<h3>'+json.validar+'</h3>').fadeOut(6000);

          }

        }
        else
        {
          $("#mensajetodos").css({'display':'block','background-color':'green'}).html("<h3>"+json.exito+"</h3>").fadeOut(6000);
          $("#nombre_unidad").val('');
        }

      }

    });

    $("#limpiar").on('click',function(){
      $("#error_nombre, #validar_error, #exito").html('').css('display','none');
      $("#nombre_unidad").val('');
    });
  });

</script>


<?=form_open(base_url('administrador/Administrador/registrarUnidadC'),array('class'=>'form','role'=>'form','id'=>'formUnidadC'));?>
  <caption><h3 class="text-center text-info">Registrar Unidad Curricular</h3></caption>
  <p class="text-left text-danger">Campo obligatorio</p>
  <div class="form-group">
    <label class="text-left text-info" for="nombre">Nombre :</label>
    <input type="text" name="nombre_unidad" id="nombre_unidad" placeholder="Unidad Curricular" class="form-control" maxlength="55">
  </div>
  <div class="alert alert-danger text-center" id="error_nombre" role="alert"></div>

 <!-- <div class="form-group">
    <label class="text-left text-info" for="clave">Cedula :</label>
    <input type="text" name="cedula" id="cedula" placeholder="cedula ejemplo: 19871554" class="form-control" maxlength="8">
  </div>
  <div class="alert alert-danger text-center" id="error_cedula" role="alert"></div>-->

  <div class="form-group text-center">
    <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-ok-sign"></span> Registrar </button>
    <button type="button" class="btn btn-danger" id="limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
  </div>

<?=form_close();?>
