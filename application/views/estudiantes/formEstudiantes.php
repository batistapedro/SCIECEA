<style>
select.ui-datepicker-year, select.ui-datepicker-month
{
  background-color: #2e6da4;
  color:white;
}
.error_nombre, .error_apellido, .error_cedula, .error_telefono, .error_correo, .error_estudios, .error_linea, .error_unidad1, .error_unidad2, .error_unidad3, .error_unidadCredito1, .error_unidadCredito2, .error_unidadCredito3, .error_periodo1, .error_periodo2, .error_periodo3, .error_numeroDeposito, .error_fechaDeposito, .error_montoDeposito, .error_area
{
  display: none;
}
</style>
<!--COPIA D ARRIBA: .error_nombre, .error_apellido, .error_cedula, .error_telefono, .error_correo, .error_estudios, .error_linea, .error_direccion, .error_lugar_de_trabajo, .error_cargo, .error_exoneracion, .error_unidad1, .error_unidad2, .error_unidad3, .error_unidadCredito1, .error_unidadCredito2, .error_unidadCredito3, .error_periodo1, .error_periodo2, .error_periodo3, .error_numeroDeposito, .error_fechaDeposito, .error_montoDeposito, .error_area
-->

<script>
  $(document).ready(function()
  {
    var valor1,valor2,valor3;
    $("#datapicker").datepicker({
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        changeYear: true,
        changeMonth:true,
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        minDate: new Date(2003, 1 - 1, 1),
        dateFormat:"yy/mm/dd"
    });
    //probar
    clonar_inspec_equipos_maquinarias = $('#clonar_inspec_equipos_maquinarias').sheepIt({
						separator: '',
						allowRemoveLast: true,
						allowRemoveCurrent: true,
						allowRemoveAll: true,
						allowAdd: true,
						allowAddN: true,
						maxFormsCount: 3,
						minFormsCount: 0,
						iniFormsCount: 1
					});
//fin de prueba

    function lista()
    {
     udoctorado = {
      'Seleccionar Unidad':'<option value="">Seleccionar Unidad</option>',
      'Pensamiento Politico,Estado,Democracia y Politicas Sociales':'<option value="Pensamiento Politico,Estado,Democracia y Politicas Sociales">Pensamiento Politico,Estado,Democracia y Politicas Sociales</option>',
      'Paradigmas y Fundamentos de la Investigacion':'<option value="Paradigmas y Fundamentos de la Investigacion">Paradigmas y Fundamentos de la Investigacion</option>',
      'Politica y Gestion Publica':'<option value="Politica y Gestion Publica">Politica y Gestion Publica</option>',
      'Teoria y Enfoques del Desarrollo':'<option value="Teoria y Enfoques del Desarrollo">Teoria y Enfoques del Desarrollo</option>'
    };
    return udoctorado;
  };

      $(document).on('change',"#estudios",function(e)
      {
        e.preventDefault();
        valor = $(this).val();
        if(valor=="")
        {
          $("#unidad1,#unidad2,#unidad3").html('');
          $("#unidadCredito1,#unidadCredito2,#unidadCredito3").val('');
          $("#periodo1,#periodo2,#periodo3").val('');
        }
        else if(valor=="doctorado")
        {
          $("#unidad1,#unidad2,#unidad3").html('');
          $("#unidadCredito1,#unidadCredito2,#unidadCredito3").val('03');
          $("#periodo1,#periodo2,#periodo3").val('');
          udoctorado = lista();
          for(i in udoctorado)
          {

              $("#unidad1").append(udoctorado[i]);
          }

        }
        else if(valor=="maestria")
        {
          $("#unidad1,#unidad2,#unidad3").html('');
          $("#unidadCredito1,#unidadCredito2,#unidadCredito3").val('03');
          $("#periodo1,#periodo2,#periodo3").val('');
          udoctorado = lista();
          for(i in udoctorado)
          {

              $("#unidad1").append(udoctorado[i]);
          }
        }
        else
        {
          $("#unidad1,#unidad2,#unidad3").html('');
          $("#unidadCredito1,#unidadCredito2,#unidadCredito3").val('');
        }
      });

      $(document).on('change','#unidad1',function(e)
      {
        e.preventDefault();
        $("#unidad2").html('');
        valor = $(this).val();
        valor1=valor;

        if(valor!="")
        {
          udoctorado = lista();
          udoctorado[valor]="";
          for(i in udoctorado)
          {
            $("#unidad2,#unidad3").append(udoctorado[i]);
          }
          $("#periodo1").val('48 horas');
        }

      });

      $(document).on('change','#unidad2',function(e)
      {
          e.preventDefault();
          valor = $(this).val();
          $("#unidad3").html('');
          unidad1 = $("#unidad1").val();
          if(valor!="")
          {
            udoctorado = lista();
            udoctorado[valor]="";
            udoctorado[valor1]="";

            for(i in udoctorado)
            {
              $("#unidad3").append(udoctorado[i]);
            }
              $("#periodo2").val('48 horas');
          }

      });

      $(document).on('change','#unidad3',function(e)
      {
        e.preventDefault();
        valor = $(this).val()
        if(valor!="")
        {
          $("#periodo3").val('48 horas');
        }

      });

      $("#limpiar").on('click',function(){
          $(".error_nombre, .error_apellido, .error_cedula, .error_telefono, .error_correo, .error_estudios, .error_linea, .error_direccion, .error_lugar_de_trabajo, .error_cargo, .error_exoneracion, .error_area, .error_unidad1, .error_unidad2, .error_unidad3, .error_unidadCredito1, .error_unidadCredito2, .error_unidadCredito3, .error_periodo1, .error_periodo2, .error_periodo3, .error_numeroDeposito, .error_fechaDeposito, .error_montoDeposito").html('').css('display','none');
      });

      
      
      $("#formEstudiantes").on('submit',function(e)
      {
        e.preventDefault();

        $.ajax({
          type: $(this).attr('method'),
          url:$(this).attr('action'),
          data : $(this).serialize(),
          success : function (respuesta)
          {
            json = JSON.parse(respuesta);
            console.log(json)
        //   $(".error_nombre, .error_apellido, .error_cedula, .error_telefono, .error_correo, .error_estudios, .error_linea, .error_direccion, .error_lugar_de_trabajo, .error_cargo, .error_exoneracion, .error_area, .error_unidad1, .error_unidad2, .error_unidad3, .error_unidadCredito1, .error_unidadCredito2, .error_unidadCredito3, .error_periodo1, .error_periodo2, .error_periodo3, .error_numeroDeposito, .error_fechaDeposito, .error_montoDeposito").html('').css('display','none');
            $(".error_nombre, .error_apellido, .error_cedula, .error_telefono, .error_correo, .error_estudios, .error_linea, .error_area, .error_unidad1, .error_unidad2, .error_unidad3, .error_unidadCredito1, .error_unidadCredito2, .error_unidadCredito3, .error_periodo1, .error_periodo2, .error_periodo3, .error_numeroDeposito, .error_fechaDeposito, .error_montoDeposito").html('').css('display','none');
            if(json.respuesta=="error")
            {
              if(json.error_nombre)
              {
                $(".error_nombre").css('display','block').append(json.error_nombre);
              }
              if(json.error_apellido)
              {
                $(".error_apellido").css('display','block').append(json.error_apellido);
              }
              if(json.error_cedula)
              {
                $(".error_cedula").css('display','block').append(json.error_cedula);
              }
              if(json.error_telefono)
              {
                $(".error_telefono").css('display','block').append(json.error_telefono);
              }
              if(json.error_correo)
              {
                $(".error_correo").css('display','block').append(json.error_correo);
              }
              if(json.error_estudios)
              {
                $(".error_estudios").css('display','block').append(json.error_estudios);
              }
              if(json.error_linea)
              {
                $(".error_linea").css('display','block').append(json.error_linea);
              }
			  
			 /* if(json.error_direccion)
              {
                $(".error_direccion").css('display','block').append(json.error_direccion);
              }
			  if(json.error_lugar_de_trabajo)
              {
                $(".error_lugar_de_trabajo").css('display','block').append(json.error_lugar_de_trabajo);
              }
			  if(json.error_cargo)
              {
                $(".error_cargo").css('display','block').append(json.error_cargo);
              }
			  if(json.error_exoneracion)
              {
                $(".error_exoneracion").css('display','block').append(json.error_exoneracion);
              }*/
			  		  
              if(json.error_area)
              {
                $(".error_area").css('display','block').append(json.error_area);
              }
              if(json.error_unidad1)
              {
                $(".error_unidad1").css('display','block').append(json.error_unidad1);
              }
              if(json.error_unidad2)
              {
                $(".error_unidad2").css('display','block').append(json.error_unidad2);
              }
              if(json.error_unidad3)
              {
                $(".error_unidad3").css('display','block').append(json.error_unidad3);
              }
              if(json.error_unidadCredito1)
              {
                $(".error_unidadCredito1").css('display','block').append(json.error_unidadCredito1);
              }
              if(json.error_unidadCredito2)
              {
                $(".error_unidadCredito2").css('display','block').append(json.error_unidadCredito2);
              }
              if(json.error_unidadCredito3)
              {
                $(".error_unidadCredito3").css('display','block').append(json.error_unidadCredito3);
              }
              if(json.error_periodo1)
              {
                $(".error_periodo1").css('display','block').append(json.error_periodo1);
              }
              if(json.error_periodo2)
              {
                $(".error_periodo2").css('display','block').append(json.error_periodo2);
              }
              if(json.error_periodo3)
              {
                $(".error_periodo3").css('display','block').append(json.error_periodo3);
              }
              if(json.error_numeroDeposito)
              {
                $(".error_numeroDeposito").css('display','block').append(json.error_numeroDeposito);
              }
              if(json.error_fechaDeposito)
              {
                $(".error_fechaDeposito").css('display','block').append(json.error_fechaDeposito);
              }
              if(json.error_montoDeposito)
              {
                $(".error_montoDeposito").css('display','block').append(json.error_montoDeposito);
              }
            }
            else
            {
              if(json.respuesta=="exito")
              {
                $("#mensajetodos").css({'display':'block','background-color':'green'}).html('<h3>'+json.mensaje+'</h3>').fadeOut(3000);
              // $("#nombre, #apellido,#cedula,#telefono, #correo, #linea, #direccion, #lugar_de_trabajo, #cargo_o_departamento, #exoneracion, #estudios, #area, #unidad1, #unidad2, #unidad3,#unidadCredito1,#unidadCredito2,#unidadCredito3,#periodo1,#periodo2,#periodo3,#numeroDeposito,#datepicker,#montoDeposito").val('');
                $("#nombre, #apellido,#cedula,#telefono, #correo, #linea, #estudios, #area, #unidad1, #unidad2, #unidad3,#unidadCredito1,#unidadCredito2,#unidadCredito3,#periodo1,#periodo2,#periodo3,#numeroDeposito,#datapicker,#montoDeposito").val('');
              }
            }
          }

        });
      });

  });
