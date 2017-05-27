<?php
class Estudiantes extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
	$this->load->library(array('session','form_validation','Pdf'));  //AGREGADO "session" EL 20-11-16
    $this->load->helper(array('url','form','security','file','download'));  //AGREGADO "url" EL 20-11-16
    $this->load->library(array('form_validation','Pdf'));
    $this->load->model('Estudiantes_model');
	//$this->load->library('session'); //AGREGADO EL 15-11-16, SI ES Q TRABAJAMOS CON SESIONES.
	//$this->audit->register(); //AGREGADO EL 16-11-16
  }

  public function index()
  {
    if($this->session->userdata('tipo_usuario')=="administrador" || ($this->session->userdata('tipo_usuario')=="operador"))
    {
      $this->load->view('estudiantes/formEstudiantes');
    }
    else
    {
      show_404();
    }
  }

  public function cargarUnidadesPorDefectos()
  {
    if(is_ajax_request())
    {
      $unidades = array(
        'pensamiento'=>'pensamiento',
        'historia'=>'historia',
        'matematica'=>'matematica'
      );
      echo json_encode($unidades);
    }
    else
    {
      show_404();
    }
  }

  public function registrarEstudiantes()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('nombre','Nombres','trim|required|min_length[3]|max_length[30]|regex_match[/^[a-zA-ZÑ-ñ\s]+$/]');
      $this->form_validation->set_rules('apellido','Apellidos','trim|required|min_length[4]|max_length[30]|regex_match[/^[a-zA-ZÑ-ñ\s]+$/]');
      $this->form_validation->set_rules('cedula','Cedula','trim|required|alpha_numeric|min_length[8]|max_length[9]');
      $this->form_validation->set_rules('telefono','Telefono','trim|required|numeric|exact_length[11]');
      $this->form_validation->set_rules('correo','Correo Electronico','trim|required|valid_email');
      $this->form_validation->set_rules('estudios','Nivel de Estudios','trim|required|alpha|in_list[espacializacion,doctorado,maestria,diplomado]');
      $this->form_validation->set_rules('linea','Linea de Investigacion','trim|required');

