<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\VistaBoletaModel;
use CodeIgniter\Database\Query;
use App\Models\EmpleadosModel;
use App\Models\DetallesPlanillasModel;
use Dompdf\Dompdf;
use Dompdf\Options;


class Boleta_pago extends BaseController
{
    protected $nombre_clase = 'boleta';

    public function index()
    {   
         return crear_plantilla(view('boleta/boleta'));
    }

    public function view($par ='')
    {
        $empleados=new EmpleadosModel();
       
  
        if ($par==''){

            return view('boleta/resultado_import');


        }else{

            $datos=$empleados->select("CONCAT(NOMBRE_PRIMERO,' ', NOMBRE_SEGUNDO,' ' ,APELLIDO_PATERNO,' ',APELLIDO_MATERNO) as 'nombre_c',NUMERO_DOCUMENTO,CODIGO,ID_EMPLEADO")
            ->join('planillas', 'planillas.ID_PLANILLA =ID_PLANILLA')->where('codigo',$par)->where('id_estado','1')->get();

                $data = [
                  'boletas' =>$datos,
                  'paginador'=>$empleados->pager
              ];
                  return view('boleta/tabla_boleta',$data);
        }


    }
    public function imprimir($id = NULL,$codigo ='')
    {
        $empleados=new EmpleadosModel();
        $dias=new DetallesPlanillasModel();
  /*      $datos=$empleados->select("CONCAT(NOMBRE_PRIMERO,' ', NOMBRE_SEGUNDO,' ' ,APELLIDO_PATERNO,' ',APELLIDO_MATERNO) as 'nombre_c',
        NUMERO_DOCUMENTO,(select IFNULL(DIRECCION, 'No asignado') 
        from domicilios where id_empleado=".$id." HAVING max(DESDE_FECHA_DOMICILIO)) as direccion,
        (select IFNULL(Telefono, 'No asignado') from telefonos where id_empleado=".$id." HAVING max(desde_fecha_telefono)) as telefonos,DIAS_LABORADOS,SALARIO,SALARIO_LIQUIDO_DETALLE AS liquido")
        ->join('detalles_planillas', 'detalles_planillas.ID_PLANILLA =ID_PLANILLA')->where('empleados.ID_EMPLEADO',$id)->get();

        */
        $boleta = new VistaBoletaModel();
     

        $datos= $boleta->select("*")->where('ID_EMPLEADO',$id)->where('codigo',$codigo)->where('NOMBRE_CONCEPTO','SALARIO ORDINARIO')->get();
        $detalles= $boleta->select("NOMBRE_CONCEPTO,TIPO,MONTO")->where('ID_EMPLEADO',$id)->where('codigo',$codigo)->where('NOMBRE_CONCEPTO <>','SALARIO ORDINARIO')->get();

        $data = [
            'boletas' =>$datos,
            'dias'=>$dias,
            'detalles'=>$detalles

        ];


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($pdfOptions);
		$dompdf->set_paper('letter', 'landscape');
        $html = view('pdfs/boleta', $data);

        $dompdf->loadHtml($html);
        
        $dompdf->render();
        
        return $dompdf->stream("boleta".$codigo.".pdf",array("Attachment" => false));

    }


    //--------------------------------------------------------------------
    public function nuevo()
    {
        (new UnidadesModel())->save([
            'ID_UNIDAD' => strtoupper($this->request->getVar('ID_UNIDAD')),
            'NOMBRE_UNIDAD' =>strtoupper( $this->request->getVar('NOMBRE_UNIDAD'))
        ]);
        $unidades = new UnidadesModel();
        $data = [
           'unidades' => $unidades->get()
       ];
   
       
      return view('empresa/unidades/busqueda', $data);
    }

}
