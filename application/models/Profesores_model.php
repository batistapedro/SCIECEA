<?php
class Profesores_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function verificarCedula($cedula="")
  {
    $this->db->select('id');
    $this->db->where('cedula',$cedula);
    $query = $this->db->get('usuarios');
    return $query->num_rows();
  }

  public function registrar($nombre,$apellido,$cedula,$telefono,$correo,$titulo,$clave,$usuario)
  {
    $datos = array(
	  'id'=>'',
      //'nombre'=>$profesores['nombre'],
	  'nombre'=>$nombre,
      //'apellido'=>$profesores['apellido'],
	  'apellido'=>$apellido,
      //'cedula'=>$profesores['cedula'],
	  'cedula'=>$cedula,
      //'telefono'=>$profesores['telefono'],
	  'telefono'=>$telefono,
      //'correo'=>$profesores['correo'],
	  'correo'=>$correo,
	  //'titulo'=>$profesores['titulo'],
	  'titulo'=>$titulo,
      //'direccion'=>$profesores['direccion'],
      //'lugar_de_trabajo'=>$profesores['lugar_de_trabajo'],
      //'cargo_o_departamento'=>$profesores['cargo_o_departamento'],
	  //'exoneracion'=>$profesores['exoneracion'],
	  //'titulo'=>'N/A',
	  'direccion'=>'N/A',
      'lugar_de_trabajo'=>'N/A',
      'cargo_o_departamento'=>'N/A',
	  'exoneracion'=>'N/A',
	  'tipo_usuario'=>'profesor',
      //'clave'=>$profesores['clave'],
	  'clave'=>$clave,
      //'usuario'=>$profesores['usuario'],
	  'usuario'=>$usuario,
      'estado'=>'activo'
    );
	 $this->db->insert('usuarios',$datos);
 /* if($this->db->insert('usuarios',$profesor))
    {
      $this->db->select_max('id');
      $this->db->where('tipo_usuario','profesor');
      $resultado = $this->db->get('usuarios');
      return $resultado->row_array();
    }
    else
    {
      return FALSE;
    }*/
  }

 
 

  public function buscarTodos()
  {
    $this->db->select('id,nombre,apellido,cedula');
    $this->db->where('tipo_usuario','profesor');
    $query = $this->db->get('usuarios');
    return $query->result_array();
  }

  
  public function buscarPorCedula($cedula='')
  {
    $this->db->select('id,nombre,apellido,cedula');
    $this->db->where('tipo_usuario','profesor');
    $this->db->where('cedula',$cedula);
    if($query = $this->db->get('usuarios'))
    {
      return $query->result_array();
    }
    else
    {
      return FALSE;
    }
  }

  
} //CIERRE de la Class: Profesores_model


