<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\AccionPersonalModel;
use App\Models\TipoAccionPersonalModel;
use App\Models\EmpleadosModel;
use App\Models\EventosModel;

class Calendario extends BaseController
{
    protected function mis_eventos($array_eventos){
        $array = [];
        foreach($array_eventos as $evento){
            $array[count($array)] = [
                'id'     => $evento['ID_EVENTO'],
                'title'  => $evento['TITULO'],
                'start'  => $evento['FECHA_INICIO'],
                'end'    => $evento['FECHA_FIN']
            ];
        }

        return json_encode($array, true);
    }

	protected function data_vista($operacion = '', $exito = false, $eventos = [], $termino = '')
	{
        $eventos  = ($eventos == []) ? $this->mis_eventos((new EventosModel())->get()) : $eventos;

		$data = [
            'eventos'    => $eventos,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
            'nombre_obj'    => 'Calendario',
            'url_guardar'	=> base_url() . '/calendario/crear',
			'url_eliminar'  => base_url() . '/calendario/eliminar',
		];
		return crear_head('Calendario')
			. crear_body(
				view('calendario/calendario', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Calendario', crear_ruta_breadcrumb('Calendario')),   //breadcrumb
				['calendario/calendario.js']
			);
	}

	public function index()
	{   
        return $this->data_vista();
    }
    
    public function crear(){
        $exito = 0;
        if ($this->request->getMethod() == 'post'){
            $exito = 'dentro del post';
            if ($this->validate([
                'FECHA_INICIO'   => 'required',
                'FECHA_FIN'   => 'required',
                'TITULO'      => 'required'
            ])) {

                (new EventosModel())->save([
                    'ID_EVENTO' => $this->request->getVar('ID_EVENTO'),
                    'FECHA_INICIO' => $this->request->getVar('FECHA_INICIO'),
                    'FECHA_FIN' => $this->request->getVar('FECHA_FIN'),
                    'TITULO' => $this->request->getVar('TITULO'),
                ]);
                
                $exito = (new EventosModel())->last_evento_id();
                
            }
        }
        return $exito;
    }

    public function eliminar(){
        $exito = 'fallo';
        if ($this->request->getMethod() == 'post'){
            if ($this->validate([
                'ID_EVENTO'   => 'required',
            ])) {
                 (new EventosModel())->where('ID_EVENTO', $this->request->getVar('ID_EVENTO'))->delete();
                 $exito = 'fallo';
            }
        }
        return 'exito';
    }
}