</script>

<div class="container-fluid master">
  <div class="row">

    <?=form_open('Estudiantes/registrarEstudiantes',array('class'=>'form text-center center-block','id'=>'formEstudiantes','role'=>'form'));?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <caption><h3 class="text-info">Registros de Estudiantes</h3></caption>
        <p class="text-danger text-left">Todos los datos son obligatorios</p>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">

          <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-left">
                  <label class="text-primary" for="nombre">Nombres : </label>
                  <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombres" >
                  <div class="error_nombre alert alert-danger" role="alert"></div>
              </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group text-left">
              <label class="text-primary" for="apellido">Apellidos : </label>
              <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellidos">
              <div class="error_apellido alert alert-danger" role="alert"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-left">
                  <label class="text-primary" for="cedula">Cédula : </label>
                  <input class="form-control" type="text" name="cedula" id="cedula" placeholder="v19871554" >
                  <div class="error_cedula alert alert-danger" role="alert"></div>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-left">
                <label class="text-primary" for="telefono">Teléfono : </label>
                <input class="form-control" type="text" name="telefono" id="telefono" placeholder="04120917497">
                <div class="error_telefono alert alert-danger" role="alert"></div>
              </div>
            </div>
          </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group text-left">
                    <label class="text-primary" for="correo">Correo Electronico : </label>
                    <input class="form-control" type="text" name="correo" id="correo" placeholder="Correo Electronico">
                    <div class="error_correo alert alert-danger" role="alert"></div>
                  </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6">
              <div class="form-group text-left">
                <label class="text-primary" for="linea">Linea de Investigación : </label>
                <input class="form-control" type="text" name="linea" id="linea" placeholder="Linea de Investigacion" >
                <div class="error_linea alert alert-danger" role="alert"></div>
              </div>
            </div>
        </div>
      </div>
	  
	  <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		 <div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
			<div class="form-group text-left">
          <label class="text-primary" for="direccion">* Dirección :</label>