//DESDE DA ERROR Y NO REGISTRA: $this->form_validation->set_rules('direccion','Direccion','trim|required');
	  //  $this->form_validation->set_rules('lugar_de_trabajo','Lugar de trabajo','trim|required');
		// $this->form_validation->set_rules('cargo','Cargo o departamento','trim|required');
		//  $this->form_validation->set_rules('exoneracion','Exoneracion','trim|required');

      $this->form_validation->set_rules('area','Area de Conocimiento','trim|required|regex_match[/^[a-zA-Zñ-Ñ\s\,]+$/]');
      $this->form_validation->set_rules('unidad1','Unidad 1','trim|required|regex_match[/^[a-zA-ZÑ-ñ\s\,]+$/]');
      $this->form_validation->set_rules('unidad2','Unidad 2','trim|required|regex_match[/^[a-zA-ZÑ-ñ\s\,]+$/]');
      $this->form_validation->set_rules('unidad3','Unidad 3','trim|required|regex_match[/^[a-zA-ZÑ-ñ\s\,]+$/]');
      $this->form_validation->set_rules('unidadCredito1','Unidad Credito 1','trim|required|integer');
      $this->form_validation->set_rules('unidadCredito2','Unidad Credito 2','trim|required|numeric');
      $this->form_validation->set_rules('unidadCredito3','Unidad Credito 3','trim|required|numeric');
      $this->form_validation->set_rules('periodo1','periodo 1','trim|required|alpha_numeric_spaces');
      $this->form_validation->set_rules('periodo2','periodo 2','trim|required|alpha_numeric_spaces');
      $this->form_validation->set_rules('periodo3','periodo 3','trim|required|alpha_numeric_spaces');
      $this->form_validation->set_rules('numeroDeposito','Numero de Deposito','trim|required|exact_length[21]|numeric');
      $this->form_validation->set_rules('fechaDeposito','Fecha De Deposito','trim|required|exact_length[10]|regex_match[/^[0-9]{4}[\/]{1}[0-9]{2}[\/]{1}[0-9]{2}+$/]');
      $this->form_validation->set_rules('montoDeposito','Monto del Deposito','trim|required|numeric|min_length[4]|max_length[5]');

      $this->form_validation->set_message('required','Error el campo %s es requerido');
      $this->form_validation->set_message('alpha','Error el campo %s debe contener solo letras ');
      $this->form_validation->set_message('min_length','Error el campo %s debe ser mayor o igual a %s caracteres');
      $this->form_validation->set_message('max_length','Error el campo %s debe ser menor o igual a %s caracteres');
      $this->form_validation->set_message('alpha_numeric','Error el campo %s no debe poseer caracteres raros');
      $this->form_validation->set_message('numeric','Error el campo %s debe ser solo numerico');
      $this->form_validation->set_message('integer','Error el campo %s debe ser numeros enteros');
      $this->form_validation->set_message('exact_length','Error el campo %s debe ser igual a %s caracteres');
      $this->form_validation->set_message('valid_email','Error el campo %s no es valido');
      $this->form_validation->set_message('regex_match','Error el campo %s no es un formato valido');
      $this->form_validation->set_message('alpha_numeric_spaces','El campo %s no debe poser caracteres raros');
      $this->form_validation->set_message('in_list','Error la opcion del campo %s no es valido');

      if($this->form_validation->run() === FALSE)
      {
       $mensaje = array(
         'respuesta'=>'error',
         'error_nombre'=>form_error('nombre'),
         'error_apellido'=>form_error('apellido'),
         'error_cedula'=>form_error('cedula'),
         'error_telefono'=>form_error('telefono'),
         'error_correo'=>form_error('correo'),
         'error_estudios'=>form_error('estudios'),
         'error_linea'=>form_error('linea'),

		 'error_direccion'=>form_error('direccion'),
		 'error_lugar_de_trabajo'=>form_error('lugar_de_trabajo'),
		 'error_cargo'=>form_error('cargo'),
		 'error_exoneracion'=>form_error('exoneracion'),

         'error_area'=>form_error('area'),
         'error_unidad1'=>form_error('unidad1'),
         'error_unidad2'=>form_error('unidad2'),
         'error_unidad3'=>form_error('unidad3'),
         'error_unidadCredito1'=>form_error('unidadCredito1'),
         'error_unidadCredito2'=>form_error('unidadCredito2'),
         'error_unidadCredito3'=>form_error('unidadCredito3'),
         'error_periodo1'=>form_error('periodo1'),
         'error_periodo2'=>form_error('periodo2'),
         'error_periodo3'=>form_error('periodo3'),
         'error_numeroDeposito'=>form_error('numeroDeposito'),
         'error_fechaDeposito'=>form_error('fechaDeposito'),
         'error_montoDeposito'=>form_error('montoDeposito')
       );
      }
      else
      {
        $cedula = xss_clean(strtolower($this->input->post('cedula')));
        $nacionalidad = substr($cedula,0,1);
        $codigoTelefono = substr($this->input->post('telefono'),0,4);

        if($nacionalidad!="v" && ($nacionalidad!="e"))
        {
          $mensaje = array(
            'respuesta'=>'error',
            'error_cedula'=>'<p>Error en en campo cedula nacionalidad no permitida</p>'
          );
        }
        else
        {
          $consulta = $this->Estudiantes_model->verificarCedula($cedula);
          if($consulta===1)
          {
            $mensaje = array(
              'respuesta'=>'error',
              'error_cedula'=>'<p>Error cedula ya esta registrada en el sistema</p>'
            );

          }
          else
          {
            if($codigoTelefono!="0412" && ($codigoTelefono!="0416" && ($codigoTelefono!="0424" && ($codigoTelefono!="0414" && ($codigoTelefono!="0426" && ($codigoTelefono!="0285"))))))
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error_telefono'=>'<p>Error en campo telefono, codigo no valido</p>'
              );
            }
            else
            {
              $usuario = 'est'.substr($cedula,1);

              $estudiante = array(
                'nombre'=>xss_clean(ucwords($this->input->post('nombre'))),
                'apellido'=>xss_clean(ucwords($this->input->post('apellido'))),
                'cedula'=>xss_clean($cedula),
                'telefono'=>xss_clean($this->input->post('telefono')),
                'correo'=>xss_clean($this->input->post('correo')),
                'tipo_usuario'=>'estudiante',
                'usuario'=>$usuario,
                'clave'=>do_hash($cedula,'md5')
              );

              $consult = $this->Estudiantes_model->registrar($estudiante);

              if($consult === FALSE)
              {
                $mensaje = array(
                  'repuesta'=>'error',
                  'error_sql'=>'error no se pudo registrar estudiantes'
                );

              }
              else
              {
                $unidades = array(
                  'unidad1'=>xss_clean($this->input->post('unidad1')),
                  'unidad2'=>xss_clean($this->input->post('unidad2')),
                  'unidad3'=>xss_clean($this->input->post('unidad3')),
                  'uc1'=>xss_clean($this->input->post('unidadCredito1')),
                  'uc2'=>xss_clean($this->input->post('unidadCredito2')),
                  'uc3'=>xss_clean($this->input->post('unidadCredito3')),
                  'periodo1'=>xss_clean($this->input->post('periodo1')),
                  'periodo2'=>xss_clean($this->input->post('periodo2')),
                  'periodo3'=>xss_clean($this->input->post('periodo3')),
                  'area'=>xss_clean($this->input->post('area')),
                  'usuarios_id'=>$consult['id']
                );
                $this->Estudiantes_model->registrarUnidades($unidades);


                 $prosecuciones = array(
                  'cohorte'=>'N/A',
                  'responsable'=>ucwords($this->session->userdata('nombre'))." ".ucwords($this->session->userdata('apellido')),
                  'ano_ingreso'=>date('Y-m-d'),
                  'condicion_de_pago'=>'N/A',
                  'propuesta_de_investigacion'=>$this->input->post('linea'),
                  'tipo_estudio'=>$this->input->post('estudios'),
                  'usuarios_id'=>$consult['id']
                );

                $datos = $this->Estudiantes_model->registrarProsecuciones($prosecuciones);

                if($datos===TRUE)
                {
                  $numero_deposito = xss_clean($this->input->post('numeroDeposito'));
                  $fecha_deposito = xss_clean($this->input->post('fechaDeposito'));
                  $monto = xss_clean($this->input->post('montoDeposito'));

                  $pagos = array(
                    'numero_deposito'=>$numero_deposito,
                    'fecha_deposito'=>$fecha_deposito,
                    'monto'=>$monto,
                    'usuarios_id'=>$consult['id']
                  );

                   $datos = $this->Estudiantes_model->registrarPagosArenceles($pagos);

                   if($datos===TRUE)
                   {
                     $mensaje = array(
                       'respuesta'=>'exito',
                       'mensaje'=>'Estudiante registrado con exito'
                     );
                   }
                   else
                   {
                     $mensaje = array(
                       'repuesta'=>'error',
                       'error_sql'=>'error no se pudo registrar estudiantes'
                     );
                   }


                }
                else
                {
                  $mensaje = array(
                    'repuesta'=>'error',
                    'error_sql'=>'error no se pudo registrar estudiantes'
                  );

                }



              }


            }


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




  public function formBuscar()
  {
    $this->load->view('estudiantes/formBuscar');
  }

  public function buscarEstudiantes()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('opcion','Opcion Busqueda','trim|required|in_list[cedula,todos]');

      $this->form_validation->set_message('required','Error el campo %s es requerido');
      $this->form_validation->set_message('in_list','Error en %s seleccion invalida');


      if($this->form_validation->run()===FALSE)
      {
          echo form_error('opcion');
      }
      else
      {
        if($this->input->post('opcion')=='todos')
        {
          $datos['estudiante'] = $this->Estudiantes_model->buscarTodos();
          if(!empty($datos['estudiante']))
          {
            $datos['cantidad']= count($datos['estudiante']);
            $datos['title']="Registro de Todos los Estudiantes";

            $this->load->view('estudiantes/verEstudiantes',$datos);
          }
          else
          {

              echo "<p>Error no hay estudiantes registrados en el sistema</p>";
          }
        }
        else if($this->input->post('opcion')=='cedula')
        {
          $cedula = xss_clean(strtolower($this->input->post('cedulaEstudiantes')));
          if(!empty($cedula))
          {
            $nacionalidad = substr($cedula, 0,1);
            if($nacionalidad!='v' && ($nacionalidad!='e'))
            {
              echo '<p>error nacionalidad de Cedula invalida</p>';
            }
            else
            {
              $this->form_validation->set_rules('cedulaEstudiantes','Cedula','trim|min_length[8]|max_length[9]|alpha_numeric|regex_match[/^[e-vE-V]{1}[0-9]+$/]');
              $this->form_validation->set_message('min_length','Error en campo %s, debe ser mayor o igual a %s caracteres');
              $this->form_validation->set_message('max_length','Error en campo %s debe ser menor o igual a %s caracteres');
              $this->form_validation->set_message('alpha_numeric','Error en campo cedula no se permite caracteres raros');
              $this->form_validation->set_message('regex_match','Error en campo %s formato no permitido');
              if($this->form_validation->run()===FALSE)
              {
                echo form_error('cedulaEstudiantes');
              }
              else
              {

                $data['estudiante'] = $this->Estudiantes_model->buscarPorCedula($cedula);

                if(!empty($data['estudiante']))
                {
                  $data['cantidad']= count($data['estudiante']);
                  $data['title']="Registro de estudiante";

                  $this->load->view('estudiantes/verEstudiantes',$data);
                }
                else
                {
                  echo '<p>error no hay estudiantes registrador con esa cedula</p>';
                }
              }
            }
          }
          else
          {
              echo '<p>Error el campo Cedula es requerido</p>';

          }
        }

      }
    }
    else
    {
      show_404();
    }
  }

  public function verInfo()
  {
    if($this->input->is_ajax_request())
    {
      $this->form_validation->set_rules('id','Id USuario','trim|required|integer|is_natural_no_zero');

      $this->form_validation->set_message('required','Error el dato %s es requerido');
      $this->form_validation->set_message('integer','Error en dato %s debe ser un numero entero');
      $this->form_validation->set_message('is_natural_no_zero','Error en dato %s no es un numero valido');

      if($this->form_validation->run()===FALSE)
      {
        echo form_error('id');
      }
      else
      {
        $id = xss_clean($this->input->post('id'));
        $datos['data'] = $this->Estudiantes_model->verInfo($id);
        $this->load->view('estudiantes/verInfoEstudiantes',$datos);
      }
    }
    else
    {
      show_404();
    }
  }


