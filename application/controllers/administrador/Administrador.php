<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
	$this->load->library(array('session','form_validation','Pdf'));  //AGREGADO "session" EL 20-11-16
    $this->load->helper(array('url','security','file','download'));  //AGREGADO "url" EL 20-11-16
    $this->load->model(array('Operador_model','Usuarios_model','Administrador_model','Profesores_model'));

  }

	public function index()
	{
    $config['template'] = '
        {table_open}
        <div class="table-responsive">
        <table class="table table-bordered text-center center-block calendario">
        <caption><h3 class="text-center text-info">Historicos de Sesion</h3></caption>
        {/table_open}

        {heading_row_start}<tr>{/heading_row_start}
        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}" class="text-info text-center">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}
          <tr>
        {/week_row_start}
        {week_day_cell}
          <td class="text-danger">{week_day}</td>
        {/week_day_cell}
        {week_row_end}
        </tr>
        {/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a class="lead text-info info sesionenlace" href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a class="lead text-info info sesionenlace" href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}
        </table>
        </div>
        {/table_close}';

      $this->load->library('calendar',$config);
      $data['sesion'] = $this->Usuarios_model->fechaSesion($this->session->userdata('id'));
      $this->load->view('administrador/inicio',$data);

		//AGREGADOS 27-11-16 PARA ENCRIPTAR BASE DE DATOS -->
		$username = "iparra";
		$password = "12345678";
		$register = date("Y-m-d");
		//$this->load->model('aes_model');
		//$this->aes_model->save($username,$password,$register); //SIGUE <-->
	}

	public function get()
	{
		//$this->load->model('aes_model');
		$users = $this->aes_model->get();
		foreach($users as $user)
		{
			echo $user->username. "---" . $user->password . "----" . $user->register_date . "<br>";
		}
	} //HASTA ACA <--.


//DESDE ACA LLAMADA A FORM UC PARA REGISTRO
  public function FFormUnidadcurricular()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/formUnidadCurricular');
    }
    else
    {
      show_404();
    }
  }

  //UNIDAD C validando FORM
   public function registrarUnidadC()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('nombre_unidad','Unidad Curricular','trim|required|min_length[3]|max_length[70]|regex_match[/^[a-zA-ZÑ-ñ\s]+$/]');
      //$this->form_validation->set_rules('cedula','Cedula','trim|required|numeric|min_length[7]|max_length[8]');

      $this->form_validation->set_message('required',"El campo %s es requerido");
      $this->form_validation->set_message('min_length',"El campo %s debe ser mayor o igual a %s caracteres");
      $this->form_validation->set_message('max_length',"El campo %s debe ser menor o igual a %s caracteres");
      $this->form_validation->set_message('numeric','El campo %s debe contener solo numero');
      $this->form_validation->set_message('alpha','El campo %s debe contener solo letras');

      if($this->form_validation->run() === FALSE)
      {
        $datos = array(
          'respuesta'=>'error',
          'nombre_unidad' => form_error('nombre_unidad'),
        );
      }
      else
      {
        $nombre_unidad = ucwords(xss_clean($this->input->post('nombre_unidad')));

        $cont = $this->unidadC_model->validarOperador($cedula);

        if($cont==1)
        {
          $datos = array(
            'respuesta' => 'error',
            'validar' => 'Error ya existe una Unidad regitsrada con el mismo nombre en el sistema'
          );
        }
        else
        {
          $verificar = $this->unidadC_model->nueva_UnidadC($nombre_unidad);
          if($verificar)
          {
              $datos = array(
                'respuesta'=>'',
                'exito'=>'Unidad Curricular registrada con exito'
              );
          }
          else
          {
            $datos = array(
              'respuesta'=>'error',
              'validar'=>'error no se pudo registrar Unidad Curricular'
            );
          }
        }
      }
      echo json_encode($datos);
    }
    else
    {
      show_404();
    }
  }



//ver UNIDAD CURRICULAR
	 public function buscarUnidadC()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/buscarUnidadC');
    }
    else
    {
      show_404();
    }
  }
