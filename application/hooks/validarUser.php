<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed');
class validarUser
{
	private $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
		!$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
		!$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
	}

	public function check_login()
	{
    if($this->ci->uri->segment(1) == '' && $this->ci->session->userdata('id') == true)
    {

            redirect(base_url('Direccionar'));

    }
    else if($this->ci->session->userdata('id') == false && $this->ci->uri->segment(1) != 'Inicio')
    {

        	redirect(base_url('Inicio'));

    }
    else if($this->ci->uri->segment(1) == 'administrador' && $this->ci->session->userdata('tipo_usuario')!="administrador")
    {
          redirect(base_url('Direccionar'));
    }
    else if($this->ci->uri->segment(1) == 'operador' && $this->ci->session->userdata('tipo_usuario')!="operador")
    {
          redirect(base_url('Direccionar'));
    }
    else if($this->ci->uri->segment(1) == 'profesor' && $this->ci->session->userdata('tipo_usuario')!="profesor")
    {
          redirect(base_url('Direccionar'));
    }
    else if($this->ci->uri->segment(1) == 'estudiante' && $this->ci->session->userdata('tipo_usuario')!="estudiante")
    {
          redirect(base_url('Direccionar'));
    }

	}
}
