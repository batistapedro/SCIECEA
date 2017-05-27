<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <link rel="stylesheet" href=<?=base_url("public/bootstrap/css/bootstrap.min.css");?>>
  <link rel="stylesheet" href=<?=base_url("public/bootstrap/css/bootstrap-theme.min.css");?>>
  <link rel="stylesheet" href=<?=base_url("public/jqueryui/jquery-ui.min.css")?>>
  <link rel="stylesheet" href=<?=base_url("public/jqueryui/jquery-ui.theme.min.css");?>>

  <style>
  body
  {
    background-color:white;
    width: 100%;
    height: auto;
    padding: 174px 0px 0px 0px;
    margin: 0px;
  }
  nav{
    background-color:cornflowerblue;
    color: white;
  }
  header{
    max-width: 100%;
    min-height: 80px;
    max-height: 80px;
  }
  #usuario
  {
    background-color: white;
    padding-left: 7px;
    padding-right: 7px;
    font-weight: bold;
  }
  .banner{
    min-width: 100%;
    max-width: 100%;
    min-height: 100px;
    max-height: 100px;
  }
  a{
    color: white;
  }
  section
  {
    background-color: white;
    width: 100%;
    height: auto;
  }
  #mensajetodos
  {
    display: none;
    background-color: red;
    color: white;
    width: 100%;
    height: auto;
    padding: 5px;
    border-radius: 7px;
    position: fixed;
    left: 0px;
    top: 191px;
    z-index: 1;
  }
  .calendario
  {
    max-width: 25%;
    min-width: 25%;
    width: 25%;
    border: 0px;
  }
  </style>
  
  <script src=<?=base_url('public/jquery/jquery.js');?>></script>
  <script src=<?=base_url("public/bootstrap/js/bootstrap.min.js");?>></script>
  <script src=<?=base_url("public/jqueryui/jquery-ui.min.js");?>></script>
  <script src=<?=base_url("public/sheepIt/sheepIt.js");?>></script>
 
 <script>
    $(document).ready(function(){

     


      fecha = "<?=Date('d/m/Y-H:i');?>";

      f = new Date();
      if(f.getHours()>=12)
      {
        formato = "PM";
      }
      else
      {
        formato = "AM";
      }

      $("#fecha").html(fecha+formato);

      $("#registraroperador").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type:"post",
          url :$(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").css('display','block').html(respuesta);
          }
        });
      });

      $("#salirSesion").on('click',function(e){
        e.preventDefault();
        $("#salirdesesion").modal('show');

        $("#nosalirsesion, #sisalirsesion").on('click',function(e){
            e.preventDefault();
            valor = $(this).val();
            if(valor=="si")
            {
              $("#salirdesesion").modal('hide');
              window.location="<?=base_url('SalirSession');?>";

            }
            else
            {
              $("#salirdesesion").modal('hide');
            }
        });
      });

      $("#operadores").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type: 'post',
          url : $(this).attr('href'),
          success :function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });

      $("#configClave").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type : 'post',
          url: $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        })
      });

      $("#profesor").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type: 'post',
          url : $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });

      $("#registrarEstudiantes").on('click',function(e)
      {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url : $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });

      $("#formPlanificacion").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type:'post',
          url:$(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });

      $("#buscarEstudiantes").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });


      $(document).on('click','.sesionenlace',function(e){
        e.preventDefault();
      });
      $(document).on('mouseover','.sesionenlace',function(e){
        e.preventDefault();
        fecha = $(this).attr('href');

        $(this).attr('title','cargando..');
        $.ajax({
          type:'post',
          url:'administrador/Administrador/horaSesion',
          data :{fecha:fecha},
          beforeSend :  function()
          {
            $(".sesionenlace").attr('title','Cargando...');
          },
          success : function(respuesta)
          {
            $(".sesionenlace").attr('title',respuesta);
          }
        });


      });

      $(document).on('click','#formCohorte',function(e){

        e.preventDefault();
        $.ajax({
          type:'post',
          url : $(this).attr('href'),
          success :  function(respuesta)
          {
          $("#section").html(respuesta);
          }
        });
      });

	  
	  
	    $("#audit_sist").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type: 'post',
          url : $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });
	  
	  
	    $("#unidadCurricular").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type: 'post',
          url : $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });
	  
	  
	  	$("#buscarUnidadC").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type: 'post',
          url : $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
      });
	  

	  
	    $("#import").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type : 'post',
          url: $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        })
      });
	  
      /*var idleTime = 0;

    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime >= 3)
    {
        window.location='http://localhost/ndubraska/SalirSession';
    }
}*/
$("#reporteBauche").on('click',function(e){
        e.preventDefault();
        $.ajax({
          type : 'post',
          url: $(this).attr('href'),
          success : function(respuesta)
          {
            $("#section").html(respuesta);
          }
        });
    });
    });