<input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direccion">
        <div class="alert alert-danger" id="error_direccion" role="dialog"></div>
      </div> </div>
	  
	    <div class="col-sm-6 col-md-6 col-lg-6">
		<div class="form-group text-left">
          <label class="text-primary" for="cargo_o_departamento">* Cargo :</label>
<input type="text" class="form-control" name="cargo_o_departamento" id="cargo_o_departamento" placeholder="Cargo o departamento">
        <div class="alert alert-danger" id="error_cargo" role="dialog"></div>
      </div>
		</div>
		 </div>  
	  </div>
	  
	  
	   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		 <div class="row">
	    <div class="col-sm-6 col-md-6 col-lg-6">
			<div class="form-group text-left">
        <label class="text-primary" for="lugar_de_trabajo">Lugar de trabajo :</label>
<input type="text" class="form-control" name="lugar_de_trabajo" id="lugar_de_trabajo" placeholder="Lugar de trabajo">
        <div class="alert alert-danger" id="error_lugar_de_trabajo" role="dialog"></div>
			</div>
		</div>
	  
	  <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group text-left">
              <label class="text-primary"  for="exoneracion">Exoneración : </label>
              <select class="form-control" id="exoneracion" name="exoneracion" >
                <option value="">Seleccione una Opción</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
               <div class="alert alert-danger" id="error_exoneracion" role="dialog"></div>
            </div>
       </div> </div> </div>-->
	  

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group text-left">
              <label class="text-primary" for="estudios">Nivel de Estudios : </label>
              <select class="form-control" id="estudios" name="estudios" >
                <option value="">Seleccione Opción</option>
                <option value="espacializacion">Especialización</option>
                <option value="doctorado">Doctorado</option>
                <option value="maestria">Maestria</option>
                <option value="diplomado">Diplomado</option>
              </select>
              <div class="error_estudios alert alert-danger" role="alert"></div>
            </div>
          </div>

          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group text-left">
              <label class="text-primary" for="area">Area de conocimiento : </label>
              <select class="form-control" id="area" name="area">
                <option value=''>Seleccione Opción</option>
                <option value='Gestion de Politicas publicas'>Gestion de Politicas publicas</option>
                <option value='Identidades E Intercurturalidad'>Identidades E Intercurturalidad</option>
                <option value='Estado y Nueva institucionalidad'>Estado y Nueva institucionalidad</option>
                <option value='Gestion en Salud Publica'>Gestion en Salud Publica</option>
                <option value='Comunicacion e Informacion'>Comunicacion e Informacion</option>
                <option value='Desarrollo Endogeno y Calidad de Vida'>Desarrollo Endogeno y Calidad de Vida</option>
                <option value='Ambiente, Ecodesarrollo y Geopolitica Nacional'>Ambiente, Ecodesarrollo y Geopolitica Nacional</option>
                <option value='Multipolaridad E Integracion de Nuestra America'>Multipolaridad E Integracion de Nuestra America</option>
                <option value='Organizacion, Comunistaria y poder popular'>Organizacion, Comunistaria y poder popular</option>
                <option value='Dominio Tecnologico para el Desarrollo Endogeno'>Dominio Tecnologico para el Desarrollo Endogeno</option>
                <option value='Innovaciones educativas, enmacipadora y Desarrollo Humano'>Innovaciones educativas, enmacipadora y Desarrollo Humano</option>
              </select>
              <div class="error_area alert alert-danger" role="alert"></div>
            </div>
          </div>
        </div>
      </div>

        <div class="col-sm-8 col-md-8 col-lg-8">
          <div class="row">
            <div class="col-lg-12">
              <h4 class="text-center text-primary">Unidad Curricular</h4>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <select class="form-control" name="unidad1" id="unidad1" placeholder="">
                </select>
                <div class="error_unidad1 alert alert-danger" role="alert"></div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2">
          <div class="row">
            <div class="col-lg-12">
              <h4 class="text-center text-primary" title="Unidad de Credito">U/C</h4>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <input type="text" class="form-control" name="unidadCredito1" id="unidadCredito1" placeholder="U/C 1" readonly>
                <div class="error_unidadCredito1 alert alert-danger" role="alert"></div>
              </div>

            </div>
          </div>
        </div>

      <div class="col-sm-2 col-md-2 col-lg-2">
        <div class="row">
          <div class="col-lg-12">
            <h4 class="text-center text-primary" title="Periodo Academico">Periodo</h4>
          </div>

          <div class="col-lg-12">
            <div class="form-group">
              <input type="text" class="form-control" name="periodo1" id="periodo1" placeholder="" readonly>
              <div class="error_periodo1 alert alert-danger" role="alert"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <select class="form-control" name="unidad2" id="unidad2">
              </select>
              <div class="error_unidad2 alert alert-danger" role="alert"></div>
            </div>

          </div>
        </div>
      </div>


    <div class="col-sm-2 col-md-2 col-lg-2">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <input type="text" class="form-control" name="unidadCredito2" id="unidadCredito2" placeholder="U/C 2" readonly>
              <div class="error_unidadCredito2 alert alert-danger" role="alert"></div>
            </div>

          </div>
        </div>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <input type="text" class="form-control" name="periodo2" id="periodo2" placeholder="" readonly>
            <div class="error_periodo2 alert alert-danger" role="alert"></div>
          </div>

        </div>
      </div>
    </div>

      <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <select class="form-control" name="unidad3" id="unidad3">
              </select>
              <div class="error_unidad3 alert alert-danger" role="alert"></div>
            </div>

          </div>
        </div>
      </div>


    <div class="col-sm-2 col-md-2 col-lg-2">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <input type="text" class="form-control" name="unidadCredito3" id="unidadCredito3" placeholder="U/C 3" readonly>
              <div class="error_unidadCredito3 alert alert-danger" role="alert"></div>
            </div>

          </div>
        </div>
  </div>

  <div class="col-sm-2 col-md-2 col-lg-2">
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <input type="text" class="form-control" name="periodo3" id="periodo3" placeholder="" readonly>
          <div class="error_periodo3 alert alert-danger" role="alert"></div>
        </div>

      </div>
    </div>
  </div>
  

