$(document).ready(function(){


  $(document).on('mouseover','#eliminarOperador',function(e){
    e.preventDefault();
    td = $(this).closest('tr').find('td');
    td.addClass('text-danger');
  });

  $(document).on('mouseout','#eliminarOperador',function(e){
      e.preventDefault();
      td = $(this).closest('tr').find('td');
      td.removeClass('text-danger');
  });

  $(document).on('click','#eliminarOperador',function(e){
    e.preventDefault();
    id = $(this).closest('tr').find('.id').text();
    td = $(this).closest('tr').find('td');
    cantidad = $("#cantidad").text();
    $("#dialogoOperador").modal('show');
    $("#sieliminaroperador, #noeliminaroperador").on('click',function(){

      valor = $(this).val();
      if(valor=='sieliminaroperador')
      {
        $("#dialogoOperador").modal('hide');
        $.ajax({
          type :"post",
          url : "administrador/Administrador/eliminarOperador",
          data: {id: id,cantidad:cantidad},
          success : function(respuesta)
          {
            json = JSON.parse(respuesta);
            if(json.respuesta=="error")
            {
              $("#mensajetodos").css({'display':'block','background-color':'red'}).html("<h3>"+json.error+"</h3>").fadeOut(6000);
            }
            else
            {
                $("#mensajetodos").css({'display':'block','background-color':'green'}).html("<h3>"+json.exito+"</h3>").fadeOut(6000);
                td.css('display','none').html('');
                $("#cantidad").text(json.cantidad);
            }
          }
        });
      }
      else
      {
        $("#dialogoOperador").modal('hide');
      }

    });

  });

  $(document).on('click','#estadoOperador',function(){
    id =  $(this).closest('tr').find('.id').text();
    btn = $(this).closest('tr').find('button#estadoOperador');
    estado = $(this).closest('tr').find('button#estadoOperador').text();
    if(estado=="activo")
    {
      dato='noactivo';
    }
    else
    {
      dato='activo';
    }
    $.ajax({
      type:"post",
      url:"administrador/Administrador/estadoOperador",
      data:{id:id,dato:dato},
      success : function(respuesta)
      {
        json= JSON.parse(respuesta);
        if(json.respuesta=="error")
        {
          $("#mensajetodos").css({'display':'block','background-color':'red'}).html("<h3>"+json.error+"</h3>").fadeOut(6000);
        }
        else
        {
          $("#mensajetodos").css({'display':'block','background-color':'green'}).html("<h3>"+json.exito+"</h3>").fadeOut(6000);
          if(estado=="activo")
          {
            datos='noactivo';
            btn.removeClass();
            btn.addClass('btn btn-default');
            btn.text(datos);
          }
          else
          {
            datos='activo';
            btn.removeClass();
            btn.addClass('btn btn-success');
            btn.text(datos);

          }
        }
      }
    });
  });
  var valor=null;
  //editar operador
  $(document).on("click","td.editable span",function(e){
		e.preventDefault();
			$("td:not(#id)").removeClass("editable");
			 td=$(this).closest("td");
			 campo=$(this).closest("td").data("campo");
			 valor =$(this).text();
			 id=$(this).closest("tr").find(".id").text();
			td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#' title='Guardar'>Guardar</a> <a class='enlace cancelar' href='#' title='cancelar'>Cancelar</a>");
		});

    //cancelar editar operador
    $(document).on("click",".cancelar",function(e){

			e.preventDefault();
			td.text("").html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
		});

    //guardar datos editados de operador
    $(document).on("click",".guardar",function(e)
		{
			e.preventDefault();
			 nuevovalor=$(this).closest("td").find("input").val();
			 id = $(this).closest("tr").find(".id").text();
			 campo= $(this).closest("td").data("campo");
			 td= $(this).closest("td");
			if(nuevovalor.trim()!="")
			{
				$.ajax({
							type: "post",
							url: "administrador/Administrador/editarOperador",
							data: { campo: campo, nuevovalor: nuevovalor, id : id },
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

								$("td:not(.id)").addClass("editable");
							}
						});
			}

		});



});