</script>

  <script src="./public/js/verOperador.js"> </script>
  <script src="./public/js/verInfoEstudiantes.js"></script>
  
</head>

<body>
  <div class="container-fluid master" style="padding:0px; margin:0px;">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <header class="navbar navbar-default navbar-fixed-top" role="navigation">

          <img src=<?=base_url('public/img/banner.png');?> class="img img-responsive center-block banner">
          <div class="clearfix" id="usuario">
            <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="pull-letf">
                  <?= ucwords($this->session->userdata('nombre'));?> :: <span class="glyphicon glyphicon-user"></span> :: <?=ucwords($this->session->userdata('tipo_usuario'));?>
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <div class="pull-right" id="fecha">
                </div>
              </div>
            </div>
          </div>
		  
          <nav>
            <div class="navbar-header">
              <div class="navbar-brand"><p title="SISTEMA DE CONTROL E INGRESO ESTUDIANTIL DE LA COORDINACION DE ESTUDIOS AVANZADOS" style="color:white; font-weght:bold; font-size:1em;">SCIECEA</p></div>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
			
            <div class="collapse navbar-collapse" id="menu">
              <ul class="nav nav-pills nav-justified">
                <li>
                  <a href="" class="btn btn-md" title="Inicio" id="inicio" style="font-weight: bold;">Inicio </a>
                </li>
                <li class="dropdown">
                  <a href="" title="Registrar" class="dropdown-toggle btn btn-md" data-toggle="dropdown" style="font-weight: bold;">Registrar <span class="caret"></span> </a>
                  <ul class="dropdown-menu" role="menu" style="box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
                    <li role="presentation" class="dropdown-header">Registrar</li>
                    <li class="divider"></li>
                    <li> <a href="<?=base_url('administrador/Administrador/formOperador');?>" id="registraroperador" role="menuitem" tabindex="-1"> Operador</a></li>
                    <!--<li> <a href="<'?=base_url('administrador/Administrador/form_profesor');?>" id="profesor" role="menuitem" tabindex="-1"> Profesor </a></li>-->
                    <li> <a href="<?=base_url('administrador/Administrador/Formestudiantes')?>" id="registrarEstudiantes" role="menuitem" tabindex="-1"> Estudiante</a></li>
                    <li><a href="<?=base_url('administrador/Administrador/formCohorte');?>" id="formCohorte" role="menuitem" tabindex='-1'>Cohortes</a></li>
                    <li><a href="<?=base_url('administrador/Administrador/formPlanificacion');?>" id="formPlanificacion" role="menuitem" tabindex='-1'>Planificacion</a></li>
					<<!--<li><a href="<'?=base_url('administrador/Administrador/FFormUnidadcurricular');?>" id="unidadCurricular" role="menuitem" tabindex='-1'>Unidad Curricular</a></li>-->
				  </ul>
                </li>
                <li class="dropdown">
                  <a href="" title="Buscar" class="dropdown-toggle btn btn-md" data-toggle="dropdown" style="font-weight: bold;">Buscar <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu" style="box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
                    <li role="presentation" class="dropdown-header"> Buscar </li>
                    <li class="divider"></li>
                    <li> <a href="<?=base_url('administrador/Administrador/extraerOperador');?>" id="operadores" role="menuitem" tabindex="-1"> Operadores</a></li>
                    <!--<li> <a href="" role="menuitem" tabindex="-1"> Profesores </a></li>-->
                    <li> <a href="<?=base_url('administrador/Administrador/formBuscarEstudiantes');?>" id="buscarEstudiantes" role="menuitem" tabindex="-1"> Estudiantes </a></li>
					<!-- <li> <a href="<'?=base_url('administrador/Administrador/buscarUnidadC');?>" id="buscarUnidadC" role="menuitem" tabindex="-1"> Unidad Curricular </a></li>-->
                    <li><a  href="<?=base_url('administrador/Administrador/reporteBauche');?>" id="reporteBauche" role='menuitem' tabindex='-1'> Reporte de Bauches</a> </li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="" class="dropdown-toggle btn btn-md" data-toggle="dropdown" title="Configurar" style="font-weight: bold;">Configuración <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu" style="box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
                    <li role="presentation" class="dropdown-header"> Cambiar Clave </li>
                    <li class="divider"></li>
                    <li><a href="<?=base_url('administrador/Administrador/formClave');?>" id="configClave" role="menuitem" tabindex="-1"> Clave de Usuario</a> </li>
					<!--<li><a href="<'?=base_url('administrador/Administrador/import');?>" id="import" role="menuitem" tabindex="-1"> Importar Excel</a> </li> -->              
				  </ul>
                </li>
				
                <li>
                  <a href="<?=base_url('administrador/Administrador/respaldarBaseDato');?>" title="Respaldar Base de Datos" style="font-weight: bold;">Respaldar</a>
                </li>
				
                <li>
                  <a href="<?base_url('Administrador/manual');?>" title="Manual de Usuario" style="font-weight: bold;">Manual</a>
                </li>
				
				<!--<li>
                  <a href="<'?base_url('welcome/auditar');?>" title="Auditar uso del Sistema" style="font-weight: bold;">Auditar</a>
                </li>-->
				
                <li>
                  <a href="#" class="btn btn-md" id="salirSesion" style="font-weight: bold;">Salir</a>
                </li>
				
              </ul>
            </div>
          </nav>
        </header>
        <div id="mensajetodos" tabindex="-1" role="dialogo" class="text-center"></div>
        <div class="modal fade" tabindex="-1" role="dialog" id="salirdesesion" aria-labelledby="myModalLabel" aria-hidden='true'>
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">
										Salir de Sesion
									</h4>
								</div>
								<div class="modal-body text-center">
									Deseas Salir de Sesion <?=$this->session->userdata('nombre');?> ?

								</div>
								<div class="modal-footer text-center">
									<button id="sisalirsesion" type="button" value='si' class="btn btn-primary">
										<span class="glyphicon glyphicon-ok-sign"> Aceptar</span>
									</button>
									<button id="nosalirsesion" type="button" value='no' class="btn btn-danger">
										<span class="glyphicon glyphicon-remove-sign"> Cancelar</span>
									</button>
								</div>
							</div>
						</div>
					</div>

        <section id="section">

         <!-- <'?php
          $data = array();
          foreach($sesion as $hsesion)
          {
            $data[ltrim(substr($hsesion['fecha'], 8, 2), '0')] = $hsesion['fecha'];
          }
          echo $this->calendar->generate(Date('Y'),Date('m'),$data);
          ?>--> <!--BLOQUEADO EL 29-01-17 Q MUESTRA CALENDARIO DE SESIONES EN INICIO-->

        </section>
      </div>

    </div>
  </div>

</body>
</html>
