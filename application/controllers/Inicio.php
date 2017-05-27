<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form','captcha','string','security'));
    $this->load->library('form_validation');
    $this->load->model('Validar_Usuario');
  }

	public function index()
	{
		$this->load->view('inicio/inicio');
	}



  public function mision()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('inicio/mision');
    }
    else
    {
      show_404();
    }
  }


  public function vision()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('inicio/vision');
    }
    else
    {
        show_404();
    }
  }


  public function organigrama()
  {
    if($this->input->is_ajax_request())
    {
      $this->load->view('inicio/organigrama');
    }
    else
    {
        show_404();
    }
  }


  public function form_login()
  {
    if($this->input->is_ajax_request())
    {
      $dat = $this->createCaptcha();
      $this->load->view('inicio/form_login',$dat);
    }
    else
    {
        show_404();
    }
  }


  public function login()
  {
      if($this->input->is_ajax_request())
      {
        $this->form_validation->set_rules('usuario','Usuario','trim|required|exact_length[11]');
        $this->form_validation->set_rules('clave','Clave','trim|required|min_length[8]|max_length[12]');
        $this->form_validation->set_rules('captcha','Captcha','trim|required|exact_length[6]');

        $this->form_validation->set_message('required','El campo %s es requerido');
        $this->form_validation->set_message('max_length','El campo %s debe ser menor a %s caracteres');
        $this->form_validation->set_message('min_length','El campo %s debe ser mayor a %s caracteres');
        $this->form_validation->set_message('exact_length','El campo %s solo debe tener %s caracteres');

        if($this->form_validation->run() === FALSE)
        {
          $dat = array(
            'respuesta' => 'error',
            'usuario' => form_error('usuario'),
            'clave' => form_error('clave'),
            'captcha'=> form_error('captcha')
          );

          echo json_encode($dat);
        }
        else
        {
          $datos = xss_clean($this->input->post('captcha'));
          $expiration = time()-600; // Límite de 10 minutos
		  $ip = $this->input->ip_address();//ip del usuario

          $this->Validar_Usuario->eliminarCaptcha($expiration);

          $validar = $this->Validar_Usuario->validarCaptcha($ip,$expiration,$datos);

          if($validar==1)
          {
            $user = xss_clean($this->input->post('usuario'));
            $clave= do_hash(xss_clean($this->input->post('clave')),'md5');

            $data = $this->Validar_Usuario->validarUsuario($user,$clave);

            if(is_array($data))
            {
              $usuario = array(
							'id'=> $data['id'],
							'nombre'=> $data['nombre'],
              'apellido'=>$data['apellido'],
							'tipo_usuario'=> $data['tipo_usuario'],
							'log'=> TRUE
							);

              $this->Validar_Usuario->guardarSesion($data['id']);
						  $this->session->set_userdata($usuario);
						  $dat = array(
							 'respuesta'=>'',
               'usuario' => $data['nombre'],
               'url'=> base_url("Direccionar")
							 );
            }
            else
            {

              $dat = array(
  						'respuesta'=>'error',
  						'validar'=>'Error usuario o Clave Invalido'
  						);
            }
          }
          else
          {
            $dat = array(
              'respuesta' => 'error',
              'captcha' =>'Error debes colocar lo mismo datos de la imagen'
            );
          }
              echo json_encode($dat);
        }
      }
      else
      {
          show_404();
      }
  }



  public function createCaptcha()
  {
    $vals = array(
				'word'	=> random_string('alnum',6),
        'img_path'      => './captcha/',
        'img_url'       => 'http://localhost/sciecea/captcha/',
        'font_path'     => './public/fonts/unispace.ttf',
        'img_width'     => '140',
        'img_height'    => '65',
        'expiration'    => '600',

        		'colors'     => array(
                'background' => array(255, 255, 255),
                'border' 	 => array(0, 0, 0),
                'text' 		 => array(0, 0, 0),
                'grid' 		 => array(255, 40, 40)
        )
		);

	$cap = create_captcha($vals);
	  $this->Validar_Usuario->guardarCaptcha($cap);
		return $cap;
  }



public function recuperarClave()
{
  if($this->input->is_ajax_request())
  {
    $this->form_validation->set_rules('correoUsuario','Correo','trim|required|valid_email');

    $this->form_validation->set_message('required','El campo %s es requerido');
    $this->form_validation->set_message('valid_email','El %s no es valido');

    if($this->form_validation->run()===FALSE)
    {
      $mensaje = array(

        'respuesta'=>'error',
        'error_correo'=>form_error('correoUsuario')
      );
    }
    else
    {
      $correo = xss_clean($this->input->post('correoUsuario'));
      $consulta['usuarios'] = $this->Validar_Usuario->extraerUsuarioId($correo);
      if(count($consulta['usuarios'][0])>1)
      {
        $nuevaClave = random_string('alnum',8);
        $clave = do_hash($nuevaClave,'md5');
        $respuesta = $this->Validar_Usuario->cambiarClave($consulta['usuarios'][0]['id'],$clave);
        if($respuesta===TRUE)
        {
          //cargamos la libreria email de ci
         $this->load->library("email");
         //configuracion para gmail
         $configGmail = array(
         'protocol' => 'smtp',
         'smtp_host' => 'ssl://smtp.gmail.com',
         'smtp_port' => 465,
         'smtp_user' => 'sciecea@gmail.com',
         'smtp_pass' => 'dubraska201617',
         'mailtype' => 'html',
         'charset' => 'utf-8',
         'newline' => "\r\n"
         );
         //cargamos la configuración para enviar con gmail
         $this->email->initialize($configGmail);
         $this->email->from('sciecea@gmail.com');
         $this->email->to("".$correo."");
         $this->email->subject('Recuperarcion de Clave');
         $this->email->message('<h2 color="blue">Recuperacion de Correo</h2><hr><p>Usuario: '.$consulta['usuarios'][0]["usuario"].'</p><p>Nueva Clave : '.$nuevaClave.'</p>');
         $this->email->send();
         $mensaje = array(
           'respuesta'=>'exito',
           'exito'=>'Se ha enviado una nueva clave a su correo'
         );
        }
        else
        {
          $mensaje = array(
            'respuesta'=>'error',
            'error_correo'=>'ocurrio un error al cambiar clave'
          );
        }
      }
      else
      {
        $mensaje = array(
          'respuesta'=>'error',
          'correono'=>'Error este correo no exite'
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

}
