<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use App\Models\MenusModel;
use App\Models\IconosModel;

class Menus extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $menus = [], $termino = '')
	{
		$menus  = ($menus == []) ? (new MenusModel())->get() : $menus;

		$menusPadre = (new MenusModel())
			->where('ID_MENU_PADRE', NULL)
			->findAll();

		$iconos = (new IconosModel())->get();


		$data = [
			'menus'				=> $menus,
			'menusModel'		=> new MenusModel(),
			'menusPadre'		=> $menusPadre,
			'menusPadreModel'	=> new MenusModel(),
			'iconos'			=> $iconos,
			'iconosModel'		=> new IconosModel(),
			'operacion'			=> $operacion,
			'exito' 			=> $exito,
			'nombre_obj'    	=> 'Menú',
			'termino'       	=> $termino,
			'url_guardar'		=> base_url() . '/menus/guardar',
			'url_eliminar'  	=> base_url() . '/menus/eliminar',
			'url_buscar'    	=> base_url() . '/menus/buscar',
		];
		return crear_head('Menu')
			. crear_body(
				view('menus/menus', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Menús', crear_ruta_breadcrumb('menus')),   //breadcrumb
				['menus/menus.js']
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
				'NOMBRE_MENU'   => 'required|string'
			])) {
				$guardarPadre = NULL;
				$guardarRuta = NULL;
				if($this->request->getVar('HIJO') == "true")
				{
					$guardarPadre = $this->request->getVar('ID_MENU_PADRE');
					$guardarRuta = $this->request->getVar('RUTA_MENU');
				}
				(new MenusModel())->save([
					'ID_MENU' 		=> $this->request->getVar('ID_MENU'),
					'ID_ICONO' 		=> $this->request->getVar('ID_ICONO'),
					'NOMBRE_MENU' 	=> $this->request->getVar('NOMBRE_MENU'),
					'ID_MENU_PADRE' => $guardarPadre,
					'RUTA_MENU' 	=> $guardarRuta,
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/menus');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_MENU'   => 'required|numeric'
			])) {
				(new MenusModel())->where('ID_MENU', $this->request->getVar('ID_MENU'))->delete();
				(new MenusModel())->where('ID_MENU_PADRE', $this->request->getVar('ID_MENU'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/menus');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$tipos_movimiento_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$tipos_movimiento_buscados = (new MenusModel())
						->like('NOMBRE_MENU', $termino)
						->findAll();
				}
				$exito = (count($menus_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $menus_buscados, $termino);
		}
		return redirect()->to(base_url() . '/menus');
	}
}