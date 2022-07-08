<?php
namespace Classes;

use Dompdf\Dompdf;

class Reporte{
  public $html;
  public $nombrePdf;

  public function __construct($html,$nombrePdf){
    $this->html = $html;
    $this->nombrePdf = $nombrePdf;
  }

  public function generarReporte(){
    //* Creando Objeto de PDF
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions(); //* Obteniendo opciones de configuración del PDF
    $options->set(array('isRemoteEnabled' => true)); //* Activando opción para visualizar imagenes en el PDF
    $dompdf->setOptions($options); //* Estableciendo nuevas opciones habilitadas al Objeto PDF

    $dompdf->loadHtml($this->html); //* Cargando HTML que se mostrará en el PDF

    // $dompdf->setPaper('letter'); //* Estableciendo tamaño carta para el PDF
    $dompdf->setPaper('A4','landscape'); //* Estableciendo tamaño A4 orientacion 'landscape' para el PDF

    $dompdf->render(); //* Renderizando HTML y configuraciones en el PDF a generar

    //* Haciendo visible el PDF en el navegador, definiendo el nombre del archivo PDF y definiendo false en
    //* 'Attachment' para que se abra en el navegador(si es true se descarga automático el PDF)
    $dompdf->stream($this->nombrePdf . '.pdf', array('Attachment' => false));

  }
}