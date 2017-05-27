<?php

class Direccionar extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {

    switch ($this->session->userdata('tipo_usuario')) {
      case 'administrador':
        redirect(base_url('administrador'));
        break;

      case 'operador':
        redirect(base_url('operador'));
        break;

      case 'profesor':
        redirect(base_url('profesor'));
        break;

      case 'estudiante':
          redirect(base_url('estudiante'));
        break;

      default:
          redirect(base_url('Inicio'));
        break;
    }


  }
}
