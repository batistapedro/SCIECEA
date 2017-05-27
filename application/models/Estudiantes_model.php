<?php
class Estudiantes_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
	$this->load->helper('date'); //COLOCADO EL 14-11-16
  }

  public function verificarCedula($cedula="")
  {
    $this->db->select('id');
    $this->db->where('cedula',$cedula);
    $query = $this->db->get('usuarios');
    return $query->num_rows();
  }


  public function registrar($estudiantes)
  {
    $estudiante = array(
      'nombre'=>$estudiantes['nombre'],
      'apellido'=>$estudiantes['apellido'],
      'cedula'=>$estudiantes['cedula'],
      'telefono'=>$estudiantes['telefono'],
      'correo'=>$estudiantes['correo'],
      //'titulo'=>$estudiantes['linea'],
	  'titulo'=>'N/A',
	  'direccion'=>'N/A',
      'lugar_de_trabajo'=>'N/A',
      'cargo_o_departamento'=>'N/A',
      //'direccion'=>$estudiantes['direccion'],
      //'lugar_de_trabajo'=>$estudiantes['lugar_de_trabajo'],
     // 'cargo_o_departamento'=>$estudiantes['cargo_o_departamento'],
	 // 'exoneracion'=>$estudiantes['exoneracion'],
	  'exoneracion'=>'N/A',
      'clave'=>$estudiantes['clave'],
      'usuario'=>$estudiantes['usuario'],
      'tipo_usuario'=>$estudiantes['tipo_usuario'],
      'estado'=>'activo'
						);
    if($this->db->insert('usuarios',$estudiante))
    {
      $this->db->select_max('id');
      $this->db->where('tipo_usuario','estudiante');
      $resultado = $this->db->get('usuarios');
      return $resultado->row_array();
    }
    else
    {
      return FALSE;
    }
  }