<!-- sheepIt Form -->
    <div id="clonar_inspec_equipos_maquinarias" class="inspec_cic">
      <!-- Form template-->
	  <div id="clonar_inspec_equipos_maquinarias_template">
			<label for="clonar_inspec_equipos_maquinarias_#index#_phone2">  
			</label>
	  
  <div class="col-sm-7 col-md-7 col-lg-8">
    <h4 class="text-center text-primary">N° de Deposito</h4>
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
              <div class="form-group">
<input class="form-control" type="text" name="numeroDeposito" id="numeroDeposito" maxlength="21">
                <div class="error_numeroDeposito alert alert-danger" role="alert"></div>
              </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        </div>
      </div>
   </div>

  <div class="col-sm-3 col-md-3 col-lg-2">
    <h4 class="text-center text-primary">Fecha de Deposito</h4>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <input class="form-control" type="text" name="fechaDeposito" id="datapicker" placeholder="AAAA/MM/DD">
            <div class="error_fechaDeposito alert alert-danger" role="alert"></div>
          </div>
        </div>
      </div>
   </div>

  <div class="col-sm-2 col-md-2 col-lg-2">
    <h4 class="text-center text-primary">Monto N° <span id="clonar_inspec_equipos_maquinarias_label"></span></h4>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
<input class="form-control" type="text" name="montoDeposito" id="montoDeposito">
            <div class="error_montoDeposito alert alert-danger" role="alert"></div>
          </div>

        </div>
      </div>
    </div>
      