//PLANILLA DE INSCRIPCION.....................
  public function pdfInscripcion($id='')
  {
    $info = $this->Estudiantes_model->verInfo($id);

   $this->pdf = new Pdf();
   // Agregamos una página
   $this->pdf->AddPage();
   $this->pdf->SetFont('Arial','B',11);
   $this->pdf->Cell(190,9,'PLANILLA DE INSCRIPCION DE ESTUDIOS CONDUCENTES A GRADO ACADEMICO ','BLRT',1,'C','0');
   $this->pdf->SetFont('Arial','i',9);
   $this->pdf->Cell(35,9,'Nombres y Apellidos :','BLT',0,'L','0');
   $this->pdf->Cell(155,9,$info[0]['nombre']." ".$info[0]['apellido'],'BTR',1,'L','0');
   $this->pdf->Cell(17,9,'Telefonos :','BLT',0,'L','0');
   $this->pdf->Cell(78,9,$info[0]['telefono'],'BT',0,'L','0');
   $this->pdf->Cell(32,9,'Cedula de Identidad :','BLT',0,'L','0');
   $this->pdf->Cell(63,9,$info[0]['cedula'],'BTR',1,'L','0');
   $this->pdf->Cell(30,9,'Correo Electronico :','BLT',0,'L','0');
   $this->pdf->Cell(65,9,$info[0]['correo'],'BT',0,'L','0');
   $this->pdf->Cell(45,9,'Nivel de Estudios que Cursa :','BLT',0,'L','0');
   $this->pdf->Cell(50,9,strtoupper($info[0]['tipo_estudio']),'BTR',1,'L','0');
   $this->pdf->Cell(34,9,'Linea de Investigacion :','BLT',0,'L','0');
   $this->pdf->Cell(156,9,ucwords($info[0]['propuesta_de_investigacion']),'BTR',1,'L','0');
   $this->pdf->Cell(94,9,'Unidad Curricular ','BLRT',0,'C','0');
   $this->pdf->Cell(48,9,'Unidad de Credito ','BLRT',0,'C','0');
   $this->pdf->Cell(48,9,'Periodo ','BLRT',1,'C','0');
    foreach($info as $est)
    {
      $this->pdf->Cell(94,9,$est['nombre_unidad'],'BLTR',0,'L','0');
      $this->pdf->Cell(48,9,'03','B',0,'C','0');
      $this->pdf->Cell(48,9,$est['periodo'],'BLRT',1,'C','0');
    }
   $this->pdf->Cell(94,9,'Numero de Deposito ','BLRT',0,'C','0');
   $this->pdf->Cell(48,9,'Fecha de Deposito ','BLRT',0,'C','0');
   $this->pdf->Cell(48,9,'Monto ','BLRT',1,'C','0');
   $this->pdf->Cell(94,9,$info[0]['numero_deposito'],'BLRT',0,'C','0'); //COLOCADO EL 29-01-17......<
   $this->pdf->Cell(48,9,$info[0]['fecha_deposito'],'BLRT',0,'C','0'); //COLOCADO EL 29-01-17......<
   $this->pdf->Cell(48,9,$info[0]['monto'],'BLRT',1,'C','0'); //COLOCADO EL 29-01-17......<
   $this->pdf->Cell(25,9,'Inscripto Por :','BLT',0,'L','0');
   $this->pdf->Cell(70,9,$info[0]['responsable'],'BTR',0,'L','0');
   $this->pdf->Cell(95,9,'Firma del Participante :','BLRT',1,'L','0');
   $this->pdf->Cell(35,9,'Fecha de Inscripcion :','BLT',0,'L','0');
   $this->pdf->Cell(60,9,$info[0]['ano_ingreso'],'BTR',0,'L','0');
   $this->pdf->Cell(45,9,'Huella del Pulgar Derecho:  ','LBT',0,'L','0');
   $this->pdf->Cell(50,9,'','RT',1,'L','0');
   $this->pdf->Cell(140,9,'','',0,'L','0');
   $this->pdf->Cell(50,30,'','BLR',1,'L','0');
   $this->pdf->Ln(50);
   $this->pdf->SetFont('Arial','B',12);
   $this->pdf->Cell(190,5,utf8_decode('Dr.C. Daniel José Rodríguez Ordaz'),'',1,'C','0');
   $this->pdf->SetFont('Arial','I',9);
   $this->pdf->Cell(190,5,utf8_decode('Coordinador  Regional  (E) de Producción y Recreación de Saberes'),'',1,'C','0');
   $this->pdf->Cell(190,5,utf8_decode('Eje Geopolítico Regional, Kerepakupai Vena'),'',1,'C','0');
   $this->pdf->SetFont('Arial','BI',9);
   $this->pdf->Cell(190,5,utf8_decode('(Según Resolución Nº CU-06-29, de fecha 19 de marzo de 2013)'),'',1,'C','0');


   // Define el alias para el número de página que se imprimirá en el pie
   $this->pdf->Output("Constancia de Inscripcion de ".$info[0]['nombre']." ".$info[0]['apellido'].".pdf", 'D');

  }



