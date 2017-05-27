<?php
class Administrador_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function registrarCohorte($cohorte='',$fechaInicio='',$fechaFinal='')
  {
    $cohorte = array(
      'id'=>'',
      'cohorte'=>$cohorte,
      'fecha_inicio'=>$fechaInicio,
      'fecha_final'=>$fechaFinal
    );

    if($this->db->insert('cohorte',$cohorte))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  public function extraerbauche()
  {
    $this->db->select('e.nombre,e.cedula,e.tipo_usuario,p.numero_deposito,p.fecha_deposito,p.monto');
    $this->db->where('e.tipo_usuario','estudiante');
    $this->db->from('usuarios as e');
    $this->db->join('pagos_aranceles as p', 'e.id = p.usuarios_id');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function sumarmontobauche()
  {
    $this->db->select_sum('monto');
    $query = $this->db->get('pagos_aranceles');
    return $query->result_array();
  }
}
