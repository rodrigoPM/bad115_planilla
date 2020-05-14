<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\EstadoEmpleadosModel;

class Estado_empleados extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $estados = []){
		$estado_empleados  = ($estados == [])? (new EstadoEmpleadosModel())->get(): $estados;

		$data = [
			'estado_empleados' => $estado_empleados,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'url_guardar'	=> base_url() . '/estado_empleados/guardar',
			'url_eliminar'  => base_url() . '/estado_empleados/eliminar',
			'url_buscar'    => base_url() . '/estado_empleados/buscar',
		];
		return crear_head('Estados Civiles')
			. crear_body(
				view('estado_empleados/estado_empleados', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Estado Empleados', crear_ruta_breadcrumb('Estado_empleado')),   //breadcrumb
				['estado_empleados/estado_empleados.js']
			);
	}

	public function index()
	{
		return $this->data_vista();
	}

	public function guardar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'NOMBRE_ESTADO'   => 'required|string'
			])) {
				(new EstadoEmpleadosModel())->save([
					'ID_ESTADO'        => $this->request->getVar('ID_GENERO'),
					'NOMBRE_ESTADO'    => $this->request->getVar('NOMBRE_ESTADO'),
					'AFECTA_CALCULO'   => $this->request->getVar('AFECTA_CALCULO'),
				]);
				$exito = true;
			} 
			return $this->data_vista('guardar', $exito);
		} else {
			return redirect()->to(base_url() . '/estado_empleados');
		}
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_ESTADO'   => 'required|numeric'
			])) {
				(new EstadoEmpleadosModel())->where('ID_ESTADO', $this->request->getVar('ID_ESTADO'))->delete();
				$exito = true;
			} 
			return $this->data_vista('eliminar', $exito);
		} else {
			return redirect()->to(base_url() . '/estado_empleados');
		}
	}

	public function buscar(){
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$estado_empleados_buscados = [];
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$exito = true;
				$termino = trim($this->request->getVar('termino'));
				if($termino != '' || strtolower($termino) == 'si' || strtolower($termino) == 'no'){
					$afecta = (strtolower($termino) == 'si') ? 1 : 0;

					$estado_empleados_buscados = (new EstadoEmpleadosModel())
									->where('AFECTA_CALCULO', $afecta)
									->orLike('NOMBRE_ESTADO', $termino)
									->findAll();
				}
			}
			return $this->data_vista('buscar', $exito, $estado_empleados_buscados);
		} else {
			return redirect()->to(base_url() . '/estado_empleados');
		}
	}
}