<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use App\Models\IngresosDescuentosModel;
use App\Models\TiposMovimientoModel;

class Ingresos_descuentos extends BaseController
{
    
    protected function data_vista($operacion = '', $exito = false, $ingresos_descuentos = [], $termino = '')
    {
        $ingresos_descuentos = ($ingresos_descuentos == [])? (new IngresosDescuentosModel())->get() : $ingresos_descuentos;

        $tipos_movimiento = (new TiposMovimientoModel())->get();

        $data = [
            'tipos_movimiento'         => $tipos_movimiento,
            'tipos_movimientoModel'    => new TiposMovimientoModel(),
            'ingresos_descuentos'      => $ingresos_descuentos,
            'ingresos_descuentosModel' => new IngresosDescuentosModel(),
            'operacion'                 => $operacion,
            'exito'                     => $exito,
            'nombre_obj'                => 'Ingreso/Descuento',
            'termino'                   => $termino,
            'url_guardar'               => base_url() . '/ingresos_descuentos/guardar',
            'url_eliminar'              => base_url() . '/ingresos_descuentos/eliminar',
            'url_buscar'                => base_url() . '/ingresos_descuentos/buscar',
        ];

        return crear_head('Ingresos/Descuentos')
            . crear_body( 
                view('ingresos_descuentos/ingresos_descuentos', $data),
                '',
                crear_breadcrumb('Ingresos/Descuentos', crear_ruta_breadcrumb('ingresos_descuentos')),
                ['ingresos_descuentos/ingresos_descuentos.js']
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
                'NOMBRE_CONCEPTO'       => 'required|string',
                'TIPO'                  => 'required|integer',
                'PREFIJO'               => 'required|string',

            ])) { 
                (new IngresosDescuentosModel())->save([
                    'ID_CODIGO'             => $this->request->getvar('ID_CODIGO'),
                    'ID_TIPO_MOVIMIENTO'    => $this->request->getvar('ID_TIPO_MOVIMIENTO'),
                    'NOMBRE_CONCEPTO'       => $this->request->getVar('NOMBRE_CONCEPTO'),
                    'APLICA_SEGURO'         => $this->request->getVar('APLICA_SEGURO'),
                    'APLICA_AFP'            => $this->request->getVar('APLICA_AFP'),
                    'APLICA_RENTA'          => $this->request->getVar('APLICA_RENTA'),
                    'TIPO'                  => $this->request->getVar('TIPO'),
                    'PREFIJO'               => $this->request->getVar('PREFIJO'), 
                ]);
                $exito = true;
            }
            return $this->data_vista('guardar', $exito);
        }

        return redirect()->to(base_url() . '/ingresos_descuentos');
    }

    public function eliminar()
    {
        if($this->request->getMethod = 'post')
        {
            $exito = false;
            if($this->validate([
                'ID_CODIGO'    => 'required|numeric'
            ])){
                (new IngresosDescuentosModel())->where('ID_CODIGO', $this->request->getVar('ID_CODIGO'))->delete();
                $exito = true;
            }
            return $this->data_vista('eliminar', $exito);
        }
        return redirect()->to(base_url() . '/ingresos_descuentos');
    }

    public function buscar()
    {
        if($this->request->getMethod() == 'post')
        {
            $exito = false;
            $ingresos_descuenntos_buscados = [];
            $termino = '';
            if($this->validate([
                'termino'   => 'required|string'
            ])) {
                $termino = trim($this->request->getVar('termino'));
                if($termino != ''){
                    $ingresos_descuentos_buscados = (new IngresosDescuentosModel())
                                            ->like('ID_TIPO_MOVIMIENTO', $termino)
                                            ->orLike('NOMBRE_CONCEPTO', $termino)
                                            ->orLike('APLICA_SEGURO', $termino)
                                            ->orLike('PREFIJO', $termino)
                                            ->findAll();
                }
                $exito = (count($ingresos_descuentos_buscados) == 0)? false : true;
            }
            return $this->data_vista('buscar', $exito, $ingresos_descuentos_buscados, $termino);
        }
        return redirect()->to(base_url() . '/ingresos_descuentos');
    }
	
}