$(document).ready(function(){

  var valor=null;
  //editar estudiantes
  $(document).on("click","td.editableEstudiantes span",function(e){
    e.preventDefault();
      $("td:not(.id)").removeClass("editableEstudiantes");
       td=$(this).closest("td");
       campo=$(this).closest("td").data("campo");
       valor =$(this).text();
       id=$(this).closest("tr").find(".id").text();
       tipo = $(this).closest('tr').find('.tipo').text();

       if(tipo=="unidades_curriculares" && (campo=="nombre_unidad"))
       {
         td.text("").html("<select name='"+campo+"'> <option value='"+valor+"'>"+valor+"</option> </select> <a class='enlaceEstudiantes guardarDatosEstudiantes' href='#' title='Guardar'>Guardar</a> <a class='enlaceEstudiantes cancelarEstudiantes' href='#' title='cancelar'>Cancelar</a>");
       }
       else if(campo=="tipo_estudio")
       {
         td.text("").html("<select name='"+campo+"'> <option value='maestria'>maestria</option><option value='doctorado'>doctorado</option><option value='especializacion'>especializacion</option> </select> <a class='enlaceEstudiantes guardarDatosEstudiantes' href='#' title='Guardar'>Guardar</a> <a class='enlaceEstudiantes cancelarEstudiantes' href='#' title='cancelar'>Cancelar</a>");
       }
       else if(campo=="condicion_de_pago")
       {
          td.text("").html("<select name='"+campo+"'> <option value='solvente'>Solvente</option><option value='pendiente'>Pendiente</option> </select> <a class='enlaceEstudiantes guardarDatosEstudiantes' href='#' title='Guardar'>Guardar</a> <a class='enlaceEstudiantes cancelarEstudiantes' href='#' title='cancelar'>Cancelar</a>");
       }
       else
       {
         td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlaceEstudiantes guardarDatosEstudiantes' href='#' title='Guardar'>Guardar</a> <a class='enlaceEstudiantes cancelarEstudiantes' href='#' title='cancelar'>Cancelar</a>");
       }

    });

    //cancelar editar info estudiantes
    $(document).on("click",".cancelarEstudiantes",function(e){

      e.preventDefault();
      td.text("").html("<span>"+valor+"</span>");
      $("td:not(.id)").addClass("editableEstudiantes");
    });

    //guardar datos editados del estudiantes
    $(document).on("click",".guardarDatosEstudiantes",function(e)
    {
      e.preventDefault();
       nuevovalor=$(this).closest("td").find("select, input").val();
       id = $(this).closest("tr").find(".id").text();
       campo= $(this).closest("td").data("campo");
       id_unidad = $(this).closest('tr').find('.id_unidad').text();
       if(campo=='seccion' || (campo=="area_conocimiento"))
       {
         tipo="unidades_curriculares"
       }
       else if(campo=="tipo_estudio" ||(campo=="propuesta_de_investigacion"))
       {
         tipo="prosecuciones";
       }
       else
       {
         tipo = $(this).closest('tr').find('.tipo').text();
       }
       td= $(this).closest("td");
      if(nuevovalor!="")
      {
        $.ajax({
              type: "post",
              url: "Estudiantes/editarCamposEstudiantes",
              data: { campo: campo, nuevovalor: nuevovalor, id : id, tipo:tipo, id_unidad : id_unidad },
              success: function(respuesta)
              {
                json  = JSON.parse(respuesta);
                if(json.respuesta=="error")
                {
                  $("#mensajetodos").css({"background-color":"red",'display':'block'}).html("<h3>"+json.error+"</h3>").fadeOut(6000);
                  td.text("").html("<span>"+valor+"</span>");
                }
                else
                {
                  $("#mensajetodos").css({"background-color":"green",'display':'block'}).html('<h3>'+json.exito+'</h3>').fadeOut(6000);
                  td.text("").html("<span>"+nuevovalor+"</span>");
                  valor = nuevovalor;
                }

                $("td:not(.id)").addClass("editableEstudiantes");
              }
            });
      }

    });
});
