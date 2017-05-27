<?php
class Operador_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function validarOperador($cedula="")
  {
    $this->db->where('cedula',$cedula);
    $query = $this->db->get('usuarios');
    return $query->num_rows();
  }

  public function registrarOperador($nombre="",$cedula="",$usuario="",$clave="")
  {
    $operador = array(
      'id'=>'',
      'nombre'=>$nombre,
      'apellido'=>NULL,
      'cedula'=> $cedula,
      'telefono'=>NULL,
      'correo'=>NULL,
      'direccion'=>NULL,
      'lugar_de_trabajo'=>NULL,
      'cargo_o_departamento'=>NULL,
      'tipo_usuario'=>'operador',
      'clave'=> $clave,
      'usuario'=>$usuario,
      'estado'=>'activo'
    );
    if($this->db->insert('usuarios',$operador))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }

  }

  public function extraer()
  {
    $this->db->where('tipo_usuario','operador');
    $query = $this->db->get('usuarios');
    return $query->result_array();
  }

  public function editarDatos($id='',$campo='',$valor='')
  {
    $this->db->where('id',$id);
    $this->db->where('tipo_usuario','operador');
    if($this->db->update('usuarios',array($campo=>$valor)))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }

  }

  public function estado($id="",$estado="")
  {
    $this->db->where('id',$id);
    $this->db->where('tipo_usuario','operador');
    if($this->db->update('usuarios',array('estado'=>$estado)))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  public function eliminar($id="")
  {
    $this->db->where('id',$id);
		$this->db->where('tipo_usuario','operador');
		if($this->db->delete('usuarios',array('id'=>$id)))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
  }

}

