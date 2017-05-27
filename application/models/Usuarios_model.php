<?php
class Usuarios_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function verifcarUsuario($id='',$clave='',$tipoUsuario='')
  {
    $this->db->where('id',$id);
    $this->db->where('clave',$clave);
    $this->db->where('tipo_usuario',$tipoUsuario);
    $resultado = $this->db->get('usuarios');
    return $resultado->num_rows();
  }

  public function cambiar_clave($id='',$clave='',$tipoUsuario='',$nclave='')
  {
    $this->db->where('id',$id);
    $this->db->where('clave',$clave);
    $this->db->where('tipo_usuario',$tipoUsuario);
    if($this->db->update('usuarios',array('clave'=>$nclave)))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  public function fechaSesion($id="")
  {
    $this->db->select('fecha');
    $this->db->where('usuarios_id',$id);
    $this->db->where('fecha >=',Date('Y').'-'.date('m'));
    $query = $this->db->get('sesiones_usuarios');
    return $query->result_array();
  }

  public function horaSesion($fecha="",$id="")
  {
    $this->db->select('hora');
    $this->db->where('usuarios_id',$id);
    $this->db->where('fecha',$fecha);
    $query = $this->db->get('sesiones_usuarios');
    return $query->result_array();
  }

}
 ?>
