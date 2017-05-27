<style>
  #form_login
  {
    width: 60%;
    max-width: 60%;
    min-width: 243px;
    margin: auto;
    padding: 0px 25px 0px 25px;
    box-shadow: 0px 0px 12px rgba(2, 40, 144, 0.5);
    border-radius: 7px;
    text-align: left;
  }
  .error_usuario, .error_clave, .error_captcha, #alerta-form
  {
    display: none;
  }
</style>
<script>
$(document).ready(function(){

  $("#form_login").on('submit',function(e){

      e.preventDefault();

      $.ajax({

        type: $(this).attr('method'),
        url:  $(this).attr('action'),
        data: $(this).serialize(),

        success : function(respuesta)
        {
            $(".error_clave, .error_usuario, .error_captcha, #alerta-form").css({'display':'none'}).html('');
          json = JSON.parse(respuesta);
          if(json.respuesta=='error')
          {
            if(json.usuario)
            {
               $(".error_usuario").append(json.usuario).css('display','block');
            }

            if(json.clave){
              $(".error_clave").append(json.clave).css('display','block');
            }

            if(json.captcha)
            {
              $(".error_captcha").append(json.captcha).css('display','block');
            }

            if(json.validar)
            {
              $("#alerta-form").html(json.validar).css('display','block');
            }

          }
          else
          {
            $("#sesionusuario").modal('show');
            $("#sesionusuariobody").html("Bienvenido al sistema "+json.usuario)
            $("#sesionusuarioir").attr('href',json.url);

          }

        }
      });
  });

  $("#limpiar").on('click',function(){
    $(".error_clave, .error_usuario, .error_captcha").css('display','none').html('');
    $("#usuario, #clave, #captcha").val('');
  });

  $("#formModalOlvidoClave").on('click',function(e){
  e.preventDefault();
  $('#modalOlvidoClave').modal('show');
});

$('#formRecuperarClave').on('submit',function(e){
  e.preventDefault();
  $.ajax({
    type:$(this).attr('method'),
    url:$(this).attr('action'),
    data : $(this).serialize(),
    success: function(respuesta)
    {
      json = JSON.parse(respuesta);
      if(json.respuesta=='exito')
      {
        $('#modalOlvidoClave').modal('hide');
        $("#mensaje").css({'display':'block','background-color':'green'}).html('<h3>'+json.exito+'</h3>').fadeOut(10000);
        $('#correoUsuario').val();

      }
      else
      {
        $('#modalOlvidoClave').modal('hide');
        if(json.correono)
        {
          $("#mensaje").css({'display':'block','background-color':'red'}).html('<h3>'+json.correono+'</h3>').fadeOut(10000);
        }

        if(json.error_correo)
        {
          $("#mensaje").css({'display':'block','background-color':'red'}).html('<h3>'+json.error_correo+'</h3>').fadeOut(10000);
        }

      }
    }
  });
});

});

</script>
<!--modal recuperar clave-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalOlvidoClave" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title text-center text-info">Recuperar Clave</h3>

              </div>
              <div class="modal-body text-center">
        <form action=<?=base_url('Inicio/recuperarClave');?> class="form" role="form" id="formRecuperarClave" method="post" accept-charset="utf-8">
          <div class="form-group">
          <label for='correoUsuario' class="text-info">Introduzca su Correo Electronico :</label>
          <input type='text' name='correoUsuario' id='correoUsuario' class="form-control" placeholder='Digite su Correo Electronico Aqui' required>
          </div>

          <div class='form-group'>
            <button type='submit' class="btn btn-success" >Enviar <span class="glyphicon glyphicon-send"></span></button>

          </div>
        </form>				</div>
            </div>
          </div>
        </div>
<!--fin modal recuperar clave-->
<div class="alert alert-danger" id="alerta-form"></div>
<?=form_open(base_url('Inicio/login'),array('id'=>'form_login','role'=>'form','class'=>'form center-block'));?>
<img src="./public/img/ubv.png" class="img img-responsive center-block">
<h3 class="text-center text-info">Entrar al Sistema</h3>

<label for="usuario">Usuario : </label>

<div class="form-group input-group">
  <span class="input-group-addon glyphicon glyphicon-user"></span>
  <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Digite nombre de usuario">
</div>

<div class="alert alert-danger error_usuario text-center" role="alert"></div>

<label for="clave">Clave :</label>

<div class="form-group input-group">
  <span class="input-group-addon glyphicon glyphicon-lock"></span>
  <input class="form-control" type="password" name="clave" id="clave" placeholder="Digite clave de usuario">
</div>

<div class="alert alert-danger error_clave text-center" role="alert"></div>

<div class="text-center center-block">
  <?= $image;?><br><br>
</div>

<label for="captcha">Dato de la imagen :</label>

<div class="form-group input-group">
  <span class="input-group-addon glyphicon glyphicon-search"></span>
  <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Digite dato de la imagen">
</div>

<div class="alert alert-danger error_captcha text-center" role="alert"></div>

<div class="form-group">
  <a id='formModalOlvidoClave' href="" style="color:blue;">¿Olvidastes la Clave o el Usuario?</a>
</div>

<div class="form-group text-center center-block">
  <button type="submit" class="btn btn-primary">Entrar <span class="glyphicon glyphicon-ok-sign"></span></button>
  <button type="button" class="btn btn-done" id="limpiar">Limpiar <span class="glyphicon glyphicon-remove-sign"></span></button>
</div>
<?=form_close();?>
