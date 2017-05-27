<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
  <link rel="icon" href='./ubv.ico'>
  <link rel="stylesheet" href="./public/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./public/bootstrap/css/bootstrap-theme.min.css">
  <style>
    body{
      background-color: #F0F8FF;
      width: 100%;
      height: auto;
      padding: 174px 0px 0px 0px;
      margin: 0px;
    }
    .nempresa
    {
      color: white;
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

    ul li{
      color: black;
      padding: 4px;
    }
    ul li a{
      color:white;
    }
    footer{
      background-color: #F5F5F5;
      border-radius: 5px;
      padding:8px;
    }
    section{
      background-color: white;
      margin: 5px;
      padding: 8px;
    }
    article
    {
      margin: 0px;
      padding: 0px;
      background-color:rgba(245,245,245,0.75);

    }
    .banner{
      min-width: 100%;
      max-width: 100%;
      min-height: 100px;
      max-height: 100px;
    }
    #ancho {
      max-width: 100%;
      max-height: 330px;
      margin: 0px;
      padding: 0px;
    }
    #ubv
    {
      box-shadow: 0px 0px 12px rgba(2, 40, 144, 0.55);
      width: 90px;
      height: auto;
      padding: 5px;
      margin-bottom: 5px;
      transition: 1s;

    }

    #ubv:hover
    {
      transform: rotate(360deg);
      box-shadow: 0px 0px 12px rgba(255,123,23,1.5);

    }
    figcaption
    {
      margin-bottom: 3px;
    }

#mensaje{
  display: none;
  background-color: red;
  text-align:center;
  color: white;
  width: 100%;
  height: auto;
  padding: 5px;
  border-radius: 7px;
  position: fixed;
  left: 0px;
  top: 259px;
  z-index: 3;
}

  </style>
  <script src="./public/jquery/jquery.js"></script>
  <script src="./public/bootstrap/js/bootstrap.min.js"></script>
  <script>
  /*window.onbeforeunload = confirmaSalida;

function confirmaSalida()
{

       return "Vas aabandonar esta pagina. Si has hecho algun cambio sin grabar vasa perder todos los datos.";

}*/
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

    $("#inicio").on('click',function(e){
      e.preventDefault();
      window.location.reload();
    });

    $("#mision").on('click',function(e){

      e.preventDefault();
      $.ajax({
        type: 'post',
        url:$(this).attr('href'),
        success : function(respuesta)
        {
          $("#section").html(respuesta);
        }
      });
    });

    $("#vision").on('click',function(e){
      e.preventDefault();
      $.ajax({
        type:"post",
        url: $(this).attr('href'),
        success : function(respuesta)
        {
          $("#section").html(respuesta);
        }
      });
    });

    $("#organigrama").on('click',function(e){
      e.preventDefault();
      $.ajax({
        type:"post",
        url: $(this).attr('href'),
        success : function(respuesta)
        {
          $("#section").html(respuesta);
        }
      });
    });	

	
	
	
    $("#forminicio").on('click',function(e){
      e.preventDefault();
      $.ajax({
        type:"post",
        url: $(this).attr('href'),
        success : function(respuesta)
        {
          $("#section").html(respuesta);
        }
      });
    });




  });
  </script>