//COLOCADO EL 15-11-16
 public function registrarTitulos($titulos)
  {
    $titulos = array(
    'id'=>'',
    'titulo'=>$linea,
    'fecha_de_titulo'=>date('Y'),
    'usuarios_id'=>$id
    );
    $this->db->insert('titulos_usuarios',$titulos);
  }//hasta aqui

  
 public function registrarUnidades($unidades)
  {
    $unidad1 = array(
      'nombre_unidad'=>$unidades['unidad1'],
      'tipo'=>'N/A',
      'ponderacion_cualitativa'=>'N/A',
      'ponderacion_cuantitativa'=>'N/A',
      'periodo'=>$unidades['periodo1'],
      'seccion'=>'N/A',
      'usuarios_id'=>$unidades['usuarios_id'],
      'area_conocimiento'=>$unidades['area']
    );

    $unidad2 = array(
      'nombre_unidad'=>$unidades['unidad2'],
      'tipo'=>'N/A',
      'ponderacion_cualitativa'=>'N/A',
      'ponderacion_cuantitativa'=>'N/A',
      'periodo'=>$unidades['periodo2'],
      'seccion'=>'N/A',
      'usuarios_id'=>$unidades['usuarios_id'],
      'area_conocimiento'=>$unidades['area']
    );

    $unidad3 = array(
      'nombre_unidad'=>$unidades['unidad3'],
      'tipo'=>'N/A',
      'ponderacion_cualitativa'=>'N/A',
      'ponderacion_cuantitativa'=>'N/A',
      'periodo'=>$unidades['periodo3'],
      'seccion'=>'N/A',
      'usuarios_id'=>$unidades['usuarios_id'],
      'area_conocimiento'=>$unidades['area']
    );
    $this->db->insert('unidades_curriculares',$unidad1);
    $this->db->insert('unidades_curriculares',$unidad2);
    $this->db->insert('unidades_curriculares',$unidad3);
  }

  
  
  public function extraerCorrelativos($id='',$tipo='')
  {
    $ano = date('Y');
    $this->db->select('cantidad,tipo,coorte,cantidad,ano');
    $this->db->where('usuarios_id',$id);
    $this->db->where('tipo',$tipo);
    $this->db->where('ano',$ano);
    $query = $this->db->get('correlativos');
    return $query->result_array();
  }

  public function registrarCorrelativo($id='',$tipo='')
  {
    $correlativos = array(
    'id'=>'',
    'tipo'=>$tipo,
    'ano'=>date('Y'),
    'usuarios_id'=>$id,
    'coorte'=>'',
    'cantidad'=>'1'
    );
    $this->db->insert('correlativos',$correlativos);
  }

  public function modificarCorrelativo($id='',$tipo='',$cantidad='')
  {
    $cant=1;
    $cantidad = intval($cantidad+$cant);
    $this->db->where('usuarios_id',$id);
    $this->db->where('tipo',$tipo);
    $this->db->update('correlativos',array('cantidad'=>$cantidad));
  }

  
  
  public function registrarProsecuciones($prosecuciones)
  {
    if($this->db->insert('prosecuciones',$prosecuciones))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  
  public function registrarPagosArenceles($pagos)
  {
    if($this->db->insert('pagos_aranceles',$pagos))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  
  public function buscarTodos()
  {
    $this->db->select('id,nombre,apellido,cedula');
    $this->db->where('tipo_usuario','estudiante');
    $query = $this->db->get('usuarios');
    return $query->result_array();
  }

  
  public function buscarPorCedula($cedula='')
  {
    $this->db->select('id,nombre,apellido,cedula');
    $this->db->where('tipo_usuario','estudiante');
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


//Planilla de inscripcion.................
  public function verInfo($id='')
  {
    $this->db->select('*');
    $this->db->from('usuarios');
	$this->db->join('pagos_aranceles','usuarios.id = pagos_aranceles.usuarios_id','inner');
    $this->db->join('unidades_curriculares','unidades_curriculares.usuarios_id  = usuarios.id ','inner');
    $this->db->join('prosecuciones','prosecuciones.usuarios_id= usuarios.id','inner');
    $this->db->where('usuarios.id',$id);
    $query = $this->db->get();
    return $query->result_array();
  }

  
//Constancia de estudios................
  public function ver($id='')
  {
    $this->db->select('unidades_curriculares.nombre_unidad,unidades_curriculares.periodo,unidades_curriculares.area_conocimiento, prosecuciones.responsable, prosecuciones.ano_ingreso,prosecuciones.condicion_de_pago, prosecuciones.propuesta_de_investigacion, prosecuciones.tipo_estudio,usuarios.nombre,usuarios.apellido,usuarios.cedula,usuarios.telefono,usuarios.correo');
    $this->db->from('unidades_curriculares');
	//$this->db->join('cohorte','id = cohorte','inner');
    $this->db->join('usuarios','usuarios.id = unidades_curriculares.usuarios_id','inner');
    $this->db->join('prosecuciones','usuarios.id = prosecuciones.usuarios_id','inner');
    $this->db->where('usuarios.id',$id);
    $query = $this->db->get();
    return $query->result_array();
  }


//Constancia de notas................
  public function infoPdfCarta($id='')
  {
    $this->db->select('usuarios.nombre,usuarios.apellido,usuarios.cedula,prosecuciones.ano_ingreso,prosecuciones.propuesta_de_investigacion,prosecuciones.tipo_estudio');
    $this->db->from('usuarios');
    $this->db->join('prosecuciones','usuarios.id = prosecuciones.usuarios_id','left');
    $this->db->where('usuarios.id',$id);
    $this->db->where('usuarios.tipo_usuario','estudiante');
    $query = $this->db->get();
    return $query->result_array();
  }


  public function editarCampo($id='',$campo='',$valor='',$tabla='',$id_unidad='')
  {
    if($tabla=='usuarios')
    {
      $this->db->where('id',$id);
      if($this->db->update('usuarios',array($campo=>$valor)))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    else if($tabla=='prosecuciones')
    {
      $this->db->where('usuarios_id',$id);
      if($this->db->update('prosecuciones',array($campo=>$valor)))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
    else if($tabla=='unidades_curriculares')
    {
      $this->db->where('usuarios_id',$id);
      $this->db->where('id_unidad',$id_unidad);
      if($this->db->update('unidades_curriculares',array($campo=>$valor)))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
  }
  
  
} //CIERRE de la Class: Estudiantes_model
 
 
 