//CONSTANCIA DE ESTUDIOS.............................
  public function pdfCartaDeEstudios($id='')
  {
    $tipo = 'P5';
    $datos = $this->Estudiantes_model->extraerCorrelativos($id,$tipo);
    if(count($datos)>=1)
    {
      $cantidad = $datos[0]['cantidad'];
      $this->Estudiantes_model->modificarCorrelativo($id,$tipo,$cantidad);
    }
    else
    {
      $this->Estudiantes_model->registrarCorrelativo($id,$tipo);
    }
    $d = $this->Estudiantes_model->extraerCorrelativos($id,$tipo);
    $info = $this->Estudiantes_model->infoPdfCarta($id);
    $dias =array(
      1=>'al primer',2=>'a los dos',3=>'a los tres',4=>'a los cuatro',5=>'a los cinco',6=>'a los seis',7=>'a los siete',8=>'a los ocho',9=>'a los nueve',10=>'a los diez',
      11=>'a los onces',12=>'a los doces',13=>'a los treces',14=>'a los catorces',15=>'a los quices',16=>'a los dieciseis',17=>'a los diecisiete',18=>'a los dieciocho',19=>'a los diecinueve',20=>'a los veinte',
      21=>'a los veitiun',22=>'a los veintidos',23=>'a los veintitres',24=>'a los veinticuatro',25=>'a los veinticinco',26=>'a los veintiseis',27=>'a los veintisiete',28=>'a los veintiocho',29=>'a los veintinueve',30=>'a los treinta',
      31=>'a los treintiun'
    );
    $mes = array(
      1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',
      11=>'Noviembre',12=>'Diciembre'
    );
    $diasletras= $dias[date('j')];
    $mesletras=$mes[date('n')];
    $this->pdf = new Pdf();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Ln(10);
    $this->pdf->Cell(190,9,'CONSTANCIA DE ESTUDIOS','',1,'C','0');
    $this->pdf->Ln(10);

    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,'UBV-BO-'.$d[0]['tipo'].'-0'.$d[0]['cantidad'].'-'.$id.'-'.$d[0]['ano']);
    $this->pdf->Ln(20);
    $this->pdf->Write(7,'Quien   suscribe ');
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode('Dr.C  Daniel  José Rodríguez Ordaz'));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(', titular  de la  cédula de  identidad'));
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(' Nro. V-14.133.263,'));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(' en su condición de Coordinador Regional  de Producción y Recreación de Saberes,  hace constar por medio de la presente, que el (la) ciudadano (a):'));
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(' '.ucfirst($info[0]['nombre']).' '.ucfirst($info[0]['apellido']).' Nº '.ucfirst($info[0]['cedula']).''));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,', es participante  desde el '.substr($info[0]['ano_ingreso'],0,4).', de la');
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,' VIII '); //COLOCAR DATO DEL CAMPO...........<
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,'cohorte del Programa de Estudios Avanzados en ');
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(ucfirst($info[0]['tipo_estudio']).' Ciencias para el Desarrollo Estratégico'));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(' en la Línea de Investigación '));
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(ucfirst($info[0]['propuesta_de_investigacion']).' '));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(', de la Universidad Bolivariana de Venezuela, Eje Geopolítico Regional, Kerepacupai Vena.'));
    $this->pdf->Ln(25);
    $this->pdf->Write(7,utf8_decode('En Ciudad Bolívar '.$diasletras.' ('.Date('d').') días del mes de '.$mesletras.' de '.Date('Y')."."));
    $this->pdf->Ln(90);
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Cell(190,5,utf8_decode('Dr.C. Daniel José Rodríguez Ordaz'),'',1,'C','0');
    $this->pdf->SetFont('Arial','I',9);
    $this->pdf->Cell(190,5,utf8_decode('Coordinador  Regional  (E) de Producción y Recreación de Saberes'),'',1,'C','0');
    $this->pdf->Cell(190,5,utf8_decode('Eje Geopolítico Regional, Kerepakupai Vena'),'',1,'C','0');
    $this->pdf->SetFont('Arial','BI',9);
    $this->pdf->Cell(190,5,utf8_decode('(Según Resolución Nº CU-06-29, de fecha 19 de marzo de 2013)'),'',1,'C','0');

    $this->pdf->Output('Constancia de Estudios de '.$info[0]['nombre'].' '.$info[0]['apellido'].'.pdf','D');
  }



