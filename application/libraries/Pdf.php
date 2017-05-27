<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
require_once APPPATH."/third_party/fpdf/fpdf.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FPDF
{
    public function __construct()
    {
        parent::__construct();
      }
        // El encabezado del PDF
    public function Header()
    {
        $this->Image('./public/img/bannerpdf.jpg',10,8,190);
        $this->Ln(30);
    }
       // El pie del pdf

   public function Footer()
   {
       $this->SetY(-10);
       $this->Image('./public/img/nuevopiedepagina.jpg',10,270,190);
       //$this->Cell(0,1,'','B',1,1,'C');
       $this->Cell(0,10,'Pagina '.$this->PageNo(),0,1,'C');

   }

}
?>
