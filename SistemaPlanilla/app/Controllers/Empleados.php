<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\EmpleadosModel;
use App\Models\AfpsModel;
use App\Models\EstadoEmpleadosModel;
use App\Models\MunicipiosModel;
use App\Models\EstadosCivilModel;
use App\Models\GenerosModel;
use App\Models\ProfesionesModel;
use App\Models\TiposContratacionModel;
use App\Models\PuestosTrabajoModel;
use App\Models\SubSeccionesModel;
use App\Models\TelefonosModel;
use App\Models\DomiciliosModel;



class Empleados extends BaseController
{
    protected $nombre_clase = 'empleados';

    protected function data_vista($operacion = '', $exito = false, $empleados = [], $termino = ''){
        $empleados  = ($empleados == [])? (new EmpleadosModel())->get(): $empleados;
        
        /* var_dump($empleados);
        return; */


        $afps               = (new AfpsModel())->get();
        $estado_empleados   = (new EstadoEmpleadosModel())->get();
        $estados_civil      = (new EstadosCivilModel())->get();
        $generos            = (new GenerosModel())->get();
        $municipios         = (new MunicipiosModel())->get();
        $profesiones        = (new ProfesionesModel())->get();
        $puestos_trabajo    = (new PuestosTrabajoModel())->get();
        $sub_secciones      = (new SubSeccionesModel())->get();
        $tipos_contratacion = (new TiposContratacionModel())->get();

		$data = [
            'afps'               => $afps,
            'afpsModel'          => new AfpsModel(),
            'empleados'          => $empleados,
            'empleadosModel'     => new EmpleadosModel(),
            'estado_empleados'   => $estado_empleados,
            'estadosModel'       => new EstadoEmpleadosModel(),
            'estados_civil'      => $estados_civil,
            'generos'            => $generos,
            'municipios'         => $municipios,
            'profesiones'        => $profesiones,
            'puestos_trabajo'    => $puestos_trabajo,
            'puestoModel'        => new PuestosTrabajoModel(),
            'sub_secciones'      => $sub_secciones,
            'tipos_contratacion' => $tipos_contratacion,
            'cod_empleado'       => $this->get_codigo_empleado(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Empleado',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/empleados/guardar',
			'url_eliminar'  => base_url() . '/empleados/eliminar',
			'url_buscar'    => base_url() . '/empleados/buscar',
		];
		return crear_head('Empleados')
			. crear_body(
				view('empleados/empleados', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Empleados', crear_ruta_breadcrumb('Empleados')),   //breadcrumb
				['empleados/empleados.js']
			);
	}


    public function index()
    {
        return $this->data_vista();
    }

    //--------------------------------------------------------------------
    public function guardar()
    {
        if ($this->request->getMethod() == 'post') {
            $exito = false;
            if ($this->validate([
                'NOMBRE_PRIMERO'     => 'required|string',
                'NOMBRE_SEGUNDO'     => 'string',
                'APELLIDO_PATERNO'   => 'required',
                'APELLIDO_MATERNO'   => 'required',
                'FECHA_NACIMIENTO'   => 'valid_date[Y-m-d]',
                //'DIRECCION'          => 'required',
                'NUMERO_DOCUMENTO'   => 'required',
                'FECHA_EXPEDICION'   => 'valid_date[Y-m-d]',
                'NIT'                => 'required',
                'NUP'                => 'required',
                'NUMERO_ISSS'        => 'required',
                'FECHA_INGRESO'      => 'valid_date[Y-m-d]',
                'FECHA_CONTRATACION' => 'valid_date[Y-m-d]',
                'SALARIO'            => 'numeric',
                'CORREO_ELECTRONICO_PERSONAL'       => 'valid_email',
                'CORREO_ELECTRONICO_INSTITUCIONAL'  => 'valid_email',
                /* 'TELEFONO_MOVIL'     => 'string',
                'TELEFONO'           => 'string', */
                'HORARIO_TRABAJO'    => 'string',

            ])) { 
                $codigo_empleado = ($this->request->getVar('CODIGO_EMPLEADO') != null)? $this->request->getVar('CODIGO_EMPLEADO'): $this->get_codigo_empleado();
                
                (new EmpleadosModel())->save([
                    'ID_EMPLEADO'           => $this->request->getvar('ID_EMPLEADO'),
                    'ID_SUB_SECCION'        => $this->request->getVar('ID_SUB_SECCION'),
                    'ID_ESTADO'             => $this->request->getVar('ID_ESTADO'),
                    'ID_ESTADO_CIVIL'       => $this->request->getVar('ID_ESTADO_CIVIL'),
                    'ID_AFP'                => $this->request->getVar('ID_AFP'),
                    'ID_PUESTO'             => $this->request->getVar('ID_PUESTO'),
                    'ID_GENERO'             => $this->request->getVar('ID_GENERO'),
                    'ID_TIPO_CONTRATACION'  => $this->request->getVar('ID_TIPO_CONTRATACION'),
                    'ID_MUNICIPIO'          => $this->request->getVar('ID_MUNICIPIO'),
                    'ID_PROFESION_OFICIO'   => $this->request->getVar('ID_PROFESION_OFICIO'),
                    'CODIGO_EMPLEADO'       => $codigo_empleado,
                    'NOMBRE_PRIMERO'        => $this->request->getVar('NOMBRE_PRIMERO'),
                    'NOMBRE_SEGUNDO'        => $this->request->getVar('NOMBRE_SEGUNDO'),
                    'APELLIDO_PATERNO'      => $this->request->getVar('APELLIDO_PATERNO'),
                    'APELLIDO_MATERNO'      => $this->request->getVar('APELLIDO_MATERNO'),
                    'FECHA_NACIMIENTO'      => $this->request->getVar('FECHA_NACIMIENTO'),
                    //'DIRECCION'             => $this->request->getVar('DIRECCION'),
                    'NUMERO_DOCUMENTO'      => $this->request->getVar('NUMERO_DOCUMENTO'),
                    'FECHA_EXPEDICION'      => $this->request->getVar('FECHA_EXPEDICION'),
                    'NIT'                   => $this->request->getVar('NIT'),
                    'NUP'                   => $this->request->getVar('NUP'),
                    'NUMERO_ISSS'           => $this->request->getVar('NUMERO_ISSS'),
                    'FECHA_INGRESO'         => $this->request->getVar('FECHA_INGRESO'),
                    'FECHA_CONTRATACION'    => $this->request->getVar('FECHA_CONTRATACION'),
                    'SALARIO'               => $this->request->getVar('SALARIO'),
                    'CORREO_ELECTRONICO_INSTITUCIONAL' => $this->request->getVar('CORREO_ELECTRONICO_INSTITUCIONAL'),
                    'CORREO_ELECTRONICO_PERSONAL'      => $this->request->getVar('CORREO_ELECTRONICO_PERSONAL'),
                    // 'TELEFONO'              => $this->request->getVar('TELEFONO'),
                    // 'TELEFONO_MOVIL'        => $this->request->getVar('TELEFONO_MOVIL'),
                    // 'NIVEL_ESTUDIOS'        => $this->request->getVar('NIVEL_ESTUDIOS'),
                    'NIVEL_ESTUDIOS'        => 'Universidad',
                    'ID_EMPLEADO_JEFE'      => $this->request->getVar('ID_EMPLEADO_JEFE'),
                    'FECHA_RETIRO'          => '',
                    'HORARIO_TRABAJO'       => $this->request->getVar('HORARIO_TRABAJO'),
                    'ID_USUARIO_CREO_EMPLEADO'         => 1,
                    'FECHA_HORA_CREACION_EMPLEADO'     => date('Y-m-d H:i:s'),
                ]);
                $exito = true;
            }
            return $this->data_vista('guardar', $exito);
        }

        return redirect()->to(base_url() . '/empleados');
    }

    public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_EMPLEADO'   => 'required|numeric'
			])) {
                (new TelefonosModel())->where('ID_EMPLEADO', $this->request->getVar('ID_EMPLEADO'))->delete();
                (new DomiciliosModel())->where('ID_EMPLEADO', $this->request->getVar('ID_EMPLEADO'))->delete();
                (new EmpleadosModel())->where('ID_EMPLEADO', $this->request->getVar('ID_EMPLEADO'))->delete();
                $exito = true;
			} 
			return $this->data_vista('eliminar', $exito);
		} 
		return redirect()->to(base_url() . '/empleados');
	}

	public function buscar(){
		if ($this->request->getMethod() == 'post') {
			$exito = false;
            $empleados_buscados = [];
            $termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                $termino = trim($this->request->getVar('termino'));
				if($termino != ''){
                    $array_puestos = (new PuestosTrabajoModel())->buscar($termino);
                    $array_estados = (new EstadoEmpleadosModel())->buscar($termino);

				    $empleados_buscados = (new EmpleadosModel())
                                    ->like('NOMBRE_PRIMERO', $termino)
                                    ->orLike('NOMBRE_SEGUNDO', $termino)
                                    ->orLike('APELLIDO_PATERNO', $termino)
                                    ->orLike('APELLIDO_MATERNO', $termino)
                                    ->orLike('CORREO_ELECTRONICO_INSTITUCIONAL', $termino)
                                    ->orLike('CORREO_ELECTRONICO_PERSONAL', $termino)
                                    ->orWhereIn('ID_PUESTO', $array_puestos)
                                    ->orWhereIn('ID_ESTADO', $array_estados)
									->findAll();
                }
                $exito = (count($empleados_buscados) == 0)? false:true;
            }
			return $this->data_vista('buscar', $exito, $empleados_buscados, $termino);
		}
		return redirect()->to(base_url() . '/empleados');
	}

    protected function get_codigo_empleado()
    {
        $cod_actual = ((new EmpleadosModel())->get_last_empleado())['CODIGO_EMPLEADO'];
        $cod_empleado = strval(intval($cod_actual) + 1);
        $ceros = '';
        for ($i = strlen($cod_empleado); $i < 4; $i++) {
            $ceros = $ceros . '0';
        }
        return $ceros . $cod_empleado;
    }
}
