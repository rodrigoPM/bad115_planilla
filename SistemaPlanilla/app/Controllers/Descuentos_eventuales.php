<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\DescuentosEventualesModel;
use App\Models\IngresosDescuentosModel;
use App\Models\EmpleadosModel;
use App\Models\PlanillasModel;

class Descuentos_eventuales extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $descuentos_eventuales = [], $termino = '')
	{
		$descuentos_eventuales  = ($descuentos_eventuales == []) ? (new DescuentosEventualesModel())->get() : $descuentos_eventuales;

		$data = [
            'descuentos_eventuales'  => $descuentos_eventuales,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
            'ingresosDescuentosModel'=> new IngresosDescuentosModel(),
            'descuentos'   => (new IngresosDescuentosModel())->get_descuentos(),
            'planillas'    => (new PlanillasModel())->get_planillas_abiertas(),
            'planillasModel'=> new PlanillasModel(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Descuento Eventuales',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/descuentos_eventuales/guardar',
			'url_eliminar'  => base_url() . '/descuentos_eventuales/eliminar',
			'url_buscar'    => base_url() . '/descuentos_eventuales/buscar',
		];
		return crear_head('Descuentos Eventuales')
			. crear_body(
				view('descuentos_eventuales/descuentos_eventuales', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Descuentos Eventuales', crear_ruta_breadcrumb('Descuentos_eventuales')),   //breadcrumb
				['descuentos_eventuales/descuentos_eventuales.js']
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
                'VALOR_DESCUENTO'   => 'required',
                'FECHA_DESCUENTO'   => 'valid_date[Y-m-d]',
                'DESCRIPCION_DESCUENTO'   => 'required|string',

			])) {
				(new DescuentosEventualesModel())->save([
					'ID_TRANSACCION_DESCUENTO' => $this->request->getVar('ID_TRANSACCION_DESCUENTO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'ID_CODIGO' => $this->request->getVar('ID_CODIGO'),
                    'ID_PLANILLA' => $this->request->getVar('ID_PLANILLA'),
                    'VALOR_DESCUENTO' => $this->request->getVar('VALOR_DESCUENTO'),
                    'FECHA_DESCUENTO' => $this->request->getVar('FECHA_DESCUENTO'),
                    'DESCRIPCION_DESCUENTO' => $this->request->getVar('DESCRIPCION_DESCUENTO'),
                    
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/descuentos_eventuales');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TRANSACCION_DESCUENTO'   => 'required|numeric'
			])) {
				(new DescuentosEventualesModel())->where('ID_TRANSACCION_DESCUENTO', $this->request->getVar('ID_TRANSACCION_DESCUENTO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/descuentos_eventuales');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$descuentos_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                
                $termino = trim($this->request->getVar('termino'));                

				if ($termino != '') {
                    $array_empleados = (new EmpleadosModel())->buscar($termino);
                    $array_movs = (new IngresosDescuentosModel())->buscar($termino);
                    $array_planillas = (new PlanillasModel())->buscar($termino);

                    $descuentos_buscados = (new DescuentosEventualesModel())
                    ->orWhereIn('ID_EMPLEADO', $array_empleados )
                    ->orWhereIn('ID_CODIGO', $array_movs )
                    ->orWhereIn('ID_PLANILLA', $array_planillas )
                    ->orLike('DESCRIPCION_DESCUENTO', $termino)
                    ->findAll();
                    
				}
				$exito = (count($descuentos_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $descuentos_buscados, $termino);
		}
		return redirect()->to(base_url() . '/descuentos_eventuales');
	}
}
