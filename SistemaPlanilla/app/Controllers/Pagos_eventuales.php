<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\PagosEventualesModel;
use App\Models\IngresosDescuentosModel;
use App\Models\EmpleadosModel;
use App\Models\PlanillasModel;

class Pagos_eventuales extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $pagos_eventuales = [], $termino = '')
	{
		$pagos_eventuales  = ($pagos_eventuales == []) ? (new PagosEventualesModel())->get() : $pagos_eventuales;

		$data = [
            'pagos_eventuales'  => $pagos_eventuales,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
            'ingresosDescuentosModel'=> new IngresosDescuentosModel(),
            'pagos'   => (new IngresosDescuentosModel())->get_ingresos(),
            'planillas'    => (new PlanillasModel())->get_planillas_abiertas(),
            'planillasModel'=> new PlanillasModel(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Pago Programado',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/pagos_eventuales/guardar',
			'url_eliminar'  => base_url() . '/pagos_eventuales/eliminar',
			'url_buscar'    => base_url() . '/pagos_eventuales/buscar',
		];
		return crear_head('Pagos Eventuales')
			. crear_body(
				view('pagos_eventuales/pagos_eventuales', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Pagos Eventuales', crear_ruta_breadcrumb('Pagos_eventuales')),   //breadcrumb
				['pagos_eventuales/pagos_eventuales.js']
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
                'VALOR_PAGO'   => 'required',
                'FECHA_PAGO'   => 'valid_date[Y-m-d]',
                'DESCRIPCION_PAGO'   => 'required|string',

			])) {
				(new PagosEventualesModel())->save([
					'ID_TRANSACCION_PAGO' => $this->request->getVar('ID_TRANSACCION_PAGO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'ID_CODIGO' => $this->request->getVar('ID_CODIGO'),
                    'ID_PLANILLA' => $this->request->getVar('ID_PLANILLA'),
                    'VALOR_PAGO' => $this->request->getVar('VALOR_PAGO'),
                    'FECHA_PAGO' => $this->request->getVar('FECHA_PAGO'),
                    'DESCRIPCION__PAGO' => $this->request->getVar('DESCRIPCION_PAGO'),
                    
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/pagos_eventuales');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TRANSACCION_PAGO'   => 'required|numeric'
			])) {
				(new PagosEventualesModel())->where('ID_TRANSACCION_PAGO', $this->request->getVar('ID_TRANSACCION_PAGO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/pagos_eventuales');
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

				if ($termino != '') {
                    $array_empleados = (new EmpleadosModel())->buscar($termino);
                    $array_movs = (new IngresosDescuentosModel())->buscar($termino);
                    $array_planillas = (new PlanillasModel())->buscar($termino);

                    $pagos_buscados = (new PagosEventualesModel())
                    ->orWhereIn('ID_EMPLEADO', $array_empleados )
                    ->orWhereIn('ID_CODIGO', $array_movs )
                    ->orWhereIn('ID_PLANILLA', $array_planillas )
                    ->orLike('DESCRIPCION__PAGO', $termino)
                    ->findAll();
                    
				}
				$exito = (count($pagos_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $pagos_buscados, $termino);
		}
		return redirect()->to(base_url() . '/pagos_eventuales');
	}
}