/*
 //extraer UNIDAD C
   public function FFextraerUnidadC()
  {
    if($this->input->is_ajax_request())
    {
      $data['operadores'] = $this->unidadC_model->extraer();
      $data['cantidad']= count($data['operadores']);
      if(is_array($data['operadores']) && (!empty($data['operadores'])))
      {
        $this->load->view('administrador/verUnidadC',$data);
      }
      else
      {
        echo "<h3 class='text-center text-danger'>Error no hay Administrador registrado en el sistema</h3>";
      }

    }
    else
    {
      show_404();
    }
  }*/


  public function reporteBauche()
  {
    if($this->input->is_ajax_request())
    {
      $resultado['resultado'] = $this->Administrador_model->extraerbauche();
      $resultado['suma'] = $this->Administrador_model->sumarmontobauche();
     $this->load->view('administrador/verbauche',$resultado);
    }
    else
    {
      show_404();
    }

  }



 //DESDE ACA DEL OPERADOR
  public function formOperador()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/form_operador');
    }
    else
    {
      show_404();
    }
  }


  public function registrarOperador()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('nombre','Nombre','trim|required|min_length[3]|max_length[20]|alpha');
      $this->form_validation->set_rules('cedula','Cedula','trim|required|numeric|min_length[7]|max_length[8]');

      $this->form_validation->set_message('required',"El campo %s es requerido");
      $this->form_validation->set_message('min_length',"El campo %s debe ser mayor o igual a %s caracteres");
      $this->form_validation->set_message('max_length',"El campo %s debe ser menor o igual a %s caracteres");
      $this->form_validation->set_message('numeric','El campo %s debe contener solo numero');
      $this->form_validation->set_message('alpha','El campo %s debe contener solo letras');

      if($this->form_validation->run() === FALSE)
      {
        $datos = array(
          'respuesta'=>'error',
          'nombre' => form_error('nombre'),
          'cedula'=> form_error('cedula'),
          'clave' => form_error('clave')
        );
      }
      else
      {
        $nombre = ucwords(xss_clean($this->input->post('nombre')));
        $cedula ='v'.xss_clean($this->input->post('cedula'));
        $usuario ='adm'.xss_clean($this->input->post('cedula'));
        $clave = do_hash($cedula,'md5');

        $cont = $this->Operador_model->validarOperador($cedula);

        if($cont==1)
        {
          $datos = array(
            'respuesta' => 'error',
            'validar' => 'Error ya existe un usuario regitsrado con la misma cedula en el sistema'
          );
        }
        else
        {
          $verificar = $this->Operador_model->registrarOperador($nombre,$cedula,$usuario,$clave);
          if($verificar)
          {
              $datos = array(
                'respuesta'=>'',
                'exito'=>'Operador registrado con exito'
              );
          }
          else
          {
            $datos = array(
              'respuesta'=>'error',
              'validar'=>'error no se pudo registrar operador'
            );
          }
        }
      }

      echo json_encode($datos);
    }
    else
    {
      show_404();
    }
  }


  public function extraerOperador()
  {
    if($this->input->is_ajax_request())
    {
      $data['operadores'] = $this->Operador_model->extraer();
      $data['cantidad']= count($data['operadores']);
      if(is_array($data['operadores']) && (!empty($data['operadores'])))
      {
        $this->load->view('administrador/verOperador',$data);
      }
      else
      {
        echo "<h3 class='text-center text-danger'>Error no hay operador registrado en el sistema</h3>";
      }

    }
    else
    {
      show_404();
    }
  }


  public function formCohorte()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/formCohorte');
    }
    else
    {
      show_404();
    }
  }


  public function buscarPlanificacion()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('planificacion','Planificacion','trim|required');
      $this->form_validation->set_message('required','el campo %s es requerido');
      $this->form_validation->set_message('is_list','opcion invalida en campo %s');

      if($this->form_validation->run()===FALSE)
      {
          echo form_error('planificacion');
      }
      else
      {
        $opcion = xss_clean($this->input->post('planificacion'));
        if($opcion=='maestria')
        {
          $this->load->view('administrador/formPlanificacionMaestria');
        }
        else if($opcion=='doctorado')
        {
          $this->load->view('administrador/formPlanificacionDoctorado');
        }
        else if($opcion=='especializacion')
        {
          $this->load->view('administrador/formPlanificacionEspecializacion');
        }
        else{
          echo 'opcion invalida';
        }
      }
    }
    else
    {
      show_404();
    }
  }


  public function formDoctorado()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/formDoctorado');
    }
    else
    {
      show_404();
    }
  }


    public function formMaestria()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/formMaestria');
    }
    else
    {
      show_404();
    }
  }


  public function formPlanificacion()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('administrador/formPlanificacion');
    }
    else
    {
      show_404();
    }
  }


  public function registrarCohorte()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('fechaInicio','Fecha Inicio','trim|required|regex_match[/^[0-9]{4}[\/]{1}[0-9]{2}[\/]{1}[0-9]{2}+$/]');
      $this->form_validation->set_rules('fechaFinal','Fecha Fecha Final','trim|required|regex_match[/^[0-9]{4}[\/]{1}[0-9]{2}[\/]{1}[0-9]{2}+$/]');
      $this->form_validation->set_rules('cohorte','Cohorte','trim|required');
      $this->form_validation->set_message('riquired','Error el campo %s es requerido');
      $this->form_validation->set_message('regex_match','Error en campo %s formato no permitido');

      if($this->form_validation->run()===FALSE)
      {
        $mensaje = array(
          'respuesta'=>'error',
          'error_fechaInicio'=>form_error('fechaInicio'),
          'error_fechaFinal'=>form_error('fechaFinal')
        );
      }
      else
      {
        $cohorte = xss_clean($this->input->post('cohorte'));
        $fechaInicio = xss_clean($this->input->post('fechaInicio'));
        $fechaFinal = xss_clean($this->input->post('fechaFinal'));

        $consulta = $this->Administrador_model->registrarCohorte($cohorte,$fechaInicio,$fechaFinal);
        if($consulta===TRUE)
        {
          $mensaje = array(
            'respuesta'=>'exito',
            'exito'=>'Datos Registrado con exito'
          );
        }
        else
        {
          $mensaje = array(
            'respuesta'=>'error',
            'error'=>'ocurrio un error en el sistema'
          );
        }
      }
      echo json_encode($mensaje);
    }
    else
    {
      show_404();
    }
  }



  public function editarOperador()
  {

    if($this->input->is_ajax_request())
    {
      $campo = xss_clean($this->input->post('campo'));
      $id = intval(xss_clean($this->input->post('id')));

      switch ($campo) {
        case 'nombre':
            $this->form_validation->set_rules('nuevovalor','Nombre','trim|required|min_length[3]|max_length[15]|alpha');

            $this->form_validation->set_message('required','Error el dato %s es requerido');
            $this->form_validation->set_message('min_length','Error el dato %s debe ser mayor o igual a %s caracteres');
            $this->form_validation->set_message('max_length','Error el dato %s debe ser menor o igual a %s caracteres');
            $this->form_validation->set_message('alpha','Error el dato %s debe ser solo letras');

            if($this->form_validation->run() === FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );

            }
            else
            {
              $valor =ucwords(xss_clean($this->input->post('nuevovalor')));
              $resultado = $this->Operador_model->editarDatos($id,$campo,$valor);
              if($resultado == TRUE)
              {
                $mensaje = array(
                  'respuesta'=>'',
                  'exito'=>'Dato nombre actualizado con exito'
                );

              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'error al actualizar datos nombre'
                );
              }

            }
            echo json_encode($mensaje);
        break;

        case 'usuario':
        $this->form_validation->set_rules('nuevovalor','Usuario','trim|required|min_length[10]|max_length[11]|alpha_numeric|regex_match[/^["a-zA-Z"]{3}[0-9]+$/]|is_unique[usuarios.usuario]');

        $this->form_validation->set_message('required','Error el dato %s es requerido');
        $this->form_validation->set_message('min_length','Error el dato %s debe ser mayor o igual a %s caracteres');
        $this->form_validation->set_message('max_length','Error el dato %s debe ser menor o igual a %s caracteres');
        $this->form_validation->set_message('alpha_numeric','Error el dato %s debe ser solo letras y numeros');
        $this->form_validation->set_message('regex_match','Error en el dato %s formato no valido');
        $this->form_validation->set_message('is_unique','Error en dato %s , ya exite en el sistema');

        if($this->form_validation->run() === FALSE)
        {
          $mensaje = array(
            'respuesta'=>'error',
            'error'=>form_error('nuevovalor')
          );
        }
        else
        {
          $valor =xss_clean($this->input->post('nuevovalor'));
          $dat = str_split($valor,3);
          if($dat[0]!="adm")
          {
            $mensaje = array(
              'respuesta'=>'error',
              'error'=>'Error en dato usuario formato no valido'
            );
          }
          else
          {
            $resultado = $this->Operador_model->editarDatos($id,$campo,$valor);
            if($resultado == TRUE)
            {
              $mensaje = array(
                'respuesta'=>'',
                'exito'=>'Dato usuario actualizado con exito'
              );
            }
            else
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>'Error al actualizar datos usuario'
              );
            }
          }
        }
        echo json_encode($mensaje);

        break;

        case 'cedula':
        $this->form_validation->set_rules('nuevovalor','Cedula','trim|required|min_length[8]|max_length[9]|alpha_numeric|regex_match[/^["a-z"]{1}["0-9"]+$/]|is_unique[usuarios.cedula]');
        $this->form_validation->set_message('required','Error el dato %s es requerido');
        $this->form_validation->set_message('min_length','Error el dato %s debe ser mayor o igual a %s caracteres');
        $this->form_validation->set_message('max_length','Error el dato %s debe ser menor o igual a %s caracteres');
        $this->form_validation->set_message('alpha_numeric','Error el dato %s debe ser numero y letras');
        $this->form_validation->set_message('regex_match','Error en el dato %s formato no valido');
        $this->form_validation->set_message('is_unique','Error en dato %s , ya existe en el sistema');

        if($this->form_validation->run() === FALSE)
        {
          $mensaje = array(
            'respuesta'=>'error',
            'error'=>form_error('nuevovalor')
          );
        }
        else
        {
          $valor = xss_clean($this->input->post('nuevovalor'));
          $dat = str_split($valor,1);
          if($dat[0]!="v" && ($dat[0]!="e"))
          {
            $mensaje = array(
              'respuesta'=>'error',
              'error'=>'Error en el dato cedula formato no valido'
            );
          }
          else
          {
            $resultado = $this->Operador_model->editarDatos($id,$campo,$valor);
            if($resultado == TRUE)
            {
              $mensaje = array(
                'respuesta'=>'',
                'exito'=>'Dato cedula actualizado con exito'
              );
            }
            else
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>'error al actualizar datos nombre'
              );
            }
          }
        }
        echo json_encode($mensaje);

        break;

        case 'clave':
        $this->form_validation->set_rules('nuevovalor','Clave','trim|required|min_length[6]|max_length[12]');

        $this->form_validation->set_message('required','Error el dato %s es requerido');
        $this->form_validation->set_message('min_length','Error el dato %s debe ser mayor o igual a %s caracteres');
        $this->form_validation->set_message('max_length','Error el dato %s debe ser menor o igual a %s caracteres');

        if($this->form_validation->run() === FALSE)
        {
          $mensaje = array(
            'respuesta'=>'error',
            'error'=>form_error('nuevovalor')
          );
        }
        else
        {
          $valor = do_hash(xss_clean($this->input->post('nuevovalor')),'md5');
          $resultado = $this->Operador_model->editarDatos($id,$campo,$valor);
          if($resultado == TRUE)
          {
            $mensaje = array(
              'respuesta'=>'',
              'exito'=>'Dato clave actualizado con exito'
            );

          }
          else
          {
            $mensaje = array(
              'respuesta'=>'error',
              'error'=>'error al actualizar datos clave'
            );
          }

        }
        echo json_encode($mensaje);


        break;

        default:
          # code...
          break;
      }
    }
    else
    {
      show_404();
    }
  }



  public function estadoOperador()
  {

    if($this->input->is_ajax_request())
    {

      $this->form_validation->set_rules('id','ID','trim|required|numeric');

      $this->form_validation->set_message('required','Error el dato %s es requerido');
      $this->form_validation->set_message('numeric','Error el dato %s debe ser numerico');

      if($this->form_validation->run() === FALSE)
      {
        $mensaje= array(
          'respuesta'=>'error',
          'error'=>form_error('id')
        );
      }
      else
      {
        $id = xss_clean($this->input->post('id'));
        $estado = xss_clean($this->input->post('dato'));

        if($estado!="activo" && ($estado!="noactivo"))
        {
          $mensaje= array(
            'respuesta'=>'error',
            'error'=>'Error al capturar estado de operador'
          );
        }
        else
        {
          $resultado = $this->Operador_model->estado($id,$estado);
          if($resultado === TRUE)
          {
            $mensaje = array(
              'respuesta'=>'exito',
              'exito'=>'Estado actualizado con exito',
            );
          }
          else
          {
            $mensaje = array(
              'respuesta'=>'error',
              'exito'=>'Error no se pudo actualizar estado'
            );
          }
        }
      }
      echo json_encode($mensaje);
    }
    else
    {
      show_404();
    }
  }



  public function eliminarOperador()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('id','ID','required|trim|numeric');
      $this->form_validation->set_message('numeric','Error %s debe ser numerico');
      $this->form_validation->set_message('required',"Error el campo %s es requerido");

      if($this->form_validation->run() === FALSE)
      {
        $mensaje = array(
          'respuesta'=>'error',
          'error'=>form_error('id')
        );
      }
      else
      {
        $id = xss_clean($this->input->post('id'));
        $cantidad = xss_clean($this->input->post('cantidad'));
        $resultado = $this->Operador_model->eliminar($id);
        if($resultado===TRUE)
        {
          $cantidad=$cantidad-1;
            $mensaje = array(
              'respuesta'=>'',
              'exito'=>'operador eliminado con exito',
              'cantidad'=>$cantidad
            );
        }
        else
        {
          $mensaje= array(
            'respuesta'=>'error',
            'error'=>'Error al eliminar operador'
          );
        }
      }
      echo json_encode($mensaje);
    }
    else
    {
      show_404();
    }
  }



