<?php
class Profesores extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
	$this->load->library(array('session','form_validation','Pdf'));  //AGREGADO "session" EL 20-11-16
    $this->load->helper(array('url','form','security','file','download'));  //AGREGADO "url" EL 20-11-16
    $this->load->model('Profesores_model');
	$this->load->library('session'); //AGREGADO EL 15-11-16, SI ES Q TRABAJAMOS CON SESIONES.
	//$this->audit->register(); //AGREGADO EL 16-11-16
  }

  public function index()
  {
    if($this->session->userdata('tipo_usuario')=="administrador" || ($this->session->userdata('tipo_usuario')=="operador") || ($this->session->userdata('tipo_usuario')=="profesor"))
    {
      $this->load->view('profesores/form_profesor');
    }
    else
    {
      show_404();
    }
  }

  public function registrarProfesor()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('nombre','Nombres','trim|required|min_length[3]|max_length[40]|regex_match[/^[a-zA-Zñ-Ñ\s]+$/]');
      $this->form_validation->set_rules('apellido','Apellidos','trim|required|min_length[4]|max_length[40]|regex_match[/^[a-zA-Zñ-Ñ\s]+$/]');
      $this->form_validation->set_rules('cedula','Cedula','trim|required|min_length[8]|max_length[9]|is_unique[usuarios.cedula]');
      $this->form_validation->set_rules('telefono','Telefono','trim|required|exact_length[11]|numeric');
      $this->form_validation->set_rules('correo','Correo Electronico','trim|required|valid_email');
      $this->form_validation->set_rules('titulo','Titulo','trim|required|min_length[10]|max_length[100]|regex_match[/^[a-zA-Zñ-Ñ\s]+$/]');

      $this->form_validation->set_message('required','Error el dato %s es requerido');
      $this->form_validation->set_message('min_length','Error el dato %s debe ser mayor o igual a %s caracteres');
      $this->form_validation->set_message('max_length','Error el dato %s debe ser menor a igual a  %s caracteres');
      $this->form_validation->set_message('exact_length','Error el dato %s debe ser igual a %s carcateres');
      $this->form_validation->set_message('numeric','Error el campo %s debe ser solo numerico');
      $this->form_validation->set_message('valid_email','Error el campo %s no es valido');
      $this->form_validation->set_message('regex_match','error solo se permiten letras');
      $this->form_validation->set_message('is_unique','Erro %s ya esta registrada en el sistema');

      if($this->form_validation->run()===FALSE)
      {
        $datos = array(  
		 'respuesta'=>'error',
         'nombre'=>form_error('nombre'),
         'apellido'=>form_error('apellido'),
         'cedula'=>form_error('cedula'),
         'telefono'=>form_error('telefono'),
         'correo'=>form_error('correo'),
         'titulo'=>form_error('titulo'),	 
		 'direccion'=>form_error('direccion'),
		 'lugar_de_trabajo'=>form_error('lugar_de_trabajo'),
		 'cargo'=>form_error('cargo_o_departamento'),
		 'exoneracion'=>form_error('exoneracion'), 
        );
      }
     else
     {
        $cedula = xss_clean(strtolower($this->input->post('cedula')));
        $nacionalidad = substr($cedula,0,1);
        $codigoTelefono = substr($this->input->post('telefono'),0,4);

        if($nacionalidad!="v" && ($nacionalidad!="e"))
        {
          $datos = array(
            'respuesta'=>'error',
            'cedula'=>'<p>Error en en campo cedula nacionalidad no permitida</p>'
          );
        }
        else
        {
          $consulta = $this->Profesores_model->verificarCedula($cedula);
          if($consulta===1)
          {
            $datos = array(
              'respuesta'=>'error',
              'cedula'=>'<p>Error cedula ya esta registrada en el sistema</p>'
            );
          }
          else
          {
            if($codigoTelefono!="0412" && ($codigoTelefono!="0416" && ($codigoTelefono!="0424" && ($codigoTelefono!="0414" && ($codigoTelefono!="0426" && ($codigoTelefono!="0285"))))))
            {
              $datos = array(
                'respuesta'=>'error',
                'telefono'=>'<p>Error en campo telefono, codigo no valido</p>'
              );
            }
            else
            {
              $usuario = 'doc'.substr($cedula,1);

              $datos = array(
                'nombre'=>xss_clean(ucwords($this->input->post('nombre'))),
                'apellido'=>xss_clean(ucwords($this->input->post('apellido'))),
                'cedula'=>xss_clean($cedula),
                'telefono'=>xss_clean($this->input->post('telefono')),
                'correo'=>xss_clean($this->input->post('correo')),
				'titulo'=>xss_clean($this->input->post('titulo')),
				'direccion'=>xss_clean($this->input->post('direccion')),
				'lugar_de_trabajo'=>xss_clean($this->input->post('lugar_de_trabajo')),
				'cargo_o_departamento'=>xss_clean($this->input->post('cargo_o_departamento')),
				'exoneracion'=>xss_clean($this->input->post('exoneracion')),
				
                'tipo_usuario'=>'profesor',
                'usuario'=>$usuario,
                'clave'=>do_hash($cedula,'md5')
              );

              $consult = $this->Profesores_model->registrar($datos);

              if($consult === FALSE)
              {
                $datos = array(
                  'repuesta'=>'error',
                  'error_sql'=>'error no se pudo registrar Profesor'
                );
              }

                   if($datos===TRUE)
                   {
                     $datos = array(
                       'respuesta'=>'exito',
                       'mensaje'=>'Profesor registrado con exito'
                     );
                   }
                   else
                   {
                     $datos = array(
                       'repuesta'=>'error',
                       'error_sql'=>'error no se pudo registrar Profesor'
                     );
                   }
            }
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
 


} //CIERRE de la Class: Profesores