</head>
<body>
 <div id="mensaje"></div>
  <div class="container" style="background-color:white;">
    <div class="row" style="padding:0px;">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0px;">
        <header class="navbar navbar-default navbar-fixed-top" role="navigation">
          <img class="img img-responsive center-block banner" src="./public/img/banner.png">
          <nav>
            <div class="navbar-header">
              <div class="navbar-brand"><p style="color:white; font-weght:bold; font-size:1em;">SCIECEA</p></div>
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menup">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>
            <div class="collapse navbar-collapse" id="menup">
              <ul class="nav nav-pills nav-justified">
                <li>
                  <a href="" class="btn btn-md" title="Inicio" id="inicio" style="font-weight: bold;">Inicio </a>
                </li>
                <li class="dropdown">
                  <a href="" title="Coordinacion" class="dropdown-toggle btn-md" data-toggle="dropdown" style="font-weight: bold;">Coordinacion <span class="caret"></span> </a>
                  <ul class="dropdown-menu" role="menu" style="box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
                    <li role="presentation" class="dropdown-header">Coordinacion</li>
                    <li class="divider"></li>
                    <li> <a href="<?=base_url('Inicio/mision');?>" id="mision" role="menuitem" tabindex="-1"> Mision</a></li>
                    <li> <a href="<?=base_url('Inicio/vision');?>" id="vision" role="menuitem" tabindex="-1"> Vision </a></li>
                    <li> <a href="" role="menuitem" tabindex="-1"> Funciones</a></li>
                <li><a href="<?=base_url('Inicio/organigrama');?>" id="organigrama"role="menuitem" > Organigrama </a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="" title="Estudios" class="dropdown-toggle btn btn-md" data-toggle="dropdown" style="font-weight: bold;">Estudios <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu" style="box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
                    <li role="presentation" class="dropdown-header"> Estudios </li>
                    <li class="divider"></li>
                    <li> <a href="" role="menuitem" tabindex="-1"> Proyecto </a> </li>
                    <li> <a href="" role="menuitem" tabindex="-1"> Normativa </a></li>
                    <li> <a href="" role="menuitem" tabindex="-1"> Formacion </a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="" class="dropdown-toggle btn btn-md" data-toggle="dropdown" title="Informacion" style="font-weight: bold;">Informacion <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu" style="box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
                    <li role="presentation" class="dropdown-header"> Informacion </li>
                    <li class="divider"></li>
                    <li><a href="" role="menuitem" tabindex="-1"> Pre-Inscripcion</a> </li>
                    <li><a href="" role="menuitem" tabindex="-1"> Programas </a></li>
                    <li><a href="" role="menuitem" tabindex="-1"> Inscripcion </a></li>
                    <li><a href="" role="menuitem" tabindex="-1"> Horarios </a></li>
                  </ul>
                </li>
                <li><a href="<?= base_url('Inicio/form_login');?>" class="btn btn-md" id="forminicio" style="font-weight: bold;">Entrar</a></li>
              </ul>
            </div>

          </nav>
          <div id="fecha" style="width:100%; background-color:white; padding-left:5px;"></div>
        </header>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0px; box-shadow:0px 0px 12px rgba(0,0,0,0.5);">
          <div class="modal fade" tabindex="-1" role="dialog" id="sesionusuario" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title text-center text-info">Usuario del sistema</h3>
                </div>
                <div class="modal-body text-center" id="sesionusuariobody"></div>
                <div class="modal-footer">
                  <a href="" class="btn btn-lg btn-primary" id="sesionusuarioir" title="pulse aqui para entrar al sistema"> Entrar al sistema  <span class="glyphicon glyphicon-log-in"></span> </a>

                </div>
              </div>
            </div>
          </div>
       <div id="slider" class="carousel slide">
         <ol class="carousel-indicators">
           <li data-target="#slider" data-slide-to="0" class="active"></li>
           <li data-target="#slider" data-slide-to="1"></li>
           <li data-target="#slider" data-slide-to="2"></li>
           <li data-target="#slider" data-slide-to="3"></li>
           <li data-target="#slider" data-slide-to="4"></li>
           <li data-target="#slider" data-slide-to="5"></li>
           <li data-target="#slider" data-slide-to="6"></li>
         </ol>
         <div class="carousel-inner">
           <div class="item active">
             <img src="./public/img/1.png" id="ancho">
           </div>
            <div class="item">
             <img src="./public/img/2.png" id="ancho">
           </div>
           <div class="item">
             <img src="public/img/3.png" id="ancho">
           </div>
           <div class="item">
             <img src="public/img/4.png" id="ancho">
           </div>
           <div class="item">
             <img src="public/img/5.png" id="ancho">
           </div>
           <div class="item">
             <img src="public/img/6.png" id="ancho">
           </div>
           <div class="item">
             <img src="public/img/7.png" id="ancho">
           </div>
           <a class="carousel-control left" href="#slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                 <a class="carousel-control right" href="#slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
         </div>
       </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <article>
                <p class="lead text-center text-info" style="margin-top:7px; margin-bottom:2px;">Enlaces de Interes</p>
              <br>
              <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <figure class="text-center text-info">
                    <img src="./public/img/ubv.png" class="img img-responsive img-circle center-block" id="ubv">
                    <figcaption>UBV</figcaption>
                  </figure>
                </div>
                  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <figure class="text-center text-info">
                      <img src="./public/img/ubv.png" class="img img-responsive img-circle center-block" id="ubv">
                      <figcaption>sur-UBV</figcaption>
                    </figure>
                  </div>
                  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <figure class="text-center text-info">
                      <img src="./public/img/ubv.png" class="img img-responsive img-circle center-block" id="ubv">
                      <figcaption>UBV</figcaption>
                    </figure>
                  </div>
                  <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <figure class="text-center text-info">
                      <img src="./public/img/ubv.png" class="img img-responsive img-circle center-block" id="ubv">
                      <figcaption>sur-UBV</figcaption>
                    </figure>
                  </div>
            </article>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <section id="section" class="text-center">
            <h1>Bienvenidos a nuestro portar web</h1>
            <p>Nuestro portar es un recurso tecnológico de la Universidad Bolivariana de Venezuela para que sus Estudiantes,
              Docentes e interesados puedan acceder a los servicios que ofrecen los procesos de ingreso,
              prosecución y egreso normado por la Secretaría General, desde cualquier municipio que conforma el
              territorio nacional de nuestra República Bolivariana de Venezuela.</p>
            </section>
          </div>

        </div>
        <footer class="text-center">
          <p>
            Universidad Bolivariana de Venezuela sede Bolívar. <br>
            Coordinación Regional de Tecnologías de la Información y Telecomunicaciones. <br>
            Ciudad Bolívar - Venezuela copy-left 2016 (fecha de creación del sistema). <br>
            Versión 1.0 de la Free Software Foundation. Podrá encontrar una copia de la licencia en: <br>
            <a href="" style="color:blue;">GNU Free Documentation License (Inglés).</a> <br>
            <a href="" style="color:blue;">Licencia de Documentación Libre de GNU (Español).</a> <br>
        </p>
        </footer>
    </div>
  </div>

  <script>
  $('.carousel').carousel();
  </script>
</body>
</html>