//FORMULARIO PROFESOR
  public function form_profesor()
  {
    if($this->input->is_ajax_request())
    {
        redirect(base_url('Profesores'));
    }
    else
    {
      show_404();
    }
  }



  public function import()
  {
    if($this->input->is_ajax_request())
    {
      redirect(base_url('import'));
    }
    else
    {
      show_404();
    }
  }




//VISTA DE AUDITAR
  public function auditar()
  {
    if($this->input->is_ajax_request())
    {
        redirect(base_url('auditar_view'));
    }
    else
    {
      show_404();
    }
  }



  public function respaldarBaseDato()
  {
				$this->load->dbutil();
				$backup =  $this->dbutil->backup();
				write_file('./respaldo_DB/postgrados'.Date('d-m-Y').'-sep.gz', $backup);

				force_download('postgrados'.Date('d-m-Y').'-sep.gz', $backup);
  }

  public function formClave()
  {
    if($this->input->is_ajax_request())
    {
      redirect(base_url('ConfigClave'));
    }
    else
    {
      show_404();
    }
  }



  public function horaSesion()
  {
    if($this->input->is_ajax_request())
    {
      $fecha = $this->input->post('fecha');
      $hora = $this->Usuarios_model->horaSesion($fecha,$this->session->userdata('id'));
      for($i=0; $i<count($hora);$i++)
      {
        echo $hora[$i]['hora']."\n";
      }
    }
    else
    {
      show_404();
    }
  }




  public function Formestudiantes()
  {
      if($this->input->is_ajax_request())
      {
        redirect(base_url('Estudiantes'));

      }
      else
      {
        show_404();
      }
  }



  public function formBuscarEstudiantes()
  {
    if($this->input->is_ajax_request())
    {
      redirect(base_url('Estudiantes/formBuscar'));
    }
    else
    {
      show_404();
    }
  }
}
?>