//CONSTANCIA DE NOTAS.....................
  public function pdfNotas($id='')
  {
    $tipo = 'P6';
    $datos = $this->Estudiantes_model->extraerCorrelativos($id,$tipo);
    if(count($datos)>=1)
    {
      $cantidad = $datos[0]['cantidad'];
      $this->Estudiantes_model->modificarCorrelativo($id,$tipo,$cantidad);
    }
    else
    {
      $this->Estudiantes_model->registrarCorrelativo($id,$tipo);
    }
    $d = $this->Estudiantes_model->extraerCorrelativos($id,$tipo);
    $dias =array(
      1=>'al primer',2=>'a los dos',3=>'a los tres',4=>'a los cuatro',5=>'a los cinco',6=>'a los seis',7=>'a los siete',8=>'a los ocho',9=>'a los nueve',10=>'a los diez',
      11=>'a los onces',12=>'a los doces',13=>'a los treces',14=>'a los catorces',15=>'a los quices',16=>'a los dieciseis',17=>'a los diecisiete',18=>'a los dieciocho',19=>'a los diecinueve',20=>'a los veinte',
      21=>'a los veitiun',22=>'a los veintidos',23=>'a los veintitres',24=>'a los veinticuatro',25=>'a los veinticinco',26=>'a los veintiseis',27=>'a los veintisiete',28=>'a los veintiocho',29=>'a los veintinueve',30=>'a los treinta',
      31=>'a los treintiun'
    );
    $mes = array(
      1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',
      11=>'Noviembre',12=>'Diciembre'
    );
    $diasletras= $dias[date('j')];
    $mesletras=$mes[date('n')];

    $info = $this->Estudiantes_model->verInfo($id);
    $this->pdf = new Pdf();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Cell(190,9,'CONSTANCIA DE NOTAS','',1,'C','0');
    $this->pdf->Ln(6);


    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,'UBV-BO-'.$d[0]['tipo'].'-0'.$d[0]['cantidad'].'-'.$id.'-'.$d[0]['ano']);
    $this->pdf->Ln(12);
    $this->pdf->Write(7,'Quien   suscribe ');
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode('Dr.C  Daniel  José Rodríguez Ordaz'));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(', titular  de la  cédula de  identidad'));
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(' Nro. V-14.133.263,'));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(' en su condición de Coordinador Regional  de Producción y Recreación de Saberes,  hace constar por medio de la presente, que el (la) ciudadano (a):'));
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(' '.ucfirst($info[0]['nombre']).' '.ucfirst($info[0]['apellido']).' Nº '.ucfirst($info[0]['cedula']).''));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,', es participante  desde el '.substr($info[0]['ano_ingreso'],0,4).', de la');
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,' VIII '); //COLOCAR DATO DEL CAMPO...........<
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,'cohorte del Programa de Estudios Avanzados en ');
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(ucfirst($info[0]['tipo_estudio']).' Ciencias para el Desarrollo Estratégico'));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode(' en la Línea de Investigación '));
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Write(7,utf8_decode(ucfirst($info[0]['propuesta_de_investigacion']).', '));
    $this->pdf->SetFont('Arial','i',11);
    $this->pdf->Write(7,utf8_decode('de la Universidad Bolivariana de Venezuela, Eje Geopolítico Regional, Kerepacupai Vena.'));
    $this->pdf->Ln(10);
    $this->pdf->SetFont('Arial','BI',11);
    $this->pdf->Cell(190,5,'Las Unidades Curriculares cursadas y las notas obtenidas son las siguientes:','',1,'C','0');
    $this->pdf->Ln(10);
    $this->pdf->SetFont('Arial','B',11);
    $this->pdf->SetTextColor(255,255,255);
    $this->pdf->SetFillColor(31,144,234);
    $this->pdf->Cell(126,7,'UNIDADES CURRICULARES','LBT',0,'C','1');
    $this->pdf->Cell(30,7,'U.C','LBT',0,'C','1');
    $this->pdf->Cell(33,7,'CALIFICACION','LBTR',1,'C','1');
    $this->pdf->SetFont('Arial','Bi',9);
    $this->pdf->SetTextColor(0,0,0);
     foreach($info as $estudiantes)
     {
       $this->pdf->Cell(126,7,utf8_decode(ucfirst($estudiantes['nombre_unidad'])),'LBT',0,'C','0');
       $this->pdf->Cell(30,7,'03','LBT',0,'C','0');
       if($estudiantes['ponderacion_cuantitativa']==0)
       {
         $this->pdf->Cell(33,7,'Por Cursar','LBTR',1,'C','0');
       }
       else
       {
         $this->pdf->Cell(33,7,$estudiantes['ponderacion_cuantitativa'],'LBTR',1,'C','0');
       }

     }
    $this->pdf->SetFont('Arial','Bi',11);
    $this->pdf->Ln(7);
    $this->pdf->Write(7,utf8_decode('En Ciudad Bolívar '.$diasletras.' ('.Date('d').') días del mes de '.$mesletras.' de '.Date('Y')."."));
    $this->pdf->Ln(60);
    $this->pdf->SetFont('Arial','B',12);
    $this->pdf->Cell(190,5,utf8_decode('Dr.C. Daniel José Rodríguez Ordaz'),'',1,'C','0');
    $this->pdf->SetFont('Arial','I',9);
    $this->pdf->Cell(190,5,utf8_decode('Coordinador  Regional  (E) de Producción y Recreación de Saberes'),'',1,'C','0');
    $this->pdf->Cell(190,5,utf8_decode('Eje Geopolítico Regional, Kerepakupai Vena'),'',1,'C','0');
    $this->pdf->SetFont('Arial','BI',9);
    $this->pdf->Cell(190,5,utf8_decode('(Según Resolución Nº CU-06-29, de fecha 19 de marzo de 2013)'),'',1,'C','0');

    $this->pdf->Output('Constancia de Estudios.pdf','D');



  }

  public function editarCamposEstudiantes()
  {
    if($this->input->is_ajax_request())
    {
      $campo = xss_clean($this->input->post('campo'));
      $id = xss_clean($this->input->post('id'));
      $valor= xss_clean($this->input->post('nuevovalor'));
      $tipo= xss_clean($this->input->post('tipo'));
      $id_unidad= xss_clean($this->input->post('id_unidad'));
      switch ($this->input->post('tipo'))
      {
        case 'usuarios':

          if($campo=="nombre")
          {
            $this->form_validation->set_rules('nuevovalor','Nombres','trim|required|min_length[3]|max_length[40]|regex_match[/^[a-zA-Zñ-Ñ\s]+$/]');

            $this->form_validation->set_message('required','Error el campo %s no puede ser vacio');
            $this->form_validation->set_message('min_length','Error el campo %s no debe ser mayor o igual a %s caracteres');
            $this->form_validation->set_message('max_length','Error el campo %s no debe ser manor o igual a %s caracteres');
            $this->form_validation->set_message('regex_match','error en el campo %s solo se permiten letras');

            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {

              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }

            }

          }
          else if($campo=="apellido")
          {
            $this->form_validation->set_rules('nuevovalor','Apellidos','trim|required|min_length[3]|max_length[40]|regex_match[/^[a-zA-Zñ-Ñ\s]+$/]');

            $this->form_validation->set_message('required','Error el campo %s no puede ser vacio');
            $this->form_validation->set_message('min_length','Error el campo %s no debe ser mayor o igual a %s caracteres');
            $this->form_validation->set_message('max_length','Error el campo %s no debe ser manor o igual a %s caracteres');
            $this->form_validation->set_message('regex_match','error en el campo %s solo se permiten letras');

            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {

              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }
            }

          }else if($campo=="cedula")
          {
            $this->form_validation->set_rules('nuevovalor','Cedula','trim|required|min_length[8]|max_length[9]|regex_match[/^[e-v]{1}[0-9]+$/]|is_unique[usuarios.cedula]');

            $this->form_validation->set_message('required','Error el campo %s no puede ser vacio');
            $this->form_validation->set_message('min_length','Error el campo %s no debe ser mayor o igual a %s caracteres');
            $this->form_validation->set_message('max_length','Error el campo %s no debe ser menor o igual a %s caracteres');
            $this->form_validation->set_message('regex_match','Error en el campo %s solo se permiten letras');
            $this->form_validation->set_message('is_unique','Error cedula ya esta registrada en el sistema ');
            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $cedula = xss_clean($this->input->post('nuevovalor'));
              $nacionalida = strtoupper(substr($cedula,0,1));
              if($nacionalida!="V" && ($nacionalida!="E"))
              {
                $mensaje = array(
                'respuesta'=>'error',
                'error'=>'<p>Error en campo cedula nacionalidad no permitida</p>'
                );
              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }

              }

            }


          }else if($campo=="telefono")
          {
            $this->form_validation->set_rules('nuevovalor','Telefono','trim|required|exact_length[11]|regex_match[/^[0-9]{11}+$/]');

            $this->form_validation->set_message('required','Error el campo %s no puede ser vacio');
            $this->form_validation->set_message('exact_length','Error el campo %s no debe ser igual a %s caracteres');
            $this->form_validation->set_message('regex_match','Error en el campo %s solo se permite numero');
            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $telefono = xss_clean($this->input->post('nuevovalor'));
              $codigo = substr($telefono,0,4);
              if($codigo!="0412" && ($codigo!="0414" && ($codigo!="0416" &&($codigo!="0424" && $codigo!="0426" && ($codigo!="0285")))))
              {
                $mensaje = array(
                'respuesta'=>'error',
                'error'=>'<p>Error en campo telefono, codigo no permitido</p>'
                );
              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }

              }

            }

          }else if($campo=="correo")
          {
            $this->form_validation->set_rules('nuevovalor','Correo Electronico','trim|required|valid_email');

            $this->form_validation->set_message('required','Error el campo %s no puede ser vacio');
            $this->form_validation->set_message('valid_email','Error en el campo %s, no es valido');
            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {

              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }

            }

          }else if($campo=="direccion")
          {
            $this->form_validation->set_rules('nuevovalor','Direccion','trim|required|max_length[100]|min_length[15]');

            $this->form_validation->set_message('required','Error el dato %s es requerido');
            $this->form_validation->set_message('max_length','Error el dato %s  debe ser menor a %s carcateres');
            $this->form_validation->set_message('min_length','Error el dato %s  debe ser mayor a %s carcateres');
            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }
            }

          }else if($campo=="lugar_de_trabajo")
          {
            $this->form_validation->set_rules('nuevovalor','Lugar de Trabajo','trim|required|max_length[100]|min_length[5]');

            $this->form_validation->set_message('required','Error el dato %s es requerido');
            $this->form_validation->set_message('max_length','Error el dato %s do debe ser menor a %s carcateres');
            $this->form_validation->set_message('min_length','Error el dato %s do debe ser mayor a %s carcateres');
            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }
            }
          }else if($campo=="cargo_o_departamento")
          {
            $this->form_validation->set_rules('nuevovalor','Cargo o Departamento','trim|required|max_length[100]|min_length[5]');

            $this->form_validation->set_message('required','Error el dato %s es requerido');
            $this->form_validation->set_message('max_length','Error el dato %s  debe ser menor a %s carcateres');
            $this->form_validation->set_message('min_length','Error el dato %s  debe ser mayor a %s carcateres');
            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }
            }

          }else if($campo=="usuario")
          {
            $this->form_validation->set_rules('nuevovalor','Usuario','trim|required|min_length[10]|max_length[11]|regex_match[/^[a-zA-Z]{3}[0-9]+$/]');

            $this->form_validation->set_message('required','Error el campo %s es requerido');
            $this->form_validation->set_message('min_length','Error el campo %s debe ser mayor o igual a %s caarcteres');
            $this->form_validation->set_message('max_length','Error el campo %s debe ser menor o igual a %s caracteres');
            $this->form_validation->set_message('regex_match','Error en campo %s formato no permitido');

            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $usuario = strtolower(substr($this->input->post('nuevovalor'),0,3));
              if($usuario!="est")
              {
                $mensaje= array(
                  'respuesta'=>'error',
                  'error'=>'error en campo Usuario formato no permitido'
                );

              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }

              }
            }

          }else if($campo=="clave")
          {
            $this->form_validation->set_rules('nuevovalor','Clave','trim|required|min_length[8]|max_length[12]|alpha_numeric');

            $this->form_validation->set_message('required','Error el dato %s es requerido');
            $this->form_validation->set_message('min_length','Error el dato %s debe ser mayo o igual a %s caracteres');
            $this->form_validation->set_message('max_length','Error el dato %s debe ser menor o igual a %s caracteres');
            $this->form_validation->set_message('alpha_numeric','Error el campo %s debe ser alfanumerico');

            if($this->form_validation->run()===FALSE)
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>form_error('nuevovalor')
              );
            }
            else
            {
              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }
            }

          }else if($campo=="estado")
          {
            $estado = strtolower($this->input->post('nuevovalor'));

            if($estado!="activo" && ($estado!="noactivo"))
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>'<p>Error en dato Estado formato no permitido</p>'
              );
            }
            else
            {
              $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
              if($consulta)
              {
                $mensaje = array(
                  'respuesta'=>'exito',
                  'exito'=>'Datos actualizado con exito'
                );
              }
              else
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>'ha ocurrido un error en el sistema'
                );
              }
            }

          }else
          {
            $mensaje = array(
              'respuesta'=>'error',
              'error'=>'<p>campo no permitido</p>'
            );

          }
          echo json_encode($mensaje);

          break;

        case 'prosecuciones':
            if($campo=="tipo_estudio")
            {
              $this->form_validation->set_rules('nuevovalor','Tipo Estudio','trim|required|in_list[doctorado,maestria,especializacion]');
              $this->form_validation->set_message('required','Error el dato %s es requerido');
              $this->form_validation->set_message('in_list','Error en el dato %s  no es valido');

              if($this->form_validation->run()===FALSE)
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>form_error('nuevovalor')
                );

              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }
              }
            }
            else if($campo=="propuesta_de_investigacion")
            {
              $this->form_validation->set_rules('nuevovalor','Propuesta de Investigacion','trim|required|max_length[200]|min_length[15]|regex_match[/^[a-zA-Z\s\,]+$/]');
              $this->form_validation->set_message('required','Error el dato %s es requerido');
              $this->form_validation->set_message('max_length','Error en el dato %s  debe ser menor o igua a %s caracteres');
              $this->form_validation->set_message('min_length','Error en el dato %s debe ser mayor a o igual a %s cacarteres');
              $this->form_validation->set_message('regex_match','Error en el dato %s no se permite carateres raros');

              if($this->form_validation->run()===FALSE)
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>form_error('nuevovalor')
                );
              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }
              }

            }else if($campo=="cohorte")
            {

            }else if($campo=="ano_ingreso")
            {
              $this->form_validation->set_rules('nuevovalor','Año de Ingreso','trim|required|regex_match[/^[0-9]{4}[\/\-]{1}[0-9]{2}[\/\-]{1}[0-9]{2}+$/]');

              $this->form_validation->set_message('required','Error en dato %s es requerido');
              $this->form_validation->set_message('regex_match','Error en el dato %s formato no permitido');

              if($this->form_validation->run()===FALSE)
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>form_error('nuevovalor')
                );
              }
              else
              {
                $ano = intval(substr($this->input->post('nuevovalor'),0,4));
                $mes = intval(substr($this->input->post('nuevovalor'),5,2));
                $dia = intval(substr($this->input->post('nuevovalor'),8,2));

                if($ano < 2003 || ($ano>date('Y')))
                {
                  $mensaje= array(
                    'respuesta'=>'error',
                    'error'=>'Error en dato Año de Ingreso, año no valido'
                  );
                }
                else if($mes>12 || ($mes<=0))
                {
                  $mensaje= array(
                    'respuesta'=>'error',
                    'error'=>'Error en dato Año de Ingreso, mes  no valido'
                  );
                }
                else if($dia>31 || ($dia<=0))
                {
                  $mensaje= array(
                    'respuesta'=>'error',
                    'error'=>'Error en dato Año de Ingreso, dia  no valido'
                  );
                }
                else
                {

                  $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                  if($consulta)
                  {
                    $mensaje = array(
                      'respuesta'=>'exito',
                      'exito'=>'Datos actualizado con exito'
                    );
                  }
                  else
                  {
                    $mensaje = array(
                      'respuesta'=>'error',
                      'error'=>'ha ocurrido un error en el sistema'
                    );
                  }
                }
              }

            }
            else if($campo=="condicion_de_pago")
            {
              $this->form_validation->set_rules('nuevovalor','Condicion de Pago','in_list[pendiente,solvente]');

              $this->form_validation->set_message('in_list','Error en campo %s dato no valido');

              if($this->form_validation->run()===FALSE)
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>form_error('nuevovalor')
                );
              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }
              }

            }
            else
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>'campo invalido'
                );
            }
            echo json_encode($mensaje);

          break;

        case 'unidades_curriculares':

            if($campo=="seccion")
            {
              $mensaje = array(
                'respuesta'=>'exito',
                'exito'=>'Datos actualizado con exito'
                );
            }
            else if($campo=="area_conocimiento")
            {
              $this->form_validation->set_rules('nuevovalor','Area de Conocimiento','trim|required|min_length[15]|max_length[100]|regex_match[/^[a-zA-Z\s\,]+$/]');
              $this->form_validation->set_message('required','Error el dato %s es requerido');
              $this->form_validation->set_message('min_length','Error el dato %s debe ser mayor o igual a %s caracteres');
              $this->form_validation->set_message('max_length','Error el dato %s debe ser menor o igual a %s caracteres');
              $this->form_validation->set_message('regex_match','Error el dato %s no se permiten caracteres raros');

              if($this->form_validation->run()===FALSE)
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>form_error('nuevovalor')
                );
              }
              else
              {
                $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo);
                if($consulta)
                {
                  $mensaje = array(
                    'respuesta'=>'exito',
                    'exito'=>'Datos actualizado con exito'
                  );
                }
                else
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'ha ocurrido un error en el sistema'
                  );
                }
              }

            }else if($campo=="tipo")
            {

            }else if($campo=="ponderacion_cualitativa")
            {

            }else if($campo=="ponderacion_cuantitativa")
            {
              $this->form_validation->set_rules('nuevovalor','Ponderacion Cuantitativa','trim|required|exact_length[2]|numeric');

              $this->form_validation->set_message('required','Error el dato %s es requerido');
              $this->form_validation->set_message('exact_length','Error el dato %s deber ser de %s digitos exactos');
              $this->form_validation->set_message('numeric','Error el dato %s debe ser numerico');

              if($this->form_validation->run()===FALSE)
              {
                $mensaje = array(
                  'respuesta'=>'error',
                  'error'=>form_error('nuevovalor')
                );

              }
              else
              {
                $nota = intval($this->input->post('nuevovalor'));

                if($nota>20 || ($nota<=0))
                {
                  $mensaje = array(
                    'respuesta'=>'error',
                    'error'=>'<p>Error en dato Ponderacion Cauntitativa nota fuera de rango</p>'
                  );
                }
                else
                {
                  $consulta = $this->Estudiantes_model->editarCampo($id,$campo,$valor,$tipo,$id_unidad);
                  if($consulta)
                  {
                    $mensaje = array(
                      'respuesta'=>'exito',
                      'exito'=>'Datos actualizado con exito'
                    );
                  }
                  else
                  {
                    $mensaje = array(
                      'respuesta'=>'error',
                      'error'=>'ha ocurrido un error en el sistema'
                    );
                  }
                }

              }
            }
            else if($campo=="periodo")
            {

            }
            else
            {
              $mensaje = array(
                'respuesta'=>'error',
                'error'=>'campo invalido'
                );
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
}
 ?>
