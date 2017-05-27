<style>
  #formProfesor
  {
    width: 60%;
    height: auto;
  }
  #error_nombre,#error_apellido,#error_cedula,#error_correo,#error_titulos,#error_telefono
  {
    display: none;
  }
</style>
<!--#error_nombre,#error_apellido,#error_cedula,#error_correo,#error_titulos,#error_telefono,#error_direccion,#error_lugar_de_trabajo,#error_cargo,#error_exoneracion
VIENE DE ARRIBA. COPIA.
-->
<script>
  $(document).ready(function(){
    $("#formProfesor").on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type:$(this).attr('method'),
        url:$(this).attr('action'),
        data:$(this).serialize(),
        success : function(respuesta)
        {
          json = JSON.parse(respuesta);
          if(json.respuesta=="error")
          {
            //$("#error_nombre,#error_apellido,#error_cedula,#error_correo,#error_telefono,#error_titulos,#error_direccion,#error_lugar_de_trabajo,#error_cargo,#error_exoneracion").css('display','none').html('');
            $("#error_nombre,#error_apellido,#error_cedula,#error_correo,#error_telefono,#error_titulos").css('display','none').html('');           
			if(json.nombre)
            {
              $("#error_nombre").css('display','block').append(json.nombre);
            }
            if(json.apellido)
            {
              $("#error_apellido").css('display','block').append(json.apellido);
            }
            if(json.cedula)
            {
              $("#error_cedula").css('display','block').append(json.cedula);
            }
            if(json.telefono)
            {
              $("#error_telefono").css('display','block').append(json.telefono);
            }
            if(json.correo)
            {
              $("#error_correo").css('display','block').append(json.correo);
            }
            if(json.titulo)
            {
              $("#error_titulos").css('display','block').append(json.titulo);
            }
			 /*if(json.direccion)
            {
              $("#error_direccion").css('display','block').append(json.direccion);
            }
            if(json.lugar_de_trabajo)
            {
              $("#error_lugar_de_trabajo").css('display','block').append(json.lugar_de_trabajo);
            }
            if(json.cargo)
            {
              $("#error_cargo").css('display','block').append(json.cargo);
            }
            if(json.exoneracion)
            {
              $("#error_exoneracion").css('display','block').append(json.exoneracion);
            }*/
			
          }
          else
          {
            //$("#error_nombre,#error_apellido,#error_cedula,#error_correo,#error_telefono,#error_titulos,#error_direccion,#error_lugar_de_trabajo,#error_cargo,#error_exoneracion").css('display','none').html('');
            $("#error_nombre,#error_apellido,#error_cedula,#error_correo,#error_telefono,#error_titulos").css('display','none').html('');          
			if(json.respuesta=="exito")
            {
              $("#mensajetodos").css({'display':'block','background-color':'green'}).html(json.mensaje).fadeOut(6000);
              //$("#nombre,#apellido,#cedula,#telefono,#correo,#titulos,#direccion,#lugar_de_trabajo,#cargo,#exoneracion").val('');
              $("#nombre,#apellido,#cedula,#telefono,#correo,#titulo").val('');           
			}
          }
        }
      });
    });

    $("#limpiarDatosProfesor").on('click',function(){
      $("#error_nombre, #error_apellido, #error_cedula, #error_correo, #error_telefono,#error_titulos,#error_direccion,#error_lugar_de_trabajo,#error_cargo,#error_exoneracion").css('display','none').html('');
    });
  });
</script>
<?=form_open(base_url('profesores/Profesores/registrarProfesor'),array('class'=>'form center-block','id'=>'formProfesor'));?>
  <caption><h3 class="text-center text-info">Registrar Profesor</h3></caption>
  <p class="text-danger text-left">* Datos Obligatorios</p>
  <br>
  <div class="row">
    <div class="col-md-6 col-lg-6">
      <div class="form-group">
        <label for="nombre"><label class="text-danger">*</label> Nombres :</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres">
        <div class="alert alert-danger" id="error_nombre" role="dialog"></div>
      </div>

      <div class="form-group">
        <label for="apellido"><label class="text-danger">*</label> Apellidos :</label>
        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos">
        <div class="alert alert-danger" id="error_apellido" role="dialog"></div>
      </div>

      <div class="form-group">
          <label for="cedula"><label class="text-danger">*</label> Cédula :</label>
        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="v12098765">
        <div class="alert alert-danger" id="error_cedula" role="dialog"></div>
      </div>
	  
	  <div class="form-group">
          <label for="direccion">Dirección :</label>
        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion">
        <!--<div class="alert alert-danger" id="error_direccion" role="dialog"></div>-->
      </div>
	  
	   <div class="form-group">
          <label for="cargo_o_departamento">Cargo :</label>
        <input type="text" class="form-control" name="cargo_o_departamento" id="cargo_o_departamento" placeholder="Cargo o departamento">
        <div  id="error_cargo" role="dialog"></div>
      </div>

    </div>

    <div class="col-md-6 col-lg-6">
      <div class="form-group">
        <label for="telefono"><label class="text-danger">*</label> Teléfono :</label>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="02120917497">
        <div class="alert alert-danger" id="error_telefono" role="dialog"></div>
      </div>

      <div class="form-group">
        <label for="correo"><label class="text-danger">*</label> Correo Electrónico :</label>
        <input type="text" class="form-control" name='correo' id="correo" placeholder="Correo">
        <div class="alert alert-danger" id="error_correo" role="dialog"></div>
      </div>

      <div class="form-group">
        <label for="titulo"><label class="text-danger">*</label> Ultimo Título Obtenido :</label>
        <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo">
        <div class="alert alert-danger" id="error_titulos" role="dialog"></div>
      </div>
	  
	  <div class="form-group">
        <label for="lugar_de_trabajo">Lugar de trabajo :</label>
        <input type="text" class="form-control" name="lugar_de_trabajo" id="lugar_de_trabajo" placeholder="Lugar de trabajo">
        <!--<div class="alert alert-danger" id="error_lugar_de_trabajo" role="dialog"></div>-->
      </div>
	  
	 
	  
	  <div class="form-group">
            <div class="form-group text-left">
              <label class="text" for="exoneracion">Exoneración : </label>
              <select class="form-control" id="exoneracion" name="exoneracion" >
                <option value="">Seleccione una Opción</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
               <div  id="error_exoneracion" role="dialog"></div>
            </div>
       </div>
	  
    </div>

  </div>

  <div class="form-group text-center">
    <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span> Registrar</button>
    <button type="reset" id="limpiarDatosProfesor" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
  </div>

<?=form_close();?>
