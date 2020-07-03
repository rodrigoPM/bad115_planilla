<?php

namespace App\Controllers;



use CodeIgniter\HTTP\Response;
use App\Models\PlanillasModel;
use App\Models\DetallesPlanillasModel;
use App\Models\EmpleadosModel;
use App\Models\PeriodicidadPlanillaModel;
use App\Models\EmpresaModel;
use App\Models\EstatusPlanillasModel;
use App\Models\TiposContratacionModel;


use Dompdf\Dompdf;
use Dompdf\Options;

class Generar_planilla extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $parametros = [], $termino = '')
	{
		$planilla  = ($parametros == []) ? '' : $parametros['planilla'];
		$estatus  = ($parametros == []) ? '' : $parametros['estatus'];
		$detalles_planillas  = ($parametros == []) ? '' : $parametros['detalles'];

		$periodo_nombre = (new PeriodicidadPlanillaModel())->get_descripcion((new EmpresaModel)->get_periodicidad(1));
		$rango = $this->get_rango();

		$data = [
			'contratacionModel' =>new TiposContratacionModel(),
			'empleadosModel'=> new EmpleadosModel(),
			'planilla'      => $planilla,
			'estatus'       => $estatus,
			'detalles_planillas' => $detalles_planillas,
			'periodicidad'  => $periodo_nombre,
			'rango'         => $rango,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Generar Planilla',
			'termino'       => $termino,
			'url_descargar_excel'	=> base_url() . '/generar_planilla/descargar_excel',
			'url_descargar_pdf'  => base_url() . '/generar_planilla/descargar_pdf',
			'url_buscar'    => base_url() . '/generar_planilla/buscar',
			'url_calcular'  => base_url() . '/generar_planilla/calcular',
			'url_cerrar'  => base_url() . '/generar_planilla/cerrar',
		];
		return crear_head('Accion Personal')
			. crear_body(
				view('generar_planilla/generar_planilla', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Generar Planilla', crear_ruta_breadcrumb('Generar_planilla')),   //breadcrumb
				['generar_planilla/generar_planilla.js']
			);
	}


	public function index()
	{
		return $this->get_planilla('planilla_existe');
		
	}

	public function descargar_pdf(){

		$planilla_codigo = $this->codigo_planilla();
		$id_planilla = (new PlanillasModel())->get_id_planilla_by_codigo($planilla_codigo);
		$planilla = ((new PlanillasModel())->get($id_planilla))[0];
		$detalles_planillas = (new DetallesPlanillasModel())->get_destalles($id_planilla);
		$rango = $this->get_rango();	

		$data = [
            'periodicidad'  	=> (new PeriodicidadPlanillaModel())->get_descripcion((new EmpresaModel)->get_periodicidad(1)),
			'planilla'      	=> $planilla,
			'estatus'       	=> (new EstatusPlanillasModel())->get_nombre((new PlanillasModel())->get_estatus($id_planilla)),
			'detalles_planillas'=> $detalles_planillas,
			'contratacionModel' =>new TiposContratacionModel(),
			'empleadosModel'	=> new EmpleadosModel(),
			'rango'         	=> $rango,
		];
		

		$pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
		$dompdf = new Dompdf($pdfOptions);
		$dompdf->set_paper('letter', 'landscape');
        $html = view('pdfs/planilla', $data);

        $dompdf->loadHtml($html);
        
        $dompdf->render();
        
        return $dompdf->stream("planilla".date('d-m-Y_g-i-a').".pdf");
	}

	public function descargar_excel(){

		$planilla_codigo = $this->codigo_planilla();
		$rango = $this->get_rango();	


		return crear_excel($planilla_codigo, $rango);
		
	}

	protected function get_rango(){
		setlocale(LC_ALL, 'es_SV'); 
		$mes = strtoupper(strftime('%B', strtotime(date('Y-m-d'))));
		$rango = '';
		
		if((new EmpresaModel)->get_periodicidad(1) == 2){//quincenal
			$rango = (date('d') < 16) ? 'PRIMERA QUINCENA DE ': 'SEGUNDA QUINCENA DE ';
		}
		return $rango.$mes;
	}
	

	public function calcular(){
		$this->calcular_planilla();
		return $this->get_planilla('calcular');
	}

	public function cerrar(){
		$planilla_codigo = $this->codigo_planilla();
		$id_planilla = (new PlanillasModel())->get_id_planilla_by_codigo($planilla_codigo);

		(new PlanillasModel())->save([
			'ID_PLANILLA'    => $id_planilla,
			'ID_ESTATUS'     => 2,
			'FECHA_CIERRE'   => date('Y-m-d'),
			// 'ID_USUARIO_CIERRE' => '',
		]);

		return $this->get_planilla('cerrar');
	}

	protected function get_planilla($op = ''){
		$planilla_codigo = $this->codigo_planilla();
		$exito = false;
		
		// var_dump($planilla_codigo);
		// return;
		if($planilla_codigo != ''){ //la planilla ya existe
			$this->calcular_planilla(true);
			$operacion = $op;
			$exito = true;
			$id_planilla = (new PlanillasModel())->get_id_planilla_by_codigo($planilla_codigo);
			$estatus = (new EstatusPlanillasModel())->get_nombre((new PlanillasModel())->get_estatus($id_planilla));
			$planilla = (new PlanillasModel())->get($id_planilla);

			$detalles_planillas = (new DetallesPlanillasModel())->get_destalles($id_planilla);
		}

		
		if($exito){ 
			return $this->data_vista($operacion, $exito, [
				'estatus' => $estatus, 
				'planilla' => $planilla[0],
				'detalles' => $detalles_planillas,
				]);
		}else{ //si no existe planilla, enviar parametros vacios
			$operacion = '';
			return $this->data_vista($operacion, $exito, []);
		}
	}

	protected function codigo_planilla(){
		$inicio = 01;
		if((new EmpresaModel)->get_periodicidad(1) == 2){//quincenal
			$inicio = (date('d') < 16) ? 01: 16;
		}
		$fecha_inicio = date('Y-m-').strval($inicio);//fecha de inicio: las mensuales en 01 y las quincenales en 01 o 16
		$planilla_codigo = (new PlanillasModel())->get_codigo((new EmpresaModel)->get_periodicidad(1),$fecha_inicio);
		
		return $planilla_codigo;
	}

	protected function calcular_planilla($existe_planilla = false){
		$exito = false;
		$db = \Config\Database::connect();
		$fecha_actual = date('Y-m-d');
		
		if(!$existe_planilla){ //si no existe planilla es de crearla
			$query = "call sp_Calcula_Nueva_Planilla('$fecha_actual')";
			try {
				$res = $db->query($query);
				$exito = ($res->connID->affected_rows == 1)? true:false;
			} catch (\Throwable $th) {
				return false;
			}
		}
		
		$planilla_codigo = $this->codigo_planilla();
	
		if($planilla_codigo == ''){
			$exito = true;
		}else {
			$id_planilla = (new PlanillasModel())->get_id_planilla_by_codigo($planilla_codigo);

			if((new PlanillasModel())->get_estatus($id_planilla) != 2){ //planilla diferente de cerrada
				$query = "call sp_Calculo_Planilla_General('$planilla_codigo')";
				try {
					$res = $db->query($query);
					$exito = ($res->connID->affected_rows == 1)? true:false;
				} catch (\Throwable $th) {
					return false;
				}
			}else{
				$exito = true;
			}
		}
		return $exito;
	}


}