<!--<input id="clonar_inspec_equipos_maquinarias_#index#_phone2" name="person[phone2s][#index#][phone2]" type="text"/>-->
                        
      </div>
      <!-- /Form template-->

              <!-- No forms template -->
              <div id="clonar_inspec_equipos_maquinarias_noforms_template" class="noItems">No hay Depositos</div>
              <!-- /No forms template-->
                         
						   
    <div class="inspec_cic clear1"></div>
                   <!-- Controls -->
      <div id="clonar_inspec_equipos_maquinarias_controls" class="controls" >
        <div id="clonar_inspec_equipos_maquinarias_add" class="btn form add"><a class="btn btn-success">
			<span>Agregar Deposito</span></a></div>
       <div id="clonar_inspec_equipos_maquinarias_remove_last" class="btn form remove"><a class="btn btn-success">
			<span>Remover Deposito</span></a></div>
      <div id="clonar_inspec_equipos_maquinarias_remove_all" class="btn form removeAll"><a class="btn btn-success">
			<span>Remover Todos los Depositos</span></a></div>
    
       </div>
                 <!-- /Controls -->
    </div>
    <!-- /sheepIt Form -->

  <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">Registrar <span class="glyphicon glyphicon-ok-sign"></span></button>
      <button type="reset" class="btn btn-danger" id="limpiar">Limpiar <span class="glyphicon glyphicon-remove-sign"></span></button>
    </div>
  </div>

<?=form_close();?>
  </div>
</div>
