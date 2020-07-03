<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\PagosProgramadosModel;
use App\Models\IngresosDescuentosModel;
use App\Models\EmpleadosModel;

class Pagos_programados extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $pagos_programados = [], $termino = '')
	{
		$pagos_programados  = ($pagos_programados == []) ? (new PagosProgramadosModel())->get() : $pagos_programados;

		$data = [
			'pagos_programados'  => $pagos_programados,
			'pagosModel'    => new PagosProgramadosModel(),
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
            'ingresosDescuentosModel'=> new IngresosDescuentosModel(),
            'pagos'   => (new IngresosDescuentosModel())->get_ingresos(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Pago Programado',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/pagos_programados/guardar',
			'url_eliminar'  => base_url() . '/pagos_programados/eliminar',
			'url_buscar'    => base_url() . '/pagos_programados/buscar',
		];
		return crear_head('Pagos Programados')
			. crear_body(
				view('pagos_programados/pagos_programados', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Pagos Programados', crear_ruta_breadcrumb('Pagos_programados')),   //breadcrumb
				['pagos_programados/pagos_programados.js']
			);
	}

	public function index()
	{
		return $this->data_vista();
	}

	public function guardar()
	{
        // $this->form_validation->set_message();
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
                'VALOR_CUOTA_PAGO'   => 'required',
                'FECHA_INICIO_PAGO'   => 'valid_date[Y-m-d]',
                'FECHA_FIN_PAGO'   => 'valid_date[Y-m-d]',

			])) {
				(new PagosProgramadosModel())->save([
					'ID_MOVIMIENTO_PAGO' => $this->request->getVar('ID_MOVIMIENTO_PAGO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'ID_CODIGO' => $this->request->getVar('ID_CODIGO'),
                    'VALOR_CUOTA_PAGO' => $this->request->getVar('VALOR_CUOTA_PAGO'),
                    'FECHA_INICIO_PAGO' => $this->request->getVar('FECHA_INICIO_PAGO'),
                    'FECHA_FIN_PAGO' => $this->request->getVar('FECHA_FIN_PAGO'),
                    'ACTIVO_PAGO' => $this->request->getVar('ACTIVO_PAGO'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/pagos_programados');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_MOVIMIENTO_PAGO'   => 'required|numeric'
			])) {
				(new PagosProgramadosModel())->where('ID_MOVIMIENTO_PAGO', $this->request->getVar('ID_MOVIMIENTO_PAGO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/pagos_programados');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$pagos_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                
                $termino = trim($this->request->getVar('termino'));
                if(strtolower($termino) == 'si'){
                    $afecta = 1;
                }else if(strtolower($termino) == 'no'){
                    $afecta = 0;
                }else{
                    $afecta = -1;
                }
                // $afecta = (strtolower($termino) == 'si') ? 1 : 0;
                

				if ($termino != '') {
                    $array_empleados = (new EmpleadosModel())->buscar($termino);
                    $array_movs = (new IngresosDescuentosModel())->buscar($termino);

                    $pagos_buscados = (new PagosProgramadosModel())
                    ->orWhereIn('ID_EMPLEADO', $array_empleados )
                    ->orWhereIn('ID_CODIGO', $array_movs )
                    ->orWhere('ACTIVO_PAGO', $afecta)
                    ->findAll();
                    
				}
				$exito = (count($pagos_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $pagos_buscados, $termino);
		}
		return redirect()->to(base_url() . '/pagos_programados');
	}
}
