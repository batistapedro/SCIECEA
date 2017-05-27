<style>
#formCohortes
{
  width:50%;
}
</style>
<script>
$(document).ready(function(){
  $("#fechaInicio, #fechaFinal").datepicker({
      dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
      changeYear: true,
      changeMonth:true,
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      minDate: new Date(2003, 1 - 1, 1),
      dateFormat:"yy/mm/dd"
  });

  $(document).on('submit','#formCohortes',function(e){
    e.preventDefault();
    $.ajax({
      type : $(this).attr('method'),
      url: $(this).attr('action'),
      data : $(this).serialize(),
      success :  function(respuesta)
      {
        json = JSON.parse(respuesta);

        if(json.error)
        {
          if(json.fecha_inicio)
          {
                $("#mensajetodos").css({'display':'block','background-color':'red'}).html('<h3>'+json.fecha_inicio+'</h3>').fadeOut(6000);
          }else if(json.fecha_final)
          {
            $("#mensajetodos").css({'display':'block','background-color':'red'}).html('<h3>'+json.fecha_final+'</h3>').fadeOut(6000);
          }else if(json.error)
          {
            $("#mensajetodos").css({'display':'block','background-color':'red'}).html('<h3>'+json.error+'</h3>').fadeOut(6000);
          }

        }else
        {
          $("#mensajetodos").css({'display':'block','background-color':'green'}).html('<h3>'+json.exito+'</h3>').fadeOut(6000);
          $("#fechaInicio, #fechaFinal,#cohorte").val('');
        }
      }

    });
  });
});
</script>
  <caption><h3 class="text-center text-info">Registrar Cohortes</h3></caption><br><br>
<?=form_open(base_url('administrador/Administrador/registrarCohorte'),array('class'=>'form center-block ','id'=>'formCohortes','role'=>'form'));?>

  <div class="row">
      <div class="col-lg-12">
        <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label class='text-info' for='fechaInicio'>Fecha Inicio Cohorte:</label>
            <input type="text" name="fechaInicio" class="form-control" id="fechaInicio" placeholder="Introduzca Fecha de inicio de la cohorte">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="text-info" for='fechaFinal'>Fecha Final Cohorte :</label>
            <input type="text" name="fechaFinal" class="form-control" id="fechaFinal" placeholder="Introduzca Fecha de culminacion de la cohorte">
          </div>
        </div>
      </div>
      <div class="form-group">
          <label class="text-info ">Selecione Cohorte</label>
          <select class="form-control" name="cohorte" id="cohorte">
          <option value=''>Selecciones un Periodo</option>
          <option value='I'>I</option>
          <option value='II'>II</option>
          <option value='III'>III</option>
          <option value='IV'>IV</option>
          <option value='V'>V</option>
          <option value='VI'>VI</option>
          <option value='VII'>VII</option>
          <option value='VIII'>VIII</option>
          <option value='IX'>IX</option>
          <option value='X'>X</option>
          <option value='XI'>XI</option>
          <option value='XII'>XII</option>
          <option value='XIII'>XIII</option>
          <option value='XIV'>XIV</option>
          <option value='XV'>XV</option>
          <option value='XVI'>XVI</option>
          <option value='XVII'>XVII</option>
          <option value='XVIII'>XVIII</option>
          <option value='XIX'>XIX</option>
          <option value='XX'>XX</option>
          <option value='XXI'>XXI</option>
          <option value='XXII'>XXII</option>
          <option value='XXIII'>XXIII</option>
          <option value='XXIV'>XXIV</option>
          <option value='XXV'>XXV</option>
          <option value='XXVI'>XXVI</option>
          <option value='XXVII'>XXVII</option>
          <option value='XXVIII'>XXVIII</option>
          <option value='XXIX'>XXIX</option>
          <option value='XXX'>XXX</option>
          </select>
      </div>
    </div>
  </div>

  <br><br>
  <div class="form-group text-center">
    <button type="submit" class="btn btn-success">Registrar <span class="glyphicon glyphicon-send"></span></button>
    <button type="reset" class="btn btn-default">Limpiar <span class="glyphicon glyphicon-remove-sign"></span> </button>
  </div>
<?=form_close();?>
