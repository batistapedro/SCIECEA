<?php
class Validar_Usuario extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function guardarCaptcha($datos="")
  {
    $data = array(
			'captcha_time' => $datos['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $datos['word']
			);

		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
  }

  public function validarCaptcha($ip,$expiration,$datos)
  {
    //comprobamos si existe un registro con los datos
		//envíados desde el formulario
		$this->db->where('word',$datos);
		$this->db->where('ip_address',$ip);
		$this->db->where('captcha_time >',$expiration);
		$query = $this->db->get('captcha');
		//devolvemos el número de filas que coinciden
		return $query->num_rows();

  }

  public function validarUsuario($usuario="", $clave="")
  {
    $this->db->select('id,nombre,apellido,tipo_usuario');
    $this->db->where('usuario',$usuario);
    $this->db->where('clave',$clave);
    $this->db->where('estado','activo');
    $query = $this->db->get('usuarios');

    return $query->row_array();

  }

  public function eliminarCaptcha($expiration="")
  {
    $this->db->where('captcha_time <',$expiration);
		$this->db->delete('captcha');
  }

  public function guardarSesion($id="")
  {

   $hora = Date('H');
   $formato = Date('A');
   $minutos = Date('i');
   $date = Date('Y/m/d');

   $horas = ($hora>12)?$hora-12:$hora;

   $horass = $horas.":".$minutos." ".$formato;
  $this->db->insert('sesiones_usuarios',array('fecha'=>$date,'hora'=>$horass,'usuarios_id'=>$id));
  }

  public function extraerUsuarioId($correo='')
  {
    $this->db->select('id,usuario');
    $this->db->where('correo',$correo);
    $query = $this->db->get('usuarios');
    return $query->result_array();
  }

  public function cambiarClave($id,$clave)
  {
    $this->db->where('id',$id);
    if($this->db->update('usuarios',array('clave'=>$clave)))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }


}
 ?>
