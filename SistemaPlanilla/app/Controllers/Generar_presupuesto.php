<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\VistaBoletaModel;
use CodeIgniter\Database\Query;
use App\Models\EmpleadosModel;
use App\Models\DetallesPlanillasModel;
use Dompdf\Dompdf;
use Datetime;
use Dompdf\Options;


class Generar_presupuesto extends BaseController
{
    protected $nombre_clase = 'boleta';

    public function index()
    {
        


        
         return crear_plantilla(view('generar_presupuesto/pruesupuesto'));
    }

    public function imprimir($hasta ='')
    {

        $fecha = new DateTime();
        $fecha->modify('first day of this month');
        $desde=$fecha->format('Y-m-d');

        if ($hasta==''|| $hasta==$desde){




        $fecha->modify('last day of this month');
            $fecha_fin=$fecha->format('Y-m-d');


        }  
        else{

            $fecha_fin=$hasta;
        }


        $db = \Config\Database::connect();

        $query = "call sp_Comparativo_Presupuesto_Real('$desde','$fecha_fin')";
		
				$res = $db->query($query)->getResult('array');
                
        $data = [
            'presupuestos' =>$res,
            'desde'=>$desde,
            'hasta'=>$fecha_fin
            

        ];


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($pdfOptions);
		$dompdf->set_paper('letter', 'landscape');
        $html = view('pdfs/presupuesto', $data);

        $dompdf->loadHtml($html);
        
        $dompdf->render();
        
        return $dompdf->stream("presupuesto.pdf",array("Attachment" => false));
		
		
	

    }




}
